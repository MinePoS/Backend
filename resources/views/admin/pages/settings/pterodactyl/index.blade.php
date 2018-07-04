@extends('admin.layout')

@section('title')
Pterodactyl
@endsection

@section('desc')
Good choice! Pterodactyl allows us to give you screeching fast processing times 
@endsection

@section('content')
<div class="col-md-8">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Pterodactyl API
                <small>Lets do this!</small>
              </h3>
            </div>
            <!-- /.box-header -->
            <form action="{{route('admin.settings.pterodactyl')}}" method="POST">
            	{{csrf_field()}}
            <div class="box-body pad">
              
              	  <label for="link">API Link</label>
                  <!-- <input class="form-control" required id="link" type="text" name="ptero_link" value="Spigot. No. You dont my API link."/> -->
                  <input class="form-control" required id="link" type="text" name="ptero_link" value="{{\Setting::get('pterodactyl_link') }}"/>
					        <label for="ckey">Client API Key</label>
                  @if(\env('APP_DEBUG', false))
                  <input type="text" class="form-control" id="ckey" required name="ptero_key" value="">
                  @else
                  <input type="text" class="form-control" id="ckey" required name="ptero_key" value="{{\Setting::get('pterodactyl_key') }}">
                  @endif
            </div>
			<div class="box-footer">
              		<button type="submit" class="btn btn-primary">Save</button>
              </div>
        </form>
          </div>
          <!-- /.box -->
        </div>


<div class="col-md-4">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Grab Servers
              </h3>
            </div>
            <!-- /.box-header -->
            @if(count(\App\Server::all()) == 0) <form action="{{route('admin.settings.pterodactyl.setup')}}" method="POST">
            	{{csrf_field()}} @endif
            @if(count(\App\Server::all()) > 0)
				<div class="alert alert-danger">
				  Since you already have servers added to your Store this feature is disabled. if you wish to use this please remove all the servers you have added already.
				</div>
            @endif
            <div class="box-body pad">
              If you have pterodactyl panel MinePoS can attempt to automagicly create all the servers in your MinePoS installation with the needed settings to get you ready in no time!.<br>
              If you wish to do this press the button Below
            </div>
			<div class="box-footer">
              		@if(count(\App\Server::all()) == 0)<button type="submit" class="btn btn-primary">Lets Go!</button>@endif
              </div>
           @if(count(\App\Server::all()) == 0)</form>@endif
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