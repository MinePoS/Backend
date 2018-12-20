@extends('layouts.app')
@section('title')
Welcome
@endsection
@section('content')
						<div class="card dark-container">
  <h4 class="card-header" data-toggle="modal" data-target="#main-container-modal">{{ \Store::homeTitle() }}</h4>
  <div class="card-body">
		{!! \Store::homeDesc() !!}
  </div>
</div>
        @endsection

@section('end_of_body')
<div class="modal fade ui-draggable" id="main-container-modal" tabindex="-1" role="dialog" aria-labelledby="main-container-modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="main-container-modal-title">Title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection