<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use Teepluss\Theme\Facades\Theme;
use Illuminate\Http\Request;

use Session;
use Hash;

use App\Model\Controller_model;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * The user repository instance. 
     */
    protected $controller_m;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository
     * @return void
     */
    public function __construct(Controller_model $controller_m)
    {
        $this->controller_m =  $controller_m;
    }

    function Login()
    {
        // return Hash::make("admin");
        $theme = Theme::uses('default')->layout('default');
        $theme->setTitle('Parking Monitoring | Login');
        return $theme->of('controller.login')->render();
    }

    function ActionLogin(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $user_details = $this->controller_m->verifyLogin($username);

        if ($user_details) {
            if (Hash::check($password, $user_details->use_password) && $username == $user_details->use_username) {

                session()->put('USER_ID', $user_details->use_id);
                session()->put('USER_NAME', $user_details->use_username);
                $user_full_name = $user_details->usd_lastname . ", " . $user_details->usd_firstname . " " . $user_details->usd_middlename;
                session()->put('USER_FULLNAME', $user_full_name);
                session()->put('USER_TYPE', $user_details->ust_type);
                session()->put('USER_EMAIL', $user_details->usd_email);
                session()->put('USER_CONTACT', $user_details->usd_contact_number);

                //for avatar of user
                if (file_exists(public_path() . '/files/account/avatar/' . $user_details->use_id . '/1.jpg')) {
                    session()->put('USER_AVATAR_PATH',  url('public/img/avatar/' . $user_details->use_id . '/1.jpg'));
                } else {
                    session()->put('USER_AVATAR_PATH',  url('public/img/avatar/0/1.jpg'));
                }

                return redirect('home');
            } else {
                return redirect('login?error=1');
            }
        } else {
            return redirect('login?error=1');
        }
    }

    function Home()
    {
        $theme = Theme::uses('main')->layout('default');
        $theme->setTitle('Parking Monitoring | Home');
        return $theme->of('controller.home')->render();
    }

    function Logout()
    {
        Session::flush();
        return redirect('login');
    }

    function getParkingStatus()
    {
        return count($this->controller_m->getAllOngoingAttendanceLog()) . "/" . $this->controller_m->getParkingCount();
    }

    function getOngoingOccupants()
    {
        return $this->controller_m->getOngoingOccupants();
    }
}
