@extends('admin.layout')

@section('title')
@if(isset($currency)) Editing {{$currency->name}} @else Creating Currency @endif
@endsection

@section('desc')

@endsection

@section('content')
<div class="col-md-12">
          <div class="card">
            <form action="
            @if(isset($currency))
            {{Route('admin.settings.virtualcurrencies.edit',['currency'=>$currency])}}
            @else
            {{Route('admin.settings.virtualcurrencies.add')}}
            @endif
            " method="POST">
              {{csrf_field()}}
              @if(isset($currency)) <input type="hidden" name="id" value="{{$currency->id}}"> @endif
            <div class="card-header">
              <h3 class="card-title">@if(isset($currency)) {{$currency->name}} @else New @endif</h3>
            </div>
            
            <div class="card-body pad">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input name="name" id="name" class="form-control"  @if(isset($currency)) value="{{$currency->name}}" @endif>

                   <label for="worth">Exchange Rate <span class="text-muted"><small>(Example: 0.50 meaning two of this currency would be 1 USD)</small></span></label>
                  <input name="worth" id="worth" type="double" class="form-control"  @if(isset($currency)) value="{{$currency->worth}}" @endif>
                </div>
            </div>
			
			       <div class="card-footer">
              		<button type="submit" class="btn btn-success">
                  
                  @if(isset($currency))
            Save
            @else
            Create
            @endif  
                  </button>
            </div>
          </div>
          <!-- /.card -->
        </div>
@endsection
