@extends('admin.layout')

@section('title')
Themes
@endsection

@section('desc')
Here you can change the look of your store
@endsection

@section('content')
<div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Installed Themes</h3>

              <div class="card-tools">
               		<a href="{{Route('admin.settings.theme.upload')}}" class="btn btn-success"><i class="fa fa-plus"></i> Install</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>Theme Name</th>
                  <th>Extends</th>
                  <th>Views Path</th>
                  <th>Asset Path</th>
                  <th>Actions</th>
                </tr>
                @if(count(\Theme::all())>0)
                <?php $users = \App\User::all(); ?>
    @foreach (\Theme::all() as $theme)
        <tr>
        <td>{{$theme->name}}</td>
        <td>{{$theme->getParent() ? $theme->getParent()->name : ""}}</td>
        <td>{{$theme->viewsPath}}</td>
        <td>{{$theme->assetPath}}</td>
        @if(Theme::get() == $theme->name)
            <td><a href="{{route('admin.settings.theme.set',['themeName' => 'disabled'])}}" class="btn btn-danger">Disable</a></td>
        @else
      		  <td><a href="{{route('admin.settings.theme.set',['themeName' => $theme->name])}}" class="btn btn-primary">Set as default</a></td>
        @endif
       
      </tr>
   
    @endforeach
    @else

     <tr>
        <td colspan="5" style="text-align: center;">No Themes Found</td>
    </tr>
    @endif
                
              </tbody></table>
         
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
@endsection