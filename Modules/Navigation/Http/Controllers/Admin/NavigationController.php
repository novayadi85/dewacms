<?php

namespace Modules\Navigation\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Modules\Navigation\Entities\Menus;
use Redirect;
use Session;
use View;
use Module;
use Auth;
use Devdewa\Injection\Helper as Injection;
use Devdewa\Injection\Tree as Tree;

class NavigationController extends Controller
{
	 public $title = "Menus";
	 
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
		$js = [Module::asset("navigation:js/menu.js")];
		View::share('js_script', $js);
        return view('navigation::backend.index',array("title"=> $this->title));
    }
	
	public function api_v1(){
		$menus = DB::table('menus')->orderBy('position', 'asc')->get();
		$posts = DB::table('posts')->get();
		$Tree = new Tree;
		$lists = $Tree->buildTree($menus,0);
		$dropdown = array();
		if(sizeof($posts)){
			foreach($posts as $list){
				$dropdown[] = array(
					"name" => $list->title,
					"shade" => $list->post_type,
					"value" => $list->id
				);
			
			}
		}
		
		if(empty($lists)){
			$lists = false;
		}	
        return Response()->json([
			'list' => $lists,
			'dropdown' => $dropdown
		], 200);		
	}

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('navigation::create');
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
			if(!isset($input["link"])) $input["link"] = "";
			if(!isset($input["target"])) $input["target"] = "";
			
			if(is_array($input["target"]))  $input["target"] = $input["target"]["value"];
			
			$Post = new Menus;
			if(isset($input["id"]) && is_numeric($input["id"])){
				$Post = Menus::find($input["id"]);
			}
			$Post->title = $input["title"];
			$Post->slug = $Injection->slug($input["link"]);
			$Post->target = $input["target"];
			$Post->link = $input["link"];
			$Post->lang = 'en';
			//$Post->user_id =  Auth::user()->id;
			$Post->save();
			return Response()->json([
				"id" => $Post->id,
				"message" => "Successfully created page!"
			], 200);
			die();
		}
		else{
			$input = $input["params"];
			if(!empty($input)){
				$Post = new Menus;
				$Post->title = $input["title"];
				$Post->slug = $Injection->slug($input["link"]);
				$Post->target = $input["target"];
				$Post->link = $input["link"];
				$Post->lang = 'en';
				//$Post->user_id =  Auth::user()->id;
				$Post->save();
			}
		}
		Session::flash('message', 'Successfully created page!');
        return Redirect::to('admin/articles');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('navigation::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('navigation::edit');
	}
	
	private function __chld($data , $position = array()){
		foreach($data as $k => $v){
			if(!empty($v["children"])){
				$this->__chld($v["children"],$position);
			}
			$position[$v["id"]] = $k;
		}
		return $position;
	}
	
	public function reload()
    {
		$input = Input::all();
		$positions = array();
		foreach($input["data"] as $k => $v){
			$positions[$v["id"]] = $k;
			if(!empty($v["children"])){
				$positions = $this->__chld($v["children"],$positions);
			}			
		}
        $sourceId = $input["details"]["sourceId"];
		$destId = $input["details"]["destId"];
		
		if(sizeof($positions)){
			foreach($positions as $post_id => $position){
				$Post = new Menus;
				$Post = Menus::find($post_id);	
				$Post->position = $position;
				$Post->save();
			}
		}

		$Post = new Menus;
		if(isset($sourceId) && is_numeric($sourceId)){
			$Post = Menus::find($sourceId);
		}
		if($destId == null){
			$destId = 0;
		}
		
		$Post->parent_id = $destId;
		$Post->title = $Post->title;
		$Post->save();	

		return Response()->json([
			"id" => $Post->id,
			"message" => "Successfully created page!"
		], 200);
		die();
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
