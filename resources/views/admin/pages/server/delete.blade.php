@extends('admin.layout')

@section('title')
Delete {{$server->name}}
@endsection

@section('desc')
So you sure you dont need {{$server->name}}?
@endsection

@section('content')
<center>
	<h3>Are you sure you would like to delete {{$server->name}}</h3>
<form method="post" action="{{ route('admin.server.delete',['server'=>$server]) }}">
	<input type="hidden" name="_method" value="delete" />
{{csrf_field()}}
<button type="submit" class="btn btn-danger">Yes, Delete</button>
<a href="{{route('admin.servers')}}" class="btn btn-primary">No, Go back</a>
</form>
</center>
@endsection