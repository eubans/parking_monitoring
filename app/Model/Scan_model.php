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
            ->first();
    }

    function getLatestOccupantReservation()
    {
        return DB::table('reservations')
            ->where('rsv_status', 'pending')
            ->first();
    }

    function updateReservation($data, $rsv_id)
    {
        DB::table('reservations')
            ->where('rsv_id', $rsv_id)
            ->update($data);
    }
}
