<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function isSub(){
    	return ($this->parent_id != null);
    }
    public function getProducts(){
      return(\App\Product::where("category_id",$this->id)->get());  
    } 
    public function isParent(){
    	return (count(\App\Category::where('visible',1)->where('parent_id', $this->id)->get()) > 0);
    }

    public function subCategories(){
    	    	return \App\Category::where('visible',1)->where('parent_id', $this->id)->get();
    }

    public function isRoute(){
    	if(\Request::is('category/'.$this->id)){
			return true;
    	}
    	$isThis = false;
    	 foreach(\App\Category::where('visible',1)->where('parent_id', $this->id)->get() as $sub){
    	 		if(\Request::is('category/'.$sub->id)){
    	 			return true;
    	 		}
    	 	}
    	 return $isThis;
    }
}
