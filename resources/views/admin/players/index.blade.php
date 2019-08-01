@extends('adminlte::page')

@section('title', 'Players')

@section('content_header')
    <h1>Players</h1>
@stop

@section('content')
	 <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Player List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>ID</th>
                  <th>Username</th>
                  <th>UUID</th>
                  <th>Orders</th>
                </tr>
                @foreach($players as $player)
                <tr>
                  <td>{{$player->id}}</td>
                  <td><span><img width="32" height="32" src="{{Store::getHeadCustom($player->uuid,32)}}"/></span>{{$player->username}}</td>
                  <td><code>{{$player->uuid}}</code></td>
                  <td>{{$player->orders()->count()}}</td>
                           
                  <td>
                  	@can('view-players')
                  	<a href="{{route('admin.players.show',['player'=>$player])}}" class="btn btn-primary">View Profile</a>
                  	@endcan
                  	@if($player->isBanned())
						@can('unban-players')
	                  		<a href="{{route('admin.players.unban',['player'=>$player])}}" class="btn btn-success">Unban</a>
	                  	@endcan
                  	@else
						@can('ban-players')
	                  		<a href="{{route('admin.players.ban',['player'=>$player])}}" class="btn btn-danger">Ban</a>
	                  	@endcan
                  	@endif
                  </td>
                </tr>
                @endforeach
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <div class="box-footer">
          	{{$players->links()}}
          </div>
          <!-- /.box -->
        </div>
      </div>
@stop
@section('js')
   
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop