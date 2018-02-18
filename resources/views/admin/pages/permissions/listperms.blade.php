@extends('admin.layout')

@section('head')
  <link rel="stylesheet" href="/admin/plugins/iCheck/square/blue.css">
@endsection

@section('title')
Permissions
@endsection

@section('desc')
Just A temp page to View all the permissions in the Database
@endsection


@section('content')
	<?php $role = \Auth::user()->roles()->get()->first(); ?>
	@foreach(\Spatie\Permission\Models\Permission::all() as $perm)
		<form method="POST" action="{{Route('admin.perms')}}">
			{{csrf_field()}}
        <div class="col-xs-2">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" @if($role->hasPermissionTo($perm->name)) checked @endif value="{{$perm->name}}" name="perms[{{$perm->id}}]"> {{ucfirst($perm->name)}}
            </label>
          </div>
        </div>
	@endforeach
	<div class="row col-xs-12">
		@can("assign perms to roles")
	<input type="submit" class="btn btn-success" value="Save"></input></div>
	@endcan
	</form>
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