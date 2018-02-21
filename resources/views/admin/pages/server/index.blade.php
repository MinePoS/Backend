@extends('admin.layout')

@section('title')
Servers
@endsection

@section('desc')
Here you can manage or create server keys
@endsection

@section('content')

@include('admin.parts.serverstable')

@endsection