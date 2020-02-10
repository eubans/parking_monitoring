<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use Teepluss\Theme\Facades\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

use DB;
use QrCode;
use Session;
use Illuminate\Support\Str;
use Hash;
use Image;

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
        $theme->setTitle('Parking Logs System | Occupant List');
        return $theme->of('occupant.list', $data)->render();
    }

    function Registration()
    {
        $occupant_type = $this->occupant_m->getAllOccupantType();

        $data = array(
            'occupant_type' => $occupant_type,
        );

        $theme = Theme::uses('main')->layout('default');
        $theme->setTitle('Parking Logs System | Occupant');
        return $theme->of('occupant.registration', $data)->render();
    }

    function Registration_Save(Request $request)
    {
        DB::beginTransaction();
        $occ_id = $request->id;

        $details = $this->occupant_m->checkOccupantUsername($request->email);
        if (count($details) > 0) {
            if ($occ_id == "") {
                return redirect()->back()->with('status', 'error_username_taken')->withInput();
            } else {
                if ($occ_id != $details->occ_id)
                    return redirect()->back()->with('status', 'error_username_taken')->withInput();
            }
        }

        try {
            if ($occ_id == null) {
                $use_id = null;
                if ($request->occupant_type != 3) {
                    $password = Str::random(8);
                    $occupant_account = array(
                        "use_username" => $request->email,
                        "use_password" => $password,
                        "use_user_type" => 2,
                    );
                    $use_id = $this->occupant_m->saveOccupantAccount($occupant_account);

                    if ($this->global_c->Get_Global_Variable('ENABLE_EMAIL') == 1) {
                        // email sending for new user start
                        $obj_parameter = new \stdClass();
                        $obj_parameter->subject = "IETI Parking Logs System: User Credentials";
                        $obj_parameter->fullname = $request->lastname . ", " . $request->firstname . " " . (($request->occ_middlename == "") ? "" : strtoupper($request->middlename[0]) . ".");
                        $obj_parameter->username = $request->email;
                        $obj_parameter->password = $password;
                        $obj_parameter->template = 'mails.new-user-created-email';
                        $obj_parameter->plain_template = 'mails.new-user-created-email';

                        try {
                            Mail::to($request->email)->send(new SendMail($obj_parameter));
                        } catch (\Exception $e) {
                            // return $e;
                            DB::rollback();
                            return redirect()->back()->with('status', 'invalid_email')->withInput();
                        }
                        // end
                    }
                }

                $occupant_details = array(
                    "occ_lastname" => ucfirst($request->lastname),
                    "occ_firstname" => ucfirst($request->firstname),
                    "occ_middlename" => ucfirst($request->middlename),
                    "occ_date_of_birth" => $request->birth_date,
                    "occ_email_address" => $request->email,
                    "occ_student_number" => $request->student_number,
                    "occ_course" => $request->course,
                    "occ_address" => ucwords($request->address),
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
                    "ocg_name" => ucwords($request->guardian_name),
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
                    "occ_lastname" => ucfirst($request->lastname),
                    "occ_firstname" => ucfirst($request->firstname),
                    "occ_middlename" => ucfirst($request->middlename),
                    "occ_date_of_birth" => $request->birth_date,
                    "occ_email_address" => $request->email,
                    "occ_course" => $request->course,
                    "occ_address" => ucwords($request->address),
                    "occ_telephone" => $request->telephone,
                    "occ_phone_number" => $request->phone_number,
                    "modified_at" => date('Y-m-d H:i:s'),
                    "created_by" => Session::get('USER_ID'),
                );
                $this->occupant_m->updateOccupant($occupant_details, $occ_id);

                $occupant_guardian = array(
                    "ocg_name" => ucwords($request->guardian_name),
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

            $photo_name = $occ_id . '.' . explode('/', explode(':', substr(
                $request->base64_image,
                0,
                strpos($request->base64_image, ';')
            ))[1])[1];
            Image::make($request->base64_image)->save(public_path('img/occupant/') . $photo_name);

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
            'qr_code' => $this->global_c->Render_QR($details->occ_qr_code, 180, 'svg', 2),
            'qr_sticker_code' => $this->global_c->Render_QR($details->occ_qr_code, 180, 'svg', 2),
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

        $details = $this->occupant_m->getOccupantProfile($id);

        try {
            $this->occupant_m->updateOccupant(array(
                "occ_account_status" => $new_status,
                "modified_at" => date('Y-m-d H:i:s'),
                "created_by" => Session::get('USER_ID'),
            ), $id);

            if ($this->global_c->Get_Global_Variable('ENABLE_EMAIL') == 1) {
                // email sending start
                $obj_parameter = new \stdClass();
                $obj_parameter->subject = "IETI Parking Logs System: Occupant Account Status - " . ucfirst($new_status);
                $obj_parameter->status = $new_status;
                $obj_parameter->template = 'mails.toggle-occupant-status-email';
                $obj_parameter->plain_template = 'mails.toggle-occupant-status-email';

                try {
                    Mail::to($details->occ_email_address)->send(new SendMail($obj_parameter));
                } catch (\Exception $e) {
                    // return $e;
                    DB::rollback();
                    return redirect()->back()->with('status', 'change_occupant_status_invalid_email')->withInput();
                }
                // end
            }

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
        $theme->setTitle('Parking Logs System | Attendance Logs');
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

        $details = $this->occupant_m->getOccupantProfile($occ_id);

        try {
            $this->occupant_m->updateUser(array(
                "use_status" => $new_status,
            ), $id);

            if ($this->global_c->Get_Global_Variable('ENABLE_EMAIL') == 1) {
                // email sending start
                $obj_parameter = new \stdClass();
                $obj_parameter->subject = "IETI Parking Logs System: Login Access Status - " . ucfirst($new_status);
                $obj_parameter->status = $new_status;
                $obj_parameter->template = 'mails.toggle-user-status-email';
                $obj_parameter->plain_template = 'mails.toggle-user-status-email';

                try {
                    Mail::to($details->occ_email_address)->send(new SendMail($obj_parameter));
                } catch (\Exception $e) {
                    // return $e;
                    DB::rollback();
                    return redirect()->back()->with('status', 'change_status_invalid_email')->withInput();
                }
                // end
            }

            DB::commit();
            return redirect('occupant/profile?id=' . $occ_id)->with('status', 'success_change_login');
        } catch (\Exception $e) {
            DB::rollback();
            // return $e;
            return redirect()->back()->with('status', 'error_change_login')->withInput();
        }
    }
}
