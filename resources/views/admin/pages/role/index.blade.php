@extends('admin.layout')

@section('title')
Roles
@endsection

@section('desc')

@endsection

@section('content')

<?php $roles = \Spatie\Permission\Models\Role::paginate(15); ?>
@include('admin.parts.rolestable')

@endsection