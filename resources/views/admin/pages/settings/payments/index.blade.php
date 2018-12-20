@extends('admin.layout')

@section('title')
Payments
@endsection

@section('desc')

@endsection

@section('content')
<div class="alert alert-danger" role="alert">
  Chances to this payment page will take affect as soon as you press "Save"
</div>


<div class="col-md-6">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">PayPal
                <small class="muted">Settings</small>
              </h3>
            </div>
            <!-- /.card-header -->
            <form action="{{route('admin.settings.payments.save')}}" method="POST">
            	{{csrf_field()}}
            <div class="card-body pad">
              
              	  <label for="paypalemail">PayPal Email</label>
                  <input class="form-control" required id="paypalemail" type="email" name="paypalemail" value="{{\Setting::get('paypal_email')}}"/>
              
            </div>
			<div class="card-footer">
              		<button type="submit" class="btn btn-primary">Save</button>
              </div>
        </form>
          </div>
          <!-- /.card -->
        </div>
@endsection


@section("extra")
<script src="/admin/plugins/ckeditor/ckeditor.js"></script>

<script type="text/javascript">
	
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('desc');
  })


</script>
@endsection