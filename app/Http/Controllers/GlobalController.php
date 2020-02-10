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
use DateTime;
use DateInterval;
use Session;

use App\Model\GlobalController_model;

class GlobalController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * The user repository instance. 
     */
    protected $global_m;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository
     * @return void
     */
    public function __construct(GlobalController_model $global_m)
    {
        $this->global_m =  $global_m;
    }

    function Render_QR($value, $size, $format, $margin)
    {
        if ($value == null)
            $value = "INVALID QR";
        // Format png,eps, svg
        return QrCode::size($size)
            ->margin($margin)
            ->generate($value);
    }

    function Get_User_Access($user_type)
    {
        $all_access = array(
            1 => array( //admin
                'home',
                'occupant',
                'occupant/registration',
                'occupant/profile',
                'occupant/attendance-logs',
                'reservation',
                'user-settings'
            ),
            2 => array( //occupant
                'home',
                'occupant/attendance-logs',
                'user-settings',
            ),
            3 => array( //superadmin
                'home',
                'send-closing-sms-blast',
                'occupant',
                'occupant/registration',
                'occupant/profile',
                'occupant/attendance-logs',
                'scan',
                'scan/occupant',
                'incident-reports',
                'reservation',
                'settings/global-variables',
                'settings/user',
                'user-settings'
            ),
            4 => array( //attendant
                'home',
                'occupant',
                'occupant/registration',
                'occupant/profile',
                'occupant/attendance-logs',
                'scan',
                'scan/occupant',
                'reservation',
                'user-settings'
            ),

        );
        return $all_access[$user_type];
    }

    function Get_Global_Variable($name)
    {
        return $this->global_m->getGlobalVariable($name);
    }

    function Send_SMS($to, $message)
    {
        $nexmo = app('Nexmo\Client');
        try {
            $nexmo->message()->send([
                'to'   => "63" . $to,
                'from' => 'IETIPARKLOGSYS',
                'text' => $message
            ]);
            return "success";
        } catch (\Exception $e) {
            return "failed";
        }
    }

    function Send_Closing_SMS_Blast($details)
    {
        if ($this->Get_Global_Variable('ENABLE_SMS') == 1) {
            foreach ($details as $value) {
                try {
                    $this->Send_SMS(
                        $value->phone_number,
                        "Hi $value->name, the parking lot will be closed in a minute. Please get your vehicle immediately to avoid it being locked down. Please do not reply. From IETI Parking Logs System."
                    );
                } catch (\Exception $e) {
                    return "failed";
                }
            }
        }
        return "success";
    }

    function Check_Parking_Slot_Availability()
    {
        $parking_status = $this->global_m->getOccupantOngoingLogsCount() < $this->global_m->getParkingCount();
        if ($parking_status) {
            $reservation = $this->global_m->getLatestOccupantReservationWithoutNotify();
            if (count($reservation) > 0) {
                if ($this->Get_Global_Variable('ENABLE_SMS') == 1) {
                    $rsv_time_limit = $this->Get_Global_Variable('RESERVATION_TIME_LIMIT');
                    $date_time = new DateTime();
                    $date_time->add(new DateInterval("PT" . $rsv_time_limit . "M"));
                    $time_limit = $date_time->format('g:i A');

                    $sms_status = $this->Send_SMS(
                        $reservation->occ_phone_number,
                        "Hi $reservation->occ_firstname, you now have a slot on IETI Parking lot. Please claim it before $time_limit. The reservation will be automatically cancelled if you failed to claim it on time. Please do not reply. From IETI Parking Logs System."
                    );
                    if ($sms_status == "success") {
                        $this->global_m->updateReservation(array(
                            "rsv_notify_ctr" => $reservation->rsv_notify_ctr + 1,
                            "rsv_expected_timein" => $date_time->format('Y-m-d H:i:s'),
                            "modified_at" => date('Y-m-d H:i:s'),
                        ), $reservation->rsv_id);
                    } else {
                        echo 'error_sms';
                    }
                }
            }
        }
        echo "success_sms";
    }

    function Cancel_Exceeded_Reservation_On_Time_Limit()
    {
        $reservations = $this->global_m->getPendingReservationWithTimeLimit();
        foreach ($reservations as $rsv) {
            $date_now = new DateTime();
            $date_now = $date_now->format('Y-m-d H:i:s');
            if ($date_now > $rsv->rsv_expected_timein) {
                $this->global_m->updateReservation(array(
                    "rsv_status" => "cancelled",
                    "modified_at" => date('Y-m-d H:i:s'),
                ), $rsv->rsv_id);
            }
        }
        echo "success_cancellation";
    }

    function Trigger_Closing_SMS_Blast()
    {
        if ($this->Get_Global_Variable('ENABLE_AUTOMATIC_CLOSING_SMS_BLAST') == 1) {
            $closing_time = substr_replace($this->Get_Global_Variable('PARKING_LOT_CLOSING_TIME'), ":", 2, 0);
            $date_time_from = new DateTime();
            $date_time_from->add(new DateInterval("PT29M"));
            $date_time_from = $date_time_from->format('H:i');

            $date_time_to = new DateTime();
            $date_time_to->add(new DateInterval("PT31M"));
            $date_time_to = $date_time_to->format('H:i');

            if (
                date_format(new DateTime($closing_time), "H:i") > $date_time_from
                && date_format(new DateTime($closing_time), "H:i") < $date_time_to
            ) {
                $obj_details = array();
                foreach ($this->global_m->getOngoingOccupants() as $value) {
                    $values = new \stdClass();
                    $values->name = $value->occ_firstname;
                    $values->phone_number = $value->occ_phone_number;
                    $obj_details[] = $values;
                }
                $status = $this->Send_Closing_SMS_Blast($obj_details);
                if ($status == "success")
                    echo "success_sms_blast";
                else
                    echo "error_sms_blast";
            }
        }
        echo "success";
    }

    function Disabling_All_Guest_Account()
    {
        if ($this->Get_Global_Variable('ENABLE_AUTOMATIC_DISABLING_OF_GUEST') == 1) {
            foreach ($this->global_m->getAllActiveOccupantGuest() as $guest) {
                $this->global_m->updateOccupant(array(
                    "occ_account_status" => "deactivated",
                    "modified_at" => date('Y-m-d H:i:s'),
                ), $guest->occ_id);
            }
        }
        echo "success";
    }
}
