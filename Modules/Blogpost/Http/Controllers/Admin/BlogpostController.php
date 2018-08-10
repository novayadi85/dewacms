<?php

namespace Modules\Blogpost\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Modules\Blogpost\Entities\Post;
use Modules\Blogpost\Entities\Category;
use Modules\Blogpost\Entities\Metafields;
use Modules\Blogpost\Entities\Metavalue as Metavalue;
use Modules\Terms\Entities\Terms;
use Config;
use App;
use Redirect;
use Session;
use View;
use Module;
use Auth;
use Devdewa\Injection\Helper as Injection;

class BlogpostController extends Controller
{
	public $title = "Articles";
	#public $Injection = new Injection;
    /**
     * Display a listing of the resource.
     * @return Response
    */
    public function index()
    {
		$Injection = new Injection();
		$js = [Module::asset("blogpost:js/post.js")];
		View::share('js_script', $js);
        return view('blogpost::backend.index',array("title"=>$this->title));
    }
	
	public function api_v1(Request $request){
	//	$request = Input::all();
		$input = ($request->has("params"))? $request["params"] : array();
		if(isset($input["lang"])){
			/* $posts = DB::table('posts')
            ->join('postlangs', 'posts.id', '=', 'postlangs.post_id')
			->select('posts.*', 'postlangs.title', 'postlangs.description','postlangs.lang',
			 'postlangs.slug','postlangs.id as child_id')
			->where(array('postlangs.lang'=>$input["lang"] , 'posts.post_type'=>'post'))
			->get();
			**/
			$posts = DB::table('posts')->where(array('lang'=>$input["lang"] , 'post_type'=>'post'))->get();
		}
		else{
			$posts = DB::table('posts')->where('post_type','post')->get();
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
		$js = [Module::asset("blogpost:js/post.js")];
		View::share('js_script', $js);
		$classCategory = \Modules\Blogpost\Entities\Category::all();
		$categories = array();
		
		if($classCategory){
			foreach($classCategory as $category){
				$categories[$category->id] = $category->title;
			}
		}

		$Injection = new Injection();
		$metafields = $Injection->metafields("post");

        return view('blogpost::backend.create',array("title" => "Create Post",'categories' =>$categories ,'metafields' => $metafields));
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
			if(!isset($input["categories"])) $input["categories"] = 1;
			$saved = array();
			$Post = new Post;
			if(isset($input["id"]) && is_numeric($input["id"])){
				$Post = Post::find($input["id"]);
			}

			$Post->title = $input["title"];
			$Post->slug = $Injection->slug($input["slug"]);
			$Post->description = $input["description"];
			$Post->lang = 'en';
			$Post->post_type = 'post';
			$Post->user_id =  Auth::user()->id;
			$Post->category_id =  $input["categories"];
			$Post->save();
			$saved[] = $Post->id;
			$_metavalues = array();
			$metavalues = DB::table('metavalues')->where('post_id',$Post->id)->get();
			if($metavalues){
				foreach($metavalues as $metavalue){
					$_metavalues[$metavalue->meta_id] =  $metavalue;
				}
			}

			
			if(!empty($input["metadata"])){
				foreach($input["metadata"] as $key => $metadata){
					if(isset($_metavalues[$key])){
						//update
						$meta = new Metavalue();
						$meta = $meta->find($_metavalues[$key]->id);
						$meta->value = $metadata;
						$meta->meta_id = $key;
						$meta->handle = '#';
						$meta->title = '#';
						$meta->user_id = Auth::user()->id;
						$meta->post_id =  $Post->id;
						$meta->save();
						
					}
					else{
						//create
						$meta = new Metavalue();
						$meta->value = $metadata;
						$meta->handle = '#';
						$meta->title = '#';
						$meta->meta_id = $key;
						$meta->user_id = Auth::user()->id;
						$meta->post_id =  $Post->id;
						$meta->save();
					}
				}
				
				//print "Test";
			}

			return Response()->json([
				"id" => $saved,
				"message" => "Successfully created post!"
			], 200);
			die();
		}
		else{
			$input = $input["params"];
			if(!isset($input["categories"])) $input["categories"] = 1;
			$Post = new Post;
			$Post->title = $input["title"];
			$Post->slug = $Injection->slug($input["slug"]);
			$Post->post_type = 'post';
			$Post->description = $input["description"];
			$Post->lang = 'en';
			$Post->user_id = Auth::user()->id;
			$Post->category_id =  $input["categories"];
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
        $js = [Module::asset("blogpost:js/post.js")];
        View::share('js_script', $js);
		$Post = Post::find($id);
		$classCategory = \Modules\Blogpost\Entities\Category::all();
		$categories = array();
		
		if($classCategory){
			foreach($classCategory as $category){
				$categories[$category->id] = $category->title;
			}
		}

		$metavalues = DB::table('metavalues')->where('post_id',$id)->get();
		$_metavalues = array();
		if($metavalues){
			foreach($metavalues as $metavalue){
				$_metavalues[$metavalue->meta_id] =  $metavalue;
			}
		}

		$Injection = new Injection();
		$metafields = $Injection->metafields("post",$_metavalues);

        return view('blogpost::backend.edit',array("title" => "Edit Post",'categories' =>$categories ,'metafields' => $metafields))->with('post', $Post);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        $js = [Module::asset("blogpost:js/post.js")];
        View::share('js_script', $js);
        $Post = Post::find($id);
        return view('blogpost::backend.edit',array("title" => "Edit Post"))->with('post', $Post);
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
			$nerd = Post::find($input["id"]);
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
