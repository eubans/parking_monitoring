<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use Teepluss\Theme\Facades\Theme;
use Illuminate\Http\Request;

use DB;
use QrCode;
use Session;
use Illuminate\Support\Str;
use Hash;

use App\Model\Occupant_model;
use App\Http\Controllers\GlobalController;

class Occupant extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * The user repository instance. 
     */
    protected $occupant_m;
    protected $global_c;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository
     * @return void
     */
    public function __construct(Occupant_model $occupant_m, GlobalController $global_c)
    {
        $this->occupant_m =  $occupant_m;
        $this->global_c =  $global_c;
    }

    function List()
    {
        $occupants = $this->occupant_m->getAllOccupants();

        $data = array(
            'occupants' => $occupants,
        );

        $theme = Theme::uses('main')->layout('default');
        $theme->setTitle('Parking Monitoring | Occupant List');
        return $theme->of('occupant.list', $data)->render();
    }

    function Registration()
    {
        $occupant_type = $this->occupant_m->getAllOccupantType();

        $data = array(
            'occupant_type' => $occupant_type,
        );

        $theme = Theme::uses('main')->layout('default');
        $theme->setTitle('Parking Monitoring | Occupant');
        return $theme->of('occupant.registration', $data)->render();
    }

    function Registration_Save(Request $request)
    {
        DB::beginTransaction();
        $occ_id = $request->id;

        try {
            if ($occ_id == null) {
                $use_id = null;
                if ($request->occupant_type != 3) {
                    $occupant_account = array(
                        "use_username" => $request->email,
                        "use_password" => Str::random(8),
                        "use_user_type" => 2,
                    );
                    $use_id = $this->occupant_m->saveOccupantAccount($occupant_account);
                }

                $occupant_details = array(
                    "occ_lastname" => $request->lastname,
                    "occ_firstname" => $request->firstname,
                    "occ_middlename" => $request->middlename,
                    "occ_date_of_birth" => $request->birth_date,
                    "occ_email_address" => $request->email,
                    "occ_student_number" => $request->student_number,
                    "occ_course" => $request->course,
                    "occ_address" => $request->address,
                    "occ_telephone" => $request->telephone,
                    "occ_phone_number" => $request->phone_number,
                    "occ_qr_code" => sha1(time()),
                    "occ_user_id" => $use_id,
                    "occ_type" => $request->occupant_type,
                    "created_at" => date('Y-m-d H:i:s'),
                    "created_by" => Session::get('USER_ID'),
                );
                $occ_id = $this->occupant_m->saveOccupant($occupant_details);

                $occupant_guardian = array(
                    "ocg_occupant_id" => $occ_id,
                    "ocg_name" => $request->guardian_name,
                    "ocg_occupation" => $request->guardian_occupation,
                    "ocg_contact" => $request->guardian_contact,
                );
                $this->occupant_m->saveOccupantGuardian($occupant_guardian);

                $occupant_motorcycle = array(
                    "omi_occupant_id" => $occ_id,
                    "omi_or_number" => $request->or_number,
                    "omi_cr_number" => $request->cr_number,
                    "omi_plate_number" => $request->plate_number,
                    "omi_brand" => $request->brand,
                    "omi_model" => $request->model,
                );
                $this->occupant_m->saveOccupantMotorcycle($occupant_motorcycle);
            } else {
                $occupant_details = array(
                    "occ_lastname" => $request->lastname,
                    "occ_firstname" => $request->firstname,
                    "occ_middlename" => $request->middlename,
                    "occ_date_of_birth" => $request->birth_date,
                    "occ_email_address" => $request->email,
                    "occ_course" => $request->course,
                    "occ_address" => $request->address,
                    "occ_telephone" => $request->telephone,
                    "occ_phone_number" => $request->phone_number,
                    "modified_at" => date('Y-m-d H:i:s'),
                    "created_by" => Session::get('USER_ID'),
                );
                $this->occupant_m->updateOccupant($occupant_details, $occ_id);

                $occupant_guardian = array(
                    "ocg_name" => $request->guardian_name,
                    "ocg_occupation" => $request->guardian_occupation,
                    "ocg_contact" => $request->guardian_contact,
                );
                $this->occupant_m->updateOccupantGuardian($occupant_guardian, $occ_id);

                $occupant_motorcycle = array(
                    "omi_or_number" => $request->or_number,
                    "omi_cr_number" => $request->cr_number,
                    "omi_plate_number" => $request->plate_number,
                    "omi_brand" => $request->brand,
                    "omi_model" => $request->model,
                );
                $this->occupant_m->updateOccupantMotorcycle($occupant_motorcycle, $occ_id);
            }

            DB::commit();
            return redirect('occupant/profile?id=' . $occ_id)->with('status', 'success_save');
        } catch (\Exception $e) {
            DB::rollback();
            // return $e;
            return redirect()->back()->with('status', 'error_save')->withInput();
        }
    }

    function getOccupantProfile(Request $request)
    {
        $details = $this->occupant_m->getOccupantProfile($request->id);
        return json_encode(array(
            'details' => $details,
            'qr_code' => $this->global_c->Render_QR($details->occ_qr_code, 200, 'svg', 5),
        ));
    }

    function Occupant_Change_Status(Request $request)
    {
        DB::beginTransaction();
        $id = $request->id;
        $new_status = "active";

        if ($request->status == "active")
            $new_status = "deactivated";

        $ongoing_ctr = $this->occupant_m->getOccupantOngoingLog($id);
        if (count($ongoing_ctr) > 0) {
            DB::rollback();
            return redirect()->back()->with('status', 'error_ongoing_log')->withInput();
        }

        try {
            $this->occupant_m->updateOccupant(array(
                "occ_account_status" => $new_status,
                "modified_at" => date('Y-m-d H:i:s'),
                "created_by" => Session::get('USER_ID'),
            ), $id);

            DB::commit();
            return redirect('occupant/profile?id=' . $id)->with('status', 'success_change_status');
        } catch (\Exception $e) {
            DB::rollback();
            // return $e;
            return redirect()->back()->with('status', 'error_change_status')->withInput();
        }
    }

    function Attendance_Logs()
    {
        $logs = $this->occupant_m->getAllOccupantLogs();

        if (Session::get('USER_TYPE_ID') == 2) {
            $logs = $this->occupant_m->getOccupantLogs(Session::get('USER_ID'));
        }

        $data = array(
            'logs' => $logs,
        );

        $theme = Theme::uses('main')->layout('default');
        $theme->setTitle('Parking Monitoring | Attendance Logs');
        return $theme->of('occupant.attendance_logs', $data)->render();
    }

    function Occupant_Change_Login(Request $request)
    {
        DB::beginTransaction();
        $id = $request->use_id;
        $occ_id = $request->occ_id;
        $new_status = "active";


        if ($request->login == "active")
            $new_status = "deactivated";

        $ongoing_ctr = $this->occupant_m->getOccupantOngoingLog($id);
        if (count($ongoing_ctr) > 0) {
            DB::rollback();
            return redirect()->back()->with('status', 'error_ongoing_log')->withInput();
        }

        try {
            $this->occupant_m->updateUser(array(
                "use_status" => $new_status,
            ), $id);

            DB::commit();
            return redirect('occupant/profile?id=' . $occ_id)->with('status', 'success_change_login');
        } catch (\Exception $e) {
            DB::rollback();
            // return $e;
            return redirect()->back()->with('status', 'error_change_login')->withInput();
        }
    }
}
