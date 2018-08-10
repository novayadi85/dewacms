<?php 
namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Redirector;
use Illuminate\Foundation\Application;
use App;
use Config;
use Request;
use Session;

#Komang Novayadi
class Language  {
	/**
     * Illuminate request class.
     *
     * @var \Illuminate\Routing\Request
     */
    protected $request;
    /**
     * Illuminate url class.
     *
     * @var \Illuminate\Routing\UrlGenerator
     */
    protected $url;
    /**
     * Illuminate request class.
     *
     * @var Illuminate\Foundation\Application
     */
    protected $app;
    /**
     * Illuminate request class.
     *
     * @var string
     */
	
	public function __construct()
    {
        $this->app = app();
        $this->request = $this->app['request'];
        $this->url = $this->app['url'];
    }
	
	public static function setLanguage($locale = null){
		
		if (empty($locale) || !is_string($locale)) {
            $locale = Request::segment(1);
        }
		
		if (!in_array($locale, array_keys(Config::get('app.locales')))) {
			$locale = Config::get('app.locale');
			
		}
		
		App::setLocale($locale);
		
		Session::put('locale', $locale);
		
		return $locale;
		
	}
    public function handle($request, Closure $next)
   {
		/* $raw_locale = Session::get('locale');
		if (in_array($raw_locale, Config::get('app.locales'))) {
			$locale = $raw_locale;
		}
		else $locale = Config::get('app.locale');
		
		App::setLocale($locale);
		Session::put('locale', $locale);
		 */
		return $next($request);
   }

}