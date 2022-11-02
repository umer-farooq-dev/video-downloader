<div>

	<div class="card">
		<div class="card-body">

			<div class="table-responsive">
				<table class="table align-items-center mb-0">
					<tbody>
						<tr>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Source') }}</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Thumbnail') }}</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Link') }}</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Date') }}</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Client IP') }}</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Country') }}</th>
						</tr>

						@if ( $downloads->isEmpty() == false )

						@foreach ($downloads as $download)

						<tr>
							<td class="align-middle">
								<p class="text-xs font-weight-bold mb-0">{{ $download->source }}</p>
							</td>
							<td class="align-middle">
								<p class="text-xs font-weight-bold mb-0">
									<img src="{{ $download->thumbnail }}" alt="thumbnail" class="avatar avatar-xl border-radius-lg shadow">
								</p>
							</td>
							<td class="align-middle">
								<p class="text-xs font-weight-bold mb-0">

									<div class="form-group">
										<a href="{{ $download->link }}" target="_blank" class="input-group">
											<input type="text" value="{{ $download->link }}" class="form-control cursor-pointer" readonly>
											<span class="input-group-text"><i class="fas fa-external-link-alt"></i></span>
										</a>
									</div>

								</p>
							</td>
							<td class="align-middle">
								<p class="text-xs font-weight-bold mb-0">{{ $download->created_at }}</p>
							</td>
							<td class="align-middle">
								<p class="text-xs font-weight-bold mb-0">{{ $download->client_ip }}</p>
							</td>
							<td class="align-middle">
								<p class="text-xs font-weight-bold mb-0">{{ __('None') }}</p>
							</td>
						</tr>

						@endforeach

						@else

						<tr>
							<td class="align-middle">{{ __('No record found') }}</td>
						</tr>

						@endif

					</tbody>
				</table>
			</div>

			<div class="float-end">
				<!-- begin:pagination -->
				{{ $downloads->links() }}
				<!-- begin:pagination -->
			</div>	

		</div>
	</div>
	
</div>
