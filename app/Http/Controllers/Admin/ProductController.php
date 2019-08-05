<?php

namespace App\Http\Controllers\Admin;

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
        $this->authorize('list-products');
        $products = Product::paginate(15);
        return view('admin.products.index',["products"=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-products');
        return view('admin.products.form',["product"=> new Product]);

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create-products');
            $product->name = request("name");
            $product->image = request("image");
            $product->description = request("desc");
            $product->price = request("price");
            $product->category_id = request("parent");
            $product->stock = 999999;
            $product->commands = json_encode(Request("commands"));
            $product->short_desc = request("short_desc");
            $product->save();

            session()->flash('good', $product->name.' created');
            return redirect()->route('admin.products.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $this->authorize('edit-products');
        return view('admin.products.form',["product"=> $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->authorize('edit-products');

            $product->name = request("name");
            $product->image = request("image");
            $product->description = request("desc");
            $product->price = request("price");
            $product->category_id = request("parent");
            $product->stock = 999999;
            $product->commands = json_encode(Request("commands"));
            $product->short_desc = request("short_desc");
            $product->save();

            session()->flash('good', $product->name.' updated');
            return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Product $product)
    {
        $this->authorize('delete-products');
    }
}
