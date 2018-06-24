<div class="col-sm-12 col-md-4">
				<div class="card dark-container">
					<h4 class="card-header">Recent Payments</h4>
					<div class="card-body">
						<div class="payments">
							<div class="container-fluid">
								<?php $orders = \App\Order::last(5); ?>
								@foreach($orders as $order)
								<div class="payment-row row">
									<div class="col-sm-12" style="padding: 0">
										<img src="{{$order->getHead()}}">{{$order->username}} ({{$order->total}} {{$order->currency}})
									</div>
								</div>
								@if($orders->last() != $order)
								<hr style="margin-top: 5px;margin-bottom: 5px;border-top: 1px solid #ffffff;">
								@endif
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>