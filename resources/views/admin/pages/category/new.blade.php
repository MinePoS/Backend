@extends('admin.layout')

@section('title')
Create Category
@endsection

@section('desc')
Keeping it all organised? Nice!
@endsection

@section('content')

<div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header with-border">
              <h3 class="card-title">Creating new category</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{route('admin.Categories.new')}}" method="POST">
            	{{csrf_field()}}
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input class="form-control" name="name" id="name" placeholder="Category Name" required>
                </div>

                <div class="form-group">
                  <label for="desc">Description</label>
                    <textarea id="desc" name="desc" rows="10" cols="80" style="visibility: hidden; display: none;"> 
                    	
                    </textarea>
                </div>


				
				<div class="form-group">
                  <label for="short_desc">Short Description</label>
                  <input class="form-control" name="short_desc" id="short_desc" placeholder="Short category description" required>
                </div>
        <div class="form-group">
                  <label for="short_desc">Material</label>
                  <input class="form-control" name="material" id="material" placeholder="CHEST" value="CHEST" required>
        </div>
				<div class="form-group">
                  <label for="visible">Visible</label>
                  <input type="checkbox" id="visible" value="1" name="visible"> 
                </div>
                <div class="form-group">
                  <label for="featured">Featured</label>
                   <input type="checkbox" id="featured" value="1" name="featured"> 
                </div>
                 <div class="form-group">
                	<label for="parent">Parent Category</label>
                	<br>
                	<select class="parent" id="parent" name="parent">
						<option value="">None</option>
        				@foreach(\App\Category::all() as $category)
        					@if($category->parent_id == null)
        						<option value="{{$category->id}}">{{$category->name}}</option>
        					@endif
                       @endforeach
					</select>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
              		<button type="submit" class="btn btn-primary">Create</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
@endsection

@section('head')
  <link rel="stylesheet" href="/admin/plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="/admin/bower_components/select2/dist/css/select2.min.css">
    <style type="text/css">
    	.select2-container {
  margin: 0;
}
    </style>
@endsection

@section('extra')
	<script src="/admin/plugins/iCheck/icheck.min.js"></script>
	<script src="/admin/plugins/ckeditor/ckeditor.js"></script>
	<script src="/admin/bower_components/select2/dist/js/select2.full.min.js"></script>

<script type="text/javascript">
	
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    ClassicEditor.create(document.getElementById("desc"));
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });

    $('.parent').select2();
  })


</script>
@endsection