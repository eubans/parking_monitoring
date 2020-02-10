<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Scan_model extends Model
{
    function getOccupantDetails($qr_code)
    {
        return DB::table('occupants')
            ->join('occupant_motorcycle_info', 'occupants.occ_id', '=', 'occupant_motorcycle_info.omi_occupant_id')
            ->join('occupant_guardians', 'occupants.occ_id', '=', 'occupant_guardians.ocg_occupant_id')
            ->join('occupant_type', 'occupants.occ_type', '=', 'occupant_type.oct_id')
            ->where('occ_qr_code', $qr_code)
            ->first();
    }

    function saveAttendaceLog($data)
    {
        DB::table('attendance_logs')
            ->insert($data);
    }

    function getOccupantLogs($id)
    {
        return DB::table('attendance_logs')
            ->where('atl_occupant_id', $id)
            ->orderBy('atl_id', 'desc')
            ->get();
    }

    function getOccupantOngoingLog($id)
    {
        return DB::table('attendance_logs')
            ->where('atl_occupant_id', $id)
            ->where('atl_status', 'ongoing')
            ->first();
    }

    function updateAttendaceLog($data, $atl_id)
    {
        DB::table('attendance_logs')
            ->where('atl_id', $atl_id)
            ->update($data);
    }

    function getOccupantOngoingLogsCount()
    {
        return DB::table('attendance_logs')
            ->where('atl_status', 'ongoing')
            ->count();
    }

    function getParkingCount()
    {
        return DB::table('global_variables')
            ->where('glv_name', 'PARKING_SLOT_COUNT')
            ->first()
            ->glv_value;
    }

    function saveReservation($data)
    {
        DB::table('reservations')
            ->insert($data);
    }

    function getOccupantPendingReservation($id)
    {
        return DB::table('reservations')
            ->where('rsv_occupant_id', $id)
            ->where('rsv_status', 'pending')
            ->orderBy('rsv_id', 'asc')
            ->first();
    }

    function getLatestOccupantReservation()
    {
        return DB::table('reservations')
            ->leftJoin('occupants', 'reservations.rsv_occupant_id', '=', 'occupants.occ_id')
            ->where('rsv_status', 'pending')
            ->orderBy('rsv_id', 'asc')
            ->first();
    }

    function getLatestOccupantReservationWithoutNotify()
    {
        return DB::table('reservations')
            ->leftJoin('occupants', 'reservations.rsv_occupant_id', '=', 'occupants.occ_id')
            ->where('rsv_status', 'pending')
            ->where('rsv_notify_ctr', 0)
            ->orderBy('rsv_id', 'asc')
            ->first();
    }

    function updateReservation($data, $rsv_id)
    {
        DB::table('reservations')
            ->where('rsv_id', $rsv_id)
            ->update($data);
    }

    function saveIncidentReport($data)
    {
        DB::table('incident_reports')
            ->insert($data);
    }

    function getAllIncidentReports()
    {
        return DB::table('incident_reports')
            ->join('occupants', 'incident_reports.icr_occupant_id', '=', 'occupants.occ_id')
            ->join('occupant_type', 'occupants.occ_type', '=', 'occupant_type.oct_id')
            ->orderBy('icr_id', 'desc')
            ->get();
    }

    function updateIncident($data, $icr_id)
    {
        DB::table('incident_reports')
            ->where('icr_id', $icr_id)
            ->update($data);
    }
}
