<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ __('VidClear Dashboard') }}</title>
	
	<x-admin.headerAssets />
	
	@livewireStyles

</head>
<body class="g-sidenav-show bg-gray-100">
	
	<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-white" id="sidenav-main">
		
		<x-admin.sidenav-header />

		<hr class="horizontal dark mt-0">

		<x-admin.sidebar />

	</aside>

	<main class="main-content mt-1 border-radius-lg">
		<!-- Navbar -->
		<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="false">
			<div class="container-fluid py-1 px-3">

				<x-admin.breadcrumbs />

				<x-admin.navright />

			</div>
		</nav>
		<!-- End Navbar -->

		<div class="container-fluid py-4">
			<div class="row">
				<div class="col">
					<div class="card">
						<div class="card-body">
							<p>{{ __('Thank you for purchasing our VidClear script. We have put in lots of love in developing this product and are excited that you have chosen this script for your website. We hope you find it easy to use our product.') }}</p>
							<a class="btn bg-gradient-success">{{ __('Download Now') }}</a>
							<a href="https://codecanyon.net/user/themeluxury" target="_blank" class="btn bg-gradient-primary">{{ __('Get Support') }}</a>

							<div class="changelog">
								<h5>{{ __('Changelog') }}</h5>
								<pre>
									{{ file_get_contents('./changelog.txt') }}
								</pre>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		
		<x-admin.footer />

	</main>

	<x-admin.footerAssets />

	@livewireScripts
</body>
</html>