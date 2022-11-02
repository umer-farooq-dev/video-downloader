<div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
	<form wire:submit.prevent="onUpdateSMTP" wire:ignore>
	
		<div class="card">
			<div class="card-body">
				<h6>{{ __('SMTP Configuration Settings') }}</h6>
				<hr>
				<table class="table settings">
					<tr>
						<td><label for="host" class="form-label">{{ __('Host') }}</label></td>
						<td>
							<input id="host" class="form-control ms-auto" type="text" wire:model="host" placeholder="smtp.gmail.com">
							<small>{{ __('Your mail server.') }}</small>
						</td>
					</tr>

					<tr>
						<td><label for="port" class="form-label">{{ __('Port') }}</label></td>
						<td>
							<input id="port" class="form-control ms-auto" type="text" wire:model="port" placeholder="587">
							<small>{{ __('The port to your mail server.') }}</small>
						</td>
					</tr>

					<tr>
						<td><label for="username" class="form-label">{{ __('Username') }}</label></td>
						<td>
							<input id="username" class="form-control ms-auto" type="text" wire:model="username" placeholder="themeluxury@gmail.com">
							<small>{{ __('The username to login to your mail server.') }}</small>
						</td>
					</tr>

					<tr>
						<td><label for="password" class="form-label">{{ __('Password') }}</label></td>
						<td>
							<input id="password" class="form-control ms-auto" type="password" wire:model="password" placeholder="hpnsegxygohzob">
							<small>{{ __('The password to login to your mail server.') }}</small>
						</td>
					</tr>

					<tr>
						<td><label for="encryption" class="form-label">{{ __('Encryption') }}</label></td>
						<td>
							<input id="encryption" class="form-control ms-auto" type="text" wire:model="encryption" placeholder="tls">
							<small>{{ __('For most servers') }} <code>ssl</code> or <code>tls</code> {{ __(' is the recommended option.') }}</small>
						</td>
					</tr>

				</table>			

			</div>
		</div>

		<div class="form-group mt-4">
			<button class="btn bg-gradient-primary float-end">
				<span>
					<div wire:loading wire:target="onUpdateSMTP">
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