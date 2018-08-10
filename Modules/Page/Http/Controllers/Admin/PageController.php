<?php

namespace Modules\Page\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Modules\Blogpost\Entities\Post;
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

class PageController extends Controller
{
    public $title = "Pages";
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        
		$js = [Module::asset("page:js/page.js")];
		View::share('js_script', $js);
        return view('page::backend.index',array("title"=>$this->title));
    }
	
	public function api_v1(){
		$posts = DB::table('posts')->where('post_type','page')->get();
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
		$js = [Module::asset("page:js/page.js")];
        View::share('js_script', $js);
        $Injection = new Injection();
		$metafields = $Injection->metafields("page");
        return view('page::backend.create',array("title" => "Create Page",'metafields' => $metafields));
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
			$Post = new Post;
			if(isset($input["id"]) && is_numeric($input["id"])){
				$Post = Post::find($input["id"]);
			}
			$Post->title = $input["title"];
			$Post->slug = $Injection->slug($input["slug"]);
			$Post->short_description = (isset($input["short_description"]))? $input["short_description"]:"NULL";
			$Post->description = (isset($input["description"]))? $input["description"]:"NULL";			
			$Post->lang = 'en';
            $Post->post_type = 'page';
            $Post->category_id = '1';
			$Post->user_id =  Auth::user()->id;
            $Post->save();
            
            $_metavalues = array();
			$metavalues = DB::table('metavalues')->where('post_id',$Post->id)->get();
			if($metavalues){
				foreach($metavalues as $metavalue){
					$_metavalues[$metavalue->meta_id] =  $metavalue;
				}
			}

			
			if(!empty($input["metadata"])){
				foreach($input["metadata"] as $key => $metadata){
                    $key = str_replace("meta_","",$key);
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
				"id" => $Post->id,
				"message" => "Successfully created page!"
			], 200);
			die();
		}
		else{
			$input = $input["params"];
			$Post = new Post;
			$Post->title = $input["title"];
			$Post->slug = $Injection->slug($input["slug"]);
			$Post->post_type = 'page';
			$Post->description = $input["description"];
            $Post->lang = 'en';
            $Post->category_id = '1';
			$Post->user_id = Auth::user()->id;
			$Post->save();
		}
		Session::flash('message', 'Successfully created page!');
        return Redirect::to('admin/articles');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $js = [Module::asset("pages:js/page.js")];
        View::share('js_script', $js);
        $Post = Post::find($id);
        return view('page::backend.edit',array("title" => "Edit page"))->with('post', $Post);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $js = [Module::asset("page:js/page.js")];
        View::share('js_script', $js);
		$Post = Post::find($id);
		$classCategory = \Modules\Blogpost\Entities\Category::all();
		$categories = array();
		
		if($classCategory){
			foreach($classCategory as $category){
				$categories[$category->id] = $category->title;
			}
		}
		$_metavalues = array();
		$metavalues = DB::table('metavalues')->where('post_id',$id)->get();
		if($metavalues){
			foreach($metavalues as $metavalue){
				$_metavalues[$metavalue->meta_id] =  $metavalue;
			}
		}

		$Injection = new Injection();
		$metafields = $Injection->metafields("page",$_metavalues);

        return view('page::backend.edit',array("title" => "Edit Page",'categories' =>$categories ,'metafields' => $metafields))->with('post', $Post);
    
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
				echo json_encode(array("message" => 'Successfully deleted the page!'));
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
