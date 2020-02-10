<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use Teepluss\Theme\Facades\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

use Session;
use Hash;
use DB;

use App\Model\Controller_model;
use App\Http\Controllers\GlobalController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * The user repository instance. 
     */
    protected $controller_m;
    protected $global_c;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository
     * @return void
     */
    public function __construct(Controller_model $controller_m, GlobalController $global_c)
    {
        $this->controller_m =  $controller_m;
        $this->global_c =  $global_c;
    }

    function Login()
    {
        //CHECK IF THERES SESSION ON LOGIN
        $username = Session::get('USER_NAME');
        $password = Session::get('USER_PASS');
        $user_details = $this->controller_m->verifyLogin($username);

        if ($user_details != null) {
            $check_password = Hash::check($password, $user_details->use_password);
            if ($user_details->ust_id == 2)
                $check_password = $password == $user_details->use_password;

            if ($check_password) {
                if (Session::get('USER_STATUS') === "active") {
                    return redirect('home');
                }
            }
        }

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
                session()->put('USER_PASS', $password);
                $user_full_name = $user_details->usd_lastname . ", " . $user_details->usd_firstname . " " . $user_details->usd_middlename;
                session()->put('USER_FULLNAME', $user_full_name);
                session()->put('USER_TYPE', $user_details->ust_type);
                session()->put('USER_TYPE_ID', $user_details->ust_id);
                session()->put('USER_EMAIL', $user_details->usd_email);
                session()->put('USER_CONTACT', $user_details->usd_contact_number);
                session()->put('USER_STATUS', $user_details->use_status);

                session()->put('BASE_URL', url('/'));
                session()->put('USER_URL_ACCESS', json_encode($this->global_c->Get_User_Access($user_details->ust_id)));

                session()->put('PARKING_SLOT_COUNT', $this->controller_m->getGlobalVariable("PARKING_SLOT_COUNT"));
                session()->put('PARKING_LOT_CLOSING_TIME', $this->controller_m->getGlobalVariable("PARKING_LOT_CLOSING_TIME"));
                session()->put('ENABLE_EMAIL', $this->controller_m->getGlobalVariable("ENABLE_EMAIL"));
                session()->put('ENABLE_SMS', $this->controller_m->getGlobalVariable("ENABLE_SMS"));

                session()->put('SUPER_ADMIN_EMAIL', $this->controller_m->getSuperAdminDetails()->usd_email);

                if ($user_details->ust_id == 2) {
                    $occ_id = $this->controller_m->getOccupantDetails(Session::get('USER_ID'))->occ_id;
                    if (file_exists(public_path() . '/img/occupant/' . $occ_id . '.png')) {
                        session()->put('USER_AVATAR_PATH',  url('public/img/occupant/' . $occ_id . '.png'));
                    } else {
                        session()->put('USER_AVATAR_PATH',  url('public/img/avatar/0/1.jpg'));
                    }
                } else {
                    if (file_exists(public_path() . '/img/avatar/' . $user_details->use_id . '/1.jpg')) {
                        session()->put('USER_AVATAR_PATH',  url('public/img/avatar/' . $user_details->use_id . '/1.jpg'));
                    } else {
                        session()->put('USER_AVATAR_PATH',  url('public/img/avatar/0/1.jpg'));
                    }
                }
                if (session()->exists('EXTERNAL_GO_TO_URL')) {
                    $go_to_url = Session('EXTERNAL_GO_TO_URL');
                    session()->forget('EXTERNAL_GO_TO_URL');
                    return redirect($go_to_url);
                } else {
                    return redirect('home');
                }
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

    function getOngoingIncidentReports()
    {
        return $this->controller_m->getAllOngoingIncidentReports();
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

        $occupant_details = $this->controller_m->getOccupantDetails($id);
        $status = $occupant_details->occ_account_status;
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

    function Forgot_Password()
    {
        $theme = Theme::uses('default')->layout('default');
        $theme->setTitle('Parking Logs System | Forgot Password');
        return $theme->of('controller.forgot-password')->render();
    }

    function Send_Verification_Code(Request $request)
    {

        $email = $request->email;
        $result = $this->controller_m->validateEmail($email);
        if (count($result) == 0)
            $result = $this->controller_m->validateOccupantEmail($email);

        if (count($result) > 0) {
            // TODO: send email and stuffs
            $verificationCode = sprintf("%06d", mt_rand(1, 999999));
            Session::put('VER_EMAIL', $email);
            Session::put('VER_CODE', md5($verificationCode));

            $obj_parameter = new \stdClass();
            $obj_parameter->subject = "IETI Parking Logs System: Verification Code";
            $obj_parameter->email = $email;
            $obj_parameter->code = $verificationCode;
            $obj_parameter->template = 'mails.verification-code-email';
            $obj_parameter->plain_template = 'mails.verification-code-email';

            try {
                Mail::to($email)->send(new SendMail($obj_parameter));
            } catch (\Exception $e) {
                $error_mail = "Verification timeout exceeded please reload page";
                return redirect('forgot-password/code-verification')->with(['status' => 'invalid_email', 'error_msg' => $error_mail]);
            }
            return redirect('forgot-password/code-verification')->with('status', 'email_sent');
        } else {
            return redirect()->back()->with('status', 'emailnotexist')->withInput();
        }
    }

    function updateVerificationCode(Request $request)
    {
        $email = $request->email;
        $result = $this->controller_m->validateEmail($email);

        if (count($result) > 0) {
            // TODO: send email and stuffs
            $verificationCode = sprintf("%06d", mt_rand(1, 999999));
            Session::put('VER_EMAIL', $email);
            Session::put('VER_CODE', md5($verificationCode));

            $obj_parameter = new \stdClass();
            $obj_parameter->subject = "Parking Logs System: Verification Code";
            $obj_parameter->email = $email;
            $obj_parameter->code = $verificationCode;
            $obj_parameter->template = 'mails.verification-code-email';
            $obj_parameter->plain_template = 'mails.verification-code-email';

            try {
                Mail::to($email)->send(new SendMail($obj_parameter));
            } catch (\Exception $e) {
                return $e;
                $error_mail = "Verification timeout exceeded please reload page";
                return redirect('code-verification')->with(['status' => 'invalid_email', 'error_msg' => $error_mail]);
            }

            // @TODO: Send associative array here vercode and email
            return md5($verificationCode);
            exit;
        } else {
            return redirect()->back()->with('status', 'emailnotexist')->withInput();
        }
    }

    function Verify_Code()
    {
        $theme = Theme::uses('default')->layout('default');
        $theme->setTitle('Parking Logs System | Verify Code');
        return $theme->of('controller.code-verification')->render();
    }

    function Change_Password(Request $request)
    {
        $email = $request->eax;
        if ($email === "") {
            $email = Session::get('VER_EMAIL');
        }

        $code = $request->qcs;
        if ($code === "") {
            $code = Session::get('VER_CODE');
        }

        $result = $this->controller_m->getUsernameFromEmail($email);
        if (count($result) == 0)
            $result = $this->controller_m->getOccupantUsernameFromEmail($email);

        $data = array(
            'account' => $result[0],
            'code' => $code
        );
        $theme = Theme::uses('default')->layout('default');
        $theme->setTitle('Parking Logs System | Change Password');
        return $theme->of('controller.change-password', $data)->render();
    }

    function Change_Password_Save(Request $request)
    {
        DB::beginTransaction();

        $account = $request->account;
        $new_password = $request->new_password;
        $confirm_password = $request->confirm_password;

        if (($new_password != null && $confirm_password != null) && $new_password != $confirm_password)
            return redirect()->back()->with('status', 'error_password_not_match')->withInput();

        try {
            if ($new_password != null && $confirm_password != null) {
                $user = array();
                if ($this->controller_m->verifyLogin($account)->use_user_type == 2)
                    $user = array(
                        "use_password" => $new_password,
                    );
                else
                    $user = array(
                        "use_password" => Hash::make($new_password),
                    );
                $this->controller_m->updatePassword($user, $account);
            }

            DB::commit();
            return redirect('login?status=cp');
        } catch (\Exception $e) {
            DB::rollback();
            // return $e;
            return redirect()->back()->with('status', 'error_save')->withInput();
        }
    }

    function getOccupantProfile(Request $request)
    {
        $details = $this->controller_m->getOccupantDetails(Session::get('USER_ID'));
        return json_encode(array(
            'details' => $details,
            'qr_code' => $this->global_c->Render_QR($details->occ_qr_code, 180, 'svg', 2),
            'qr_sticker_code' => $this->global_c->Render_QR($details->occ_qr_code, 180, 'svg', 2),
        ));
    }

    function Closing_SMS_Blast()
    {
        $obj_details = array();
        foreach ($this->controller_m->getOngoingOccupants() as $value) {
            $values = new \stdClass();
            $values->name = $value->occ_firstname;
            $values->phone_number = $value->occ_phone_number;
            $obj_details[] = $values;
        }
        $status = $this->global_c->Send_Closing_SMS_Blast($obj_details);
        if ($status == "success")
            return redirect()->back()->with('status', 'success_sms_blast');
        else
            return redirect()->back()->with('status', 'error_sms_blast');
    }
}
