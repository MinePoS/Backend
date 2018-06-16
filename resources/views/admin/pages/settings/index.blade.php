@extends('admin.layout')

@section('title')
Settings
@endsection

@section('desc')
Ohhh be careful please
@endsection

@section('content')
<div class="alert alert-danger" role="alert">
  This is the site wide settings panel, please take care editing settings if you dont know what the setting does probbaly better not touch it. 
</div>


<div class="col-md-12">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Home page
                <small>This is the text that will be displayed on the home page</small>
              </h3>
            </div>
            <!-- /.box-header -->
            <form action="{{route('admin.settings.save')}}" method="POST">
            	{{csrf_field()}}
            <div class="box-body pad">
              
              	  <label for="title">Title</label>
                  <input class="form-control" required id="title" type="text" name="title" value="{{\Store::homeTitle()}}"/>
					<label for="desc">Description</label>
                    <textarea id="desc" name="desc" rows="10" cols="80" style="visibility: hidden; display: none;"> 
                    	{!! \Store::homeDesc() !!}
                    </textarea>
              
            </div>
			<div class="box-footer">
              		<button type="submit" class="btn btn-primary">Save</button>
              </div>
        </form>
          </div>
          <!-- /.box -->
        </div>
@endsection


@section("extra")
<script src="/admin/bower_components/ckeditor/ckeditor.js"></script>

<script type="text/javascript">
	
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('desc');
  })


</script>
@endsection