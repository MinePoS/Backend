<?php $ignoremodules = true; ?>

@extends('layouts.app')
@section('title')
Checkout
@endsection

@section('content')
<div class="card dark-container main-container">
          <div class="tab-content" id="tab-content">
            <div class="tab-pane fade show active" id="ranks-tab">
              <h4 class="card-header" data-toggle="modal" data-target="#main-container-modal">Checkout</h4>
              <div class="card-body">
                <form action="{{Route('store.checkout')}}" id="payment-form" method="POST">
                  {{csrf_field()}}
                  <!-- <div class="page-header">
                    <label>Coupon / gift codes</label>
                  </div>
                  <div class="form-group">
                    <input disabled name="coupon" class="btn btn-dark btn-dark-input" placeholder="COOLCOUPON20" type="text">
                    <button class="btn btn-dark">Add</button>
                    <small class="form-text text-muted">If you have one, put a coupon or gift code here to get the product(s) for free or discounted.</small>
                  </div> -->
                  <div class="page-header">
                    <label>Payment Method</label>
                  </div>
                  <div class="form-group">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-sm-12 col-md-4">
                          <div class="pretty p-icon p-smooth">
                            <input name="gateway" value="paypal" type="radio">
                            <div class="state p-success-o">
                              <svg class="svg-inline--fa fa-check fa-w-16 icon" aria-hidden="true" data-prefix="far" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M435.848 83.466L172.804 346.51l-96.652-96.652c-4.686-4.686-12.284-4.686-16.971 0l-28.284 28.284c-4.686 4.686-4.686 12.284 0 16.971l133.421 133.421c4.686 4.686 12.284 4.686 16.971 0l299.813-299.813c4.686-4.686 4.686-12.284 0-16.971l-28.284-28.284c-4.686-4.686-12.284-4.686-16.97 0z"></path></svg><!-- <i class="icon far fa-check"></i> -->
                              <label></label>
                            </div>
                          </div>
                          <img src="{{theme_url('includes/img/paypal.png')}}" class="payment-gateway-logo">
                        </div>


                        @if(Setting('STRIPE_ENABLED') == true)
                        <div class="col-sm-12 col-md-4">
                          <div class="pretty p-icon p-smooth">
                            <input name="gateway" value="stripe" type="radio">
                            <div class="state p-success-o">
                              <svg class="svg-inline--fa fa-check fa-w-16 icon" aria-hidden="true" data-prefix="far" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M435.848 83.466L172.804 346.51l-96.652-96.652c-4.686-4.686-12.284-4.686-16.971 0l-28.284 28.284c-4.686 4.686-4.686 12.284 0 16.971l133.421 133.421c4.686 4.686 12.284 4.686 16.971 0l299.813-299.813c4.686-4.686 4.686-12.284 0-16.971l-28.284-28.284c-4.686-4.686-12.284-4.686-16.97 0z"></path></svg><!-- <i class="icon far fa-check"></i> -->
                              <label></label>
                            </div>
                          </div>
                          <img src="{{theme_url('includes/img/stripe.png')}}" class="payment-gateway-logo">
                        </div>
                        @endif
                      </div>
                    </div>
                  </div>

                  <script type="text/javascript">
                   setTimeout(function(){
                    $("input[name='gateway']").change(function(){
                       $(".gateway-extra").hide();
                       var gate = $("input[name='gateway']:checked").val();
                       $(".gateway-extra-"+gate).show();
                    });
                    stripeSetup();
                   },100);
                  </script>

                  <div class="gateway-extra gateway-extra-stripe" style="display: none;">
                    <div class="page-header">
                      <label>Stripe Payment</label>
                    </div>
                        @include('payment.stripe')
                     <br>
                  </div>
                  <div class="page-header">
                    <label>Purchase</label>
                  </div>
                  <div class="form-group">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-sm-12 col-md-6">
                          <div class="pretty p-icon p-smooth">
                            <input name="tos" value="1" type="checkbox">
                            <div class="state p-success-o">
                              <svg class="svg-inline--fa fa-check fa-w-16 icon" aria-hidden="true" data-prefix="far" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M435.848 83.466L172.804 346.51l-96.652-96.652c-4.686-4.686-12.284-4.686-16.971 0l-28.284 28.284c-4.686 4.686-4.686 12.284 0 16.971l133.421 133.421c4.686 4.686 12.284 4.686 16.971 0l299.813-299.813c4.686-4.686 4.686-12.284 0-16.971l-28.284-28.284c-4.686-4.686-12.284-4.686-16.97 0z"></path></svg><!-- <i class="icon far fa-check"></i> -->
                              <label id="tc-link" class="minepos-link">I agree to the <a href="#" data-toggle="modal" data-target="#tc">terms &amp; conditions</a></label>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                          <?php 

                            $intent = \Stripe\PaymentIntent::create([
                                'amount' => Cart::subtotal()*100,
                                'currency' => 'usd',
                            ]);
                          ?>
                          <input id="card-button" data-secret="{{$intent->client_secret}}" class="btn btn-dark float-md-right" value="Purchase"/>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
@endsection

@section('end_of_body')
<div class="dark-modal modal fade ui-draggable" id="tc" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header ui-draggable-handle">
        <h5 class="modal-title" id="tc-title">{{\Setting::get("tos_title")}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        {!! \Setting::get("tos_desc") !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection