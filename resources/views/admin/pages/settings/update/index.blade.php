@extends('admin.layout')

@section('title')
Update
@endsection

@section('desc')
Yhhh i get ittt you hate updatinggg 
@endsection

@section('content')
<div class="col-md-12">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Update
              </h3>
            </div>
            <!-- /.box-header -->
            @if(Updater::isNewVersionAvailable(\Updater::getVersionInstalled("v",""))) <form action="{{route('admin.settings.update')}}" method="POST">
            	{{csrf_field()}} 
          @else
				<div class="alert alert-danger">
				  Since you already are already running the most up-to-date version there is no need to update
				</div>
            @endif
            <div class="box-body pad">
              When we come out with new features and fun things to play with we get that you dont want to open SSH and type commands just to get them so we made it simple with a one click updater
              <br>
              If you wish to do this press the button Below (once started please leave the tab "loading" as it updates)
            </div>
			<div class="box-footer">
              		 @if(Updater::isNewVersionAvailable(\Updater::getVersionInstalled("v","")))<button type="submit" class="btn btn-primary">Lets Go!</button>@endif
              </div>
            @if(Updater::isNewVersionAvailable(\Updater::getVersionInstalled("v","")))</form>@endif
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