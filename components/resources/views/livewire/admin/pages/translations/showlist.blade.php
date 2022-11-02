<div>

        <!-- begin:Add new page translations -->
        <div class="dropdown d-flex">
          <a class="btn bg-gradient-info dropdown-toggle " data-bs-toggle="dropdown" id="navbarDropdownMenuLang">
             {{ __('Add New Translations') }}
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLang">
             @foreach(localization()->getSupportedLocales() as $localeCode => $properties)
                  <li>
                      <a class="dropdown-item" href="{{ localization()->getLocalizedURL($properties->key(), route('create-page-translations', $page_id), [], true) }}">
                        <img src="{{ asset('assets/img/flags/' . $properties->key() . '.svg') }}" class="lang-menu me-1 my-auto"> {{ $properties->native() }}
                      </a>
                  </li>
              @endforeach
          </ul>
        </div>
        <!-- begin:Add new page translations -->

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
                    <table class="table align-items-center mb-0">
                        <tbody>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Title') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Language') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Action') }}</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                            @if ( $page_translations->isNotEmpty() )

                                @foreach ($page_translations as $page_translation)

                                    <tr>
                                        <td class="align-middle">
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex align-items-center">
                                                    <h6 class="mb-0 text-xs">{{ $page_translation->title }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <img src="{{ asset('assets/img/flags/' . $page_translation->locale . '.svg') }}" class="lang-menu mx-auto"> 
                                        </td>
                                        <td class="align-middle w-25">
                                            <a href="{{ localization()->getLocalizedURL($page_translation->locale, route('home') . '/' . $slug, [], true) }}" class="btn btn-sm btn-info" title="{{ __('View') }}" target="_blank"><i class="fas fa-eye fa-fw"></i> {{ __('View') }}</a>
                                            <a href="{{ localization()->getLocalizedURL($page_translation->locale, route('edit-page-translations', $page_translation->id), [], true) }}" class="btn btn-sm btn-primary" title="{{ __('Edit') }}"><i class="fas fa-edit"></i> {{ __('Edit') }}</a>
                                            <a wire:click="onDeleteConfirmPageTranslation( {{ $page_translation->id }} )" class="btn btn-sm btn-danger" title="{{ __('Delete') }}"><i class="fas fa-trash fa-fw"></i> {{ __('Delete') }}</a>
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
					{{ $page_translations->links() }}
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
				window.livewire.emit('onDeletePageTranslation', event.detail.id)
			  }
			});

		});

		window.addEventListener('alert', event => {
			toastr[event.detail.type](event.detail.message);
		});
	});

})( jQuery );
</script>