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

    function getAllPendingReservations()
    {
        return DB::table('reservations')
            ->join('occupants', 'reservations.rsv_occupant_id', '=', 'occupants.occ_id')
            ->join('occupant_type', 'occupants.occ_type', '=', 'occupant_type.oct_id')
            ->where('rsv_status', 'pending')
            // ->orderBy('rsv_id', 'desc')
            ->get();
    }

    function getAllOngoingIncidentReports()
    {
        return DB::table('incident_reports')
            ->join('occupants', 'incident_reports.icr_occupant_id', '=', 'occupants.occ_id')
            ->join('occupant_type', 'occupants.occ_type', '=', 'occupant_type.oct_id')
            ->where('icr_status', 'ongoing')
            ->get();
    }

    function getOccupantDetails($use_id)
    {
        return DB::table('occupants')
            ->join('occupant_motorcycle_info', 'occupants.occ_id', '=', 'occupant_motorcycle_info.omi_occupant_id')
            ->join('occupant_guardians', 'occupants.occ_id', '=', 'occupant_guardians.ocg_occupant_id')
            ->join('occupant_type', 'occupants.occ_type', '=', 'occupant_type.oct_id')
            ->where('occ_user_id', $use_id)
            ->first();
    }

    function getOccupantPendingReservation($id)
    {
        return DB::table('reservations')
            ->where('rsv_occupant_id', $id)
            ->where('rsv_status', 'pending')
            ->first();
    }

    function saveReservation($data)
    {
        DB::table('reservations')
            ->insert($data);
    }

    function updateReservation($data, $rsv_id)
    {
        DB::table('reservations')
            ->where('rsv_id', $rsv_id)
            ->update($data);
    }

    function getOccupantOngoingAttendance($occ_id)
    {
        return DB::table('attendance_logs')
            ->where('atl_occupant_id', $occ_id)
            ->where('atl_status', 'ongoing')
            ->get();
    }

    function validateEmail($email)
    {
        return DB::table('user_details')
            ->where('usd_email', $email)
            ->get();
    }

    function validateOccupantUsername($email)
    {
        return DB::table('users')
            ->where('use_username', $email)
            ->get();
    }

    function getUsernameFromEmail($email)
    {
        return DB::table('user_details')
            ->leftjoin('users', 'user_details.usd_user_id', '=', 'users.use_id')
            ->where('usd_email', $email)
            ->pluck('users.use_username');
    }

    function updatePassword($details, $account)
    {
        DB::table('users')
            ->where('use_username', $account)
            ->update($details);
    }

    function getGlobalVariable($name)
    {
        return DB::table('global_variables')
            ->where('glv_name', $name)
            ->first()
            ->glv_value;
    }
}
