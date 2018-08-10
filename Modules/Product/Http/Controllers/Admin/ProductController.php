<?php

namespace Modules\Product\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Modules\Blogpost\Entities\Post;
use Modules\Blogpost\Entities\Category;
use Modules\Blogpost\Entities\Metafields;
use Modules\Blogpost\Entities\Metavalue as Metavalue;
use Modules\Blogpost\Entities\Contents as Contents;
use Modules\Blogpost\Entities\Dates as Dates;
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

class ProductController extends Controller
{
    public $title = "Product";
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
		$js = [Module::asset("product:js/product.js")];
		View::share('js_script', $js);
		$Injection = new Injection();
		return view('product::backend.index',array("title"=>$this->title));
    }
	
	public function api_v1(){
		$request = Input::all();
		$input = $request["params"];
		if(isset($input["lang"])){
			$posts = DB::table('posts')->where(array('lang'=>$input["lang"] , 'post_type'=>'product'))->get();
		}
		else{
			$posts = DB::table('posts')->where('post_type','product')->get();
		}
		
        return Response()->json([
			'posts' => $posts
		], 200);		
	}
	
	/**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function load(Request $request)
    {
		$input = $request["params"];
		$find = false;
		$posts = array();
		$_contents = array();
		$_dates = array();
		//
		if(isset($input["id"]) && is_numeric($input["id"])){
			$contents = DB::table('contents')
			->join("posts", 'posts.id', '=', 'contents.post_id')
			->select('posts.id as post_id','contents.*','contents.text as content')
			->where(
				array(
					'contents.post_id' => $input["id"]
					) 
				)
			->get();
			
			if($contents->count() > 0) {
				foreach($contents as $content){
					$content->uid = uniqid().$content->id;
					$_contents[$content->id] =  $content;
				}	

				$posts = $_contents;
			}

			$dates = DB::table('dates')
			->join("posts", 'posts.id', '=', 'dates.post_id')
			->select('posts.id as post_id','dates.*')
			->where(
				array(
					'dates.post_id' => $input["id"]
					) 
				)
			->get();
			
			if($dates->count() > 0) {
				foreach($dates as $date){
					$date->uid = uniqid().$date->id;
					$_dates[$date->id] =  $date;
				}	
			}
			

		}
		return Response()->json([
			'posts' => $posts,
			'dates' => $_dates
		], 200);
        
    }
	
	/**
     * Show the specified resource.
     * @return Response
    */
    public function get_post(Request $request)
    {
        $posts = Post::find($request["id"]);
		return Response()->json([
			'posts' => $posts
		], 200);
	}
	
	public function create()
    {
		$js = [Module::asset("product:js/product.js")];
		View::share('js_script', $js);
		$classCategory = \Modules\Blogpost\Entities\Category::where('taxonomy','product')->get();
		$categories = array();
		
		if($classCategory){
			foreach($classCategory as $category){
				$categories[$category->id] = $category->title;
			}
		}

		$Injection = new Injection();
		$metafields = $Injection->metafields("product");
		$files = '$files';
        return view('product::backend.create',array("files" => $files , "title" => "Create Product",'categories' =>$categories ,'metafields' => $metafields));
    }
	
	/**
     * Show the specified resource.
     * @return Response
    */
    public function show($id)
    {
        $js = [Module::asset("product:js/product.js")];
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
		$metafields = $Injection->metafields("product",$_metavalues);
		$files = '$files';
        return view('product::backend.edit',array("title" => "Edit Post",'categories' =>$categories ,'metafields' => $metafields , 'files' => $files))->with('post', $Post);
    }
	
	public function store(Request $request)
    {
        $Injection = new Injection();
		$input = Input::all();
		
		if(isset($input["action"]) && $input["action"] == "add"){
			try {
				$input = $input["params"];
				if(!isset($input["categories"])) $input["categories"] = 2;
				$saved = array();
				$Post = new Post;
				if(isset($input["id"]) && is_numeric($input["id"])){
					$Post = Post::find($input["id"]);
				}

				$Post->title = $input["title"];
				$Post->slug = $Injection->slug($input["slug"]);
				$Post->short_description = (isset($input["short_description"]))? $input["short_description"]:"NULL";
				$Post->notes = $input["CONTEXT"]["notes"];
				$Post->description = (isset($input["CONTEXT"]["description"]))? $input["CONTEXT"]["description"]:"NULL";
				$Post->lang = 'en';
				$Post->post_type = 'product';
				$Post->user_id =  Auth::user()->id;
				$Post->category_id =  $input["categories"];
				$Post->save();
				$saved[] = $Post->id;
				$_metavalues = array();
				$_metaTabs = array();
				$metavalues = DB::table('metavalues')->where('post_id',$Post->id)->get();
				if($metavalues){
					foreach($metavalues as $metavalue){
						$_metavalues[$metavalue->meta_id][$metavalue->id] =  $metavalue;
					}
				}

				$metaTabs = DB::table('contents')->where('post_id',$Post->id)->get();
				if($metaTabs){
					foreach($metaTabs as $metaTab){
						$_metaTabs[$metaTab->post_id][$metaTab->id] =  $metaTab;
					}
				}
				//tabs store
				if(isset($input["tabs"])){
					//need delete days first 
					if(isset($_metaTabs[$Post->id])){
						if(is_array($_metaTabs[$Post->id])){
							foreach($_metaTabs[$Post->id] as $_metaTabToDrop){
								$nerd = new Contents();
								$nerd = Contents::find($_metaTabToDrop->id);
								$nerd->delete();
							}
						}
					}

					foreach($input["tabs"] as $index => $tabs){
						if(!empty($tabs)){
							$Contents = new Contents();
							$Contents->text = "";
							$Contents->title = $input["tabs"][$index];
							if(isset($input["CONTEXT"]["content_".$index])){
								$Contents->text = $input["CONTEXT"]["content_".$index];
							}
							
							/*
							if(is_array( $day["file"])){
								$Days->file = $day["file"]["result"];
							}
							else{
								$Days->file = $day["file"];
							}
							*/
							
							$Contents->user_id = Auth::user()->id;
							$Contents->post_id =  $Post->id;
							$Contents->save();
						}	
					}

				}

				if(isset($input["dates"])){
					
					//date store
					$_metaDates = array();
					$metaDates = DB::table('contents')->where('post_id',$Post->id)->get();
					if($metaDates){
						foreach($metaDates as $metaDate){
							$_metaDates[$metaDate->post_id][$metaDate->id] =  $metaDate;
						}
					}
					//need delete days first 
					if(isset($_metaDates[$Post->id])){
						if(is_array($_metaDates[$Post->id])){
							foreach($_metaDates[$Post->id] as $_metaDateToDrop){
								$nerd = new Dates();
								if(is_numeric($_metaDateToDrop->id)){
									$nerd = Dates::find($_metaDateToDrop->id);
									$nerd->delete();
								}
								
								//if($nerd->result())
								//$nerd->delete();
							}
						}
					}
					if(isset($input["dates"]["start"]) && is_array($input["dates"]["start"]) && sizeof($input["dates"])){
						foreach($input["dates"]["start"] as $index => $date){
							if(!empty($tabs)){
								$Dates = new Dates();
								$Dates->title = "";
								$Dates->start = $date;
								$Dates->end = $input["dates"]["end"][$index];
								$Dates->price = (isset($input["dates"]["price"])) ? $input["dates"]["price"][$index] : "";							
								$Dates->user_id = Auth::user()->id;
								$Dates->post_id =  $Post->id;
								$Dates->save();
							}	
						}
					}
					

				}

				if(!empty($input["metadata"])){
					foreach($input["metadata"] as $key => $metadata){
						$key = str_replace("meta_","",$key);
						if(isset($_metavalues[$key]->id)){
							//update
							if(!empty($metadata)){
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
							
							
						}
						else{
							//create
							if(!empty($metadata)){
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
					}
					
					//print "Test";
				}
				$error = false;
				$error_message = "Successfully created post!";
			}
			catch (\Exception $e) {
				$error = true;
				$error_message = $e->getMessage();
			}
			//print_r($input); exit();
			return Response()->json([
				"id" => $saved,
				"message" => $error_message,
				"error" => $error
			], 200);
			die();
		}
		else{
			try{
				$input = $input["params"];
				if(!isset($input["categories"])) $input["categories"] = 2;
				$Post = new Post;
				$Post->title = $input["title"];
				$Post->slug = $Injection->slug($input["slug"]);
				$Post->post_type = 'product';
				$Post->description =(!empty($input["description"]))? $input["description"]:"NULL";
				$Post->lang = 'en';
				$Post->user_id = Auth::user()->id;
				$Post->category_id =  $input["categories"];
				$Post->save();
				$error_message = 'Successfully created user!';
			}
			catch (\Exception $e) {
				$error_message = $e->getMessage();
			}
		}
		Session::flash('message', $error_message);
        return Redirect::to('admin/product');
	}
	
	public function uploadFiles(Request $request){
		if ($request->hasFile('file')) {
			$image = $request->file('file');
			$name = time().'.'.$image->getClientOriginalExtension();
			$image_resize = Image::make($image->getRealPath());              
			$image_resize->resize(300, 300);
			$image_resize->save(public_path('/images/product/thumbs/' .$name));	
			return '/images/product/thumbs/' .$name;
		}

	}
	
	public function upload(Request $request){
		// $this->validate($request, [
			// 'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		// ]);

		if ($request->hasFile('file')) {
			$image = $request->file('file');
			$name = time().'.'.$image->getClientOriginalExtension();
			$image_resize = Image::make($image->getRealPath());              
			$image_resize->resize(300, 300);
			$image_resize->save(public_path('/images/product/thumbs/' .$name));			
			$destinationPath = public_path('/images/product');
			$image->move($destinationPath, $name);
			$postData = $this->create_gallery($request->post, $name , '/images/product/');
			$data = array_merge(['photo' => "images/product/{$name}" , 'input' => $postData], $request->all());
			//return back()->with('success','Image Upload successfully');
			return Response()->json([
				'data' => $data
			], 200);
		}
		
	}
	
	public function create_gallery($input,$name , $path = false){
		if(!$path){
			$path = ('/images/product/');
		}
		$Injection = new Injection();
		$input = json_decode($input,true);
		$Post = new Post;
		$out = array();
		if(isset($input["id"]) && is_numeric($input["id"])){
			$Post->title = $name;
			$Post->parent_id = $input["id"];
			$Post->slug = $Injection->slug($name);
			$Post->description = "NULL";
			$Post->category_id = 2;
			$Post->lang = 'en';
			$Post->guid = $path . $name;
			$Post->post_type = 'attachment';
			$Post->user_id =  Auth::user()->id;
			$saved = $Post->save();
			$out["id"] = $Post->id;
			$out["draft"] = false;
		}
		else{
			$Post->title = (!empty($input["title"]))? $input["title"]:"draft";
			$Post->slug = $Injection->slug($input["slug"]);
			$Post->description = (!empty($input["description"]))? $input["description"]:"NULL";
			$Post->lang = 'en';
			$Post->category_id = 2;
			$Post->post_type = 'draft';
			$Post->user_id =  Auth::user()->id;
			$saved = $Post->save();
			$out["draft"] = $Post->id;
			
			if($saved){
				$Post = new Post;
				$Post->title = $name;
				$Post->parent_id = $out["draft"];
				$Post->slug = $Injection->slug($name);
				$Post->description = "NULL";
				$Post->category_id = 2;
				$Post->lang = 'en';
				$Post->post_type = 'attachment';
				$Post->guid = $path . $name;
				$Post->user_id =  Auth::user()->id;
				$saved = $Post->save();
				$out["id"] = $Post->id;
				
			}
		}
		
		return $out;
		
		
	}
	
	public function gallery(Request $request){	
		$input = $request["params"];
		$images = array();
		if($input["id"]){
			$images = DB::table('posts')->select('*','guid as src')->where(array('parent_id'=> $input["id"] , 'post_type'=>'attachment'))->get();
		}
		
		return Response()->json([
			'galleries' => $images
		], 200);
		
		/* return response()->json([
			'body' => view('product::backend.gallery', compact('images'))->render(),
			'product' => $images,
		]); */
	}
	
	public function remove()
    {
		
		$input = Input::all();
		// print_r($input); exit();
		if(isset($input["action"]) && $input["action"] == "remove"){
			$input = $input["params"];
			$nerd = Post::find($input["id"]);
			if($nerd->delete()){
				echo json_encode(array("message" => 'Successfully deleted the post!'));
			}
			else{
				echo "Error";
			}
			die();
			
		}
		else if(isset($input["action"]) && $input["action"] == "removeImage"){
			$input = $input["params"];
			$nerd = Post::find($input["id"]);
			$image_path = public_path($nerd->guid);
			if(File::exists($image_path)){
				File::delete($image_path);
				if($nerd->delete()) {
					echo json_encode(array("message" => 'Successfully deleted the image!'));
					
				}
				
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
