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
        $theme->setTitle('Parking Monitoring | Scan');
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

        $id = $this->scan_m->getOccupantDetails($request->qr_code)->occ_id;

        if ($this->scan_m->getOccupantOngoingLogsCount() >= $this->scan_m->getParkingCount()) {
            return 'parking_full';
        }

        try {
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
            return 'success_time_in';
        } catch (\Exception $e) {
            DB::rollback();
            // return $e;
            return 'error_time_in';
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

            DB::commit();
            return 'success_time_out';
        } catch (\Exception $e) {
            DB::rollback();
            // return $e;
            return 'error_time_out';
        }
    }
}
