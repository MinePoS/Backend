
<div class="card dark-container">
              <h4 class="card-header" data-toggle="modal" data-target="">Login</h4>
              <div class="card-body">
                <div class="card-title">
                  <h5>Please enter your minecraft username.</h5>
                </div>
	<form action="{{Route('store.login')}}" method="POST">
	  {{csrf_field()}}
                  <div class="input-group">
                    <input type="text" name="username" class="form-control btn btn-dark btn-dark-input" placeholder="PiggyPiglet" required>
                    <button class="btn btn-dark" type="submit">Continue</button>
                  </div>
                </form>
              </div>
            </div>
@section('title')
Login
@endsection