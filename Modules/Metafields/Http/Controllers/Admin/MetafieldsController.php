<?php

namespace Modules\Metafields\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Modules\Blogpost\Entities\Metafields;
use Config;
use App;
use Redirect;
use Session;
use View;
use Module;
use Auth;
use Devdewa\Injection\Helper as Injection;

class MetafieldsController extends Controller
{
	public $title = "Metafields";
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
		$js = [Module::asset("metafields:js/post.js")];
		View::share('js_script', $js);
        return view('metafields::backend.index',array("title"=>$this->title));
    }
	
	public function api_v1(){
		$request = Input::all();
		$input = $request["params"];
		if(isset($input["lang"])){
			$posts = DB::table('metafields')->where(array('lang'=>$input["lang"]))->get();
		}
		else{
			$posts = DB::table('metafields')->get();
		}
		
        return Response()->json([
			'posts' => $posts
		], 200);		
	}

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
		$js = [Module::asset("metafields:js/post.js")];
		View::share('js_script', $js);
        return view('metafields::backend.create',array("title" => "Create Metafield"));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $Injection = new Injection();
		$input = Input::all();
		if(isset($input["action"]) && $input["action"] == "add"){
			$input = $input["params"];
			$saved = array();
			$Post = new Metafields;
			if(isset($input["id"]) && is_numeric($input["id"])){
				$Post = Metafields::find($input["id"]);
			}
			$Post->title = $input["title"];
			$Post->handle = $Injection->slug($input["handle"]);
			$Post->description = ($input["description"])? $input["description"] : '.' ;
			$Post->lang = 'en';
			$Post->user_id =  Auth::user()->id;
			$Post->type =  $input["type"];
			$Post->post_type =  $input["post_type"];
			$Post->save();
			$saved = $Post->id;
			return Response()->json([
				"id" => $saved,
				"message" => "Successfully created post!"
			], 200);
			die();
		}
		else{
			$input = $input["params"];
			$Post = new Metafields;
			$Post->title = $input["title"];
			$Post->handle = $Injection->slug($input["handle"]);
			$Post->description = ($input["description"])? $input["description"] : '.' ;
			$Post->lang = 'en';
			$Post->type =  $input["type"];
			$Post->post_type =  $input["post_type"];
			$Post->user_id = Auth::user()->id;
			$Post->save();
		}
		Session::flash('message', 'Successfully created user!');
        return Redirect::to('admin/articles');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $js = [Module::asset("metafields:js/post.js")];
        View::share('js_script', $js);
        $Post = Metafields::find($id);
        return view('metafields::backend.edit',array("title" => "Edit Metafields"))->with('post', $Post);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        $js = [Module::asset("metafields:js/post.js")];
        View::share('js_script', $js);
        $Post = Post::find($id);
        return view('metafields::backend.edit',array("title" => "Edit Metafields"))->with('post', $Post);
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
	
	public function remove()
    {
		$input = Input::all();
		if(isset($input["action"]) && $input["action"] == "remove"){
			$input = $input["params"];
			$nerd = Metafields::find($input["id"]);
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
