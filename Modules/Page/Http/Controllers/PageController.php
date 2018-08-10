<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Blogpost\Entities\Post;
use Modules\Blogpost\Entities\Metafields;
use Modules\Blogpost\Entities\Metavalue as Metavalue;
use Modules\Terms\Entities\Terms;
use Session;
use View;
use Devdewa\Injection\Helper as Injection;
use Devdewa\Injection\Product as Product;
use Devdewa\Injection\Tree as Tree;

class PageController extends Controller
{
	public $title = "Page";
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public $menu ;

    public function  __construct(){
        $menu = DB::table('menus')->orderBy('position', 'asc')->get();
        $Tree = new Tree;
        $this->menu = $Tree->buildTree($menu,0);
        
    }

    public function index()
    {
		$Session = Session::all();
        $this->title = $Session["subdomain"];
        $Tree = new Tree();
        $Injection = new Injection();
        $menu = $this->menu;
        //$nav =  $Tree->drawMenu($menu[0]->children);
        $onepages = DB::table('posts')->where('post_type','page')->get();
        $classCategory = \Modules\Blogpost\Entities\Category::all();
        $metavalues = DB::table('metavalues')->join("metafields", 'metafields.id', '=', 'metavalues.meta_id')
        ->select('metavalues.*','metafields.handle')->get();
		$categories = array();
		$postMetavalues = array();
		if($classCategory){
			foreach($classCategory as $category){
				$categories[$category->id] = $category->title;
			}
        }
        foreach($onepages as $key => $page){
            $_metavalues = array();
			if($metavalues){
                $inDomain = false;
				foreach($metavalues as $metavalue){
                    if($page->id == $metavalue->post_id){
                        $_metavalues[$metavalue->handle] = $metavalue;
                        $page->metadata = $_metavalues;
                       // $page->description = $Injection->shortcodify($page->description);
                        $html = $page->description;
                        $page->html = $Injection->shortcodify($html , $page);
                        $postMetavalues[$page->id] = $page;
                    }
                    
                    if( $metavalue->handle == "location" && strtolower($metavalue->value) == $Session["subdomain"]){
                        $inDomain = true;
                    }

                }

                if(!$inDomain && isset($postMetavalues[$page->id])){
                    unset($postMetavalues[$page->id]);
                }
                
            }
           // $onepages->$key->metadata = $_metavalue;
        }

        $metaCollections = collect($postMetavalues);
        $categories = collect($categories);
        return view('page::index',array("title"=>$this->title,"posts"=>$metaCollections , "menu" => $menu));
    }

    public function search()
    {
		$Session = Session::all();
		$this->title = $Session["subdomain"];
        return view('page::search',array("title"=>$this->title));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('page::create');
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
    public function show()
    {
        return view('page::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('page::edit');
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
