@extends('adminlte::page')

@section('title', 'Servers')

@section('content_header')
    <h1>Servers</h1>
@stop

@section('content')

<div class="box box-info">
            <div class="box-header with-border">
              @if($server->name == "")
              	<h3 class="box-title">Creating new server</h3>
              @else
              	<h3 class="box-title">Editing '{{$server->name}}'</h3>
              @endif
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            @if($server->name != null)
			 {{\Form::model($server, array('route' => array('admin.servers.update', $server->id)),["class"=>"form-horizontal"])}}
			@else
			 {{\Form::model($server, array('route' => array('admin.servers.store')),["class"=>"form-horizontal"])}}
			@endif
         
              <div class="box-body">

                <div class="form-group">
                  {{ Form::label('name', 'Server Name', ["class"=>"col-sm-2 control-label"]) }}
                  <div class="col-sm-10">
					{{ Form::text('name', null,["class"=>"form-control","required"]) }}
                  </div>
                </div>

                
                <div class="form-group">
                
                    
                      {{ Form::label('enabled', 'Enabled', ["class"=>"col-sm-2 control-label"]) }}
                      {{ Form::checkbox('enabled', 'true') }}
                    
             </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
              	@if($server->name == "")
                	<button class="btn btn-info pull-right" type="submit">Create</button>
              	@else
                	<button class="btn btn-info pull-right" type="submit">Save</button>
              	@endif
              </div>
              <!-- /.box-footer -->
            {{ Form::close() }}



			



			
          </div>


	
@stop
@section('js')
    $(function () {
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
  })
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop