@extends('front-end.master')

@section('pageTitle')
{{ $product->product_name }}
@endsection

@section('headerScriptArea1')

@endsection


@section('headerScriptArea2')
	<!-- flexslider -->
	<link rel="stylesheet" href="{{ asset('/') }}front-end/css/flexslider.css" type="text/css" media="screen" />
@endsection

@section('body')
	<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="{{ route('home-page') }}">Home</a>
						<i>|</i>
					</li>

					@foreach($categoriesForThisProduct as $categoryForThisProduct)
						<li>
							<a href="{{ route('category-details', $categoryForThisProduct->id) }}">{{ $categoryForThisProduct->cat_name }}</a>
							<i>|</i>
						</li>
					@endforeach

					<li>{{ $product->product_name }}</li>
				</ul>
			</div>
		</div>
	</div>

	<!-- Single Page -->
	<div class="banner-bootom-w3-agileits">
		<div class="container">
			<!-- tittle heading -->
	
			<!-- //tittle heading -->
			<div class="col-md-5 single-right-left ">
				<div class="grid images_3_of_2">
					<div class="flexslider">
						<ul class="slides">
							<li data-thumb="{{ asset('/') }}uploads/product-images/{{ $product->product_image }}">
								<div class="thumb-image">
									<img src="{{ asset('/') }}uploads/product-images/{{ $product->product_image }}" data-imagezoom="true" class="img-responsive" alt=""> </div>
							</li>
							@php($i = 1)
							@foreach(json_decode($product->multiple_image) as $multipleImage)
								@if($i <=2)
									<li data-thumb="{{ asset('/') }}uploads/product-images/{{ $multipleImage }}">
										<div class="thumb-image">
											<img src="{{ asset('/') }}uploads/product-images/{{ $multipleImage }}" data-imagezoom="true" class="img-responsive" alt=""> </div>
									</li>
									@php($i++)
								@endif
							@endforeach
						</ul>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="col-md-7 single-right-left simpleCart_shelfItem">
				<h3>{{ $product->product_name }}</h3>



				@if($product->discount_price != 0.00)
					<p>
						<span class="item_price">${{ $product->discount_price }}</span>
						<del>${{ $product->product_price }}</del>
					</p>
				@else
					<p>
						<span class="item_price">${{ $product->product_price }}</span>
					</p>
				@endif



				<div class="product-single-w3l">
					<p>
						<i class="fa fa-hand-o-right" aria-hidden="true"></i>
						{{ $product->short_desc }}	
					</p>
					<p>
						<i class="fa fa-hand-o-right" aria-hidden="true"></i>
						<label>Brand:</label> {{ $product->brand_name }}						
					</p>
					<p>Description:</p>
					{!! $product->long_desc !!}

				</div>
				<div class="occasion-cart">
					<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
						{{ Form::open(['route' => 'add-to-cart', 'method' => 'POST']) }}
							<input type="hidden" name="id" value="{{ $product->id }}">
							<input type="number" name="qty" value="1" min="1"><br><br>
							<input type="submit" name="submit" value="Add to cart" class="button" />
						{{ Form::close() }}
					</div>

				</div>

			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!-- //Single Page -->

@endsection

@section('footerScriptArea')

	<!-- imagezoom -->
	<script src="{{ asset('/') }}front-end/js/imagezoom.js"></script>
	<!-- //imagezoom -->

	<!-- FlexSlider -->
	<script src="{{ asset('/') }}front-end/js/jquery.flexslider.js"></script>
	<script>
		// Can also be used with $(document).ready()
		$(window).load(function () {
			$('.flexslider').flexslider({
				animation: "slide",
				controlNav: "thumbnails"
			});
		});
	</script>
	<!-- //FlexSlider-->

@endsection