@extends('adminlte::page')

@section('title', "Banning '$player->username'")

@section('content_header')
    <h1>Banning '{{$player->username}}'</h1>
@stop

@section('content')
	 <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Banning '{{$player->username}}'</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	{{ Form::open(array('route' => array('admin.players.ban', $player))) }}
				{{Form::token()}}
				<div class="form-group">
            	{{Form::label('Reason','Reason')}}
            	{{Form::text('Reason',null,["class"=>"form-control","placeholder"=>"Enter a reason for banning $player->username here","required","minlength"=>16])}}
            	</div>
				<button type="submit" class="btn btn-danger" >Ban</button>
            	{{ Form::close() }}
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
@stop
@section('js')
   
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop