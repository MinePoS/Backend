<div class="container-fluid">
<div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Roles</h3>

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
                  
                  <th>Actions</th>
                </tr>
			    @foreach ($roles as $role)
			        <tr>
			        <td>{{$role->id}}</td>
			        <td>{{$role->name}}</td>
			         @if(\Auth::user()->can('list servers') || \Auth::user()->can('create server'))
			        <td><a class="btn btn-primary" href="{{route('admin.roles.view', ['role' => $role])}}">@can('edit roles') Edit @else View @endcan</a> @can('delete roles')<a href="{{route('admin.roles.delete', ['role' => $role])}}" class="btn btn-danger">Delete</a>@endcan</td>
			        @endif 
			      </tr>
			    @endforeach
                
              </tbody></table>
              {{ $roles->links() }}
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
</div>