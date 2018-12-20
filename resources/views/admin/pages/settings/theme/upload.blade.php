@extends('admin.layout')

@section('title')
Upload New Theme
@endsection

@section('desc')
Ohh, getting Fancy are we ;)
@endsection

@section('content')
<div class="row">
  <div class="col-6">
<div class="card card-primary">
            <div class="card-header with-border">
              <h3 class="card-title">Quick Example</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" enctype="multipart/form-data" action="{{Route('admin.settings.theme.upload')}}" method="POST">
              {{csrf_field()}}
              <div class="card-body">
                <div class="form-group">
                  <label for="theme">Theme Archive</label>
                  <input id="theme" name="theme" accept=".theme.tar.gz" type="file">
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
</div>
@endsection