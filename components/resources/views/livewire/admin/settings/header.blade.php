<div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
	<form wire:submit.prevent="onUpdateHeader" wire:ignore>

		<div class="card">
			<div class="card-body">
				<table class="table settings">

						<tr>
							<td class="align-middle"><label for="logo" class="form-label">{{ __('Logo') }}</label></td>
							<td class="align-middle">
								<div class="input-group">
									<span class="input-group-btn">
										<a data-input="logo" class="btn btn-primary mb-0 logo">
											<i class="fa fa-picture-o"></i> {{ __('Choose') }}
										</a>
									</span>
									<input id="logo" class="form-control ps-2" type="text" wire:model="logo">
								</div>
							</td>
						</tr>

						<tr>
							<td class="align-middle"><label for="favicon" class="form-label">{{ __('Favicon') }}</label></td>
							<td class="align-middle">
								<div class="input-group">
									<span class="input-group-btn">
										<a data-input="favicon" class="btn btn-primary mb-0 favicon">
											<i class="fa fa-picture-o"></i> {{ __('Choose') }}
										</a>
									</span>
									<input id="favicon" class="form-control ps-2" type="text" wire:model="favicon">
								</div>
							</td>
						</tr>

						<tr>
							<td class="align-middle"><label for="sticky-header" class="form-label">{{ __('Sticky Header') }}</label></td>
							<td class="align-middle">
								<div class="form-check form-switch ps-0">
									<input id="sticky-header" class="form-check-input ms-auto" type="checkbox" wire:model="sticky_header">
								</div>
							</td>
						</tr>

				</table>
			</div>
		</div>

		<div class="form-group mt-4">
			<button class="btn bg-gradient-primary float-end">
				<span>
					<div wire:loading wire:target="onUpdateHeader">
						<x-loading />
					</div>
					<span>{{ __('Save Changes') }}</span>
				</span>
			</button>
		</div>

	</form>

</div>

<script src="{{ asset('components/public/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script>
(function( $ ) {
	"use strict";

    document.addEventListener('livewire:load', function () {

		jQuery('.logo, .favicon').filemanager('image', {prefix: '{{ url('/') }}/filemanager'});

		jQuery('input#logo').change(function() { 
			window.livewire.emit('onSetLogo', this.value)
		});

		jQuery('input#favicon').change(function() { 
			window.livewire.emit('onSetFavicon', this.value)
		});

		window.addEventListener('alert', event => {
			toastr[event.detail.type](event.detail.message);
		});
	
    });

})( jQuery );
</script>