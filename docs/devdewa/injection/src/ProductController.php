<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Devdewa\Injection\Helper as Injection;
use Devdewa\Injection\Product as Product;
use Devdewa\Injection\Tree as Tree;
use Modules\Blogpost\Entities\Post;
use Modules\Blogpost\Entities\Category;
use Modules\Blogpost\Entities\Metafields;
use Modules\Blogpost\Entities\Metavalue as Metavalue;
use Modules\Terms\Entities\Terms;

use Session;

class ProductController extends Controller
{
    public $title = "Product";

    public $menu ;

    public function  __construct(){
        $menu = DB::table('menus')->orderBy('position', 'asc')->get();
        $Tree = new Tree;
        $this->menu = $Tree->buildTree($menu,0);
        
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('product::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('product::create');
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
    public function show(Request $request)
    {
        $Session = Session::all();
        $this->title = $Session["subdomain"];
        $galleries = DB::table('posts')->where(
            array(
                'parent_id'=> $request->slug,
                'post_type'=>'attachment'
            )
        )->get();
        $Post = Post::find($request->slug);
        //$Post = DB::table('posts')->where("slug",$request->slug);
		$classCategory = \Modules\Blogpost\Entities\Category::all();
		$categories = array();
		
		if($classCategory){
			foreach($classCategory as $category){
				$categories[$category->id] = $category->title;
			}
		}
		$_metavalues = array();
        $metavalues = DB::table('metavalues')
        ->join("metafields","metafields.id", "=", "metavalues.meta_id")
        ->select("metavalues.*","metafields.handle as handler","metafields.title as headline")
        ->where('.metavalues.post_id',$request->slug)->get();
		if($metavalues){
			foreach($metavalues as $metavalue){
               // $_metavalues[$metavalue->handler] =  $metavalue;
                if($metavalue->handler == "days"){
                    $_metavalues[$metavalue->handler][$metavalue->id] =  $metavalue;
                }
                else{
                    $_metavalues[$metavalue->handler] =  $metavalue;
                }
			}
        }
        /* echo $request->slug;
        print "<pre>";
        print_r($galleries); exit();*/

        return view('product::show',array(
            "title"=>$this->title , 
            "metavalues" =>$_metavalues ,
            "galleries"=>$galleries, 
            "categories" => $categories,
            "product" => $Post,
            "menu"=>$this->menu)
        );
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('product::edit');
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
