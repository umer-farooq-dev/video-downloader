<div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
	<form wire:submit.prevent="onUpdateADS">

		<div class="row">
			<!-- Begin:Ads Area 1 -->
			<div class="col-12 col-lg-6 mb-4">
				<div class="card">
					<div class="card-body">

						<div class="form-group">

							<div class="d-flex">
								<label for="ads-area-1" class="form-label">{{ __('Ads Area 1') }} </label>

								<div class="form-check form-switch ps-3">
									<input class="form-check-input ms-auto" type="checkbox" wire:model="area1_status">
								</div>
							</div>

							<div class="col">
								<textarea class="form-control" id="ads-area-1" wire:model="area1" rows="5"></textarea>
							</div>

						</div>

						<div class="row">
							<div class="input-group">

								<div class="col-12 col-md-6 pe-md-4">
									<div class="input-group">
										<button class="btn btn-outline-secondary mb-0" type="button">{{ __('Align') }}</button>
										<select name="align" class="form-control ps-3" wire:model="area1_align">
											<option value="left">{{ __('Left') }}</option>
											<option value="right">{{ __('Right') }}</option>
											<option value="center">{{ __('Center') }}</option>
										</select>
									</div>
								</div>

								<div class="col-12 col-md-6">
									<div class="input-group">
										<button class="btn btn-outline-secondary mb-0" type="button">{{ __('Margin') }}</button>
										<input type="number" class="form-control ps-3" wire:model="area1_margin" value="10">
										<span class="input-group-text">{{ __('px') }}</span>
									</div>
								</div>

							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- End:Ads Area 1 -->

			<!-- Begin:Ads Area 2 -->
			<div class="col-12 col-lg-6">
				<div class="card">
					<div class="card-body">

						<div class="form-group">
							<div class="d-flex">
								<label for="ads-area-2" class="form-label">{{ __('Ads Area 2') }} </label>

								<div class="form-check form-switch ps-3">
									<input class="form-check-input ms-auto" type="checkbox" wire:model="area2_status">
								</div>
							</div>

							<div class="col">
								<textarea class="form-control" id="ads-area-2" rows="5" wire:model="area2"></textarea>
							</div>
						</div>

						<div class="row">
							<div class="input-group">

								<div class="col-12 col-md-6 pe-md-4">
									<div class="input-group">
										<button class="btn btn-outline-secondary mb-0" type="button">{{ __('Align') }}</button>
										<select name="align" class="form-control ps-3" wire:model="area2_align">
											<option value="left">{{ __('Left') }}</option>
											<option value="right">{{ __('Right') }}</option>
											<option value="center">{{ __('Center') }}</option>
										</select>
									</div>
								</div>

								<div class="col-12 col-md-6">
									<div class="input-group">
										<button class="btn btn-outline-secondary mb-0" type="button">{{ __('Margin') }}</button>
										<input type="number" class="form-control ps-3" value="10" wire:model="area2_margin">
										<span class="input-group-text">{{ __('px') }}</span>
									</div>
								</div>

							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- End:Ads Area 2 -->

			<!-- Begin:Ads Area 3 -->
			<div class="col-12 col-lg-6">
				<div class="card">
					<div class="card-body">

						<div class="form-group">
							<div class="d-flex">
								<label for="ads-area-3" class="form-label">{{ __('Ads Area 3') }} </label>

								<div class="form-check form-switch ps-3">
									<input class="form-check-input ms-auto" type="checkbox" wire:model="area3_status">
								</div>
							</div>

							<div class="col">
								<textarea class="form-control" id="ads-area-3" rows="5" wire:model="area3"></textarea>
							</div>
						</div>

						<div class="row">
							<div class="input-group">

								<div class="col-12 col-md-6 pe-md-4">
									<div class="input-group">
										<button class="btn btn-outline-secondary mb-0" type="button">{{ __('Align') }}</button>
										<select name="align" class="form-control ps-3" wire:model="area3_align">
											<option value="left">{{ __('Left') }}</option>
											<option value="right">{{ __('Right') }}</option>
											<option value="center">{{ __('Center') }}</option>
										</select>
									</div>
								</div>

								<div class="col-12 col-md-6">
									<div class="input-group">
										<button class="btn btn-outline-secondary mb-0" type="button">{{ __('Margin') }}</button>
										<input type="number" class="form-control ps-3" value="10" wire:model="area3_margin">
										<span class="input-group-text">{{ __('px') }}</span>
									</div>
								</div>

							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- End:Ads Area 3 -->

			<!-- Begin:Ads Area 4 -->
			<div class="col-12 col-lg-6">
				<div class="card">
					<div class="card-body">

						<div class="form-group">
							<div class="d-flex">
								<label for="ads-area-4" class="form-label">{{ __('Ads Area 4') }} </label>

								<div class="form-check form-switch ps-3">
									<input class="form-check-input ms-auto" type="checkbox" wire:model="area4_status">
								</div>
							</div>

							<div class="col">
								<textarea class="form-control" id="ads-area-4" rows="5" wire:model="area4"></textarea>
							</div>
						</div>

						<div class="row">
							<div class="input-group">

								<div class="col-12 col-md-6 pe-md-4">
									<div class="input-group">
										<button class="btn btn-outline-secondary mb-0" type="button">{{ __('Align') }}</button>
										<select name="align" class="form-control ps-3" wire:model="area4_align">
											<option value="left">{{ __('Left') }}</option>
											<option value="right">{{ __('Right') }}</option>
											<option value="center">{{ __('Center') }}</option>
										</select>
									</div>
								</div>

								<div class="col-12 col-md-6">
									<div class="input-group">
										<button class="btn btn-outline-secondary mb-0" type="button">{{ __('Margin') }}</button>
										<input type="number" class="form-control ps-3" value="10" wire:model="area4_margin">
										<span class="input-group-text">{{ __('px') }}</span>
									</div>
								</div>

							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- End:Ads Area 4 -->

			<div class="col-12 mt-3">
				<div class="card">
					<div class="card-body">
						<h6 class="badge bg-gradient-primary">{{ __('Enable or Disable Ads on the specified page') }}</h6>
						<table class="table">
							<tbody>
								<tr>
									<th>{{ __('Page Slug') }}</th>
									<th>{{ __('Page Type') }}</th>
									<th>{{ __('Status') }}</th>
								</tr>
								@foreach ($pages as $index => $page)
									<tr>
										<td class="align-middle py-3">{{ $page['slug'] }}</td>
										<td class="align-middle">{{ $page['type'] }}</td>
										<td class="align-middle">
											<div class="form-check form-switch ps-0">
												<input class="form-check-input ms-auto" type="checkbox" wire:model="pages.{{ $index }}.ads_status">
											</div>
										</td>
									</tr>
								@endforeach

							</tbody>
						</table>

					</div>
				</div>
			</div>

			<div class="form-group mt-4">
				<button class="btn bg-gradient-primary float-end">
					<span>
						<div wire:loading wire:target="onUpdateADS">
							<x-loading />
						</div>
						<span>{{ __('Save Changes') }}</span>
					</span>
				</button>
			</div>

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