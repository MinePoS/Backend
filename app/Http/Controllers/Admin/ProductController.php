<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
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
        $products = Product::paginate(15);
        return view('admin.pages.product.index')->with(["products"=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.product.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Respons e
     */
    public function store(Request $request)
    {
    $product = new \App\Product;

    $product->name = request("name");
    $product->image = request("image");
    $product->description = request("desc");
    $product->price = request("price");
    $product->category_id = request("parent");
    $product->stock = 999999;
    $product->sold = 0; 
    $product->commands = json_encode(Request("commands"));
    $product->material = request("material");

    $product->save();

    session()->flash('good', 'Product created');
    return redirect()->route('admin.products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.pages.product.edit')->with(["product"=>$product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
            $product->name = request("name");
            $product->image = request("image");
            $product->description = request("desc");
            $product->price = request("price");
            $product->category_id = request("parent");
            $product->stock = 999999;
            $product->commands = json_encode(Request("commands"));
            $product->material = request("material");
            $product->save();

            session()->flash('good', $product->name.' updated');
            return redirect()->route('admin.products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
