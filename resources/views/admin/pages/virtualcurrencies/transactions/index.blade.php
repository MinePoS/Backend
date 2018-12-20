@extends('admin.layout')

@section('title')
Virtual Transactions
@endsection

@section('desc')

@endsection

@section('content')

<div class="container-fluid">
<div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Transactions</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <!-- <input name="table_search" class="form-control pull-right" placeholder="Search" type="text"> -->

                  <div class="input-group-btn">
                    <!-- <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button> -->
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>ID</th>
                  <th>User</th>
                  <th>Before</th>
                  <th>After</th>
                  <th>Currency</th>
                  <th>Cause</th>
                  <th>Reason</th>
                  <th>Happend at</th>
                </tr>
                @foreach($transactions as $transaction)
                <tr style="background-color: @if(\Store::isMore($transaction)) #00ff001a; @else #f003; @endif">
                  <td>{{$transaction->id}}</td>
                  <td>{{\App\CurrencyUser::find($transaction->user_id)->ident}} ({{\App\CurrencyUser::find($transaction->user_id)->game}})</td>
                  <td>{{json_decode($transaction->before,true)[$transaction->currency_id]}}</td>
                  <td>{{json_decode($transaction->after,true)[$transaction->currency_id]}}</td>
                  <td>{{\App\VirtualCurrency::find($transaction->currency_id)->name}}</td>
                  <td>{{$transaction->cause}}</td>
                  <td>{{$transaction->reason}}</td>
                  <td>{{$transaction->created_at->diffForHumans()}}</td>
                </tr>
                @endforeach
              </tbody></table>
             
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
 				{{$transactions->links()}}
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
</div>
@endsection