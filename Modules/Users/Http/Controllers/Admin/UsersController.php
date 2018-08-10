<?php

namespace Modules\Users\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Modules\Users\Entities\Users;
use Redirect;
use Session;
use View;
use Module;

class UsersController extends Controller
{
	public $title = "Users";
    /**
     * Display a listing of the resource.
     * @return Response
    */
    public function index()
    {		
		$js = [Module::asset("users:js/users.js")];
		View::share('js_script', $js);
        $users = DB::table('users')->get();
        return view('users::backend.index', ['users' => $users , "title" => $this->title]);
		//return view('admin.article.index');
    }
	
	public function api_index()
    {		
		$users = DB::table('users')->get();
        $out["users"] = $users;
		echo json_encode($out);
	}

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('users::backend.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
		$input = Input::all();
		if(isset($input["action"]) && $input["action"] == "add"){
			$input = $input["params"];
			$user = new Users;
			if(isset($input["id"]) && is_numeric($input["id"])){
				$user = Users::find($input["id"]);
			}
			$user->email = $input["email"];
			$user->name = $input["name"];
            $user->username = $input["email"];
            if(!empty($input["password"])){
                $user->password = bcrypt($input["password"]);
            }
			
			$user->role = $input["role"];
			$user->save();
			echo json_encode(array("id"=> $user->id , "message" => 'Successfully created user!'));
			die();
		}
		else{
			$user = new Users;
			$user->email = $input["email"];
			$user->name = $input["name"];
			$user->username = $input["email"];
			$user->password = bcrypt($input["password"]);
			$user->role = $input["role"];
			$user->save();
		}
		Session::flash('message', 'Successfully created user!');
        return Redirect::to('admin/users');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
		$users = Users::find($id);
		return View::make('users::backend.show')
            ->with('user', $users); 
		
       // return view('users::backend.show', ['users' => $users]);
		
      //  return view('users::backend.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
       $users = Users::find($id);
		return View::make('users::backend.edit')
            ->with('user', $users); 
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id)
    {
		$input = Input::all();
		$user = Users::find($id);
		$user->email = $input["email"];
		$user->name = $input["username"];
		$user->username = $input["email"];
		$user->password = bcrypt($input["password"]);
		$user->role = $input["role"];
		$user->save();
		 Session::flash('message', 'Successfully updated the user!');
        return Redirect::to('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
		$nerd = Users::find($id);
        $nerd->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the user!');
        return Redirect::to('admin/users');
    }
	
	public function remove()
    {
		$input = Input::all();
		if(isset($input["action"]) && $input["action"] == "remove"){
			$input = $input["params"];
			//print_r($input);
			$nerd = Users::find($input["id"]);
			if($nerd->delete()){
				echo json_encode(array("message" => 'Successfully deleted the user!'));
			}
			else{
				echo "Error";
			}
			die();
			
		}
		else{
			print "Delete";
		}
		
        
    }
}
