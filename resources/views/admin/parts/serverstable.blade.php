<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Servers</h3>

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
                  <th>Name</th>
                  <th>Active</th>
                  <th>Last API Call</th>
                </tr>
                @foreach($servers as $server)
                <tr>
                  <td>{{$server->id}}</td>
                  <td>{{$server->name}}</td>
                    <?php if($server->enabled == true){ $status="success"; }else{ $status="danger"; }?>
                  <td><span class="label label-{{$status}}">@if($server->enabled == true) Enabled @else Disabled @endif</span></td>
                  <td>@if($server->last_used != null) {{$server->last_used->diffForHumans()}} @else Never used @endif</td>
                </tr>
                @endforeach
              </tbody></table>
              {{$servers->links()}}
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>