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

use DB;
use QrCode;
use Session;
use Hash;
use DateTime;

use App\Model\Settings_model;
use App\Http\Controllers\GlobalController;

class Settings extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * The user repository instance. 
     */
    protected $settings_m;
    protected $global_c;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository
     * @return void
     */
    public function __construct(Settings_model $settings_m, GlobalController $global_c)
    {
        $this->settings_m =  $settings_m;
        $this->global_c =  $global_c;
    }

    function Global_Variables()
    {
        $closing_time = substr_replace($this->global_c->Get_Global_Variable('PARKING_LOT_CLOSING_TIME'), ":", 2, 0);

        $data = array(
            'parking_slot' => $this->global_c->Get_Global_Variable('PARKING_SLOT_COUNT'),
            'reservation_time_limit' => $this->global_c->Get_Global_Variable('RESERVATION_TIME_LIMIT'),
            'parking_closing_time' => date_format(new DateTime($closing_time), "g:i A"),
            'enable_email' => $this->global_c->Get_Global_Variable('ENABLE_EMAIL'),
            'enable_sms' => $this->global_c->Get_Global_Variable('ENABLE_SMS'),
            'enable_automatic_closing_sms_blast' => $this->global_c->Get_Global_Variable('ENABLE_AUTOMATIC_CLOSING_SMS_BLAST'),
            'enable_automatic_disabling_of_guest' => $this->global_c->Get_Global_Variable('ENABLE_AUTOMATIC_DISABLING_OF_GUEST'),
        );

        $theme = Theme::uses('main')->layout('default');
        $theme->setTitle('Parking Logs System | Settings Global Variables');
        return $theme->of('settings.global-variables', $data)->render();
    }

    function Global_Variables_Save(Request $request)
    {
        DB::beginTransaction();
        $parking_slot = $request->parking_slot;
        $reservation_time_limit = $request->reservation_time_limit;
        $parking_closing_time = $request->parking_closing_time;
        $enable_email = $request->enable_email;
        $enable_sms = $request->enable_sms;
        $enable_automatic_closing_sms_blast = $request->enable_automatic_closing_sms_blast;
        $enable_automatic_disabling_of_guest = $request->enable_automatic_disabling_of_guest;

        $parking_closing_time = str_replace(":", "", date_format(new DateTime($parking_closing_time), "H:i"));

        if (count($this->settings_m->getAllOngoingAttendanceLog()) > $parking_slot)
            return redirect('settings/global-variables')->with('status', 'error_invalid_parking_slot');

        try {
            $global_variables = array(
                "glv_value" => $parking_slot,
                "modified_at" => date('Y-m-d H:i:s'),
                "created_by" => Session::get('USER_ID'),
            );
            $this->settings_m->updateGlobalVariables($global_variables, "PARKING_SLOT_COUNT");

            $global_variables = array(
                "glv_value" => $parking_closing_time,
                "modified_at" => date('Y-m-d H:i:s'),
                "created_by" => Session::get('USER_ID'),
            );
            $this->settings_m->updateGlobalVariables($global_variables, "PARKING_LOT_CLOSING_TIME");

            $global_variables = array(
                "glv_value" => $reservation_time_limit,
                "modified_at" => date('Y-m-d H:i:s'),
                "created_by" => Session::get('USER_ID'),
            );
            $this->settings_m->updateGlobalVariables($global_variables, "RESERVATION_TIME_LIMIT");

            $global_variables = array(
                "glv_value" => $enable_email,
                "modified_at" => date('Y-m-d H:i:s'),
                "created_by" => Session::get('USER_ID'),
            );
            $this->settings_m->updateGlobalVariables($global_variables, "ENABLE_EMAIL");

            $global_variables = array(
                "glv_value" => $enable_sms,
                "modified_at" => date('Y-m-d H:i:s'),
                "created_by" => Session::get('USER_ID'),
            );
            $this->settings_m->updateGlobalVariables($global_variables, "ENABLE_SMS");

            $global_variables = array(
                "glv_value" => $enable_automatic_closing_sms_blast,
                "modified_at" => date('Y-m-d H:i:s'),
                "created_by" => Session::get('USER_ID'),
            );
            $this->settings_m->updateGlobalVariables($global_variables, "ENABLE_AUTOMATIC_CLOSING_SMS_BLAST");

            $global_variables = array(
                "glv_value" => $enable_automatic_disabling_of_guest,
                "modified_at" => date('Y-m-d H:i:s'),
                "created_by" => Session::get('USER_ID'),
            );
            $this->settings_m->updateGlobalVariables($global_variables, "ENABLE_AUTOMATIC_DISABLING_OF_GUEST");

            DB::commit();
            return redirect('settings/global-variables')->with('status', 'success_save');
        } catch (\Exception $e) {
            DB::rollback();
            // return $e;
            return redirect()->back()->with('status', 'error_save')->withInput();
        }
    }

    function User_List()
    {
        $users = $this->settings_m->getAdminAttendantUsers();

        $data = array(
            'users' => $users,
        );

        $theme = Theme::uses('main')->layout('default');
        $theme->setTitle('Parking Logs System | Settings Adminitrator List');
        return $theme->of('settings.user-list', $data)->render();
    }

    function User()
    {
        $theme = Theme::uses('main')->layout('default');
        $theme->setTitle('Parking Logs System | Settings User Set-up');
        return $theme->of('settings.user')->render();
    }

    function User_Save(Request $request)
    {
        DB::beginTransaction();

        $use_id = $request->id;

        $user_type = $request->user_type;

        $username = $request->username;
        $password = $request->password;
        $confirm_password = $request->confirm_password;
        $lastname = $request->lastname;
        $firstname = $request->firstname;
        $middlename = $request->middlename;
        $email = $request->email;
        $phone_number = $request->phone_number;

        if (($password != null && $confirm_password != null) && $password != $confirm_password)
            return redirect()->back()->with('status', 'error_password_not_match')->withInput();

        if (count($this->settings_m->checkUsername($username)) > 0 && $use_id == null)
            return redirect()->back()->with('status', 'error_username_taken')->withInput();

        try {
            if ($use_id == null) {
                $user = array(
                    "use_username" => $username,
                    "use_password" => Hash::make($password),
                    "use_user_type" => $user_type,
                );
                $use_id = $this->settings_m->saveUser($user);

                $user_details = array(
                    "usd_user_id" => $use_id,
                    "usd_firstname" => ucfirst($firstname),
                    "usd_lastname" => ucfirst($lastname),
                    "usd_middlename" => ucfirst($middlename),
                    "usd_email" => $email,
                    "usd_contact_number" => $phone_number,
                    "created_at" => date('Y-m-d H:i:s'),
                    "created_by" => Session::get('USER_ID'),
                );
                $this->settings_m->saveUserDetails($user_details);

                if ($this->global_c->Get_Global_Variable('ENABLE_EMAIL') == 1) {
                    // email sending start
                    $obj_parameter = new \stdClass();
                    $obj_parameter->subject = "IETI Parking Logs System: User Credentials";
                    $obj_parameter->fullname = $lastname . ", " . $firstname . " " . (($middlename == "") ? "" : strtoupper($middlename[0]) . ".");
                    $obj_parameter->username = $username;
                    $obj_parameter->password = $password;
                    $obj_parameter->template = 'mails.new-user-created-email';
                    $obj_parameter->plain_template = 'mails.new-user-created-email';

                    try {
                        Mail::to($email)->send(new SendMail($obj_parameter));
                    } catch (\Exception $e) {
                        // return $e;
                        DB::rollback();
                        return redirect()->back()->with('status', 'invalid_email')->withInput();
                    }
                    // end
                }
            } else {
                if (($password != null && $confirm_password != null)) {
                    $user = array(
                        "use_password" => Hash::make($password),
                    );
                    $this->settings_m->updateUser($user, $use_id);
                }

                $user_details = array(
                    "usd_firstname" => ucfirst($firstname),
                    "usd_lastname" => ucfirst($lastname),
                    "usd_middlename" => ucfirst($middlename),
                    "usd_email" => $email,
                    "usd_contact_number" => $phone_number,
                    "modified_at" => date('Y-m-d H:i:s'),
                    "created_by" => Session::get('USER_ID'),
                );
                $this->settings_m->updateUserDetails($user_details, $use_id);
            }

            DB::commit();
            return redirect('settings/user?id=' . $use_id)->with('status', 'success_save');
        } catch (\Exception $e) {
            DB::rollback();
            // return $e;
            return redirect()->back()->with('status', 'error_save')->withInput();
        }
    }

    function getAdminitratorDetails(Request $request)
    {
        $details = $this->settings_m->getUserAdminAttendantDetails($request->id);
        return json_encode($details);
    }

    function User_Settings()
    {
        $details = $this->settings_m->getUserDetails(Session::get('USER_ID'));

        $data = array(
            "user" => $details
        );

        $theme = Theme::uses('main')->layout('default');
        $theme->setTitle('Parking Logs System | User Settings');
        return $theme->of('settings.user-login-settings', $data)->render();
    }

    function User_Settings_Save(Request $request)
    {
        DB::beginTransaction();

        $use_id = Session::get('USER_ID');

        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $confirm_password = $request->confirm_password;

        $lastname = $request->lastname;
        $firstname = $request->firstname;
        $middlename = $request->middlename;
        $email = $request->email;
        $phone_number = $request->phone_number;

        $user_details = $this->settings_m->getUserDetails($use_id);

        $checkPassword = Hash::check($old_password, $user_details->use_password);

        if (Session::get('USER_TYPE_ID') == 2)
            $checkPassword = $old_password == $user_details->use_password;

        if (!$checkPassword && ($new_password != null && $confirm_password != null && $old_password != null))
            return redirect()->back()->with('status', 'error_invalid_old_password')->withInput();

        if (($new_password != null && $confirm_password != null && $old_password != null) && $new_password != $confirm_password)
            return redirect()->back()->with('status', 'error_password_not_match')->withInput();

        try {
            if (($new_password != null && $confirm_password != null && $old_password != null)) {

                if (Session::get('USER_TYPE_ID') != 2)
                    $new_password = Hash::make($new_password);

                $user = array(
                    "use_password" => $new_password,
                );
                $this->settings_m->updateUser($user, $use_id);
            }

            if (($firstname != null && $lastname != null && $email != null && $phone_number != null) && Session::get('USER_TYPE_ID') != 2) {
                $user_details = array(
                    "usd_firstname" => ucfirst($firstname),
                    "usd_lastname" => ucfirst($lastname),
                    "usd_middlename" => ucfirst($middlename),
                    "usd_email" => $email,
                    "usd_contact_number" => $phone_number,
                );
                $this->settings_m->updateUserDetails($user_details, $use_id);
            }

            DB::commit();
            return redirect('user-settings')->with('status', 'success_save');
        } catch (\Exception $e) {
            DB::rollback();
            // return $e;
            return redirect()->back()->with('status', 'error_save')->withInput();
        }
    }

    function uploadAvatar(Request $request)
    {
        $user_id = Session::get('USER_ID');

        DB::beginTransaction();

        $file = $request->file('imageUpload');

        $file_name = $file->getClientOriginalName();
        $file_extension = $file->getClientOriginalExtension();
        $file_real_path = $file->getRealPath();
        $file_size = $file->getSize();
        $file_mime_type = $file->getMimeType();
        $file_path = url('/public') . '/img/avatar';

        try {

            $uploadSuccess = $file->move(public_path() . '/img/avatar/' . $user_id, '/1.jpg'); //1 is for Avatar
            if ($uploadSuccess) {
                session()->put('USER_AVATAR_PATH',  url('public/img/avatar/' . $user_id . '/1.jpg'));
                error_log("Destination: $file_path");
                error_log("Filename: $file");
                error_log("Extension: " . $file->getClientOriginalExtension());
                error_log("Original name: " . $file->getClientOriginalName());
                error_log("Real path: " . $file->getRealPath());
            } else {
                error_log("Error moving file: " . $file->getClientOriginalName());
                return "Error moving file: " . $file->getClientOriginalName();
            }

            DB::commit();
            return url('public/img/avatar/' . $user_id . '/1.jpg?');
        } catch (\Exception $e) {
            DB::rollback();
            // return $e;
        }
    }

    function User_Change_Status(Request $request)
    {
        DB::beginTransaction();
        $id = $request->use_id;
        $new_status = "active";

        if ($request->status == "active")
            $new_status = "deactivated";

        $details = $this->settings_m->getUserDetails($id);

        try {
            $this->settings_m->updateUser(array(
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
                    Mail::to($details->usd_email)->send(new SendMail($obj_parameter));
                } catch (\Exception $e) {
                    // return $e;
                    DB::rollback();
                    return redirect()->back()->with('status', 'change_status_invalid_email')->withInput();
                }
                // end
            }

            DB::commit();
            return redirect('settings/user?id=' . $id)->with('status', 'success_change_status');
        } catch (\Exception $e) {
            DB::rollback();
            // return $e;
            return redirect()->back()->with('status', 'error_change_status')->withInput();
        }
    }
}
