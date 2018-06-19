@extends('admin.layout')

@section('title')
Orders
@endsection

@section('desc')
Here you can view all the orders that have been created.
@endsection

@section('content')
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Orders</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <!-- <input name="table_search" class="form-control pull-right" placeholder="Search" type="text"> -->

                  <div class="input-group-btn">
                    <!-- <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button> -->
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>ID</th>
                  <th>Username</th>
                  <th>Status</th>
                  <th>Total</th>
                  <th>Actions</th>
                </tr>
			    @foreach ($orders as $order)
			        <tr>
			        <td>{{$order->id}}</td>
              <td>{{$order->username}}</td>
			        <td>{{$order->status}}</td>
			        <td>{{$order->total}} {{$order->currency}}</td>
			        
			        <td>
                <a class="btn btn-primary" href="#">View</a>
                <a href="#" class="btn btn-danger">Delete</a>
              </td>
			      </tr>
			    @endforeach
                
              </tbody></table>
              {{ $orders->links() }}
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
@endsection