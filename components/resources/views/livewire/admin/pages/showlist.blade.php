<div>

		<button class="btn bg-gradient-info" data-bs-toggle="modal" data-bs-target="#addNewPage"><i class="fas fa-plus fa-fw"></i> {{ __('Add New Page') }}</button>

		<!-- begin:Form Search -->
		<form id="formSearchPage">
			<div class="input-group mb-3">
				<input type="text" class="form-control form-control-lg" wire:model="searchQuery" placeholder="{{ __('Search with title...') }}">
			</div>
		</form>
		<!-- end:Form Search -->

		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table align-items-center">
						<tbody>
							<tr>
								<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Slug') }}</th>
								<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Page Type') }}</th>
								<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Latest updates') }}</th>
								<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Default Language') }}</th>
								<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Translation Progress') }}</th>
								<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Action') }}</th>
							</tr>

							@if ( $pages->isNotEmpty() )

								@foreach ($pages as $page)

									<tr>
										<td class="align-middle">
											<div class="d-flex px-2 py-1">
												<div>
													<img src="{{ ($page->featured_image) ? $page->featured_image : asset('assets/img/no-thumb.jpg') }}" class="avatar avatar-sm me-3">
												</div>
												<div class="d-flex align-items-center">
													<h6 class="mb-0 text-xs">{{ $page->slug }}</h6>
												</div>
											</div>
										</td>
										<td class="align-middle">
											<p class="text-xs font-weight-bold mb-0">{{ $page->type }}</p>
										</td>
										<td class="align-middle">
											<span class="text-secondary text-xs font-weight-bold">{{ $page->updated_at }}</span>
										</td>
										<td class="align-middle">
											<img src="{{ asset('assets/img/flags/' . $default_lang . '.svg') }}" class="lang-menu mx-auto"> 
										</td>

										<td class="align-middle">

											@foreach ($translation_progress as $value)

												@if ($value['page_id'] == $page->id)

													@if ($value['progress'] == $total_lang)
														<span class="badge bg-gradient-success">{{ $value['progress'] }}/{{ $total_lang }}</span>
													@else
														<span class="badge bg-gradient-secondary">{{ $value['progress'] }}/{{ $total_lang }}</span>
													@endif
													
												@endif
											@endforeach
											
										</td>
										<td class="align-middle w-25">
											<a href="{{ route('page-translations', $page->id ) }}" class="btn btn-sm btn-primary mb-0" title="{{ __('Translations') }}"><i class="fas fa-language fa-fw"></i> Translations</a>
											<a wire:click="onShowEditPageModal( {{ $page->id }} )" class="btn btn-sm btn-info mb-0" title="{{ __('Edit') }}"><i class="fas fa-edit fa-fw"></i> {{ __('Edit') }}</a>
											<a wire:click="onDeleteConfirmPage( {{ $page->id }} )" class="btn btn-sm btn-danger mb-0" title="{{ __('Delete') }}"><i class="fas fa-trash fa-fw"></i> {{ __('Delete') }}</a>
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
					{{ $pages->links() }}
					<!-- begin:pagination -->
				</div>
				
			</div>
		</div>

	    <!-- Begin::Add New Page -->
	    <div class="modal fade" id="addNewPage" tabindex="-1" role="dialog" aria-labelledby="addNewPageLabel" aria-hidden="true">
	      <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	          <div class="modal-header">
	            <h5 class="modal-title" id="addNewPageModalLabel">{{ __('Add New Page') }}</h5>
	            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>

	          <div class="modal-body">
	            @livewire('admin.pages.create')
	          </div>

	        </div>
	      </div>
	    </div>
	    <!-- End::Add New Page -->

	    <!-- Begin::Edit Page -->
	    <div class="modal fade" id="editPage" tabindex="-1" role="dialog" aria-labelledby="editPageLabel" aria-hidden="true">
	      <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	          <div class="modal-header">
	            <h5 class="modal-title" id="editPageModalLabel">{{ __('Edit Page') }}</h5>
	            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>

	          <div class="modal-body">
	            @livewire('admin.pages.edit')
	          </div>

	        </div>
	      </div>
	    </div>
	    <!-- End::Edit Page -->

</div>

<script src="{{ asset('components/public/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
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
			    window.livewire.emit('onDeletePage', event.detail.id)
			  }
			});
	
		});

		window.addEventListener('closeModal', event => {
			$('#' + event.detail.id).modal('hide');
		});

		window.addEventListener('showModal', event => {
			$('#' + event.detail.id).modal('show');
		});
			
		window.addEventListener('alert', event => {
			toastr[event.detail.type](event.detail.message);
		});

	});

})( jQuery );
</script>