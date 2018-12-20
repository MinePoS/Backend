@extends('admin.layout')

@section('title')
Pterodactyl
@endsection

@section('desc')
Good choice! Pterodactyl allows us to give you screeching fast processing times 
@endsection

@section('content')
 <div class="row">
<div class="col-md-8">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Pterodactyl API
                <small>Lets do this!</small>
              </h3>
            </div>

            <!-- /.card-header -->
            <form action="{{route('admin.settings.pterodactyl')}}" method="POST">
            	{{csrf_field()}}
            <div class="card-body pad">
              
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
			<div class="card-footer">
              		<button type="submit" class="btn btn-primary">Save</button>
              </div>
        </form>
          </div>
          <!-- /.card -->
        </div>


<div class="col-md-4">
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Grab Servers
              </h3>
            </div>
            <!-- /.card-header -->
            @if(count(\App\Server::all()) == 0) <form action="{{route('admin.settings.pterodactyl.setup')}}" method="POST">
            	{{csrf_field()}} @endif
            @if(count(\App\Server::all()) > 0)
				<div class="alert alert-danger">
				  Since you already have servers added to your Store this feature is disabled. if you wish to use this please remove all the servers you have added already.
				</div>
            @endif
            <div class="card-body pad">
              If you have pterodactyl panel MinePoS can attempt to automagicly create all the servers in your MinePoS installation with the needed settings to get you ready in no time!.<br>
              If you wish to do this press the button Below
            </div>
			<div class="card-footer">
              		@if(count(\App\Server::all()) == 0)<button type="submit" class="btn btn-primary">Lets Go!</button>@endif
              </div>
           @if(count(\App\Server::all()) == 0)</form>@endif
          </div>
          <!-- /.card -->
        </div>
      </div>
@endsection


@section("extra")
<script src="/admin/plugins/ckeditor/ckeditor.js"></script>

<script type="text/javascript">
	
 ClassicEditor.create(document.querySelector('#desc'))


</script>
@endsection