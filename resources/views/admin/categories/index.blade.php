@extends('adminlte::page')

@section('title', 'Categories')

@section('content_header')
    <h1>Categories</h1>
@stop

@section('content')
	 <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Categories List</h3>

              @can('create-categories')
				<div class="box-tools">
                <a href="{{Route('admin.categories.create')}}" class="btn btn-success">Create</a>
              </div>
              @endcan

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Short Description</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                @foreach($categories as $category)
                <tr>
                  <td>{{$category->id}}</td>
                  <td>{{$category->name}}</td>
                  <td>{{$category->short_desc}}</td>
                  
                            @if($category->visible)
                				<td><span class="label label-success">Visible</span></td>
                			@else
								<td><span class="label label-danger">Hidden</span></td>
                			@endif
                  <td>
                  	@can('edit-categories')
                  	<a href="{{Route('admin.categories.edit',['category'=>$category])}}" class="btn btn-success">Edit</a>
                  	@endcan
                  	
					@can('delete-categories')
                  	<a href="{{Route('admin.categories.delete',['category'=>$category])}}" class="btn btn-danger">Delete</a>
                  	@endcan
                  </td>
                </tr>
                @endforeach
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
@stop
@section('js')
  
@stop
@section('css')

@stop