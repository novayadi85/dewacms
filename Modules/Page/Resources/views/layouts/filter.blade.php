<!DOCTYPE html>
<html lang="en">
<head>

	<!-- Basic Meta Tags
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<meta charset="utf-8">
	<meta name="description" content="Travel choice">
	<meta name="author" content="novayadi">
	<meta name="keywords" content="Travel choice">

	<!-- Mobile Specific Meta Tags
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Page title
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<title>My travel choice - @yield('title')</title>

	<!-- links for icons and fonts
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/flaticon.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|PT+Serif:400,400i,700,700i" rel="stylesheet">
	<!-- links for favicon
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
	<link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

	<!-- css links
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<!-- animate css -->
	<link rel="stylesheet" href="https://daneden.github.io/animate.css/animate.min.css" type="text/css">
	<!-- Magnific Popup core CSS file -->
	<link rel="stylesheet" href="{{asset('css/magnific-popup.css') }}">
	<!-- owl carousel css -->
	<link href="{{asset('css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{asset('css/owl.theme.css')}}" rel="stylesheet">
    <link href="{{asset('css/owl.theme.default.css')}}" rel="stylesheet">
	<!-- Quform css -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/base.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/light.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('jquery-ui/themes/base/all.css') }}">
	<!-- custom css -->
	<link href="{{asset('css/app.css')}}" rel="stylesheet">
	
	<link href="{{asset('css/media_query.css') }}" rel="stylesheet" type="text/css">

	<!-- jquery script -->
    <script src="{{asset('js/theme/jquery-1.12.4.min.js')}}"></script>
   <script src="{{asset('jquery-ui/ui/widget.js')}}"></script>
	<script src="{{asset('jquery-ui/ui/widgets/mouse.js')}}"></script>
	<script src="{{asset('jquery-ui/ui/widgets/slider.js')}}"></script>
	<script src="{{asset('jquery-ui/ui/widgets/datepicker.js')}}"></script>
	
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>


<!-- Body starts
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<body data-spy="scroll" data-target="#navbar" data-offset="50">

<!-- Header starts
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<header id="my_header" class="">
		<nav class="custom_nav navbar submenu" data-spy="affix" data-offset-top="10">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-5 col-md-5 col-lg-5">
						<!-- Navigation bar on the right side 
						(not visible on extra-small devices) -->
						<?php 
						$Tree = new Devdewa\Injection\Tree();
						$nav1 = $Tree->drawMenu($menu[0]->children,0,0,2);
						$nav2 = $Tree->drawMenu($menu[0]->children,0,3);
						
						?>
						<div class="collapse navbar-collapse" id="navbar">
							<ul class="nav navbar-nav navbar-right hideFirst">
								<?php 
								if($nav1){
									print $nav1;
								}
								?>
							</ul>
							
						</div>
					</div>
					<div class="col-sm-2 col-md-2 col-lg-2">
						<div class="navbar-header align-center">
							<!-- button which is visible in extra-small devices -->
							<button type="button" class="custom_butt navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
								<span class="sr-only">Toggle Nagivaion</span>
								<span class="icon-bar bar1"></span>
								<span class="icon-bar bar2"></span>
								<span class="icon-bar bar3"></span>
							</button>
							<!-- Brand logo on the left side -->
							<a class="navbar-brand hideFirst" href="index.html">
								<img src="{{asset('images/brand_logo.png')}}" class="img-responsive" alt="brand logo">
							</a>
						</div>
						<!-- End of .navbar-header -->
					</div>
					<div class="col-sm-5 col-md-5 col-lg-5">
						<div class="collapse navbar-collapse" id="navbar2">
							<ul class="nav navbar-nav navbar-left hideFirst">
								<?php 
								if($nav1){
									print $nav2;
								}
								?>
							</ul>
						</div>
					</div>
				</div>
				
				
				
				
				
				<!-- End of #navbar -->
			</div>
			<!-- End of .container -->
		</nav>
		<!-- End fo nav -->
	</header>
	<!-- End of header -->

	@yield('content')
	
	
	<div class="loading"><img src="{{asset('images/animation.gif')}}"></div>
	
	<!--banner,Video Section Ends Here-->
	
	<!-- Footer starts
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<footer>
		<div class="footer_top">
			<div class="container">
				<div class="row">
					<div class="col-sm-3 col-md-3 col-lg-3">
						<h3 class="clearfix">
							<a class="navbar-brand" href="">
								<img src="{{asset('images/brand_logo.png')}}" class="img-responsive" alt="brand logo">
							</a>
						</h3>
						<p>A brand that defines luxury.</p>
					</div>
					<!-- End of .col-sm-3 -->

					<div class="col-sm-3 col-md-3 col-lg-3">
						<ul>
							<li><h3>Our Services</h3></li>
							<li><a href="#">Graphic Design</a></li>
							<li><a href="#">Web Design</a></li>
							<li><a href="#">Web Development</a></li>
							<li><a href="#">Ethical Hacking</a></li>
						</ul>
					</div>
					<!-- End of .col-sm-3 -->

					<div class="col-sm-3 col-md-3 col-lg-3">
						<ul>
							<li><h3>Quick Links</h3></li>
							<li><a href="#">Partners</a></li>
							<li><a href="#">About</a></li>
							<li><a href="#">FAQ’s</a></li>
							<li><a href="#">Badges</a></li>
						</ul>
					</div>
					<!-- End of .col-sm-3 -->

					<div class="col-sm-3 col-md-3 col-lg-3">
						<ul>
							<li><h3>Connect with us Socially</h3></li>
							<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i>Facebook</a></li>
							<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i>Twitter</a></li>
							<li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i>Youtube</a></li>
							<li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i>Pinterest</a></li>
						</ul>
					</div>
					<!-- End of .col-sm-3 -->

				</div>
				<!-- End of .row -->
			</div>
			<!-- End of .container -->
		</div>
		<!-- End of .footer_top -->

		<div class="footer_bottom clearfix">
			<div class="container">
				<p><span>Yuan Li.</span> -2018. ALL RIGHTS RESERVED.</p>
				<ul class="right list-inline">
					<li><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
					<li><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
					<li><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Google-plus"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
					<li><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
					<li><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
				</ul>
			</div>
			<!-- End of .container-fluid -->
		</div>
		<!-- End of .footer_top -->
	</footer>
	<!-- End of footer -->

<!-- Javascripts
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->

	<!-- common scripts -->
	<script src="{{asset('js/theme/bootstrap.min.js')}}"></script>
	<!-- parallax effect-->
	<script src="{{asset('js/theme/jquery.stellar.min.js')}}"></script>
	<!-- animation on scroll and click scripts -->
	<script src="{{asset('js/theme/wow.min.js')}}"></script>
	<!-- Smooth scroll scripts -->
	<script src="{{asset('js/theme/smooth-scroll.min.js')}}"></script>
	<!-- isotope script -->
	<script src="{{asset('js/theme/isotope.pkgd.min.js')}}"></script>
	<!-- Magnific Popup core JS file -->
	<script src="{{asset('js/theme/jquery.magnific-popup.min.js')}}"></script>
	<!-- owl carousel scripts -->
	<script src="{{asset('js/theme/owl.carousel.min.js')}}"></script>
	<!-- waypoints scripts -->
	<script src="{{asset('js/theme/jquery.waypoints.min.js')}}"></script>
	<!-- Counter_up scripts -->
	<script src="{{asset('js/theme/jquery.counterup.min.js')}}"></script>
	<!-- Video background -->
	<script src="{{asset('js/theme/jquery.mb.YTPlayer.min.js')}}"></script>
	<!-- Quform scripts -->
	<script type="text/javascript" src="{{asset('js/theme/plugins.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/theme/scripts.js')}}"></script>
	<!-- custom scripts -->
	<script src="{{asset('js/theme/main.js')}}"></script>
	</body>
</html>



