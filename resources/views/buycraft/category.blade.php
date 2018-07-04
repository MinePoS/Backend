@extends('layouts.app')
@section('title')
{{$category->name}}
@endsection
@section('content')
<div class="card dark-container">
  <h4 class="card-header">{{$category->name}}</h4>
  <div class="card-body">
		{!!$category->desc!!}

		<table class="table table-custom">
			<tbody>
				@foreach($category->getProducts() as $product)
				<tr>
					<td>{{$product->name}}</td>
					<td><p class="float-right">{{$product->price}} <a href="#" data-toggle="modal" data-target="#Product{{$product->id}}" class="btn btn-dark">Buy</a></p></td>
				</tr>
				@endforeach
			</tbody>
		</table>
  </div>
</div>
@endsection

@section('end_of_body')
@foreach($category->getProducts() as $product)
<div class="dark-modal modal fade ui-draggable" id="Product{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="Product{{$product->id}}" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header ui-draggable-handle">
				<h5 class="modal-title" id="adept-title">{{$product->name}}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				{!! $product->description !!}
			</div>
			<div class="modal-footer">
				<a href="{{Route('store.addproduct',['product'=>$product])}}" type="button" class="btn btn-dark">Add To Cart</a>
				<button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@endforeach
@endsection
        