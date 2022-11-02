<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ __('VidClear Dashboard') }}</title>
	
    <x-admin.headerAssets />

    <!-- Nestable -->
    <script src="{{ asset('assets/js/jquery.nestable.min.js') }}"></script>

    <link type="text/css" href="{{ asset('assets/css/jquery.nestable.min.css') }}" rel="stylesheet">
    
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
                
               @livewire('admin.settings.menu')

            </div>

        <x-admin.footer />

    </main>

    <x-admin.footerAssets />

    @livewireScripts

    <script src="{{ asset('assets/js/choices.min.js') }}"></script>

</body>
</html>