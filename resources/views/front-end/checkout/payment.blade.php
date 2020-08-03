@extends('front-end.master')

@section('pageTitle')
Payment
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
					<li>Payment</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->

	<!-- welcome -->
	<div class="welcome">
		<div class="container">
			<div class="well">
				<h3>Dear {{Session::get('customerName')}} your payment information goes here</h3>
			</div>

			<div class="row">
				<div class="col-md-8 col-md-offset-2 well">			
				
					{{Form::open(['route'=>'new-order', 'method'=>'post'])}}
						<table class="table table-bordered">
							<tr>
								<th>Cash on delivery</th>
								<td><input type="radio" name="payment_type" value="cash" checked="checked"> Cash on delivery</td>
							</tr>
							<tr>
								<th>Paypal</th>
								<td><input type="radio" name="payment_type" value="paypal"> Paypal</td>
							</tr>
							<tr>
								<th>bKash</th>
								<td><input type="radio" name="payment_type" value="bkash"> bKash</td>
							</tr>
							<tr>
								<th>Stripe</th>
								<td><input type="radio" name="payment_type" value="stripe"> Stripe</td>
							</tr>
							<tr>
								<th></th>
								<td><input type="submit" name="btn" value="Confirm order"></td>
							</tr>
						</table>
					{{Form::close()}}			
							
				</div>
			</div>

			<div class="row">
				<div class="col-md-8 col-md-offset-2 well shipping-address">
					<h3>Shipping address:</h3>
					<strong>Name: </strong><span>{{$customer->full_name}}</span><br>
					<strong>Email: </strong><span>{{$customer->email_address}}</span><br>
					<strong>Phone: </strong><span>{{$customer->phone_number}}</span><br>
					<strong>Address: </strong><span>{{$customer->address}}</span><br><br>
					<a class="btn btn-primary" href="{{route('checkout-shipping-edit')}}">Change shipping address</a>
				</div>
			</div>
		
		</div>

	</div>
	<!-- //welcome -->



@endsection

@section('footerScriptArea')



@endsection