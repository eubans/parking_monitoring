<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Controller_model extends Model
{
    function verifyLogin($username)
    {
        return DB::table('users')
            ->join('user_type', 'users.use_user_type', '=', 'user_type.ust_id')
            ->leftJoin('user_details', 'users.use_id', '=', 'user_details.usd_user_id')
            ->where('use_username', $username)
            ->first();
    }

    function getAllOngoingAttendanceLog()
    {
        return DB::table('attendance_logs')
            ->where('atl_status', 'ongoing')
            ->get();
    }

    function getParkingCount()
    {
        return DB::table('global_variables')
            ->where('glv_name', 'PARKING_SLOT_COUNT')
            ->first()
            ->glv_value;
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
}
