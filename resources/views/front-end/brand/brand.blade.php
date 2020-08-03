@extends('front-end.master')

@section('pageTitle')
{{ $brandInfo->brand_name }}
@endsection

@section('headerScriptArea1')

@endsection


@section('headerScriptArea2')

@endsection

@section('body')
	<!-- top Products -->
	<div class="ads-grid">
		<div class="container">
			<!-- tittle heading -->
			<h3 class="tittle-w3l">{{ $brandInfo->brand_name }}</h3>
			<!-- //tittle heading -->

			<!-- product right -->
			<div class="agileinfo-ads-display col-md-12">
				<div class="wrapper">
					<!-- first section (nuts) -->
					<div class="product-sec1">
						@foreach($products as $product)
							<div class="col-md-4 product-men">
								<div class="men-pro-item simpleCart_shelfItem">
									<div class="men-thumb-item">
										<img src="{{ asset('/') }}uploads/product-images/{{ $product->product_image }}" alt="" width="150" height="150">
										<div class="men-cart-pro">
											<div class="inner-men-cart-pro">
												<a href="{{ route('single-product-details', $product->id) }}" class="link-product-add-cart">Quick View</a>
											</div>
										</div>

										@if($product->discount_price != 0.00)
												<span class="product-new-top">Sale</span>
										@endif
										
									</div>
									<div class="item-info-product ">
										<h4>
											<a href="{{ route('single-product-details', $product->id) }}">{{ $product->product_name }}</a>
										</h4>
										
									@if($product->discount_price != 0.00)
										<div class="info-product-price">
											<span class="item_price">${{ $product->discount_price}}</span>
											<del>${{ $product->product_price}}</del>
										</div>
									@else
										<div class="info-product-price">
											<span class="item_price">${{ $product->product_price}}</span>
										</div>
									@endif

										<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
											{{ Form::open(['route' => 'add-to-cart', 'method' => 'POST']) }}
												<input type="hidden" name="id" value="{{ $product->id }}">
												<input type="submit" name="submit" value="Add to cart" class="button" />
											{{ Form::close() }}
										</div>

									</div>
								</div>
							</div>
						@endforeach
						<div class="clearfix"></div>
					</div>
					<!-- //first section (nuts) -->
					{{ $products->links() }}


				</div>
			</div>
			<!-- //product right -->
		</div>
	</div>
	<!-- //top products -->
@endsection

@section('footerScriptArea')

@endsection