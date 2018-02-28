<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Users</h3>

              <div class="box-tools">

                   @can('create user') <a href="{{Route('admin.users.new')}}" class="btn btn-success"><i class="fa fa-plus"></i> New</a> @endcan

              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Actions</th>
                </tr>
    @foreach ($users as $user)
    
        <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->getRole()}}</td>
        <td>@if($user->email == \Auth::user()->email)@else<a class="btn btn-primary" href="{{route('admin.users.view', ['user' => $user])}}">@can('edit user') Edit @else View @endcan</a> @can('delete user')<a class="btn btn-danger" href="{{route('admin.users.delete', ['user' => $user])}}">Delete</a>@endcan @endif</td>
      </tr>
   
    @endforeach
                
              </tbody></table>
              {{ $users->links() }}
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>