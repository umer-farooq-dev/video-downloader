<div>

	<div class="card">
		<div class="card-body">

			<div class="table-responsive">
				<table class="table align-items-center mb-0">
					<tbody>
						<tr>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Link') }}</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Date') }}</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Action') }}</th>
						</tr>
						@if ( $reports->isEmpty() == false )

							@foreach ($reports as $report)

							<tr>
								<td class="align-middle">
									<p class="text-xs font-weight-bold mb-0 ">

										<div class="form-group">
											<a href="{{ $report->link }}" target="_blank" class="input-group">
												<input type="text" value="{{ $report->link }}" class="form-control cursor-pointer" readonly>
												<span class="input-group-text"><i class="fas fa-external-link-alt"></i></span>
											</a>
										</div>

									</p>
								</td>
								<td class="align-middle">
									<p class="text-xs font-weight-bold mb-0">{{ $report->created_at }}</p>
								</td>
								<td class="align-middle">
									<a wire:click="onDeleteConfirm( {{ $report->id }} )" class="btn btn-danger" title="Delete"><i class="fas fa-trash"></i></a>
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
				{{ $reports->links() }}
				<!-- begin:pagination -->
			</div>

		</div>
	</div>
	
</div>

<script>
(function( $ ) {
	"use strict";

	document.addEventListener('livewire:load', function () {
		
		window.addEventListener('swal:modal', event => {

			const swalWithBootstrapButtons = Swal.mixin({
			  customClass: {
				confirmButton: 'btn bg-gradient-success',
				cancelButton: 'btn bg-gradient-danger'
			  },
			  buttonsStyling: false
			})

		swalWithBootstrapButtons.fire({
			  title: event.detail.title,
			  text: event.detail.text,
			  icon: event.detail.type,
			  showCancelButton: true,
			  confirmButtonText: "{{ __('Yes, delete it!') }}",
			  cancelButtonText: "{{ __('Cancel') }}"
			}).then((result) => {
			  if (result.isConfirmed) {
				window.livewire.emit('onDeleteReport', event.detail.id)
			  }
			});

		});

		window.addEventListener('alert', event => {
			toastr[event.detail.type](event.detail.message);
		});

	});

})( jQuery );
</script>