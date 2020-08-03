@extends('front-end.master')

@section('pageTitle')
Order completed
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
					<li>Order completed</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->

	<!-- welcome -->
	<div class="welcome">
		<div class="container">
			<div class="alert alert-success">
				<h3>Dear {{Session::get('customerName')}} your order is placed successfully!</h3>
			</div>

			<div class="row">
				<div class="col-md-8 col-md-offset-2 well">			
				
			
							
				</div>
			</div>
		
		</div>

	</div>
	<!-- //welcome -->



@endsection

@section('footerScriptArea')



@endsection