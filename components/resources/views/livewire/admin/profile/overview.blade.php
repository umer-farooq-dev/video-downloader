<div class="card h-100 tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab" wire:ignore.self>
	<div class="card-header pb-0 p-3">
		<h6 class="mb-0">{{ __('Overview') }}</h6>
	</div>
	<div class="card-body p-3">

		<p class="text-sm">{{ $profile->bio }}</p>
		<hr class="horizontal gray-light my-4" />
		<ul class="list-group">
			<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">{{ __('Full Name') }}:</strong> {{ $profile->fullname }}</li>
			<li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">{{ __('Position') }}:</strong> {{ $profile->position }}</li>
			<li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">{{ __('Mobile') }}:</strong> {{ $profile->phone }}</li>
			<li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">{{ __('Email') }}:</strong> {{ $profile->email }}</li>
			<li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">{{ __('Address') }}:</strong> {{ $profile->address }}</li>

			@if ( $profile->social_status == true)
				@if ( $socials != null )

					<li class="list-group-item border-0 ps-0 pb-0">
						<strong class="text-dark text-sm">Social:</strong> &nbsp;
						@foreach ($socials as $social)
							<a class="btn btn-{{ $social['name'] }} btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
								<i class="fab fa-{{ $social['name'] }} fa-lg" aria-hidden="true"></i>
							</a>
						@endforeach
					</li>

				@endif
			@endif

		</ul>

	</div>
</div>
