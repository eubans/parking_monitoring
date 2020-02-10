<?php

namespace App\Model;

use DB;

use Illuminate\Database\Eloquent\Model;

class GlobalController_model extends Model
{
    function getGlobalVariable($name)
    {
        return DB::table('global_variables')
            ->where('glv_name', $name)
            ->first()
            ->glv_value;
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

    function getPendingReservationWithTimeLimit()
    {
        return DB::table('reservations')
            ->where('rsv_status', 'pending')
            ->where('rsv_notify_ctr', '<>', 0)
            ->whereNotNull('rsv_expected_timein')
            ->orderBy('rsv_id', 'asc')
            ->get();
    }

    function getOngoingOccupants()
    {
        return DB::table('attendance_logs')
            ->join('occupants', 'attendance_logs.atl_occupant_id', '=', 'occupants.occ_id')
            ->join('occupant_motorcycle_info', 'occupants.occ_id', '=', 'occupant_motorcycle_info.omi_occupant_id')
            ->join('occupant_type', 'occupants.occ_type', '=', 'occupant_type.oct_id')
            ->where('atl_status', 'ongoing')
            ->orderBy('atl_id', 'desc')
            ->get();
    }

    function getAllActiveOccupantGuest()
    {
        return DB::table('occupants')
            ->join('occupant_type', 'occupants.occ_type', '=', 'occupant_type.oct_id')
            ->where('occ_account_status', 'active')
            ->where('oct_name', 'Guest')
            ->get();
    }

    function updateOccupant($data, $occ_id)
    {
        DB::table('occupants')
            ->where('occ_id', $occ_id)
            ->update($data);
    }
}
