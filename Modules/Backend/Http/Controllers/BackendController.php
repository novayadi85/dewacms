<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Users\Entities\Users;
use Auth;
use App;

class BackendController extends Controller
{
	var $data = array("title" => "Backend Laravel");
	
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
		echo App::getLocale();
		$this->data["content"] = __('welcome');
		/*https://laravel.com/docs/4.2/eloquent*/
		/* $user = new Users;
		$user->name = 'John';
		$user->password = '1234';
		$user->email = 'jhondue@gmail.com';
		$user->save(); */
		//$users = Users::find(1);
		$users = Users::all();
		//$users = DB::table('users')->get();
		/* $loggedId = Auth::user();
		print "<pre>";
		print_r(json_decode($loggedId));
		print "</pre>";
		exit(); */
        return view('backend::index', ['users' => $users , 'data' => $this->data ,'title' => __('dashboard')] );
		//return view('backend::index')->with('data', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('backend::create');
    }
	
	public function auth(Request $request)
    {
		$userdata = array(
			'username' => $request->input('username') ,
			'password' => $request->input('password')
		);
		
		
		
		if (Auth::attempt($userdata,true))
		{
			return redirect('admin');
		}
		else{
			return redirect()->guest('/backend/login');
		}
	}
	
	public function login()
    {
		return view('backend::login');
	}
	
	public function logout()
    {
		Auth::logout();
		return redirect()->guest('/backend/login');
	}

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('backend::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('backend::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
