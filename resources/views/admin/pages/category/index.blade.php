@extends('admin.layout')

@section('title')
Categories
@endsection

@section('desc')
Here you can manage or create categories
@endsection

@section('content')
<div class="container-fluid">
<div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Categories</h3>

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
            <div class="card-body">
              <table class="table table-hover">
                <tbody><tr>
                  <th style="width:5%;">ID</th>
                  <th>Name</th>
                  <th>Short Description</th>
                  <th style="width:20%;">Actions</th>
                </tr>
			    @foreach ($categories as $category)
			        <tr>
			        <td>{{$category->id}}</td>
			        <td>{{$category->name}}</td>
			        <td>{{$category->short_desc}}</td>
			         @if(\Auth::user()->can('list category') || \Auth::user()->can('create category'))
			        <td><a class="btn btn-primary" href="{{route('admin.Categories.edit', ['category' => $category])}}">@can('edit categorys') Edit @else View @endcan</a> @can('delete category')<a href="{{route('admin.Categories.delete', ['category' => $category])}}" class="btn btn-danger">Delete</a>@endcan</td>
			        @endif 
			      </tr>
			    @endforeach
                
              </tbody></table>
              {{ $categories->links() }}
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
@endsection