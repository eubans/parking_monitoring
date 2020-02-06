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

use App\Model\GlobalController_model;

class GlobalController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * The user repository instance. 
     */
    protected $global_m;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository
     * @return void
     */
    public function __construct(GlobalController_model $global_m)
    {
        $this->global_m =  $global_m;
    }

    function Render_QR($value, $size, $format, $margin)
    {
        if ($value == null)
            $value = "INVALID QR";
        // Format png,eps, svg
        return QrCode::size($size)
            ->margin($margin)
            ->generate($value);
    }

    function Get_User_Access($user_type)
    {
        $all_access = array(
            1 => array( //admin
                'home',
                'occupant',
                'occupant/registration',
                'occupant/profile',
                'occupant/attendance-logs',
                'reservation',
                'user-settings'
            ),
            2 => array( //occupant
                'home',
                'occupant/attendance-logs',
                'user-settings',
            ),
            3 => array( //superadmin
                'home',
                'occupant',
                'occupant/registration',
                'occupant/profile',
                'occupant/attendance-logs',
                'scan',
                'scan/occupant',
                'incident-reports',
                'reservation',
                'settings/global-variables',
                'settings/user',
                'user-settings'
            ),
            4 => array( //attendant
                'home',
                'occupant',
                'occupant/registration',
                'occupant/profile',
                'occupant/attendance-logs',
                'scan',
                'scan/occupant',
                'reservation',
                'user-settings'
            ),

        );
        return $all_access[$user_type];
    }
}
