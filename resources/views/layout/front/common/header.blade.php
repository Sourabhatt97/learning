<div class="header-container header-color color">
	<div class="header_full">
		<div class="header">
			<div class="header-logo show-992">
				<a href="{{url('/')}}" class="logo"> <img class="img-responsive" src="{{url('resources/assets/admin/images/logo.jpg')}}" height="60" width = "90" alt="" /></a>
			</div><!--- .header-logo -->
			<div class="header-bottom">
				<div class="container">
					<div class="row">
						<div class="header-config-bg">
							<div class="header-wrapper-bottom">
								<div class="custom-menu col-lg-12">
									<div class="header-logo hidden-992">
										<a href="{{url('/')}}" class="logo"> <img class="img-responsive" src="{{url('resources/assets/admin/images/logo.jpg')}}" height="60" width = "90" alt="" /></a>
									</div><!--- .header-logo -->
									<div class="magicmenu clearfix">
										<ul class="nav-desktop sticker">
											<li class="level0 logo display"><a class="level-top" href="{{url('/')}}"><img alt="logo" src="{{url('resources/assets/admin/images/logo.jpg')}}" height="60" width = "90"></a></li>
											<li class="level0 home">
												<a class="level-top" href="{{url('/')}}"><span class="icon-home fa fa-home"></span><span class="icon-text">Home</span></a>
											</li>

											<li class="level0 home">
												<a class="level-top" href="{{url('/watches')}}"><span class="icon-home fa fa-home"></span><span class="icon-text">Watches</span></a>
											</li>
										</ul>
									</div><!--- .nav-mobile -->
								</div><!--- .custom-menu -->
							</div><!--- .header-wrapper-bottom -->
						</div><!--- .header-config-bg -->
					</div><!--- .row -->
				</div><!--- .container -->
			</div><!--- .header-bottom -->
			<div class="header-page clearfix">
				<div class="header-setting">
					<div class="settting-switcher">
						<div class="dropdown-toggle">
							<div class="icon-setting"><i class="icon-settings icons"></i></div>
						</div>
						<div class="dropdown-switcher">
							<div class="top-links-alo">
								<div class="header-top-link">
									<ul class="links">
										@if(auth::guest())
										<li><a href = "{{url('/register')}}">Register</a></li>
										<li><a href = "{{url('/login')}}">Login</a></li>
										@endif
										@if(!auth::guest())
										<li><a href="myprofile" title="My Account" >My Profile</a></li>
										<li><a href = "{{url('/myorders')}}">My Orders</a></li>

										<li class=" last" ><a href="{{ route('logout') }}" Logout onclick="event.preventDefault();
										document.getElementById('logout-form').submit();">
									{{ __('Logout') }}</a></li>


									<form id="logout-form" action="{{ route('logout') }}" method="POST">
										@csrf
									</form>
									@endif
								</ul>
							</div>
						</div><!--- .top-links-alo -->
					</div><!--- .dropdown-switcher -->
				</div><!--- .settting-switcher -->
			</div><!--- .header-setting -->	
			<div class="miniCartWrap">
				<div class="mini-maincart">
					<div class="cartSummary">
						<div class="crat-icon"> 
							<span class="icon-handbag icons" id="small_cart"></span>
							<p class="mt-cart-title">My Cart</p>
						</div>
						<div class="cart-header"> 
							<span class="zero">0 </span>
							<p class="cart-tolatl"> 
								<span class="toltal">Total:</span>
								<span><span class="price">0.00</span></span>
							</p>
						</div>
					</div><!--- .cartSummary -->
					<div class="mini-contentCart" style="display: none">
						<div class="block-content">
							<p class="mini_cart"></p>

						</div>
					</div>
				</div><!--- .mini-maincart -->
			</div><!--- .miniCartWrap -->		
			
		</div><!--- .header-page -->
	</div><!--- .header -->
</div><!--- .header_full -->
</div>