<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Reservation_model extends Model
{
    function getAllPendingReservations()
    {
        return DB::table('reservations')
            ->join('occupants', 'reservations.rsv_occupant_id', '=', 'occupants.occ_id')
            ->join('occupant_type', 'occupants.occ_type', '=', 'occupant_type.oct_id')
            ->where('rsv_status', 'pending')
            // ->orderBy('rsv_id', 'desc')
            ->get();
    }

    function getAllReservations()
    {
        return DB::table('reservations')
            ->join('occupants', 'reservations.rsv_occupant_id', '=', 'occupants.occ_id')
            ->join('occupant_type', 'occupants.occ_type', '=', 'occupant_type.oct_id')
            ->orderBy('rsv_id', 'desc')
            ->get();
    }

    function updateReservation($data, $rsv_id)
    {
        DB::table('reservations')
            ->where('rsv_id', $rsv_id)
            ->update($data);
    }
}