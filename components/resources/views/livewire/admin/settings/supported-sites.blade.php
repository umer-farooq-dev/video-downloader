<div>

  <!-- Begin:Sites -->
    <div class="row">
        <div class="col-12">

            <button class="btn bg-gradient-info" data-bs-toggle="modal" data-bs-target="#addNewSite"><i class="fas fa-plus fa-fw"></i> {{ __('Add New Site') }}</button>

            <div class="card">
              <div class="card-body">
                  <table class="table align-items-center">
                      <tbody>
                          <tr>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Title') }}</th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Link') }}</th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Latest updates') }}</th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Action') }}</th>
                          </tr>

                            @if ( !empty($sites) )

                                @foreach ($sites as $site)
                                    <tr>
                                        <td class="align-middle">
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ ($site['image']) ? $site['image'] : asset('assets/img/no-thumb.jpg') }}" class="avatar avatar-sm me-3">
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <h6 class="mb-0 text-xs">{{ $site['title'] }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <input class="form-control" type="text" value="{{ url('/') . '/' . $site['link'] }}" readonly>
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $site['updated_at'] }}</span>
                                        </td>
                                        <td class="align-middle w-25 py-3">
                                            <a class="btn btn-sm btn-info mb-0" title="{{ __('Edit') }}" wire:click="onShowEditSiteModal( {{ $site['id'] }} )"><i class="fas fa-edit fa-fw"></i> {{ __('Edit') }}</a>
                                            <a class="btn btn-sm btn-danger mb-0" title="{{ __('Delete') }}" wire:click="onDeleteConfirmSite( {{ $site['id'] }} )"><i class="fas fa-trash fa-fw"></i> {{ __('Delete') }}</a>
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
            </div>

        </div>
    </div>
    <!-- End:Sites -->

    <!-- Begin::Add New Site -->
    <div class="modal fade" id="addNewSite" tabindex="-1" role="dialog" aria-labelledby="addNewSiteLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addNewSiteModalLabel">{{ __('Add New Site') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            @livewire('admin.settings.supported-sites.create')
          </div>

        </div>
      </div>
    </div>
    <!-- End::Add New Site -->

    <!-- Begin::Edit Site -->
    <div class="modal fade" id="editSite" tabindex="-1" role="dialog" aria-labelledby="editSiteLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editSiteModalLabel">{{ __('Edit Site') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            @livewire('admin.settings.supported-sites.edit')
          </div>

        </div>
      </div>
    </div>
    <!-- End::Edit Site -->

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
                window.livewire.emit('onDeleteSite', event.detail.id)
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