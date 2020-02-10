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
use DateTime;
use DateInterval;

use App\Model\Scan_model;
use App\Http\Controllers\GlobalController;

class Scan extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * The user repository instance. 
     */
    protected $scan_m;
    protected $global_c;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository
     * @return void
     */
    public function __construct(Scan_model $scan_m, GlobalController $global_c)
    {
        $this->scan_m =  $scan_m;
        $this->global_c =  $global_c;
    }

    function Index()
    {
        $theme = Theme::uses('main')->layout('default');
        $theme->setTitle('Parking Logs System | Scan');
        return $theme->of('scan.index')->render();
    }

    function getOccupantDetails(Request $request)
    {
        $details = $this->scan_m->getOccupantDetails($request->qr_code);
        return json_encode(array(
            'details' => $details,
            'qr_code' => $this->global_c->Render_QR($details->occ_qr_code, 100, 'svg', 0),
        ));
    }

    function occupantTimeIn(Request $request)
    {
        DB::beginTransaction();

        $occupant_details = $this->scan_m->getOccupantDetails($request->qr_code);
        $id = $occupant_details->occ_id;
        $status = $occupant_details->occ_account_status;

        if ($status != "active")
            return array('data' => 'occupant_deactivated');

        $parking_status = $this->scan_m->getOccupantOngoingLogsCount() >= $this->scan_m->getParkingCount();

        if ($parking_status)
            return array('data' => 'parking_full');

        $reservation = $this->scan_m->getLatestOccupantReservation();
        // return response()->json($reservation);

        try {
            // // return response()->json(isset($reservation->rsv_occupant_id));
            // return response()->json([$reservation->rsv_occupant_id, $id]);
            if (isset($reservation->rsv_occupant_id)) {
                if ($reservation->rsv_occupant_id != $id) {
                    if (!count($this->scan_m->getOccupantPendingReservation($id)) > 0)
                        return array('data' => 'parking_full');
                    else
                        return array('data' => 'invalid_occupant_queue');
                } else
                    $this->scan_m->updateReservation(array(
                        "rsv_timein_datetime" => date('Y-m-d H:i:s'),
                        "rsv_status" => "done",
                        "modified_at" => date('Y-m-d H:i:s'),
                        "created_by" => Session::get('USER_ID'),
                    ), $reservation->rsv_id);
            }

            $attendance_logs = array(
                "atl_occupant_id" => $id,
                "atl_date_in" => date('Y-m-d'),
                "atl_time_in" => date('H:i:s'),
                "atl_status" => "ongoing",
                "created_at" => date('Y-m-d H:i:s'),
                "created_by" => Session::get('USER_ID'),
            );
            $this->scan_m->saveAttendaceLog($attendance_logs);

            DB::commit();
            return array('data' => 'success_time_in');
        } catch (\Exception $e) {
            DB::rollback();
            // return $e;
            return array('data' => 'error_time_in');
        }
    }

    function getOccupantLogs(Request $request)
    {
        $occ_id = $this->scan_m->getOccupantDetails($request->qr_code)->occ_id;
        $logs = $this->scan_m->getOccupantLogs($occ_id);

        //check if occupant has a ongoing log
        $ongoing_ctr = $this->scan_m->getOccupantOngoingLog($occ_id);
        $ongoing_log = false;
        if (count($ongoing_ctr) > 0)
            $ongoing_log = true;

        $ongoing_ctr = (array) $ongoing_ctr;
        return json_encode(array(
            'logs' => $logs,
            'ongoing_log' => $ongoing_log,
            'ongoing_log_id' => empty($ongoing_ctr) ? 0 : $ongoing_ctr['atl_id'],
        ));
    }

    function occupantTimeOut(Request $request)
    {
        DB::beginTransaction();

        try {
            $attendance_logs = array(
                "atl_date_out" => date('Y-m-d'),
                "atl_time_out" => date('H:i:s'),
                "atl_status" => "done",
                "modified_at" => date('Y-m-d H:i:s'),
                "created_by" => Session::get('USER_ID'),
            );
            $this->scan_m->updateAttendaceLog($attendance_logs, $request->atl_id);

            if ($this->global_c->Get_Global_Variable('ENABLE_SMS') == 1) {
                $reservation = $this->scan_m->getLatestOccupantReservationWithoutNotify();
                if (count($reservation) > 0) {
                    $rsv_time_limit = $this->global_c->Get_Global_Variable('RESERVATION_TIME_LIMIT');
                    $date_time = new DateTime();
                    $date_time->add(new DateInterval("PT" . $rsv_time_limit . "M"));
                    $time_limit = $date_time->format('g:i A');

                    $sms_status = $this->global_c->Send_SMS(
                        $reservation->occ_phone_number,
                        "Hi $reservation->occ_firstname, you now have a slot on IETI Parking lot. Please claim it before $time_limit. The reservation will be automatically cancelled if you failed to claim it on time. Please do not reply. From IETI Parking Logs System."
                    );
                    if ($sms_status == "success") {
                        $this->scan_m->updateReservation(array(
                            "rsv_notify_ctr" => $reservation->rsv_notify_ctr + 1,
                            "rsv_expected_timein" => $date_time->format('Y-m-d H:i:s'),
                            "modified_at" => date('Y-m-d H:i:s'),
                            "created_by" => Session::get('USER_ID'),
                        ), $reservation->rsv_id);
                    } else {
                        DB::rollback();
                        return array('data' => 'error_time_out_sms');
                    }
                }
            }

            DB::commit();
            return array('data' => 'success_time_out');
        } catch (\Exception $e) {
            DB::rollback();
            // return $e;
            return array('data' => 'error_time_out');
        }
    }

    function occupantReservation(Request $request)
    {
        DB::beginTransaction();

        $occupant_details = $this->scan_m->getOccupantDetails($request->qr_code);
        $id = $occupant_details->occ_id;
        $status = $occupant_details->occ_account_status;

        if ($status != "active")
            return array('data' => 'occupant_deactivated');

        if (count($this->scan_m->getOccupantPendingReservation($id)) > 0)
            return array('data' => 'occupant_reservation_exist');

        try {
            $reservation = array(
                "rsv_occupant_id" => $id,
                "rsv_datetime" => date('Y-m-d H:i:s'),
                "created_at" => date('Y-m-d H:i:s'),
                "created_by" => Session::get('USER_ID'),
            );
            $this->scan_m->saveReservation($reservation);

            DB::commit();
            return array('data' => 'success_reservation');
        } catch (\Exception $e) {
            DB::rollback();
            // return $e;
            return array('data' => 'error_reservation');
        }
    }

    function reportIncident(Request $request)
    {
        DB::beginTransaction();

        $details = $this->scan_m->getOccupantDetails($request->qr_code);
        $id = $details->occ_id;

        try {
            $incident_report = array(
                "icr_occupant_id" => $id,
                "icr_datetime" => date('Y-m-d H:i:s'),
                "icr_description" => $request->description,
                "icr_status" => "ongoing",
                "created_at" => date('Y-m-d H:i:s'),
                "created_by" => Session::get('USER_ID'),
            );
            $this->scan_m->saveIncidentReport($incident_report);

            if ($this->global_c->Get_Global_Variable('ENABLE_EMAIL') == 1) {
                // email sending start
                $obj_parameter = new \stdClass();
                $obj_parameter->subject = "IETI Parking Logs System: Incident Report " . date('F j, Y h:i:s A');
                $obj_parameter->occupant_name = $details->occ_lastname . ", " . $details->occ_firstname . " " . (($details->occ_middlename == "") ? "" : strtoupper($details->occ_middlename[0]) . ".");
                $obj_parameter->description = $request->description;
                $obj_parameter->datetime = date('F j, Y h:i:s A');
                $obj_parameter->template = 'mails.incident-report-email';
                $obj_parameter->plain_template = 'mails.incident-report-email';

                try {
                    Mail::to(Session::get('SUPER_ADMIN_EMAIL'))->send(new SendMail($obj_parameter));
                } catch (\Exception $e) {
                    // return $e;
                    DB::rollback();
                    return array('data' => 'invalid_email');
                }
                // end
            }

            DB::commit();
            return array('data' => 'success_report_incident');
        } catch (\Exception $e) {
            DB::rollback();
            // return $e;
            return array('data' => 'error_report_incident');
        }
    }

    function Incident_Reports()
    {
        $incidents = $this->scan_m->getAllIncidentReports();

        $data = array(
            'incidents' => $incidents,
        );

        $theme = Theme::uses('main')->layout('default');
        $theme->setTitle('Parking Logs System | Incident Reports');
        return $theme->of('scan.incident-reports', $data)->render();
    }

    function Process_Incident(Request $request)
    {
        DB::beginTransaction();
        $icr_id = $request->id;
        $status = $request->s;
        $notes = $request->notes;

        try {
            $details = array(
                "icr_status" => $status,
                "icr_notes" => $notes,
                "modified_at" => date('Y-m-d H:i:s'),
                "created_by" => Session::get('USER_ID'),
            );
            $this->scan_m->updateIncident($details, $icr_id);

            DB::commit();
            return redirect('incident-reports')->with('status', 'success_process');
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
            return redirect()->back()->with('status', 'error_process')->withInput();
        }
    }
}
