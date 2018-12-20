<div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header with-border">
              <h3 class="card-title">Creating new role</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{route('admin.roles.new')}}" method="POST">
            	{{csrf_field()}}
              <div class="card-body">
                <div class="form-group">
                  <label for="roleName">Name</label>
                  <input class="form-control" name="name" id="roleName" placeholder="Role Name" required>
                </div>
                <div class="form-group">
                  	@foreach(\Spatie\Permission\Models\Permission::all() as $perm)						
			        <div class="col-xs-4">
			          <div class="checkbox icheck">
			            <label>
			              <input type="checkbox" name="perms[{{$perm->id}}]" value="{{$perm->name}}"> {{ucfirst($perm->name)}}
			            </label>
			          </div>
			        </div>
				@endforeach
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
              	@can('edit roles')
              		<button type="submit" class="btn btn-primary">Save</button>
              	@endcan
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>

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