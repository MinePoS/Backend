@extends('layouts.app')
@section('title')
{{$category->name}}
@endsection
@section('content')
<div class="card dark-container">
  <h4 class="card-header">{{$category->name}}</h4>
  <div class="card-body">
		{!!$category->desc!!}
  </div>
</div>
        @endsection