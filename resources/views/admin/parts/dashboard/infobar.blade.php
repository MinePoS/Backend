<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{count(\App\Order::lastDays($days))}}</h3>
              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
            	@if(\App\Order::moneyReceivedDays($days) == null)
            		<h3>None</h3>
            	@else
					<h3>{{ \App\Order::moneyReceivedDays($days) }}</h3>
            	@endif
              <p>Money Received</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
            	@if(\App\Order::topUsernameDays($days) != "None")
				<h4>{{\App\Order::topUsernameDays($days)->first()->username}}</h4>
            	@else
            	<h3>{{\App\Order::topUsernameDays($days)}}</h3>
            	@endif
              <h4></h4>
              <p>Top donator</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
            	@if(\App\Order::topUsernameDays($days) != "None")
				<h3>{{\App\Order::topUsernameDays($days)->count()}}</h3>
            	@else
            	<h3>0</h3>
            	@endif

              <p>Unique Donators</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>