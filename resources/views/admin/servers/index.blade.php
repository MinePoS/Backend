@extends('adminlte::page')

@section('title', 'Servers')

@section('content_header')
    <h1>Servers</h1>
@stop

@section('content')
	 <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Server List</h3>

              @can('create-servers')
				<div class="box-tools">
                <a href="{{Route('admin.servers.create')}}" class="btn btn-success">Create</a>
              </div>
              @endcan

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>API Key</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                @foreach($servers as $server)
                <tr>
                  <td>{{$server->id}}</td>
                  <td>{{$server->name}}</td>
                  <td>
                    <code title="" id="apikey-{{$server->id}}-shown" class="toggle-display" style="cursor:pointer" data-toggle="tooltip" data-original-title="Click to Reveal" data-placement="right" onClick="showAPIKEY({{$server->id}})">
                                        <i class="fa fa-key"></i> ••••••••
                                    </code>
                                    <code class="hidden" id="apikey-{{$server->id}}-hidden" data-attr="api-key">{{$server->api_key}}</code>
                             </td> 	
                            @if($server->enabled)
                				<td><span class="label label-success">Enabled</span></td>
                			@else
								<td><span class="label label-danger">Disabled</span></td>
                			@endif
                  <td>
                  	@can('edit-servers')
                  	<a href="{{Route('admin.servers.edit',['server'=>$server])}}" class="btn btn-success">Edit</a>
                  	@endcan
                  	@can('rekey-servers')
                  	<a href="#" onclick="rekey({{$server->id}});" class="btn btn-primary">Re-Key</a>
                  	@endcan
					@can('delete-servers')
                  	<a href="{{Route('admin.servers.delete',['server'=>$server])}}" class="btn btn-danger">Delete</a>
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
    <script>
    	function showAPIKEY(id){
    		$("#apikey-"+id+"-shown").hide();
    		$("#apikey-"+id+"-hidden").show();
    		$("#apikey-"+id+"-hidden").removeClass("hidden");
    	}

      function rekey(id){
          swal({
          title: "Are you sure?",
          text: "Once rekeyed, The server will no longer be able to talk to the Store until its config file is updated and will be disconnected immediately.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            var link = "{{Route('admin.servers.rekey',['server'=>0])}}";
            var link2 = link.replace("0",id);
            location.href = link2;          
          } else {
            swal("Rekey canceled!");
          }
        });
      }
    </script>




@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop