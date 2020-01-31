<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use Teepluss\Theme\Facades\Theme;
use Illuminate\Http\Request;

use Session;
use Hash;
use DB;

use App\Model\Controller_model;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * The user repository instance. 
     */
    protected $controller_m;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository
     * @return void
     */
    public function __construct(Controller_model $controller_m)
    {
        $this->controller_m =  $controller_m;
    }

    function Login()
    {
        // return Hash::make("admin");
        $theme = Theme::uses('default')->layout('default');
        $theme->setTitle('Parking Logs System | Login');
        return $theme->of('controller.login')->render();
    }

    function ActionLogin(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $user_details = $this->controller_m->verifyLogin($username);


        if ($user_details) {
            if ($user_details->use_status != "active")
                return redirect('login?error=2');

            $check_password = Hash::check($password, $user_details->use_password);
            if ($user_details->ust_id == 2)
                $check_password = $password == $user_details->use_password;

            if ($check_password && $username == $user_details->use_username) {

                session()->put('USER_ID', $user_details->use_id);
                session()->put('USER_NAME', $user_details->use_username);
                $user_full_name = $user_details->usd_lastname . ", " . $user_details->usd_firstname . " " . $user_details->usd_middlename;
                session()->put('USER_FULLNAME', $user_full_name);
                session()->put('USER_TYPE', $user_details->ust_type);
                session()->put('USER_TYPE_ID', $user_details->ust_id);
                session()->put('USER_EMAIL', $user_details->usd_email);
                session()->put('USER_CONTACT', $user_details->usd_contact_number);
                session()->put('USER_STATUS', $user_details->use_status);

                //for avatar of user
                if (file_exists(public_path() . '/img/avatar/' . $user_details->use_id . '/1.jpg')) {
                    session()->put('USER_AVATAR_PATH',  url('public/img/avatar/' . $user_details->use_id . '/1.jpg'));
                } else {
                    session()->put('USER_AVATAR_PATH',  url('public/img/avatar/0/1.jpg'));
                }

                return redirect('home');
            } else {
                return redirect('login?error=1');
            }
        } else {
            return redirect('login?error=1');
        }
    }

    function Home()
    {
        $theme = Theme::uses('main')->layout('default');
        $theme->setTitle('Parking Logs System | Home');
        return $theme->of('controller.home')->render();
    }

    function Logout()
    {
        Session::flush();
        return redirect('login');
    }

    function getParkingStatus()
    {
        return count($this->controller_m->getAllOngoingAttendanceLog()) . "/" . $this->controller_m->getParkingCount();
    }

    function getOngoingOccupants()
    {
        return $this->controller_m->getOngoingOccupants();
    }

    function getPendingReservation()
    {
        return $this->controller_m->getAllPendingReservations();
    }

    function getQueuedReservationCount()
    {
        return count($this->controller_m->getAllPendingReservations());
    }

    function getOccupantQueueNumber()
    {
        $reservation_list = $this->getPendingReservation();

        $ctr = 1;
        foreach ($reservation_list as $rsv) {
            if ($rsv->occ_user_id == Session('USER_ID')) {
                return array(
                    "ctr" => $ctr,
                    "rsv_id" => $rsv->rsv_id,
                );
            }
            $ctr++;
        }
        return array(
            "ctr" => 0,
            "rsv_id" => 0,
        );
    }

    function reserveSlot(Request $request)
    {
        DB::beginTransaction();

        $id = Session::get('USER_ID');
        $status = Session::get('USER_STATUS');

        $occupant_details = $this->controller_m->getOccupantDetails($id);
        $occ_id = $occupant_details->occ_id;

        if (count($this->controller_m->getOccupantOngoingAttendance($occ_id)) > 0)
            return 'occupant_ongoing_attendance_exist';

        if (count($this->controller_m->getAllOngoingAttendanceLog()) < $this->controller_m->getParkingCount())
            return 'reservation_invalid_not_full';

        if ($status != "active")
            return 'occupant_deactivated';

        if (count($this->controller_m->getOccupantPendingReservation($occ_id)) > 0)
            return 'occupant_reservation_exist';

        try {
            $reservation = array(
                "rsv_occupant_id" => $occ_id,
                "rsv_datetime" => date('Y-m-d H:i:s'),
                "created_at" => date('Y-m-d H:i:s'),
                "created_by" => Session::get('USER_ID'),
            );
            $this->controller_m->saveReservation($reservation);

            DB::commit();
            return 'success_reservation';
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
            return 'error_reservation';
        }
    }

    function cancelReservation(Request $request)
    {
        DB::beginTransaction();
        $rsv_id = $request->id;

        try {
            $details = array(
                "rsv_status" => "cancelled",
                "modified_at" => date('Y-m-d H:i:s'),
                "created_by" => Session::get('USER_ID'),
            );
            $this->controller_m->updateReservation($details, $rsv_id);

            DB::commit();
            return 'success_cancellation';
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
            return 'error_cancellation';
        }
    }
}
