<!DOCTYPE html>
<html>

<head>
	<title>@yield('pageTitle') | {{ $settings->site_name }}</title>
	<!--/tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="" />

	@yield('headerScriptArea1')

	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!--//tags -->
	<link href="{{ asset('/') }}front-end/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="{{ asset('/') }}front-end/css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="{{ asset('/') }}front-end/css/font-awesome.css" rel="stylesheet">
	<!--pop-up-box-->
	<link href="{{ asset('/') }}front-end/css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
	<!--//pop-up-box-->
	<!-- price range -->
	<link rel="stylesheet" type="text/css" href="{{ asset('/') }}front-end/css/jquery-ui1.css">
	<!-- fonts -->
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">

	@yield('headerScriptArea2')

</head>

<body>

	<!-- top-header -->
	<div class="header-most-top">
		<p>We are in development stage, currently not accepting orders.</p>
	</div>
	<!-- //top-header -->

                @if(Session::has('message'))
                        <h3>{!! Session::get('message') !!}</h3>
                @endif


	<!-- header-bot-->
	<div class="header-bot">
		<div class="header-bot_inner_wthreeinfo_header_mid">
			<!-- header-bot-->
			<div class="col-md-4 logo_agile">
				<h1>
					<a href="{{ route('home-page') }}">
						{{ $settings->site_name }}
						<img src="{{ asset('/') }}uploads/settings-images/{{ $settings->logo }}" alt=" ">
					</a>
				</h1>
			</div>
			<!-- header-bot -->
			<div class="col-md-8 header">
				<!-- header lists -->
				<ul>
					@if(Session::get('customerId'))
						<li style="width: auto;">
							Welcome <strong>{{ Session::get('customerName')}}</strong>&nbsp;
						</li>
						<li>
							<a href="#" onclick="event.preventDefault();
								document.getElementById('customerLogoutForm').submit();">
							<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout </a>
						</li>
						{{Form::open(['route' => 'customer-logout', 'method' => 'POST', 'id' => 'customerLogoutForm'])}}

						{{Form::close()}}
					@else
						<li>
							<a href="#" data-toggle="modal" data-target="#myModal1">
								<span class="fa fa-unlock-alt" aria-hidden="true"></span> Sign In </a>
						</li>
						<li>
							<a href="#" data-toggle="modal" data-target="#myModal2">
								<span class="fa fa-pencil-square-o" aria-hidden="true"></span> Sign Up </a>
						</li>
					@endif

				</ul>
				<!-- //header lists -->
				<!-- search -->
				<div class="agileits_search">
					<form action="#" >
						<input name="Search" type="search" placeholder="How can we help you today?" required="">
						<button type="submit" class="btn btn-default" aria-label="Left Align">
							<span class="fa fa-search" aria-hidden="true"> </span>
						</button>
					</form>
				</div>
				<!-- //search -->
				<!-- cart details -->
				<div class="top_nav_right">
					<div class="wthreecartaits wthreecartaits2 cart cart box_1">
						<form action="{{route('show-cart')}}" method="get" class="last">

							<button class="w3view-cart" type="submit" name="submit" value="">
								<i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
							</button>
						</form>
					</div>
				</div>
				<!-- //cart details -->
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<!-- signin Model -->
	<!-- Modal1 -->
	<div class="modal fade" id="myModal1" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body modal-body-sub_agile">
					<div class="main-mailposi">
						<span class="fa fa-envelope-o" aria-hidden="true"></span>
					</div>
					<div class="modal_body_left modal_body_left1">
						<h3 class="agileinfo_sign">Sign In </h3>
						<p>
							Sign in now. Don't have an account?
							<a href="#" data-toggle="modal" data-target="#myModal2">
								Sign Up Now</a>
						</p>
						{{ Form::open(['route' => 'customer-login', 'method' => 'POST']) }}
							<div class="styled-input agile-styled-input-top">
								<input type="email" placeholder="Email" name="email_address" required="">
							</div>
							<div class="styled-input">
								<input type="password" placeholder="Password" name="password" required="">
							</div>
							<input type="submit" value="Sign In">
						{{ Form::close() }}
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<!-- //Modal content-->
		</div>
	</div>
	<!-- //Modal1 -->
	<!-- //signin Model -->
	<!-- signup Model -->
	<!-- Modal2 -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body modal-body-sub_agile">
					<div class="main-mailposi">
						<span class="fa fa-envelope-o" aria-hidden="true"></span>
					</div>
					<div class="modal_body_left modal_body_left1">
						<h3 class="agileinfo_sign">Sign Up</h3>
						<p>
							Join {{ $settings->site_name }}! Let's set up your Account.
						</p>
						{{ Form::open(['route' => 'customer-sign-up', 'method' => 'POST']) }}
							<div class="styled-input agile-styled-input-top">
								<input type="text" placeholder="First name" name="first_name" required="">
							</div>
							<div class="styled-input agile-styled-input-top">
								<input type="text" placeholder="Last name" name="last_name" required="">
							</div>
							<div class="styled-input">
								<input type="email" placeholder="E-mail" name="email_address" id="email_address" required="">
								<span class="text-success" id="res"></span>
							</div>
							<div class="styled-input">
								<input type="password" placeholder="Password" name="password" id="password1" required="">
							</div>
							<div class="styled-input">
								<input type="password" placeholder="Confirm Password" name="Confirm Password" id="password2" required="">
							</div>
							<div class="styled-input agile-styled-input-top">
								<input type="text" placeholder="Phone number" name="phone_number" required="">
							</div>
							<div class="styled-input agile-styled-input-top">
								<input type="text" placeholder="Address" name="address" required="">
							</div>
							<input type="submit" id="regBtn" value="Sign Up">
						{{ Form::close() }}
						<p>
							<a href="#">By clicking register, I agree to your terms</a>
						</p>
					</div>
				</div>
			</div>
			<!-- //Modal content-->
		</div>
	</div>
	<!-- //Modal2 -->
	<!-- //signup Model -->
	<!-- //header-bot -->
 @include('front-end.includes.navigation')

  @yield('body')

 @include('front-end.includes.footer')


	<!-- js-files -->
	<!-- jquery -->
	<script src="{{ asset('/') }}front-end/js/jquery-2.1.4.min.js"></script>
	<!-- //jquery -->

	<!-- popup modal (for signin & signup)-->
	<script src="{{ asset('/') }}front-end/js/jquery.magnific-popup.js"></script>
	<script>
		$(document).ready(function () {
			$('.popup-with-zoom-anim').magnificPopup({
				type: 'inline',
				fixedContentPos: false,
				fixedBgPos: true,
				overflowY: 'auto',
				closeBtnInside: true,
				preloader: false,
				midClick: true,
				removalDelay: 300,
				mainClass: 'my-mfp-zoom-in'
			});

		});
	</script>
	<!-- Large modal -->
	<!-- <script>
		$('#').modal('show');
	</script> -->
	<!-- //popup modal (for signin & signup)-->

	<!-- cart-js -->
	<script src="{{ asset('/') }}front-end/js/minicart.js"></script>
	<script>
		paypalm.minicartk.render(); //use only unique class names other than paypalm.minicartk.Also Replace same class name in css and minicart.min.js

		paypalm.minicartk.cart.on('checkout', function (evt) {
			var items = this.items(),
				len = items.length,
				total = 0,
				i;

			// Count the number of each item in the cart
			for (i = 0; i < len; i++) {
				total += items[i].get('quantity');
			}

			if (total < 3) {
				alert('The minimum order quantity is 3. Please add more to your shopping cart before checking out');
				evt.preventDefault();
			}
		});
	</script>
	<!-- //cart-js -->

	<!-- price range (top products) -->
	<script src="{{ asset('/') }}front-end/js/jquery-ui.js"></script>
	<script>
		//<![CDATA[ 
		$(window).load(function () {
			$("#slider-range").slider({
				range: true,
				min: 0,
				max: 9000,
				values: [50, 6000],
				slide: function (event, ui) {
					$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
				}
			});
			$("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));

		}); //]]>
	</script>
	<!-- //price range (top products) -->

	<!-- flexisel (for special offers) -->
	<script src="{{ asset('/') }}front-end/js/jquery.flexisel.js"></script>
	<script>
		$(window).load(function () {
			$("#flexiselDemo1").flexisel({
				visibleItems: 3,
				animationSpeed: 1000,
				autoPlay: true,
				autoPlaySpeed: 3000,
				pauseOnHover: true,
				enableResponsiveBreakpoints: true,
				responsiveBreakpoints: {
					portrait: {
						changePoint: 480,
						visibleItems: 1
					},
					landscape: {
						changePoint: 640,
						visibleItems: 2
					},
					tablet: {
						changePoint: 768,
						visibleItems: 2
					}
				}
			});

		});
	</script>
	<!-- //flexisel (for special offers) -->

	<!-- password-script -->
	<script>
		window.onload = function () {
			document.getElementById("password1").onchange = validatePassword;
			document.getElementById("password2").onchange = validatePassword;
		}

		function validatePassword() {
			var pass2 = document.getElementById("password2").value;
			var pass1 = document.getElementById("password1").value;
			if (pass1 != pass2)
				document.getElementById("password2").setCustomValidity("Passwords Don't Match");
			else
				document.getElementById("password2").setCustomValidity('');
			//empty string means no validation error
		}
	</script>
	<!-- //password-script -->

	<!-- smoothscroll -->
	<script src="{{ asset('/') }}front-end/js/SmoothScroll.min.js"></script>
	<!-- //smoothscroll -->

	<!-- start-smooth-scrolling -->
	<script src="{{ asset('/') }}front-end/js/move-top.js"></script>
	<script src="{{ asset('/') }}front-end/js/easing.js"></script>
	<script>
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				event.preventDefault();

				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
		});
	</script>
	<!-- //end-smooth-scrolling -->

	<!-- smooth-scrolling-of-move-up -->
	<script>
		$(document).ready(function () {
			/*
			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
			};
			*/
			$().UItoTop({
				easingType: 'easeOutQuart'
			});

		});
	</script>
	<!-- //smooth-scrolling-of-move-up -->

	<!-- for bootstrap working -->
	<script src="{{ asset('/') }}front-end/js/bootstrap.js"></script>
	<!-- //for bootstrap working -->
	<!-- //js-files -->


<script>

	var email_address = document.getElementById('email_address');
	email_address.onblur = function()
	{

		var email = document.getElementById('email_address').value;
		var xmlHttp = new XMLHttpRequest();
		var serverPage = '{{ asset('/') }}ajax-email-check/?email='+email;
		xmlHttp.open('GET', serverPage);
		xmlHttp.onreadystatechange = function()
		{
			if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
			{
				document.getElementById('res').innerHTML = xmlHttp.responseText;

				if(xmlHttp.responseText == 'Already exists!')
				{
					document.getElementById('regBtn').disabled = true;
				}
				else
				{
					document.getElementById('regBtn').disabled = false;
				}
			}
		}

		xmlHttp.send(null);
	}

</script>


@yield('footerScriptArea')

</body>

</html>