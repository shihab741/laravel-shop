@extends('front-end.master')

@section('pageTitle')
Cart
@endsection

@section('headerScriptArea1')

@endsection


@section('headerScriptArea2')

@endsection

@section('body')

	<!-- page -->
	<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="{{ route('home-page') }}">Home</a>
						<i>|</i>
					</li>
					<li>Cart</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->

	<!-- welcome -->
	<div class="welcome">
		<div class="container">
			<div class="checkout-right">
				<h4>Your shopping cart contains:
					{{-- <span>3 Products</span> --}}
				</h4>
				<div class="table-responsive">
					<table class="timetable_sub">
						<thead>
							<tr>
								<th>SL No.</th>
								<th>Product</th>
								<th>Quantity</th>
								<th>Product Name</th>
								<th>Rate</th>
								<th>Price</th>
								<th>Remove</th>
							</tr>
						</thead>
						<tbody>
							@php($i = 1)
							@php($sum = 0)
							@foreach ($cartProducts as $cartProduct)
								<tr class="rem1">
									<td class="invert">{{ $i++ }}</td>
									<td class="invert-image">
										<a href="{{ route('single-product-details', $cartProduct->id) }}">
											<img src="{{ asset('/') }}uploads/product-images/{{ $cartProduct->options->image }}" alt=" " height="75px" width="75px">
										</a>
									</td>
									<td class="invert">
										{{Form::open(['route' =>'update-cart', 'method' =>'POST']) }}
														<input type="number" name="qty" value="{{ $cartProduct->qty}}" min="1">
														<input type="hidden" name="rowId" value="{{ $cartProduct->rowId}}">
														<input type="submit" name="btn" value="Update">
										{{Form::close()}}
									</td>
									<td class="invert">{{ $cartProduct->name }}</td>
									<td class="invert">${{ $cartProduct->price }}</td>
									<td class="invert">${{ $total = $cartProduct->price*$cartProduct->qty}}</td>
									<td class="invert">
										<a href="{{ route('delete-cart-item', ['rowId'=>$cartProduct->rowId])}}" class="btn btn-danger btn-xs" title="Delete">
											<span class="glyphicon glyphicon-trash"></span>
										</a>
									</td>
								</tr>
								<?php  $sum = $sum + $total; ?>
							@endforeach
						</tbody>
						<thead>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th>Total</th>
								<th>{{ $sum }}</th>
							</tr>
						</thead>
					</table>
							<?php 
								Session::put('orderTotal', $sum);
							?>					
				</div>
			</div>
		
		</div>

	</div>
	<!-- //welcome -->



	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			@if(Session::get('customerId') && Session::get('shippingId'))
					<a href="{{route('checkout-payment')}}" class="btn btn-success pull-right">Checkout</a>
			@elseif(Session::get('customerId'))
					<a href="{{route('checkout-shipping')}}" class="btn btn-success pull-right">Checkout</a>
			@else
					<a href="{{route('checkout')}}" class="btn btn-success pull-right">Checkout</a>
			@endif
			
			<a href="{{ route('home-page') }}" class="btn btn-success">Continue shopping</a>
		</div>
	</div>





@endsection

@section('footerScriptArea')

@endsection