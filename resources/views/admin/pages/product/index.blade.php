@extends('admin.layout')

@section('title')
Products
@endsection

@section('desc')
Here you can manage or create products
@endsection

@section('content')
<div class="container-fluid">
<div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Products</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <!-- <input name="table_search" class="form-control pull-right" placeholder="Search" type="text"> -->

                  <div class="input-group-btn">
                    <!-- <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button> -->
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Sold</th>
                  <th>Price</th>
                  <th>Actions</th>
                </tr>
			    @foreach ($products as $product)
			        <tr>
			        <td>{{$product->id}}</td>
			        <td>{{$product->name}}</td>
              <td>{{$product->sold}}</td>
			        <td>{{$product->price}}</td>
			         @if(\Auth::user()->can('list product') || \Auth::user()->can('create product'))
			        <td><a class="btn btn-primary" href="{{route('admin.products.edit', ['product' => $product])}}">@can('edit product') Edit @else View @endcan</a> @can('delete product')<a href="{{route('admin.products.delete', ['product' => $product])}}" class="btn btn-danger">Delete</a>@endcan</td>
			        @endif 
			      </tr>
			    @endforeach
                
              </tbody></table>
              {{ $products->links() }}
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
</div>
@endsection