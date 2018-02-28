 <br>
 <center>
 <form action="{{Route('store.login')}}" method="POST">
  {{csrf_field()}}
  <div class="form-group">
    <label for="username">Username:</label>
    <input type="text" class="form-control" name="username" id="username">
  </div>
  <div class="checkbox">
    <label><input type="checkbox"> Remember me</label>
  </div>
  <button type="submit" class="btn btn-default">Login</button>
</form> 
</center>
<br>

@section('title')
Login
@endsection