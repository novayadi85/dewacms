<?php

namespace Modules\Terms\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Modules\Blogpost\Entities\Post;
use Modules\Blogpost\Entities\Category;
use Config;
use App;
use Redirect;
use Session;
use View;
use Module;
use Auth;
use Devdewa\Injection\Helper as Injection;

class TermsController extends Controller
{
	public $title = "Category";

	public $options_values = array(
		"bali" => "Bali",
		"java" => "Java"
	);
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
		$js = [Module::asset("terms:js/post.js")];
		View::share('js_script', $js);
        return view('terms::backend.index',array("title"=>$this->title));
    }
	
	public function api_v1(){
		$request = Input::all();
		$input = $request["params"];
		if(isset($input["lang"])){
			/* $posts = DB::table('posts')
            ->join('postlangs', 'posts.id', '=', 'postlangs.post_id')
			->select('posts.*', 'postlangs.title', 'postlangs.description','postlangs.lang',
			 'postlangs.slug','postlangs.id as child_id')
			->where(array('postlangs.lang'=>$input["lang"] , 'posts.post_type'=>'post'))
			->get();
			*/
			$posts = DB::table('categories')->where(array('lang'=>$input["lang"]))->get();
		}
		else{
			$posts = DB::table('categories')->get();
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
		$js = [Module::asset("terms:js/post.js")];
		View::share('js_script', $js);
        return view('terms::backend.create',array("title" => "Create Category"))->with(array("options_values" => $this->options_values));
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
			$Post = new Category;
			if(isset($input["id"]) && is_numeric($input["id"])){
				$Post = Category::find($input["id"]);
			}
			$Post->title = $input["title"];
			$Post->slug = $Injection->slug($input["slug"]);
			$Post->description = $input["description"];
			$Post->lang = 'en';
			$Post->location = $input["location"];
			$Post->user_id =  Auth::user()->id;
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
			$Post = new Category;
			$Post->title = $input["title"];
			$Post->slug = $Injection->slug($input["slug"]);
			$Post->description = $input["description"];
			$Post->lang = 'en';
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
		echo $id;
        $js = [Module::asset("terms:js/post.js")];
        View::share('js_script', $js);
		$Post = Category::find($id);
		
        return view('terms::backend.edit',array("title" => "Edit Category"))->with(array('post' => $Post , "options_values" => $this->options_values));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        $js = [Module::asset("terms:js/post.js")];
        View::share('js_script', $js);
        $Post = Post::find($id);
        return view('terms::backend.edit',array("title" => "Edit Category"))->with('post', $Post);
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
			$nerd = Category::find($input["id"]);
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
