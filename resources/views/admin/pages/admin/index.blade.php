@extends('admin.layout')

@section('title')
Admins
@endsection

@section('desc')

@endsection

@section('content')
<?php $users = App\User::paginate(15); ?>
@include('admin.parts.adminstable')

@endsection