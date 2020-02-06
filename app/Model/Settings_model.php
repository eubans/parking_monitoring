<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Settings_model extends Model
{
    function getParkingCount()
    {
        return DB::table('global_variables')
            ->where('glv_name', 'PARKING_SLOT_COUNT')
            ->first()
            ->glv_value;
    }

    function updateGlobalVariables($data, $name)
    {
        DB::table('global_variables')
            ->where('glv_name', $name)
            ->update($data);
    }

    function getAllOngoingAttendanceLog()
    {
        return DB::table('attendance_logs')
            ->where('atl_status', 'ongoing')
            ->get();
    }

    function getAdminUsers()
    {
        return DB::table('users')
            ->join('user_details', 'users.use_id', '=', 'user_details.usd_user_id')
            ->join('user_type', 'users.use_user_type', '=', 'user_type.ust_id')
            ->where('ust_type', 'Admin')
            ->get();
    }

    function saveUser($data)
    {
        return DB::table('users')
            ->insertGetId($data);
    }

    function saveUserDetails($data)
    {
        DB::table('user_details')
            ->insert($data);
    }

    function checkUsername($username)
    {
        return DB::table('users')
            ->where('use_username', $username)
            ->first();
    }

    function getUserAdminDetails($id)
    {
        return DB::table('users')
            ->join('user_details', 'users.use_id', '=', 'user_details.usd_user_id')
            ->join('user_type', 'users.use_user_type', '=', 'user_type.ust_id')
            ->where('use_id', $id)
            ->where('ust_type', "Admin")
            ->first();
    }

    function updateUser($data, $use_id)
    {
        DB::table('users')
            ->where('use_id', $use_id)
            ->update($data);
    }

    function updateUserDetails($data, $use_id)
    {
        DB::table('user_details')
            ->where('usd_user_id', $use_id)
            ->update($data);
    }

    function getUserDetails($id)
    {
        return DB::table('users')
            ->leftJoin('user_details', 'users.use_id', '=', 'user_details.usd_user_id')
            ->join('user_type', 'users.use_user_type', '=', 'user_type.ust_id')
            ->where('use_id', $id)
            ->first();
    }

    function getUserType()
    {
        return DB::table('user_type')
            ->get();
    }
}
