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

use App\Model\Reservation_model;
use App\Http\Controllers\GlobalController;

class Reservation extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * The user repository instance. 
     */
    protected $reservation_m;
    protected $global_c;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository
     * @return void
     */
    public function __construct(Reservation_model $reservation_m, GlobalController $global_c)
    {
        $this->reservation_m =  $reservation_m;
        $this->global_c =  $global_c;
    }

    function List()
    {
        $reservations = $this->reservation_m->getAllPendingReservations();

        $data = array(
            'reservations' => $reservations,
        );

        // return response()->json($data);

        $theme = Theme::uses('main')->layout('default');
        $theme->setTitle('Parking Monitoring | Reservation List');
        return $theme->of('reservation.list', $data)->render();
    }

    function Logs()
    {
        $reservations = $this->reservation_m->getAllReservations();

        $data = array(
            'reservations' => $reservations,
        );

        // return response()->json($data);

        $theme = Theme::uses('main')->layout('default');
        $theme->setTitle('Parking Monitoring | Reservation List');
        return $theme->of('reservation.logs', $data)->render();
    }

    function Cancel_Reservation(Request $request)
    {
        DB::beginTransaction();
        $rsv_id = $request->id;

        try {
            $details = array(
                "rsv_status" => "cancelled",
                "modified_at" => date('Y-m-d H:i:s'),
                "created_by" => Session::get('USER_ID'),
            );
            $this->reservation_m->updateReservation($details, $rsv_id);

            DB::commit();
            return redirect('reservation')->with('status', 'success_cancellation');
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
            return redirect()->back()->with('status', 'error_cancellation')->withInput();
        }
    }
}
