@extends('admin.layout')

@section('title')
Upload New Theme
@endsection

@section('desc')
Ohh, getting Fancy are we ;)
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" enctype="multipart/form-data" action="{{Route('admin.settings.theme.upload')}}" method="POST">
              {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label for="theme">Theme Archive</label>
                  <input id="theme" name="theme" accept=".theme.tar.gz" type="file">
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
</div>
@endsection