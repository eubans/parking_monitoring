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
use DateTime;
use DateInterval;

use App\Model\Reservation_model;
use App\Http\Controllers\GlobalController;

class Reservation extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * The user repository instance. 
     */
    protected $reservation_m;
    protected $global_c;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository
     * @return void
     */
    public function __construct(Reservation_model $reservation_m, GlobalController $global_c)
    {
        $this->reservation_m =  $reservation_m;
        $this->global_c =  $global_c;
    }

    function List()
    {
        $reservations = $this->reservation_m->getAllPendingReservations();

        $data = array(
            'reservations' => $reservations,
        );

        // return response()->json($data);

        $theme = Theme::uses('main')->layout('default');
        $theme->setTitle('Parking Logs System | Reservation List');
        return $theme->of('reservation.list', $data)->render();
    }

    function Logs()
    {
        $reservations = $this->reservation_m->getAllReservations();

        $data = array(
            'reservations' => $reservations,
        );

        // return response()->json($data);

        $theme = Theme::uses('main')->layout('default');
        $theme->setTitle('Parking Logs System | Reservation List');
        return $theme->of('reservation.logs', $data)->render();
    }

    function Cancel_Reservation(Request $request)
    {
        DB::beginTransaction();
        $rsv_id = $request->id;

        try {
            if ($this->global_c->Get_Global_Variable('ENABLE_SMS') == 1) {
                $reservation = $this->reservation_m->getReservationDetails($rsv_id);
                if (count($reservation) > 0) {
                    $sms_status = $this->global_c->Send_SMS(
                        $reservation->occ_phone_number,
                        "Hi $reservation->occ_firstname, just want to let you know that your reservation has been cancelled by the Attendant in charge. For any concern please contact the IETI Attendant or Admin. Please do not reply. From IETI Parking Logs System."
                    );
                    if ($sms_status != "success") {
                        DB::rollback();
                        return 'error_cancellation';
                    }
                }
            }

            $details = array(
                "rsv_status" => "cancelled",
                "modified_at" => date('Y-m-d H:i:s'),
                "created_by" => Session::get('USER_ID'),
            );
            $this->reservation_m->updateReservation($details, $rsv_id);

            DB::commit();
            return redirect('reservation')->with('status', 'success_cancellation');
        } catch (\Exception $e) {
            DB::rollback();
            // return $e;
            return redirect()->back()->with('status', 'error_cancellation')->withInput();
        }
    }

    function Alert_Occupant_SMS(Request $request)
    {
        DB::beginTransaction();

        try {
            if ($this->global_c->Get_Global_Variable('ENABLE_SMS') == 1) {
                $reservation = $this->reservation_m->getReservationDetails($request->id);
                if (count($reservation) > 0) {
                    $rsv_time_limit = $this->global_c->Get_Global_Variable('RESERVATION_TIME_LIMIT');
                    $date_time = new DateTime();
                    $date_time->add(new DateInterval("PT" . $rsv_time_limit . "M"));
                    $time_limit = $date_time->format('g:i A');

                    $sms_status = $this->global_c->Send_SMS(
                        $reservation->occ_phone_number,
                        "Hi $reservation->occ_firstname, just a follow up alert on your reservation. Your expected time-in has been reset, you need to claim your slot before $time_limit. Please do not reply. From IETI Parking Logs System."
                    );
                    if ($sms_status == "success") {
                        $this->reservation_m->updateReservation(array(
                            "rsv_notify_ctr" => $reservation->rsv_notify_ctr + 1,
                            "rsv_expected_timein" => $date_time->format('Y-m-d H:i:s'),
                            "modified_at" => date('Y-m-d H:i:s'),
                            "created_by" => Session::get('USER_ID'),
                        ), $reservation->rsv_id);
                    } else {
                        DB::rollback();
                        return 'error_time_out_sms';
                    }
                }
            }

            DB::commit();
            return redirect('reservation')->with('status', 'success_alert_sms');
        } catch (\Exception $e) {
            DB::rollback();
            // return $e;
            return redirect()->back()->with('status', 'error_alert_sms')->withInput();
        }
    }
}
