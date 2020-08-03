@extends('front-end.master')

@section('pageTitle')
Shipping
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
					<li>Shipping</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->

	<!-- welcome -->
	<div class="welcome">
		<div class="container">
			<div class="well">
				<h3>Dear {{Session::get('customerName')}} update your shipping information from here.</h3>
			</div>

			<div class="row">
				<div class="col-md-12">				
					
						{{Form::open(['route'=> 'update-shipping', 'method' => 'POST'])}}
							<div class="form-group">
								<label for="name">First name</label>
								<input type="text" class="form-control" placeholder="Name" name="full_name" required="" value="{{$customer->full_name}}">
							</div>
							<div class="form-group">
								<label for="name">Email address</label>
								<input type="email" class="form-control" placeholder="E-mail" name="email_address" required="" value="{{$customer->email_address}}">
								<span class="text-success" id="res-checkout"></span>
							</div>
							<div class="form-group">
								<label for="name">Phone number</label>
								<input type="text" class="form-control" placeholder="Phone number" name="phone_number" required="" value="{{$customer->phone_number}}">
							</div>
							<div class="form-group">
								<label for="name">Address</label>
								<textarea class="form-control" placeholder="Address" name="address" required="">{{$customer->address}}</textarea>
							</div>
							<input type="submit" class="btn btn-primary" value="Save shipping information">
						{{ Form::close() }}				
				</div>
			</div>
		
		</div>

	</div>
	<!-- //welcome -->



@endsection

@section('footerScriptArea')



@endsection