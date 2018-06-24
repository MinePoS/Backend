@extends('admin.layout')

@section('title')
Categories
@endsection

@section('desc')
Here you can manage or create categories
@endsection

@section('content')
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Categories</h3>

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
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
@endsection