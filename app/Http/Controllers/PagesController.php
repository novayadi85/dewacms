<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class PagesController extends Controller
{
    public function index(){
		$Session = Session::all();
		return view("pages.index");
    }
	
	 public function tes(Request $request){
		if($request->has("store")){
			Session::put('store', $request->store);
		}
		$data = Session::all();
		print_r($data);
        return view("pages.index");
	 }

    public function getPage($slug = null){
        // $page = Page::where('route', $slug)->where('active', 1);
        // $page = $page->firstOrFail();
        // return view($page->template)->with('page', $page);
       $data = array(
           "title" => "List Devices",
           "devices" => array(
                "Apple iMac",
                "Apple iPhone 8.0",
                "Apple iPad 3.0"
           )
       );
        return view("pages.view")->with($data);
    }
}
