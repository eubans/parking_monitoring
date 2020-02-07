<?php

namespace App\Http\Middleware;

use Session;
use Closure;

class CheckUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->session()->exists('USER_ID')) {
            // user value cannot be found in session
            $request->session()->put('EXTERNAL_GO_TO_URL', $request->url());
            return redirect('login');
        }
        $base_url = $request->session()->get('BASE_URL');
        $cu = $request->url();
        $url_path = str_replace($base_url . "/", "", $cu);
        // var_dump(json_decode($request->session()->get("USER_URL_ACCESS")));
        // var_dump($url_path);

        $isUrlExist = 0;
        $user_access = json_decode($request->session()->get("USER_URL_ACCESS"));
        foreach ($user_access as $key => $a) {
            if (strpos($url_path, $a) !== false) {
                $isUrlExist++;
            }
        }
        // var_dump($isUrlExist);
        // exit;

        if ($isUrlExist)
            return $next($request);
        else
            return redirect('404');
    }
}
