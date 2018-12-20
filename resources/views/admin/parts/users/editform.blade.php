<div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header with-border">
              <h3 class="card-title">Editing {{$user->name}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{route('admin.users.edit', ['user' => $user])}}" method="POST">
            	{{csrf_field()}}
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input @can('edit user') @else disabled @endcan class="form-control" name="name" id="name" value="{{$user->name}}" placeholder="Name" required>
                </div>

               <div class="form-group">
                  <label for="email">Email</label>
                  <input @can('edit user') @else disabled @endcan class="form-control" name="email" id="email" value="{{$user->email}}" placeholder="Name" required>
                </div>

                @can('change user role')
                <div class="form-group">
                	<label for="role">Role</label>
                	<br>
                	<select class="roleSelector" id="role" name="role">
        					     @foreach(\Spatie\Permission\Models\Role::all() as $role)
        					         <option value="{{$role->name}}" @if($user->getRole() == $role->name) selected="true" @endif>{{$role->name}}</option>
                       @endforeach
					         </select>
                </div>
                @endcan
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
  <link rel="stylesheet" href="/admin/bower_components/select2/dist/css/select2.min.css">
@endsection
@section('extra')
	<script src="/admin/plugins/iCheck/icheck.min.js"></script>
	<script src="/admin/bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
  $(function () {

    $('.roleSelector').select2();

  });
</script>
@endsection