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
}
