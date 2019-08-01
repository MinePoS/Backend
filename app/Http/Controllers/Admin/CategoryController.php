<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
class CategoryController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$this->authorize('list-categories');
    	return view("admin.categories.index")->with(["categories"=>\App\Category::all()]);
    }

    public function create(){
    	$this->authorize('create-categories');
    	return view("admin.categories.form",["category"=> new Category]);

    }


    public function store(){
    	$this->authorize('create-categories');
    }

    public function edit(Category $category){
    	$this->authorize('edit-categories');
    	return view("admin.categories.form",["category"=> $category]);
    }

    public function update(Category $category){
		$this->authorize('edit-categories');
    }

    public function delete(Category $category){
    	$this->authorize('delete-categories');
    	if($category->products()->count() > 0){
    		$productsString = "";
    		foreach($category->products()->get() as $p){
    			if($productsString == ""){
    			$productsString = $p->name;

    			}else{
    			$productsString = $productsString.", ".$p->name;

    			}
    		}
    		\Session::flash("bad","Cant delete this category at this time");
    		\Session::flash("swal","Cant delete $category->name because it currently still has products linked to it. Please move or delete the following products from the category: $productsString");
    		return redirect()->back();
    	}
    }
}