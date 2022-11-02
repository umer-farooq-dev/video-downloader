<div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
	<form wire:submit.prevent="onUpdate">

		<!-- Begin:Insert Header -->
		<div class="col-12 mb-4">
			<div class="card">
				<div class="card-body">

					<div class="form-group">

						<div class="d-flex">
							<label for="insert-header" class="form-label">{{ __('Insert Header') }} </label>

							<div class="form-check form-switch ps-3">
								<input class="form-check-input ms-auto" type="checkbox" wire:model="header_status" checked>
							</div>
						</div>

						<div class="col">
							<textarea class="form-control" id="insert-header" wire:model="insert_header" rows="8"></textarea>
						</div>
					</div>
					<small>{{ __('Add custom scripts inside HEAD tag. You need to have') }} <code class="font-weight-bold">{{ __('SCRIPT') }}</code> {{ __('or') }} <code class="font-weight-bold">{{ __('STYLE') }}</code> {{ __('tag around scripts.') }}</small>

				</div>
			</div>
		</div>
		<!-- End:Insert Header -->

		<!-- Begin:Insert Footer -->
		<div class="col-12">
			<div class="card">
				<div class="card-body">

					<div class="form-group">
						
						<div class="d-flex">
							<label for="insert_footer" class="form-label">{{ __('Insert Footer') }} </label>

							<div class="form-check form-switch ps-3">
								<input class="form-check-input ms-auto" type="checkbox" wire:model="footer_status" checked>
							</div>
						</div>

						<div class="col">
							<textarea class="form-control" id="insert_footer" wire:model="insert_footer" rows="8"></textarea>
						</div>
					</div>
					<small>{{ __('Add custom scripts you might want to be loaded in the footer of your website. You need to have') }} <code class="font-weight-bold">{{ __('SCRIPT') }}</code> {{ __('or') }} <code class="font-weight-bold">{{ __('STYLE') }}</code> {{ __('tag around scripts.') }}</small>

				</div>
			</div>
		</div>
		<!-- End:Insert Footer -->

		<div class="form-group mt-4">
			<button class="btn bg-gradient-primary float-end">
				<span>
					<div wire:loading wire:target="onUpdate">
						<x-loading />
					</div>
					<span>{{ __('Save Changes') }}</span>
				</span>
			</button>
		</div>

	</form>
	
</div>

<script>
(function( $ ) {
	"use strict";

	document.addEventListener('livewire:load', function () {
		
		window.addEventListener('alert', event => {
			toastr[event.detail.type](event.detail.message);
		});
		
	});

})( jQuery );
</script>