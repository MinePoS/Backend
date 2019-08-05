@extends('adminlte::page')

@section('title', "Viewing '$player->username'")

@section('content_header')
    <h1>Viewing '{{$player->username}}'</h1>
@stop

@section('content')
	 <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{\Store::getHeadCustom($player->uuid, 128)}}" alt="{{$player->username}}'s Head">

              <h3 class="profile-username text-center">{{$player->username}}</h3>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Orders</b> <a class="pull-right">{{$player->orders()->count()}}</a>
                </li>
                <li class="list-group-item">
                  <b>Unpaid Orders</b> <a class="pull-right">{{$player->orders()->where("status",["awaiting_payment"])->count()}}</a>
                </li>
				<li class="list-group-item">
                  <b>Paid Orders <span class="text-muted">Awaiting fulfilment</span></b> <a class="pull-right">{{$player->orders()->where("status",["paid"])->count()}}</a>
                </li>
				<li class="list-group-item">
                  <b>Completed Orders</b> <a class="pull-right">{{$player->orders()->where("status",["fulfilled"])->count()}}</a>
                </li>
				<li class="list-group-item">
                  <b>Refunded Orders</b> <a class="pull-right">{{$player->orders()->where("status",["refunded"])->count()}}</a>
                </li>
				<li class="list-group-item">
                  <b>Charged-back Orders</b> <a class="pull-right">{{$player->orders()->where("status",["charge_back"])->count()}}</a>
                </li>
                
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          
          <!-- /.box -->
        </div>
        <div class="col-md-9">
        	<div class="box box-profile">
        		<div class="box-header">
        			<h3 class="box-title">Ban Management</h3>
        		</div>
        		<div class="box-body">
        			@if(\Auth::user()->can('view-players-bans'))
        			                        <div class="table-responsive">
                        <table class="table">
                                <thead>
                                    <tr>
                                        <th>BAN #</th>
                                        <th>BANNED BY</th>
                                        <th>REASON</th>
                                        <th>TYPE</th>
                                        <th>EXPIRES</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $bans = $player->bans()->withTrashed()->orderBy('id','DESC')->get(); ?>
                                    @if($bans->count() == 0)
                                    <tr>
                                        <td colspan="6"><center>This player has no bans on record.</center></td>
                                    </tr>
                                    @else
                                    @foreach($bans as $ban)
                                    <tr style="background-color:@if($ban->trashed()) #fbd6d6 @else #e0fbd6 @endif ; @if($ban->trashed())text-decoration: line-through;@endif">
                                        <th scope="row">{{$ban->id}}</th>
                                        <td>@if($ban->created_by_id != null) @if(\App\Admin::find($ban->created_by_id) != null) {{\App\Admin::find($ban->created_by_id)->name}} @else
                                        Deleted Admin
                                        @endif @else SYSTEM @endif</td>
                                        <td>@if($ban->comment == null) No Comment @else {{$ban->comment}} @endif</td>
                                        <td>@if($ban->isPermanent()) Permanent @else Temporary @endif</td>
                                        <td>@if($ban->expired_at == null) Never @else {{$ban->expired_at->diffForHumans()}} @endif</td>
                                        <td>@if(!$ban->trashed() && \Auth::user()->can('unban-players')) <a class="btn btn-danger" href="{{Route('admin.players.unban',['player'=>$player])}}">Lift</a> @endif</td>
                                    </tr>
                                    @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="alert alert-danger">
                        	You do not have access to view this data
                        </div>
                        @endif
        		</div>
        	</div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Order List</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              @can('view-orders')
              <table class="table table-hover">
                <tbody><tr>
                  <th>ID</th>
                  <th>Status</th>
                  <th>Gateway</th>
                  <th>Products</th>
                  <th>Cost</th>
                  <!-- <th>Actions</th> -->
                </tr>
                @foreach($player->orders()->get()->reverse() as $order)
                <?php
                  $items= json_decode(json_decode($order->order_data,true)["products"],true);
                  $itemCount = count($items);
                ?>
                <tr>
                  <td>{{$order->id}}</td>
                  <td>{!! $order->getStatusLabel() !!}</td>
                  <td>{{$order->PaymentProvider()->getName()}}</td>
                  <td>{{$itemCount}}</td>
                  <td>{{$order->cost}}</td>
                </tr>
                @endforeach
              </tbody></table>
              @else
                <div class="alert alert-danger">
                  You do not have access to view this data
                </div>
              @endcan
            </div>
            <!-- /.box-body -->
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