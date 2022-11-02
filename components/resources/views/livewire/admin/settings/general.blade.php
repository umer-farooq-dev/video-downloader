<div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
	@php

		$google_fonts = json_decode($google_fonts, true);

		$timezones = json_decode($timezones, true);

	@endphp

	<form wire:submit.prevent="onUpdateGeneral">
		<div class="row">
			<div class="col-12 mb-3">
				<div class="card">
					<div class="card-body">
						<table class="table settings">

							<tr>
								<td class="align-middle"><label for="wave-animation-status" class="form-label">{{ __('Enable Wave Animation') }}</label></td>
								<td class="w-75">
									<div class="form-switch ps-0">
										<input id="wave-animation-status" class="form-check-input ms-auto" type="checkbox" wire:model="wave_animation_status">
									</div>
								</td>
							</tr>

							<tr>
								<td class="align-middle"><label for="parallax-image" class="form-label">{{ __('Parallax Image') }}</label></td>
								<td class="align-middle">
									<div class="input-group">
										<span class="input-group-btn">
											<a id="parallax-image" data-input="parallax-thumbnail" data-preview="parallax-preview" class="btn btn-primary mb-0 parallax-image">
												<i class="fa fa-picture-o"></i> {{ __('Choose') }}
											</a>
										</span>
										<input id="parallax-thumbnail" class="form-control ps-2" type="text" wire:model="parallax_image">
									</div>

									<div class="screenshot w-10 my-2">
										<div class="img-fluid shadow border-radius-xl overlay-preview" style="
											@if ( $overlay_type == 'solid' )

											background: {{ $solid_color }};opacity: {{ $opacity }};

											@elseif( $overlay_type == 'gradient' )

											background: {{ $gradient_first_color }};
											background: -moz-linear-gradient( {{ $gradient_position }}, {{ $gradient_first_color }}, {{ $gradient_second_color }}  );
											background: -webkit-linear-gradient( {{ $gradient_position }}, {{ $gradient_first_color }}, {{ $gradient_second_color }} );
											background: linear-gradient( {{ $gradient_position }}, {{ $gradient_first_color }}, {{ $gradient_second_color }} );
											opacity: {{ $opacity }};

											@endif

										"></div>
										<img class="img-fluid shadow border-radius-xl parallax-preview" src="{{ $parallax_image }}" style="filter: blur({{ $blur }}px);">
									</div>

								</td>
							</tr>

							<tr>
								<td class="align-middle"><label for="social" class="form-label">{{ __('Overlay Type') }}</label></td>
								<td class="align-middle">
									<select class="form-control" wire:model="overlay_type">
										<option value="solid">{{ __('Solid') }}</option>
										<option value="gradient">{{ __('Gradient') }}</option>
									</select>
								</td>
							</tr>

							@if ( $overlay_type == 'solid' )

								<tr>
									<td class="align-middle"><label for="color_picker" class="form-label">{{ __('Choose Solid Color') }}</label></td>
									<td class="align-middle"><input class="form-control form-control-color" id="color_picker" wire:model="solid_color" type="color"></td>
								</tr>

							@elseif( $overlay_type == 'gradient' )

								<tr>
									<td class="align-middle"><label for="ads-area-1" class="form-label">{{ __('Choose Gradient Color') }}</label></td>
									<td class="align-middle">
										<table class="table">
											<tr>
												<td class="align-middle"><input class="form-control form-control-color" wire:model="gradient_first_color" type="color"></td>
												<td class="align-middle"><input class="form-control form-control-color" wire:model="gradient_second_color" type="color"></td>
												<td class="align-middle">
													<select class="form-control" wire:model="gradient_position">
														<option value="to top" selected="selected">{{ __('To Top') }}</option>
														<option value="to right">{{ __('To Right') }}</option>
														<option value="to bottom">{{ __('To Bottom') }}</option>
														<option value="to left">{{ __('To Left') }}</option>
													</select>
												</td>
											</tr>
										</table>
									</td>
								</tr>

							@endif

							<tr>
								<td class="align-middle"><label for="opacity" class="form-label">{{ __('Opacity') }}</label></td>
								<td class="align-middle">
									<div class="w-100">
										<input id="opacity" class="form-range overlay-opacity" wire:model="opacity" type="range" min="0" max="1" step="0.1" value="0.2">
										<small class="font-weight-normal d-block">{{ __('Opacity') }}: <span>{{ $opacity }}</span>{{ __('px') }}</small>
									</div>
								</td>
							</tr>

							<tr>
								<td class="align-middle"><label for="blur" class="form-label">{{ __('Blur') }}</label></td>
								<td class="align-middle">
									<div class="w-100">
										<input id="blur" class="form-range background-blur" type="range" wire:model="blur" min="0.0" max="10" step="0.5" value="1.5">
										<small class="font-weight-normal d-block">{{ __('Blur') }}: <span>{{ $blur }}</span>{{ __('px') }}</small>
									</div>
								</td>
							</tr>

						</table>

					</div>
				</div>
			</div>

			<div class="col-12">
				<div class="card">
					<div class="card-body">

							<table class="table settings">
								<tr>
									<td scope="row"><label for="maintenance_mode" class="form-label">{{ __('Enable Maintenance Mode') }}</label></td>
									<td class="w-75">
										<div class="form-check form-switch ps-0">
											<input id="maintenance_mode" class="form-check-input ms-auto" type="checkbox" wire:model="maintenance_mode">
										</div>
									</td>
								</tr>

								<tr>
									<td scope="row"><label for="automatic_language_detection" class="form-label">{{ __('Enable Automatic Language Detection') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch ps-0">
											<input id="automatic_language_detection" class="form-check-input ms-auto" type="checkbox" wire:model="automatic_language_detection">
										</div>
									</td>
								</tr>

								<tr>
									<td scope="row"><label for="recaptcha_v3" class="form-label">{{ __('Enable reCAPTCHA v3') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch ps-0">
											<input id="recaptcha_v3" class="form-check-input ms-auto" type="checkbox" wire:model="recaptcha_v3">
										</div>
									</td>
								</tr>

								<tr>
									<td scope="row"><label for="language_switcher" class="form-label">{{ __('Enable Language Switcher') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch ps-0">
											<input id="language_switcher" class="form-check-input ms-auto" type="checkbox" wire:model="language_switcher">
										</div>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="page-load" class="form-label">{{ __('Enable Page Load') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch ps-0">
											<input id="page-load" class="form-check-input ms-auto" type="checkbox" wire:model="page_load">
										</div>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="share-icons-status" class="form-label">{{ __('Enable Share Icons') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch ps-0">
											<input id="share-icons-status" class="form-check-input ms-auto" type="checkbox" wire:model="share_icons_status">
										</div>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="supported-sites" class="form-label">{{ __('Enable Supported Sites') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch ps-0">
											<input id="supported-sites" class="form-check-input ms-auto" type="checkbox" wire:model="supported_sites">
										</div>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="author-box-status" class="form-label">{{ __('Enable Author Box') }}</label></td>
									<td class="align-middle">
										<div class="form-check form-switch ps-0">
											<input id="author-box-status" class="form-check-input ms-auto" type="checkbox" wire:model="author_box_status">
										</div>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="prefix" class="form-label">{{ __('Prefix for Download Files') }}</label></td>
									<td class="align-middle"><input id="prefix" type="text" class="form-control" wire:model="prefix"></td>
								</tr>

								<tr>
									<td class="align-middle"><label for="timezone" class="form-label">{{ __('Timezone') }}</label></td>
									<td wire:ignore>
										<select id="timezone" class="form-control" wire:model="timezone">
											@foreach ($timezones as $key => $value)
												<optgroup label="{{ $value['group'] }}">

													@foreach ($value['zones'] as $key2 => $value2)
														<option value="{{ $value2['value'] }}">{{ $value2['value'] }}</option>
													@endforeach

												</optgroup>
											@endforeach
										</select>
									</td>
								</tr>

								<tr>
									<td class="align-middle"><label for="font_family" class="form-label">{{ __('Font Family') }}</label></td>
									<td wire:ignore>
										<select id="font_family" class="form-control" wire:model="font_family">
											<optgroup label="{{ __('Google Fonts') }}">
												@foreach ($google_fonts as $key => $value)

													<option value="{{ $key }}">{{ $key }}</option>

												@endforeach

											</optgroup>
										</select>
									</td>
								</tr>

								<tr>
									<td colspan="2">

										<div class="d-flex">

											<label for="social" class="form-label">{{ __('Social Media') }}</label>

											<div class="form-check form-switch">
												<input class="form-check-input ms-auto" type="checkbox" wire:model="social_status">
											</div>
										
										</div>

										@foreach ($socials as $index => $social)
										
											<div class="row">
												<div class="col-md-5">
													<div class="form-group">
														<select class="form-control" wire:model="socials.{{ $index }}.name">
															<option value="facebook">{{ __('Facebook') }}</option>
															<option value="twitter">{{ __('Twitter') }}</option>
															<option value="instagram">{{ __('Instagram') }}</option>
															<option value="youtube">{{ __('Youtube') }}</option>
															<option value="linkedin">{{ __('Linkedin') }}</option>
															<option value="skype">{{ __('Skype') }}</option>
															<option value="github">{{ __('Github') }}</option>
															<option value="behance">{{ __('Behance') }}</option>
															<option value="dribbble">{{ __('Dribble') }}</option>
															<option value="flickr">{{ __('Flickr') }}</option>
															<option value="pinterest">{{ __('Pinterest') }}</option>
															<option value="tumblr">{{ __('Tumblr') }}</option>
															<option value="vimeo">{{ __('Vimeo') }}</option>
															<option value="vk">{{ __('VK') }}</option>
															<option value="telegram">{{ __('Telegram') }}</option>
															<option value="reddit">{{ __('Reddit') }}</option>
															<option value="whatsapp">{{ __('WhatsApp') }}</option>
														</select>
														@error( 'socials.' . $index . '.name' ) <span class="error">{{ $message }}</span> @enderror
													</div>
												</div>
												<div class="col-md-5">
													<div class="form-group">
														<input type="text" class="form-control" placeholder="URL" wire:model="socials.{{ $index }}.url">
														@error( 'socials.' . $index . '.url' ) <span class="error">{{ $message }}</span> @enderror
													</div>
												</div>

												@if ( $index == 0 )

													<div class="col-md-2">
														<button class="btn text-white btn-info w-100" wire:click.prevent="addSocial( {{ $i }} )">{{ __('Add new') }}</button>
													</div>

												@else
													<div class="col-md-2">
														<button class="btn btn-danger w-100" wire:click.prevent="onDeleteSocial({{ $social['id'] }})">{{ __('Remove') }}</button>
													</div>
												@endif

											</div>
										@endforeach

										@foreach($inputs as $key => $value)
											<div class="row">
												<div class="col-md-5">
													<div class="form-group">
														<select wire:model="name.{{ $value }}" class="form-control">
															<option value selected style="display:none;">{{ __('Choose a social...') }}</option>
															<option value="facebook">{{ __('Facebook') }}</option>
															<option value="twitter">{{ __('Twitter') }}</option>
															<option value="instagram">{{ __('Instagram') }}</option>
															<option value="youtube">{{ __('Youtube') }}</option>
															<option value="linkedin">{{ __('Linkedin') }}</option>
															<option value="skype">{{ __('Skype') }}</option>
															<option value="github">{{ __('Github') }}</option>
															<option value="behance">{{ __('Behance') }}</option>
															<option value="dribbble">{{ __('Dribble') }}</option>
															<option value="flickr">{{ __('Flickr') }}</option>
															<option value="pinterest">{{ __('Pinterest') }}</option>
															<option value="tumblr">{{ __('Tumblr') }}</option>
															<option value="vimeo">{{ __('Vimeo') }}</option>
															<option value="vk">{{ __('VK') }}</option>
															<option value="telegram">{{ __('Telegram') }}</option>
															<option value="reddit">{{ __('Reddit') }}</option>
															<option value="whatsapp">{{ __('WhatsApp') }}</option>
														</select>
														@error( 'name.' . $value ) <span class="error">{{ $message }}</span> @enderror
													</div>
												</div>
												<div class="col-md-5">
													<div class="form-group">
														<input type="text" class="form-control" placeholder="URL" wire:model="url.{{ $value }}">
														@error( 'url.' . $value ) <span class="error">{{ $message }}</span> @enderror
													</div>
												</div>
												<div class="col-md-2">
													<button class="btn btn-danger w-100" wire:click.prevent="removeSocial({{ $key }})">{{ __('Remove') }}</button>
												</div>
											</div>
										@endforeach
									</td>
								</tr>
							</table>
					</div>
				</div>
			</div>

			<div class="form-group mt-4">
				<button class="btn bg-gradient-primary float-end">
					<span>
						<div wire:loading wire:target="onUpdateGeneral">
							<x-loading />
						</div>
						<span>{{ __('Save Changes') }}</span>
					</span>
				</button>
			</div>

		</div>
	</form>

<div>

<script src="{{ asset('components/public/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script>
(function( $ ) {
	"use strict";

    document.addEventListener('livewire:load', function () {

        const timezone = new Choices( document.querySelector('#timezone') );
        const font_family = new Choices( document.querySelector('#font_family') );

        jQuery('#timezone').on('change', function (e) {
        	var time_data = jQuery(this).find(":selected").val();
        	@this.set('timezone', time_data);
        });

        jQuery('#font_family').on('change', function (e) {
        	var font_data = jQuery(this).find(":selected").val();
        	@this.set('font_family', font_data);
        });

		jQuery('.parallax-image').filemanager('image', {prefix: '{{ url('/') }}/filemanager'});

		jQuery('input#parallax-thumbnail').change(function() { 
			window.livewire.emit('onSetParallaxImage', this.value)
		});

		window.addEventListener('alert', event => {
			toastr[event.detail.type](event.detail.message);
		});

    });

})( jQuery );
</script>