<?php

namespace Modules\Terms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Modules\Blogpost\Entities\Category as Category;
use Modules\Blogpost\Entities\Post as Post;
use Modules\Blogpost\Entities\Metafields;
use Modules\Blogpost\Entities\Metavalue as Metavalue;
use Modules\Terms\Entities\Terms;
use Session;
use View;
use Devdewa\Injection\Helper as Injection;
use Devdewa\Injection\Product as Product;
use Devdewa\Injection\Tree as Tree;

class TermsController extends Controller
{
    public $title = "Category";

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
        $Session = Session::all();
        $this->title = $Session["subdomain"];
        return view('terms::index',array("title"=>$this->title));
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('terms::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    protected function filter($request){

        $Session = Session::all();
        $this->title = $Session["subdomain"];
        $result = array();
        $Injection = new Injection();
        if($slug = $request->slug){
            $classCategory = new Category;
            $Post = new Post;
            $category =  $classCategory::where("slug",$slug)
            ->orderBy('id', 'desc')
            ->take(1)
            ->get(); 

            if( $category->count() > 0){
                $category = $category->first();
                if($request->typeFilter == "sortLowHigh"){
                    $listings =  DB::table('posts')
                        ->distinct()
                        ->join("metavalues","posts.id", "=", "metavalues.post_id")
                        ->join("metafields","metafields.id", "=", "metavalues.meta_id")
                        ->select('posts.*','metavalues.post_id','metafields.handle as handler', "metavalues.value as price")
                        ->where(
                            array(
                                "posts.category_id"=>$category->id,
                                "posts.post_type" =>  $request->type,
                                "metafields.handle" => "price"
                            )
                        )
                        ->orderBy('metafields.handle', 'asc')
                        ->offset(0)
                        ->groupBy("posts.id")
                        ->take(12)
                        ->get();
                } 
                else if($request->typeFilter == "sortHighLow"){
                    $listings =  DB::table('posts')
                        ->distinct()
                        ->join("metavalues","posts.id", "=", "metavalues.post_id")
                        ->join("metafields","metafields.id", "=", "metavalues.meta_id")
                        ->select('posts.*','metavalues.post_id','metafields.handle as handler', "metavalues.value as price")
                        ->where(
                            array(
                                "posts.category_id"=>$category->id,
                                "posts.post_type" =>  $request->type,
                                "metafields.handle" => "price"
                            )
                        )
                        ->orderBy('metafields.handle', 'asc')
                        ->offset(0)
                        ->groupBy("posts.id")
                        ->take(12)
                        ->get();
                }
                else if($request->typeFilter == "sortEarlier"){
                    $listings =  DB::table('posts')
                        ->distinct()
                        ->join("metavalues","posts.id", "=", "metavalues.post_id")
                        ->join("metafields","metafields.id", "=", "metavalues.meta_id")
                        ->select('posts.*','metavalues.post_id','metafields.handle as handler', "metavalues.value as price")
                        ->where(
                            array(
                                "posts.category_id"=>$category->id,
                                "posts.post_type" =>  $request->type,
                                "metafields.handle" => "price"
                            )
                        )
                        ->orderBy('metafields.handle', 'asc')
                        ->offset(0)
                        ->groupBy("posts.id")
                        ->take(12)
                        ->get();
                }
                else if($request->typeFilter == "sortViews"){
                    $listings =  DB::table('posts')
                        ->distinct()
                        ->join("metavalues","posts.id", "=", "metavalues.post_id")
                        ->join("metafields","metafields.id", "=", "metavalues.meta_id")
                        ->select('posts.*','metavalues.post_id','metafields.handle as handler', "metavalues.value as price")
                        ->where(
                            array(
                                "posts.category_id"=>$category->id,
                                "posts.post_type" =>  $request->type,
                                "metafields.handle" => "price"
                            )
                        )
                        ->orderBy('metafields.handle', 'asc')
                        ->offset(0)
                        ->groupBy("posts.id")
                        ->take(12)
                        ->get();
                } 
                else if($request->typeFilter == "price"){
                    $listings =  DB::table('posts')
                        ->distinct()
                        ->join("metavalues","posts.id", "=", "metavalues.post_id")
                        ->join("metafields","metafields.id", "=", "metavalues.meta_id")
                        ->select('posts.*','metavalues.post_id','metafields.handle as handler', "metavalues.value as price")
                        ->where(
                            array(
                                "posts.category_id"=>$category->id,
                                "posts.post_type" =>  $request->type,
                                "metafields.handle" => "price"
                            )
                        )
                        ->orderBy('metafields.handle', 'asc')
                        ->offset(0)
                        ->groupBy("posts.id")
                        ->take(12)
                        ->get();
                }
                else if($request->typeFilter == "filter"){
                    $listings =  DB::table('posts')
                        ->distinct()
                        ->join("metavalues","posts.id", "=", "metavalues.post_id")
                        ->join("metafields","metafields.id", "=", "metavalues.meta_id")
                        ->select('posts.*','metavalues.post_id','metafields.handle as handler', "metavalues.value as price")
                        ->where(
                            array(
                                "posts.category_id"=>$category->id,
                                "posts.post_type" =>  $request->type,
                                "metafields.handle" => "price"
                                
                            )
                        )
                        ->where("metavalues.value", '>=', $request->price["min"])
                        ->where("metavalues.value", '<=', $request->price["max"])
                        ->orderBy('metafields.handle', 'asc')
                        ->offset(0)
                        ->groupBy("posts.id")
                        ->take(12)
                        ->get();
                }
                

            }
            else{
                $listings =  $category;
            }

        }

        $attachments =  DB::table('posts')
                ->distinct()
                ->where("post_type","attachment")
                ->get();

        return response()->json([
			'body' => view('terms::lists', compact(array('attachments','listings')))->render(),
			'listings' => $listings,
		]);
    }

    public function show(Request $request)
    {
        $Session = Session::all();
        $this->title = $Session["subdomain"];
        return view('terms::view',array("title"=>$this->title))->with(array("menu"=>$this->menu));
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show1(Request $request)
    {
        $Session = Session::all();
        $this->title = $Session["subdomain"];
        if($request->ajax()){
            
            return $this->filter($request);
        }

        $Injection = new Injection();
        if($slug = $request->slug){
            $classCategory = new Category;
            $Post = new Post;
            $category =  $classCategory::where("slug",$slug)
            ->orderBy('id', 'desc')
            ->take(1)
            ->get(); 
            
            $attachments =  DB::table('posts')
                ->distinct()
                ->where("post_type","attachment")
                ->get(); 

            /*
            select posts.* , metavalues.value, metafields.handle as handler 
            from posts 
            inner join metavalues on posts.id = metavalues.post_id 
            inner join metafields on metafields.id = metavalues.meta_id 
            where metafields.handle = "price"
            group by posts.id
            order by metafields.handle 
            */
            if( $category->count() > 0){
                $category = $category->first();
                $result =  DB::table('posts')
                    ->distinct()
                    ->join("metavalues","posts.id", "=", "metavalues.post_id")
                    ->join("metafields","metafields.id", "=", "metavalues.meta_id")
                    ->select('posts.*','metavalues.post_id','metafields.handle as handler', "metavalues.value as price")
                    ->where(
                        array(
                            "posts.category_id"=>$category->id,
                            "posts.post_type" =>  $request->type,
                            "metafields.handle" => "price"
                        )
                    )
                    ->orderBy('metafields.handle', 'asc')
                    ->offset(0)
                    ->groupBy("posts.id")
                    ->take(12)
                    ->get();
            }
            else{
                $result =  $category;
            }

            return view('terms::show',array("title"=>$this->title))->with(array("attachments"=> $attachments,"listings"=>$result , "menu"=>$this->menu));
        }
 
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('terms::edit');
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
