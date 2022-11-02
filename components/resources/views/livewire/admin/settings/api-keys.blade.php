<div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
	<form wire:submit.prevent="onUpdateAPIKeys" class="row">

		<!-- Begin:reCAPTCHA v3 -->
		<div class="col-12 mb-4">
			<div class="card">
				<div class="card-body">
					<h6>{{ __('reCAPTCHA v3') }} (<a href="https://docs.themeluxury.com/vidclear/getting-started/how-to-get-google-recaptcha-v3-keys/" target="_blank" class="text-gradient text-primary">{{ __('How to get Google reCAPTCHA v3 Keys') }}</a>)</h6>
					<hr>
					<table class="table settings">
						<tr>
							<td class="align-middle"><label for="username" class="form-label">{{ __('Site Key') }}</label></td>
							<td class="align-middle">
								<input type="text" class="form-control" wire:model="recaptcha_public_api_key">
							</td>
						</tr>

						<tr>
							<td class="align-middle"><label for="password" class="form-label">{{ __('Secret Key') }}</label></td>
							<td class="align-middle">
								<input type="text" class="form-control" wire:model="recaptcha_private_api_key">
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<!-- End:reCAPTCHA v3 -->

		<!-- Begin:Twitter -->
{{-- 		<div class="col-12 mb-4">
			<div class="card">
				<div class="card-body">
					<h6>{{ __('Twitter') }} (<a href="https://docs.themeluxury.com/vidclear/getting-started/how-to-get-api-keys-and-access-tokens-for-twitter/" target="_blank" class="text-gradient text-primary">{{ __('How to get API Keys and Access Tokens for Twitter') }}</a>)</h6>
					<hr>
					<table class="table settings">
						<tr>
							<td class="align-middle"><label for="twitter_consumer_key" class="form-label">{{ __('Consumer Key (API Key)') }}</label></td>
							<td class="align-middle">
								<input type="text" class="form-control" wire:model="twitter_consumer_key">
							</td>
						</tr>

						<tr>
							<td class="align-middle"><label for="twitter_consumer_secret" class="form-label">{{ __('Consumer Secret (API Secret)') }}</label></td>
							<td class="align-middle">
								<input type="text" class="form-control" wire:model="twitter_consumer_secret">
							</td>
						</tr>

						<tr>
							<td class="align-middle"><label for="twitter_oauth_access_token" class="form-label">{{ __('OAuth Access Token') }}</label></td>
							<td class="align-middle">
								<input type="text" class="form-control" wire:model="twitter_oauth_access_token">
							</td>
						</tr>

						<tr>
							<td class="align-middle"><label for="twitter_oauth_access_token_secret" class="form-label">{{ __('OAuth Access Token Secret') }}</label></td>
							<td class="align-middle">
								<input type="text" class="form-control" wire:model="twitter_oauth_access_token_secret">
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div> --}}
		<!-- End:Twitter -->

		<!-- Begin:Facebook -->
		<div class="col-12 mb-4">
			<div class="card">
				<div class="card-body">
					<h6>{{ __('Facebook') }} (<a href="https://docs.themeluxury.com/vidclear/getting-started/how-to-get-facebook-cookies/" target="_blank" class="text-gradient text-primary">{{ __('How to get Facebook Cookies') }}</a>)</h6>
					<hr>
					<table class="table settings">
						<tr>
							<td class="align-middle"><label for="facebook_cookies" class="form-label">{{ __('Cookies') }}</label></td>
							<td class="align-middle">
								<textarea class="form-control" wire:model="facebook_cookies" rows="5"></textarea>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<!-- End:Facebook -->

		<!-- Begin:Instagram -->
		<div class="col-12 mb-4">
			<div class="card">
				<div class="card-body">
					<h6>{{ __('Instagram') }} (<a href="https://docs.themeluxury.com/vidclear/getting-started/how-to-get-instagram-cookies/" target="_blank" class="text-gradient text-primary">{{ __('How to get Instagram Cookies') }}</a>)</h6>
					<hr>
					<table class="table settings">
						<tr>
							<td class="align-middle"><label for="instagram_cookies" class="form-label">{{ __('Cookies') }}</label></td>
							<td class="align-middle">
								<textarea class="form-control" wire:model="instagram_cookies" rows="5"></textarea>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<!-- End:Instagram -->

		<div class="form-group">
			<button class="btn bg-gradient-primary float-end">
				<span>
					<div wire:loading wire:target="onUpdateAPIKeys">
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
