@extends('admin.layout')

@section('title')
Products
@endsection

@section('desc')
Here you can manage or create products
@endsection

@section('content')
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Products</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <!-- <input name="table_search" class="form-control pull-right" placeholder="Search" type="text"> -->

                  <div class="input-group-btn">
                    <!-- <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button> -->
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Short Description</th>
                  <th>Actions</th>
                </tr>
			    @foreach ($products as $product)
			        <tr>
			        <td>{{$product->id}}</td>
			        <td>{{$product->name}}</td>
			        <td>{{$product->short_desc}}</td>
			         @if(\Auth::user()->can('list product') || \Auth::user()->can('create product'))
			        <td><a class="btn btn-primary" href="{{route('admin.products.edit', ['product' => $product])}}">@can('edit product') Edit @else View @endcan</a> @can('delete product')<a href="{{route('admin.products.delete', ['product' => $product])}}" class="btn btn-danger">Delete</a>@endcan</td>
			        @endif 
			      </tr>
			    @endforeach
                
              </tbody></table>
              {{ $products->links() }}
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
@endsection