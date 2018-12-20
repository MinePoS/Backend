@extends('admin.layout')

@section('title')
Virtual Currencies
@endsection

@section('desc')

@endsection

@section('content')
<div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Currencies</h3>
              <div class="card-tools">
               		<a href="{{Route('admin.settings.virtualcurrencies.add')}}" class="btn btn-success"><i class="fa fa-plus"></i> Create</a>
              </div>
            </div>
            
            <div class="card-body pad">
             <div class="card-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Exchange Rate</th>
                  <th>Actions</th>
                </tr>
			   	
			   	@if(count(\App\VirtualCurrency::all()) == 0)
				<tr><td colspan="4"><center>You have not added a virtual currency</center></td></tr>

				@else 
					@foreach(\App\VirtualCurrency::all() as $currency)
				<tr>
                  <td>{{$currency->id}}</td>
                  <td>{{$currency->name}}</td>
                  <td>1 USD is worth {{$currency->worth}}</td>
                  <td>
                  	<a class="btn btn-success" href="{{Route('admin.settings.virtualcurrencies.edit',['currency'=>$currency])}}">Edit</a>
                  	<a class="btn btn-danger" href="{{Route('admin.settings.virtualcurrencies.delete',['currency'=>$currency])}}">Delete</a>
                  </td>
                </tr>
                @endforeach
			   	@endif
                
              </tbody></table>
              
            </div>
            </div>
			
			<div class="card-footer">
              		
            </div>
          </div>
          <!-- /.card -->
        </div>
@endsection
