<?php

namespace Modules\Services\Http\Controllers\Admin;

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
use File;
use Devdewa\Injection\Helper as Injection;
use Intervention\Image\ImageManagerStatic as Image;

class ServicesController extends Controller
{
    public $title = "Services";
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        
		$js = [Module::asset("services:js/service.js")];
		View::share('js_script', $js);
        return view('services::backend.index',array("title"=>$this->title));
    }
	
	public function api_v1(){
		$posts = DB::table('posts')->where('post_type','service')->get();
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
		$js = [Module::asset("services:js/service.js")];
        View::share('js_script', $js);
        $Injection = new Injection();
		$metafields = $Injection->metafields("service");
        return view('services::backend.create',array("title" => "Create service",'metafields' => $metafields));
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
			//$Post->description = $input["description"];
			$Post->short_description = (isset($input["short_description"]))? $input["short_description"]:"NULL";
			$Post->description = (isset($input["description"]))? $input["description"]:"NULL";
			$Post->lang = 'en';
            $Post->post_type = 'service';
            $Post->category_id = '1';
			$Post->user_id =  Auth::user()->id;
			if(isset($input["file"]) && is_array($input["file"])){
				$Post->file = $input["file"]["result"];
			} 
			else if(isset($input["file"]) && !is_array($input["file"])) {
				$Post->file = $input["file"];
			}
			else{

			}
			
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
				"message" => "Successfully created service!"
			], 200);
			die();
		}
		else{
			$input = $input["params"];
			$Post = new Post;
			$Post->title = $input["title"];
			$Post->slug = $Injection->slug($input["slug"]);
			$Post->post_type = 'service';
			$Post->description = $input["description"];
            $Post->lang = 'en';
            $Post->category_id = '1';
			$Post->user_id = Auth::user()->id;
			$Post->save();
		}
		Session::flash('message', 'Successfully created service!');
        return Redirect::to('admin/articles');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $js = [Module::asset("services:js/service.js")];
        View::share('js_script', $js);
		$Post = Post::find($id);
		$files = '$files';
        return view('services::backend.edit',array("title" => "Edit service"))->with(array('files' => $files ,'post' => $Post));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $js = [Module::asset("services:js/service.js")];
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
		$metafields = $Injection->metafields("service",$_metavalues);

        return view('services::backend.edit',array("title" => "Edit service",'categories' =>$categories ,'metafields' => $metafields))->with('post', $Post);
    
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
	
	public function uploadFiles(Request $request){
		if ($request->hasFile('file')) {
			$image = $request->file('file');
			$name = time().'.'.$image->getClientOriginalExtension();
			$image_ = Image::make($image->getRealPath());       
			$image_->save(public_path('/images/product/' .$name));	
			
			$image_resize = Image::make($image->getRealPath());  
			$image_resize->resize(300, 300);
			$image_resize->save(public_path('/images/product/thumbs/' .$name));	
			return '/images/product/' .$name;
		}

	}
}
