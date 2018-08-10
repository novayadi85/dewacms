<?php

namespace Devdewa\Injection;
use Illuminate\Support\Facades\DB;
use Form;
use Config;
use Session;
use Illuminate\Support\Facades\View;

class Helper
{	
	var $post ;

	public function slug($string) {
		$string = strtolower($string);    
		$string = str_replace(' ', '-', $string);
		$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
		$string = str_replace('--', '-', $string);
		return  $string;
	}

	public function metafields($type,$values = array()){
		$posts = DB::table('metafields')->whereRaw("find_in_set('$type',post_type)")->get();
		return $this->renderHtml($posts,$values , $type);
	}

	private function getLocales(){
		$languages = Config::get('app.locales');
		return $languages ;
	}

	public static function renderLanguages($locale = "en",$event = ''){
		$languages = Config::get('app.locales');
		$html =  Form::select('lang', $languages , $locale ,['init-model' => 'lang' , 'class' => 'form-control','ng-model' => 'post.lang']);
		return $html;
	}

	private function renderHtml($objs,$values = array(),$type){
		$html = array();
		if($objs){
			foreach($objs as $obj){
				$value = '';
				$options_values = array("true" => "Yes", "false" => "Nope");
				if($obj->handle == "location"){
					$obj->type = "select";
					$options_values = array(
						"bali" => "Bali",
						"java" => "Java"
					);
				}
				
				if(isset($values[$obj->id])){
					$value = $values[$obj->id]->value;
				}
				$handle = "metadata[{$obj->id}]";
				$html[]= "<div class=\"form-group row\">";
				if($obj->handle == 'days'){
					$html[]= "<label class=\"col-md-8 control-label\">".$obj->title."</label>";
					$html[]= "<div class=\"col-md-4\"><a ng-click=\"addDays()\" class=\"btn blue btn-default pull-right\">Add New</a></div>";
				}
				else{
					$html[]= "<label class=\"col-md-12 control-label\">".$obj->title."</label>";
				}
				$html[]= "<div class=\"col-md-12\">";
				switch($obj->type){
					case 'select' :
						$html[]=  Form::select($handle, $options_values , $value ,['init-model' => 'metadata.meta_'.$obj->id ,'dataMeta' => "meta_".$obj->id , 'class' => 'form-control','ng-model' => $type.".meta_".$obj->id]);
					break;
					case 'text' :
						if($obj->handle == 'days'){
							$html[]=  "
							<div class=\"days-tabs\">
								<div ng-repeat=\"x in days\" class=\"tab-child\">
									<ul class=\"nav nav-tabs\">
										<li class=\"active\"><a href=\"#<%x.id%>\"><%x.title%></a></li>
									</ul>
									<div class=\"tab-content\" style=\"margin-bottom:25px;\">
										<div id=\"<%x.id%>\" class=\"tab-pane fade in active\">
											<textarea ckeditor=\"options\"  data-ck-editor init-model=\"x.value\" ng-model=\"x.value\" cols=\"60\" rows=\"5\" class=\"days_textarea editor<%x.uid%> form-control\"><%x.value%></textarea>
										</div>
										<br><a ng-click=\"removeDay()\" class=\"btn red pull-right\"> Remove </a>
									</div>
								
								</div>
							</div>";
						}
						else {
							$html[]=  Form::textarea($handle, $value , ['init-model' => 'metadata.meta_'.$obj->id ,'dataMeta' => "meta_".$obj->id,'class' => 'form-control','ng-model' => $type.".meta_".$obj->id , 'size' => '45x5']);
						}
					break;
					case 'checkbox' :
						$html[]= "<div class=\"checkbox-list\">";
						$html[]= "<label>";
						$html[]=  Form::checkbox($handle, '' , '',['init-model' => 'metadata.meta_'.$obj->id,'dataMeta' => "meta_".$obj->id,'class' => '','ng-model' => $type.".meta_".$obj->id]);
						$html[]= $obj->title ."</label>";
						$html[] = "</div>";
						break;
					default:
						$html[]= Form::text($handle, $value ,['init-model' => 'metadata.meta_'.$obj->id,'dataMeta' => "meta_".$obj->id,'class' => 'form-control','ng-model' => $type.".meta_".$obj->id]);
					break;
				}
				$html[] = "</div>";
				$html[] = "</div>";
			}
		}

		return  join($html);
	}

	function shortcodify($string , $post){
		$this->post = $post;
		return preg_replace_callback('#\[\[(.*?)\]\]#', function ($matches) {
			$whitespace_explode = $this->parseAttributes($matches[1]);
			$fnName = 'shortcode_'.array_shift($whitespace_explode);
			$attributes = array($whitespace_explode);
			return method_exists($this, $fnName) ? call_user_func_array(array($this, $fnName),$attributes) : $matches[0];
		}, $string);
	}

	function shortcode_html($attrs){
		return "page::includes.section";
	}

	public function get_post($type = "post"){
        $Session = Session::all();
    	$posts = DB::table('posts')->where("post_type","$type")->get();
		
		   
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
		
        foreach($posts as $key => $post){
            if($post->parent_id){
                $postMetavalues[$post->parent_id]->children[$post->post_type][$post->id] = $post;
			}
			
            if($post->post_type != $type){
                continue;
			}
			else{
				$postMetavalues[$post->id] = $post;
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

	function shortcode_template($attrs){
		if(isset($attrs["type"])){
			$listings = $this->get_post($attrs["type"]);
		}

		if(isset($attrs["view"])){
			return $html = View::make('page::includes.'.$attrs["view"],array('post'=> $this->post , "attribute" => $attrs , "listings" => $listings))->render();
		}
		
	}
	

	protected function parseAttributes($text)
    {
        $attributes = array();
        // attributes pattern
        $pattern = '/(\w+)\s*=\s*"([^"]*)"(?:\s|$)|(\w+)\s*=\s*\'([^\']*)\'(?:\s|$)|(\w+)\s*=\s*([^\s\'"]+)(?:\s|$)|"([^"]*)"(?:\s|$)|(\S+)(?:\s|$)/';
        // Match
        if(preg_match_all($pattern, preg_replace("/[\x{00a0}\x{200b}]+/u", " ", $text), $match, PREG_SET_ORDER))
        {
            foreach ($match as $m)
            {
                if (!empty($m[1]))
                {
                    $attributes[strtolower($m[1])] = stripcslashes($m[2]);
                }
                elseif (!empty($m[3]))
                {
                    $attributes[strtolower($m[3])] = stripcslashes($m[4]);
                }
                elseif (!empty($m[5]))
                {
                    $attributes[strtolower($m[5])] = stripcslashes($m[6]);
                }
                elseif (isset($m[7]) and strlen($m[7]))
                {
                    $attributes[] = stripcslashes($m[7]);
                }
                elseif (isset($m[8]))
                {
                    $attributes[] = stripcslashes($m[8]);
                }
            }
        }
        else
        {
            $attributes = ltrim($text);
        }
        // return attributes
        return is_array($attributes) ? $attributes : array($attributes);
    }

}
