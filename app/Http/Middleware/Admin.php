<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Input;
use App;
use Config;
use Request;
use Session;
use Log;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
	 
	public static function setLanguage($locale = null){
		if (empty($locale) || !is_string($locale)) {
            $locale = Request::segment(1);
        }
		
		if (!in_array($locale, Config::get('app.locales'))) {
			$locale = Config::get('app.locale');
		}
		App::setLocale($locale);
		Session::put('locale', $locale);
		
		return $locale;
		
	}
	
    public function handle( $request, Closure $next , $guard = null)
    {
		//echo bcrypt('admin#1234');exit();
		
		
		if (Auth::guard($guard)->guest()) {
			
			if ($request->has("username")) {
				$userdata = array(
					'username' => $request->input('username') ,
					'password' => ($request->input('password'))
				);
				
				$this->setLanguage('en');
				
				if (Auth::attempt($userdata,true))
				{
					$this->setLanguage('en');
					Session::put('logged_as', $request->input('username'));
					return $next($request);
				}
				else{
					return redirect()->guest('/backend/login');
				}
				
			} else {
				return redirect()->guest('/backend/login');
			}
		}
		
		if (Auth::check()) {
			$this->setLanguage('en');
			return $next($request);
		}
		else{
			return redirect()->guest('/backend/login');
		}
		
		
        return $next($request);
    }
	
	
}
