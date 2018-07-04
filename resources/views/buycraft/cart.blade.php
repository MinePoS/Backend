<?php $ignoremodules = true; ?>
@extends('layouts.app')
@section('title')
Cart
@endsection
@section('content')
<div class="col-sm-12">
        <div class="card dark-container main-container">
          <div class="tab-content" id="tab-content">
            <div class="tab-pane fade show active" id="ranks-tab">
              <h4 class="card-header" data-toggle="modal" data-target="#main-container-modal">Cart</h4>
              <div class="card-body">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-sm-12" style="padding: 0">
                      <table class="table table-custom">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th><span class="float-right">Options</span></th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(Cart::count() == 0)
                          <tr>
                            <td>You have no items in your cart</td>
                          </tr>
                          @endif
                          
                          @foreach(Cart::content() as $item)
                          <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->price}}</td>
                            <td>
                              <input type="number" min="1" class="btn btn-dark btn-dark-input" value="{{$item->qty}}">
                            </td>
                            <td>
                              <div class="float-right">
                                <div class="pretty p-default">
                                  <input type="checkbox">
                                  <div class="state">
                                    <label></label>
                                  </div>
                                </div>
                                <a href="#" data-toggle="modal" data-target="#Product{{$item->id}}" class="btn btn-dark">Info</a>
                              </div>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>

                  @if(Cart::count() > 0)
                  <hr class="MinePoSHR">
                    Total: {{Cart::subtotal()}}
                  <hr class="MinePoSHR">

                  <div class="row cart-button-row">
                    <div class="col-sm-4">
                      <a href="{{Route('store.viewcheckout')}}" class="btn btn-dark">Checkout</a>
                    </div>
                    <div class="col-sm-8">
                      <a href="{{Route('store.clearcart')}}" class="float-sm-right btn btn-red" disabled>Empty Cart</a>
                    </div>
                  </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection

@section('end_of_body')
 @foreach(Cart::content() as $item)
 <?php $product = \App\Product::find($item->id); ?>
<div class="dark-modal modal fade ui-draggable" id="Product{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="Product{{$item->id}}" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header ui-draggable-handle">
        <h5 class="modal-title" id="adept-title">{{$item->name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        {!! $product->description !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection
