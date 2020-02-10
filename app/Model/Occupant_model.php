<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Occupant_model extends Model
{
    function getAllOccupants()
    {
        return DB::table('occupants')
            ->join('occupant_motorcycle_info', 'occupants.occ_id', '=', 'occupant_motorcycle_info.omi_occupant_id')
            ->join('occupant_guardians', 'occupants.occ_id', '=', 'occupant_guardians.ocg_occupant_id')
            ->join('occupant_type', 'occupants.occ_type', '=', 'occupant_type.oct_id')
            ->leftJoin('users', 'occupants.occ_user_id', '=', 'users.use_id')
            ->get();
    }

    function getAllOccupantType()
    {
        return DB::table('occupant_type')
            ->get();
    }

    function saveOccupantAccount($data)
    {
        return $result = DB::table('users')
            ->insertGetId($data);
    }

    function saveOccupant($data)
    {
        return DB::table('occupants')
            ->insertGetId($data);
    }

    function saveOccupantGuardian($data)
    {
        DB::table('occupant_guardians')
            ->insert($data);
    }

    function saveOccupantMotorcycle($data)
    {
        DB::table('occupant_motorcycle_info')
            ->insert($data);
    }

    function getOccupantProfile($id)
    {
        return DB::table('occupants')
            ->join('occupant_motorcycle_info', 'occupants.occ_id', '=', 'occupant_motorcycle_info.omi_occupant_id')
            ->join('occupant_guardians', 'occupants.occ_id', '=', 'occupant_guardians.ocg_occupant_id')
            ->join('occupant_type', 'occupants.occ_type', '=', 'occupant_type.oct_id')
            ->leftJoin('users', 'occupants.occ_user_id', '=', 'users.use_id')
            ->where('occ_id', $id)
            ->first();
    }

    function updateOccupant($data, $occ_id)
    {
        DB::table('occupants')
            ->where('occ_id', $occ_id)
            ->update($data);
    }

    function updateOccupantGuardian($data, $occ_id)
    {
        DB::table('occupant_guardians')
            ->where('ocg_occupant_id', $occ_id)
            ->update($data);
    }

    function updateOccupantMotorcycle($data, $occ_id)
    {
        DB::table('occupant_motorcycle_info')
            ->where('omi_occupant_id', $occ_id)
            ->update($data);
    }

    function getAllOccupantLogs()
    {
        return DB::table('attendance_logs')
            ->join('occupants', 'attendance_logs.atl_occupant_id', '=', 'occupants.occ_id')
            ->join('occupant_motorcycle_info', 'occupants.occ_id', '=', 'occupant_motorcycle_info.omi_occupant_id')
            ->join('occupant_guardians', 'occupants.occ_id', '=', 'occupant_guardians.ocg_occupant_id')
            ->join('occupant_type', 'occupants.occ_type', '=', 'occupant_type.oct_id')
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

    function updateUser($data, $use_id)
    {
        DB::table('users')
            ->where('use_id', $use_id)
            ->update($data);
    }

    function getOccupantLogs($id)
    {
        return DB::table('attendance_logs')
            ->join('occupants', 'attendance_logs.atl_occupant_id', '=', 'occupants.occ_id')
            ->join('occupant_motorcycle_info', 'occupants.occ_id', '=', 'occupant_motorcycle_info.omi_occupant_id')
            ->join('occupant_guardians', 'occupants.occ_id', '=', 'occupant_guardians.ocg_occupant_id')
            ->join('occupant_type', 'occupants.occ_type', '=', 'occupant_type.oct_id')
            ->orderBy('atl_id', 'desc')
            ->where('occ_user_id', $id)
            ->get();
    }

    function checkOccupantUsername($username)
    {
        return DB::table('users')
            ->leftjoin('occupants', 'users.use_id', '=', 'occupants.occ_user_id')
            ->where('use_username', $username)
            ->first();
    }
}
