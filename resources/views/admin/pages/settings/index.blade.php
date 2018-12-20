@extends('admin.layout')

@section('title')
Settings
@endsection

@section('desc')
Ohhh be careful please
@endsection

@section('content')
<div class="alert alert-danger" role="alert">
  This is the site wide settings panel, please take care editing settings. If you dont know what a setting does it is  probably better not to touch it. 
</div>


<div class="col-md-12">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Home page
                <small>This is the text that will be displayed on the home page</small>
              </h3>
            </div>
            <!-- /.card-header -->
            <form action="{{route('admin.settings.save')}}" method="POST">
            	{{csrf_field()}}
            <div class="card-body pad">
              
              	  <label for="title">Title</label>
                  <input class="form-control" required id="title" type="text" name="title" value="{{\Store::homeTitle()}}"/>
					<label for="desc">Description</label>
                    <textarea class="form-control" id="desc" name="desc" rows="10" cols="80"> 
                    	{!! \Store::homeDesc() !!}
                    </textarea>
              
            </div>
			<div class="card-footer">
              		<button type="submit" class="btn btn-primary">Save</button>
              </div>
        </form>
          </div>
          <!-- /.card -->
        </div>


<div class="col-md-12">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Terms Of Service 
                <small>This is the text that will be displayed on the checkout page</small>
              </h3>
            </div>
            <!-- /.card-header -->
            <form action="{{route('admin.settings.savetos')}}" method="POST">
              {{csrf_field()}}
            <div class="card-body pad">
              
                  <label for="title">TOS Title</label>
                  <input class="form-control" required id="title" type="text" name="title" value="{{\Setting::get('tos_title','TOS HERE')}}"/>
          <label for="desc">TOS</label>
                    <textarea class="form-control" id="desc2" name="desc" rows="10" cols="80"> 
                      {!! \Setting::get("tos_desc","TOS HERE") !!}
                    </textarea>
            </div>
      <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
              </div>
        </form>
          </div>
          <!-- /.card -->
        </div>


@endsection



@section("extra")
<script src="/admin/plugins/ckeditor/ckeditor.js"></script>

<script type="text/javascript">
	
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
  
    ClassicEditor.create(document.querySelector('#desc'))
    ClassicEditor.create(document.querySelector('#desc2'))
 
  })


</script>
@endsection