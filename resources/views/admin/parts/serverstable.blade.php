<div class="container-fluid">
<div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Servers</h3>

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
                  <th>Name</th>
                  <th>Type</th>
                  <th>Active</th>
                  <th>Last API Call</th>
                  <th>Actions</th>
                </tr>
                @foreach($servers as $server)
                <tr>
                  <td>{{$server->id}}</td>
                  <td>{{$server->name}}</td>
                  <td>{{$server->type}}</td>
                    <?php if($server->enabled == true){ $status="success"; }else{ $status="danger"; }?>
                  <td><span class="badge bg-{{$status}}">@if($server->enabled == true) Enabled @else Disabled @endif</span></td>
                  <td>@if($server->last_used != null) {{$server->last_used->diffForHumans()}} @else Never used @endif</td>
                  <td><a class="btn btn-primary" href="{{route('admin.server.edit',['server'=>$server])}}">Edit</a> <a href="{{route('admin.server.delete',['server'=>$server])}}" class="btn btn-danger">Delete</a></td>
                </tr>
                @endforeach
              </tbody></table>
              {{$servers->links()}}
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
</div>