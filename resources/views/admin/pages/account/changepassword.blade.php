@extends('admin.layout')

@section('title')
Change Password
@endsection

@section('desc')
Changing your password is always a good idea
@endsection

@section('content')

<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Change Password</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{route('admin.account.changepassword')}}" method="POST">
            	{{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label for="current_password">Current Password</label>
                  <input class="form-control" autocomplete="off" name="current_password" id="current_password" type="password" required>
                </div>
                <div class="form-group">
                  <label for="new_password">New Password</label>
                  <input class="form-control" name="new_password" id="new_password" type="password" required>
                </div>
                <div class="form-group">
                  <label for="new_password_repeat">New Password Repeat</label>
                  <input class="form-control" name="new_password_repeat" id="new_password_repeat" type="password" required>
                </div>

         
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
              		<button type="submit" class="btn btn-primary">Create</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
@endsection