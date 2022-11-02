<div>

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

			      <div class="card card-body blur shadow-blur">
			        <div class="row gx-4">

			          @livewire('admin.profile.avatar')

			        </div>
			      </div>

			      <div class="row py-4">
			        <div class="col-12">

			        	<div class="tab-content">

			        		@livewire('admin.profile.overview')

			        		@livewire('admin.profile.update-profile')

			        		@livewire('admin.profile.change-password')

					    </div>

			        </div>
				  </div>


				</div>
			  </div>
			</div>
			
		<x-admin.footer />

	</main>

</div>

<script src="{{ asset('components/public/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script>
(function( $ ) {
	"use strict";
	
    document.addEventListener('livewire:load', function () {

		jQuery('.edit-avatar').filemanager('image', {prefix: '{{ url('/') }}/filemanager'});

		jQuery('input#avatar').change(function() { 
			window.livewire.emit('onSetAvatar', this.value)
		});

		window.addEventListener('alert', event => {
			toastr[event.detail.type](event.detail.message);
		});
	
    });

})( jQuery );
</script>