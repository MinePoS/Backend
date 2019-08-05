@extends('adminlte::page')

@section('title', 'Products')

@section('content')

<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="card-title">Products</h3>

              @can('create-products')
        <div class="box-tools">
                <a href="{{Route('admin.products.create')}}" class="btn btn-success">Create</a>
              </div>
              @endcan
            </div>
            <!-- /.card-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Short Description</th>
                  <th>Sold</th>
                  <th>Price</th>
                  <th>Actions</th>
                </tr>
          @foreach ($products as $product)
              <tr>
              <td>{{$product->id}}</td>
              <td>{{$product->name}}</td>
              <td>{{$product->short_desc}}</td>
              <td>{{$product->sold}}</td>
              <td>{{$product->price}}</td>
              
                  <td>
                    @can('edit-products')
                    <a class="btn btn-primary" href="{{route('admin.products.edit', ['product' => $product])}}"> Edit</a>
                    @endcan

                    @can('delete-products')<a href="{{route('admin.products.delete', ['product' => $product])}}" class="btn btn-danger">Delete</a>@endcan
                    
                  </td>
             
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


@stop
@section('js')
  
@stop

@section('css')
<link rel="stylesheet" href="/admin/plugins/iCheck/square/blue.css">
<link rel="stylesheet" href="/admin/bower_components/select2/dist/css/select2.min.css">

    <style type="text/css">
      .select2-container {
  margin: 0;
}
    </style>

    <style>
.command .form-group {
    width: 80%;
    display: inline-block;
}
.command .btn {
    width: 15%;
}
.server-selector select {
    width: calc(100% - 80px);
    display: inline-block;
}
.server-selector a {
    width: 37px;
    display: inline-block;
}
</style>
@stop