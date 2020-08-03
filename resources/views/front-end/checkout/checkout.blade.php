@extends('front-end.master')

@section('pageTitle')
Checkout
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
					<li>Checkout</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->

	<!-- welcome -->
	<div class="welcome">
		<div class="container">
			<div class="well">
				<h3>Please login to complete your order or register if you have not registered yet.</h3>
			</div>

			<div class="row">
				<div class="col-md-6">				
					
						<h3 class="agileinfo_sign">Sign Up</h3>
						{{ Form::open(['route' => 'customer-sign-up', 'method' => 'POST']) }}

							<input type="hidden" name="is_checkout_page" value="1">

							<div class="form-group">
								<label for="name">First name</label>
								<input type="text" class="form-control" placeholder="First name" name="first_name" required="">
							</div>
							<div class="form-group">
								<label for="name">Last name</label>
								<input type="text" class="form-control" placeholder="Last name" name="last_name" required="">
							</div>
							<div class="form-group">
								<label for="name">Email address</label>
								<input type="email" class="form-control" placeholder="E-mail" name="email_address" id="email_address_checkout" required="">
								<span class="text-success" id="res-checkout"></span>
							</div>
							<div class="form-group">
								<label for="name">Password</label>
								<input type="password" class="form-control" placeholder="Password" name="password" id="password1-checkout" required="">
							</div>
							<div class="form-group">
								<label for="name">Confirm password</label>
								<input type="password" class="form-control" placeholder="Confirm Password" name="Confirm Password" id="password2-checkout" required="">
							</div>
							<div class="form-group">
								<label for="name">Phone number</label>
								<input type="text" class="form-control" placeholder="Phone number" name="phone_number" required="">
							</div>
							<div class="form-group">
								<label for="name">Address</label>
								{{-- <input type="text" class="form-control" placeholder="Address" name="address" required=""> --}}
								<textarea class="form-control" placeholder="Address" name="address" required=""></textarea>
							</div>
							<input type="submit" id="regBtn-checkout" value="Register">
						{{ Form::close() }}
						<p>
							<a href="#">By clicking register, I agree to your terms</a>
						</p>				
				</div>
				<div class="col-md-6">
						<h3 class="agileinfo_sign">Sign In </h3>
						{{ Form::open(['route' => 'customer-login', 'method' => 'POST']) }}

							<input type="hidden" name="is_checkout_page" value="1">
							
							<div class="form-group">
								<label for="name">Email address</label>
								<input type="email" class="form-control" placeholder="Email" name="email_address" required="">
							</div>
							<div class="form-group">
								<label for="name">Password</label>
								<input type="password" class="form-control" placeholder="Password" name="password" required="">
							</div>
							<input type="submit" value="Sign In">
						{{ Form::close() }}					
				</div>
			</div>
		
		</div>

	</div>
	<!-- //welcome -->



@endsection

@section('footerScriptArea')

<script>

	var email_address = document.getElementById('email_address_checkout');
	email_address.onblur = function()
	{

		var email = document.getElementById('email_address_checkout').value;
		var xmlHttp = new XMLHttpRequest();
		var serverPage = '{{ asset('/') }}ajax-email-check/?email='+email;
		xmlHttp.open('GET', serverPage);
		xmlHttp.onreadystatechange = function()
		{
			if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
			{
				document.getElementById('res-checkout').innerHTML = xmlHttp.responseText;

				if(xmlHttp.responseText == 'Already exists!')
				{
					document.getElementById('regBtn-checkout').disabled = true;
				}
				else
				{
					document.getElementById('regBtn-checkout').disabled = false;
				}
			}
		}

		xmlHttp.send(null);
	}

</script>






	<script>
		window.onload = function () {
			document.getElementById("password1-checkout").onchange = validatePassword;
			document.getElementById("password2-checkout").onchange = validatePassword;
		}

		function validatePassword() {
			var pass2 = document.getElementById("password2-checkout").value;
			var pass1 = document.getElementById("password1-checkout").value;
			if (pass1 != pass2)
				document.getElementById("password2-checkout").setCustomValidity("Passwords Don't Match");
			else
				document.getElementById("password2-checkout").setCustomValidity('');
			//empty string means no validation error
		}
	</script>
	<!-- //password-script -->




@endsection