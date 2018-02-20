@extends('admin.layout')

@section('title')
Editing {{$role->name}}
@endsection

@section('desc')

@endsection

@section('content')

@include('admin.parts.roles.editform')

@endsection