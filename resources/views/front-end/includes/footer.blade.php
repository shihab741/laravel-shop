	<!-- footer -->
	<footer>
		<div class="container">

			<!-- footer third section -->
			<div class="footer-info w3-agileits-info">
				<!-- footer categories -->
				<div class="col-md-3 address-right footer-grids">					
						<h3>Categories</h3>
						<ul>
							@foreach($categories as $category)
								<li><a href="{{ route('category-details', $category->id) }}">{{ $category->cat_name }}</a></li>
							@endforeach
						</ul>
				</div>
				<!-- //footer categories -->
				<!-- quick links -->
				<div class="col-md-3 address-right footer-grids">
						<h3>Quick Links</h3>
						<ul>
							@foreach($staticPages as $staticPage)
								<li><a href="{{ route('page-details', $staticPage->url) }}">{{ $staticPage->heading }}</a></li>
							@endforeach
						</ul>
				</div>
				<!-- //quick links -->

				<!-- Contact -->
				<div class="col-md-3 address-right footer-grids">
						<h3>Get in Touch</h3>
						<ul>
							<li>
								<i class="fa fa-map-marker"></i> {{ $settings->address }}
							</li>
							<li>
								<i class="fa fa-phone"></i> {{ $settings->phone }}
							</li>
							<li>
								<i class="fa fa-envelope-o"></i>
								<a href="mailto:{{ $settings->email }}"> {{ $settings->email }}</a>
							</li>
						</ul>					
				</div>
				<!--//Contact -->

				<!-- social icons -->
				<div class="col-md-3 footer-grids  w3l-socialmk">
					<h3>Follow Us on</h3>
					<div class="social">
						<ul>
							<li>
								<a class="icon fb" href="#">
									<i class="fa fa-facebook"></i>
								</a>
							</li>
							<li>
								<a class="icon tw" href="#">
									<i class="fa fa-twitter"></i>
								</a>
							</li>
							<li>
								<a class="icon gp" href="#">
									<i class="fa fa-google-plus"></i>
								</a>
							</li>
						</ul>
					</div>

				</div>
				<!-- //social icons -->
				<div class="clearfix"></div>
			</div>
			<!-- //footer third section -->

<div class="agile-sometext">

				<!-- brands -->
				<div class="sub-some">
					<h5>Brands</h5>
					<ul>
						@foreach($brands as $brand)
							<li><a href="{{ route('brand-details', $brand->id) }}">{{ $brand->brand_name }}</a></li>
						@endforeach
					</ul>
				</div>
				<!-- //brands -->

</div>



		</div>
	</footer>
	<!-- //footer -->
	<!-- copyright -->
	<div class="copy-right">
		<div class="container">
			<p>&copy;  {{date("Y")}} {{ $settings->site_name }}, Developed by Shihab</a>
			</p>
		</div>
	</div>
	<!-- //copyright -->