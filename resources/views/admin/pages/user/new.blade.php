@extends('admin.layout')

@section('title')
New User
@endsection

@section('desc')

@endsection

@section('content')

<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">New User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{route('admin.users.new')}}" method="POST">
            	{{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input class="form-control" name="name" id="name" value="" placeholder="Name" required>
                </div>

               <div class="form-group">
                  <label for="email">Email</label>
                  <input class="form-control" name="email" id="email" value="" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input class="form-control" name="password" id="password" value="" placeholder="password" type="password" required>
                </div>

                @can('change user role')
                <div class="form-group">
                	<label for="role">Role</label>
                	<br>
                	<select class="roleSelector" id="role" name="role">
        					     @foreach(\Spatie\Permission\Models\Role::all() as $role)
        					         <option value="{{$role->name}}">{{$role->name}}</option>
                       @endforeach
					         </select>
                </div>
                @endcan
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
              	@can('edit roles')
              		<button type="submit" class="btn btn-primary">Save</button>
              	@endcan
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
@endsection

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