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
class Domain  {
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
	
    public function handle($request, Closure $next)
    {
	    $route = $request->route();
		$subdomain = $route->parameter('subdomain');
		Session::put('subdomain', $subdomain);
		
		header("Access-Control-Allow-Origin: *");
        // ALLOW OPTIONS METHOD
        $headers = [
            'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, Authorization'
        ];
        if ($request->getMethod() == "OPTIONS") {
            // The client-side application can set only headers allowed in Access-Control-Allow-Headers
            return \Response::make('OK', 200, $headers);
        }
        $request->route()->forgetParameter('subdomain');
        $response = $next($request);
        foreach ($headers as $key => $value)
            $response->header($key, $value);
        return $response;
		
		//return $next($request);
    }

}