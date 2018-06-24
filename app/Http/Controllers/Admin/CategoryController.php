<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(15);
        return view('admin.pages.category.index')->with(["categories"=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.category.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    $category = new \App\Category;
    $category->name = request("name");
    $category->desc = request("desc");
    $category->short_desc = request("short_desc");
    $category->visible = (request("visible") != null);
    $category->featured = (request("featured") != null);
    $category->parent_id = request("parent");

    $category->save();
    session()->flash('good', 'Category created');
    return redirect()->route('admin.Categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.pages.category.edit')->with(compact("category"));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->name = request("name");
        $category->desc = request("desc");
        $category->short_desc = request("short_desc");
        $category->visible = (request("visible") != null);
        $category->featured = (request("featured") != null);
        $category->parent_id = request("parent");

        $category->save();
        session()->flash('good', "'$category->name' saved");
        return redirect()->route('admin.Categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        session()->flash('good', "'$category->name' deleted (All products in this category will need to have a new one set)");
        $category->delete();

        return redirect()->route('admin.Categories');
    }
}
