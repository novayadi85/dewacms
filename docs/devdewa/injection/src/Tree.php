<?php 
namespace Devdewa\Injection;

class Tree {
	function buildTree($_elements, $parentId = 0) {
		$branch = array();
		foreach($_elements as $element) {
			if ($element->parent_id == $parentId) {
				$children = $this->buildTree($_elements, $element->id);
				if ($children) {
					$element->children = $children;
				}
				$branch[] = $element;
			}
		}

		return $branch;
	}
	
	function drawUrls($listOfItems , $parent = 0){
		$output = array();
		foreach ($listOfItems as $item) {
			$productUrls  = json_decode($item["productUrls"],true);
			if(is_array($productUrls) && sizeof($productUrls)){
				foreach($productUrls as $url){
					$output[] = $url;
				}
			}
		}
		return $output;
		
	}
	
	function drawTable($listOfItems , $parent = 0, $deleteIcon = false){
		$output = array();
		if($parent){
			$output[] = "<tr class=\"details\">";
		}
		foreach ($listOfItems as $item) {
			if(empty($item["position"])){
				$item["position"] = 0;
			}
			$output[] = "<td data-parent=\"$parent\" class=\"dd-item\" data-id=\"".$item["cid"]."\">";
				$output[]  = $item["name"];
				if(isset($item["children"])){
					
					$output[] = $this->drawTable($item["children"] , $item["cid"]); 
					
				}
				
			$output[] ="</td>";
			
			
		}

		if($parent){
		   $output[] = "</tr>";
		}
		
		return join($output);
		
	}

	function drawMenu($listOfItems , $parent = 0, $start = false , $end = false){
		$output = array();
		if($parent){
			$output[] = "<ul class=\"lists dropdown-menu\">";
		}
		foreach ($listOfItems as $item) {
			if(empty($item->position)){
				$item->position = 0;
			}

			if($end){
				if($item->position > $end){
					continue;
				}
			}

			if($start){
				if($item->position < $start){
					continue;
				}
			}
			if(isset($item->children)){	
				$output[] = "<li class=\"dropdown\" data-parent=\"$parent\" class=\"item\" data-id=\"".$item->id."\">";
			}
			else{
				$output[] = "<li data-parent=\"$parent\" class=\"item\" data-id=\"".$item->id."\">";
			}
			if(isset($item->children)){	
				$output[] = "<a href=\"".$item->link."\" class=\"dropdown-toggle handle-link link\" data-toggle=\"dropdown\">";
				$output[] =	$item->title."<b class=\"caret\"></b></a>";	
			}
			else{
				$output[] = "<a href=\"".$item->link."\" class=\"handle-link link\">";
				$output[] =	$item->title."</a>";	
			}
				
		

			if(isset($item->children)){					
				$output[] = $this->drawMenu($item->children , $item->id); 					
			}
				
			$output[] ="</li>";
			
			
		}

		if($parent){
		   $output[] = "</ul>";
		}
		
		return join($output);
		
	}
	
	function drawTree($listOfItems , $parent = 0, $deleteIcon = false){
		$output = array();
		if($parent){
			$output[] = "<ol class=\"dd-list\">";
		}
		foreach ($listOfItems as $item) {
			if(empty($item["position"])){
				$item["position"] = 0;
			}
			$output[] = "<li data-parent=\"$parent\" class=\"dd-item\" data-id=\"".$item["cid"]."\">
				<div class=\"dd-handle\">
					".$item["name"]."
				</div>";
				
				if(isset($item["children"])){
					
					$output[] = $this->drawTree($item["children"] , $item["cid"]); 
					
				}
				
			$output[] ="</li>";
			
			
		}

		if($parent){
		   $output[] = "</ol>";
		}
		
		return join($output);
		
	}
}