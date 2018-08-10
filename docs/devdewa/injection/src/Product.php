<?php

namespace Devdewa\Injection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Blogpost\Entities\Post;
use Modules\Blogpost\Entities\Metafields;
use Modules\Blogpost\Entities\Metavalue as Metavalue;
use Modules\Terms\Entities\Terms;
use Illuminate\Support\Facades\DB;
use Form;
use Config;
use Session;
use Illuminate\Support\Facades\View;
class Product
{	
    var $post ;
    public function list(){
        
    }

    public function most_popular(){
        $Session = Session::all();
       // $posts = DB::table('posts')->where('post_type','product')->get();
        $posts = DB::table('posts')->get();
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

        /*
        *
        print "<div class=\"text-left\"><pre>";
        print_r($posts);
        print_r($metavalues);
        print "</pre></div>";
        *
        */

        foreach($posts as $key => $post){
            if($post->parent_id){
                $postMetavalues[$post->parent_id]->children[$post->post_type][$post->id] = $post;
            }
            if($post->post_type !="product"){
                continue;
            }
            $_metavalues = array();
			if($metavalues){
                $inDomain = false;
				foreach($metavalues as $metavalue){
                    if($post->id == $metavalue->post_id){
                        $_metavalues[$metavalue->handle] = $metavalue;
                        $post->metadata = $_metavalues;
                        $postMetavalues[$post->id] = $post;
                    }
                    
                    if( $metavalue->handle == "location" && strtolower($metavalue->value) == $Session["subdomain"]){
                        $inDomain = true;
                    }

                }

                if(!$inDomain && isset($postMetavalues[$post->id])){
                    unset($postMetavalues[$post->id]);
                }
                
            }
        }

        $metaCollections = collect($postMetavalues);
        return $metaCollections;
    }
}