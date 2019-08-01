<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@if(Store::isLoggedIn() || Route::currentRouteName() == "store.index") @yield('title') @else Login @endif- {{ config('app.name', 'MinePoS') }}</title>
  <link rel="icon" type="image/png" href="{{theme_url('includes/img/favicon.png')}}">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
  <link rel="stylesheet" type="text/css" href="{{theme_url('includes/css/main.css')}}">
  <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-2 col-md-4">
        <img src="{{theme_url('includes/img/favicon.png')}}" class="logo">
      </div>

      <div class="col-sm-10 col-md-8">
        
        <a href="{{Route('store.viewcart')}}" class="btn btn-dark top-btn float-md-right">Cart ({{ Cart::count() }})</a>
        

        <a class="btn btn-dark top-btn float-md-right dropdown-toggle" href="#" id="currency" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">{{\Store::getCurrentCurencyString()}}</a>
       <div class="dropdown-menu" aria-labelledby="currency">
       
          <a class="dropdown-item" href="{{Route('store.setcurrency',['currency'=>'USD'])}}">USD</a>
        </div>
        

        @if(Store::isLoggedIn()) <a href="{{route('store.logout')}}" class="btn btn-dark top-btn float-md-right btn-danger" style="background-color: #dc3545;border-color: #dc3545;">Logout ({{Store::username()}})</a>@endif
	  </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
          <a class="navbar-brand" href="#">{{ config('app.name', 'MinePoS') }}</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item @if(\Request::is('/')) active @endif">
                <a class="nav-link" href="{{route('store.index')}}">Home <span class="sr-only">(current)</span></a>
              </li>
			@foreach(\App\Category::where('visible',1)->where('parent_id', null)->get() as $category)
      
      @if($category->isParent())
            <li class="nav-item dropdown @if($category->isRoute()) active @endif">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$category->name}}</a>
                <div class="dropdown-menu" aria-labelledby="{{$category->name}}">
                  @foreach($category->subCategories() as $subcat)
                  <a class="dropdown-item" href="{{route('store.category',[$subcat])}}">{{$subcat->name}}</a>
                  @endforeach
                </div>
              </li>


      @else
              <li class="nav-item @if($category->isRoute()) active @endif">
                <a class="nav-link" href="{{route('store.category',[$category])}}">{{$category->name}}</a>
              </li>
      @endif
			@endforeach
            </ul>
          </div>
        </nav>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 @if(isset($ignoremodules) && $ignoremodules == true) col-md-12 @else col-md-8 @endif">
        <div class="container-fluid">
          <div class="row">
            @if(Store::showContent())
				@yield('content')
			@else
				@include("parts.login")
			@endif
          </div>
        </div>
      </div>
      @if(isset($ignoremodules) && $ignoremodules == true)
        @else
        @include('parts.modules.recent')
      @endif
    </div>


  </div>
</div>
</div>

@if(Session::has('error-model'))
<div class="modal fade show" id="error-model" tabindex="-1" role="dialog" aria-hidden="true" style="display: block;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Error</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{Session::get('error-model')}}  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endif


@include('parts.footer')
@yield('end_of_body')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{theme_url('includes/js/main.js')}}"></script>
</body>
</html>