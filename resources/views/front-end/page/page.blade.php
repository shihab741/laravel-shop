@extends('front-end.master')

@section('pageTitle')
{{ $singleStaticPage->heading }}
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
					<li>{{ $singleStaticPage->heading }}</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->

	<!-- welcome -->
	<div class="welcome">
		<div class="container">
			<!-- tittle heading -->
			<h3 class="tittle-w3l">{{ $singleStaticPage->heading }}</h3>
			<!-- //tittle heading -->
			<div class="w3l-welcome-info">
				<div class="col-sm-12 col-xs-12 welcome-grids">
					<div class="welcome-img">
						<img src="{{ asset('/') }}uploads/page-images/{{ $singleStaticPage->image }}" class="img-responsive zoom-img" width="100%" alt="">
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="w3l-welcome-text">
				{!! $singleStaticPage->page_content !!}
			</div>
		</div>
	</div>
	<!-- //welcome -->








@endsection

@section('footerScriptArea')

@endsection