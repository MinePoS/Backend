@extends('admin.layout')

@section('title')
403 Error Page
@endsection

@section('desc')
Im sorry, Are you meant to be here? 
@endsection

@section('content')
<div class="error-page">
        <h2 class="headline text-red"> 403</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-red"></i> Oops! You dont have access to this page.</h3>

          <p>
            Your account is not allowed to view this page, please contact your system admin if you belive this is a error
            Meanwhile, you may <a href="{{Route('admin.dashboard')}}">return to dashboard</a>
          </p>
        </div>
        <!-- /.error-content -->
      </div>
@endsection