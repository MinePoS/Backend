@extends('admin.layout')

@section('title')
New Server
@endsection

@section('desc')
Guys its happening! A new server!
@endsection

@section('content')

<div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header with-border">
              <h3 class="card-title">Creating new server</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{route('admin.server.new')}}" method="POST">
            	{{csrf_field()}}
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input class="form-control" name="name" id="name" placeholder="Server Name" required>
                </div>

                <div class="form-group">
                	<label for="enabled">Enabled</label>
			       
			          <div class="checkbox icheck">
        
			              <input type="checkbox" id="Enabled" name="enabled"> 			         
			        </div>
                </div>

                    <div class="form-group">
                      <label for="srvType">Type</label><br>
                        <input type="radio" class="srvSel" name="srvType" value="plugin"> Plugin<br>
                        <input type="radio" class="srvSel" name="srvType" value="pterodactyl" checked=""> Pterodactyl Panel<br>
                    </div>
                    <div class="form-group" id="pterodactyl-settings">
                       <label for="srvID">Pterodactyl Server ID</label><br>
                        <input type="text" class="form-control" name="srvID" id="srvID"><br>
                    </div>
                    <div class="form-group" id="plugin-settings">
                       <label for="httpSrvIP">HTTP Server IP</label><br>
                        <input type="text" class="form-control" name="httpSrvIP" id="httpSrvIP"><br>
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
@endsection
@section('extra')
	<script src="/admin/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('.srvSel').on('ifChecked', function(event){
      if(event.target.value == "pterodactyl"){
        $("#pterodactyl-settings").show();
        $("#plugin-settings").hide();
      }else{
        $("#pterodactyl-settings").hide();
        $("#plugin-settings").show();
      } 
    });

    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });


</script>
@endsection