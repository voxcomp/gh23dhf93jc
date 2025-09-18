<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"><!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title><!-- Styles -->
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

	@yield('head')
</head>

<body{{ (isset($classes))?' class='.$classes:'' }}>
    <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
        {{ csrf_field() }}
    </form>

	<div class="header">
		<div class="container-fluid">
		    <div class="row">
		        <div class="col-md-3 d-none d-md-block menu-button">
		        </div>
		        <div class="col-md-6 col-sm-9 rtecenter"> 
				    <div class='site-logo'>
				        <a href='/' title='{{ config('app.name', 'Laravel') }}' rel='home'><img class="img-fluid" src='/images/logo.png' alt='{{ config('app.name', 'Laravel') }}'></a>
				    </div>
		        </div>
		        <div class="col-sm-3 rtecenter padding-top-15">
			        <div style="margin-bottom:4px;">
	                    @auth
	                    @else
<!-- 	                        <a href="{{ route('login') }}">Login</a> -->
	
	                        {{-- @if (Route::has('register'))
<!-- 	                            <a href="{{ route('register') }}">Register</a> -->
	                        @endif --}}
	                    @endauth
			        </div>
			        <div style="margin-bottom:4px;">
				        608-215-5939
			        </div>
<!--
					<div class="social-icons">
						<ul>
							<li><a href="https://www.flickr.com/photos/brancelcharters/" target="_blank"><span class="social-circle"><i class="fas fa-flickr"></i></span></a></li>
							<li><a href="https://www.facebook.com/Brancel-Charters-159089050783151" target="_blank"><span class="social-circle"><i class="fas fa-facebook"></i></span></a></li>
							<li><a href="https://www.instagram.com/brancelcharters/" target="_blank"><span class="social-circle"><i class="fas fa-instagram"></i></span></a></li>
						</ul>
					</div>
-->
		        </div>
		    </div>
		</div>
	</div>
	
	<div class="page-title-banner">
		<div class="page-title-overlay"></div>
		<div class="page-title-content container">
			<h1>@yield('title')</h1>
		</div>
	</div>
	
	<div class="container">
		<div class="row dmbs-content">
				@if(View::hasSection('rightsidebar'))
				    <div class="col-sm-8 dmbs-main">
				@else
				    <div class="col-sm dmbs-main">
				@endif

				@yield('content')

				@if(View::hasSection('rightsidebar'))
				    </div>
			      <aside class="col-sm-4" id="right-sidebar" role="complementary">
			        @yield('rightsidebar')
			      </aside>
			    @else
				    </div>
				@endif
		    </div>
		</div>
	</div> <!-- end main content container -->
	
    @if(View::hasSection('panel'))
		<div class="page-panel">
			@yield('panel')
		</div>
	@endif
	
	<div class="footer">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm order-sm-12 rteright mobile-centered">
					<nav role="navigation">
				        <div class="menu-footer-container">
					        <ul id="menu-footer" class="nav">
						        <li id="menu-item-298" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-298"><a title="Contact Us" href="/contact-us/">Contact Us</a></li>
								<li id="menu-item-405" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-405"><a title="Privacy Policy" href="/privacy-policy/">Privacy Policy</a></li>
								<li id="menu-item-406" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-406"><a title="Sitemap" href="/sitemap/">Sitemap</a></li>
							</ul>
						</div>
					</nav>
				</div>
				<div class="col-sm order-sm-1 mobile-centered">
					© {{date('Y')}} Brancel Bicycle Charters. &nbsp;All Rights Reserved.<br>
					608-215-5939 | P.O. Box 393 | Waunakee, WI 53597 | <a href="/contact-us">email us</a>
				</div>
			</div>
		</div>
	</div>

	<div id="dialog-confirm"></div>

    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/theme.js') }}" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	@yield('footer')

</body>
</html>