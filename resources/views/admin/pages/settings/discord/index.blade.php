@extends('admin.layout')

@section('title')
Discord
@endsection

@section('desc')
Eye, Nice to see you want to use our discord intergration
@endsection

@section('content')
<div class="col-md-8">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Discord
           
              </h3>
            </div>
            <!-- /.box-header -->
            <form action="{{route('admin.settings.discord')}}" method="POST">
            	{{csrf_field()}}
            <div class="box-body pad">
          							
			        
			          <div class="checkbox icheck">
			            <label>
			              <input type="checkbox" @if(Setting::get('DISCORD_LOGIN_ENABLED', false)) checked @endif name="admin_enabled" value="admin_enabled"> Admin Login Notifications
			            </label>
			          </div>
			          <div class="checkbox icheck">
			            <label>
			              <input @if(Setting::get('DISCORD_ORDER_ENABLED', false)) checked @endif type="checkbox" name="order_enabled" value="order_enabled"> Order Notifications
			            </label>
			          </div>
				<br>
              	  <label for="adminlink">Admin Login Notificatoins</label>
                  <input class="form-control" required id="adminlink" type="text" name="admin_link" value="{{\Setting::get('DISCORD_LOGIN_WEBHOOK')}}"/>
              	  <label for="adminlink">Order Notificatoins</label>

                  <input class="form-control" required id="orderlink" type="text" name="order_link" value="{{\Setting::get('DISCORD_ORDER_WEBHOOK')}}"/>
              
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
              <h3 class="box-title">Test webhooks
              </h3>
            </div>
            <!-- /.box-header -->
           <form action="{{route('admin.settings.discord.test')}}" method="POST">
            	{{csrf_field()}}
            <div class="box-body pad">
            	This test process will attempt to send messages to both the webhooks
            </div>
			<div class="box-footer">
              	<button type="submit" class="btn btn-primary">Lets Go!</button>
              </div>
          </form>
          </div>
          <!-- /.box -->
        </div>
@endsection

@section('head')
  <link rel="stylesheet" href="/admin/plugins/iCheck/square/blue.css">
@endsection
@section('extra')
	<script src="/admin/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
@endsection