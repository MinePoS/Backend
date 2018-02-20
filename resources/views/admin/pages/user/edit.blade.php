@extends('admin.layout')

@section('title')
Editing {{$user->name}}
@endsection

@section('desc')

@endsection

@section('content')
@include('admin.parts.users.editform')

@endsection