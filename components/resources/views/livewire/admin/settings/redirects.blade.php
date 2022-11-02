<div>

  <!-- Begin:Redirects -->
    <div class="row">
        <div class="col-12">

            <button class="btn bg-gradient-info" data-bs-toggle="modal" data-bs-target="#addNewRedirect"><i class="fas fa-plus fa-fw"></i> {{ __('Add New Redirect') }}</button>

            <div class="card">
              <div class="card-body">
                  <table class="table align-items-center">
                      <tbody>
                          <tr>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Old Slug') }}</th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('New Slug or URL') }}</th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Action') }}</th>
                          </tr>

                            @if ( !empty($redirects) )

                                @foreach ($redirects as $redirect)
                                    <tr>
                                        <td class="align-middle">{{ $redirect['old_slug'] }}</td>
                                        <td class="align-middle">{{ $redirect['new_slug'] }}</td>
                                        <td class="align-middle w-25 py-3">
                                            <a class="btn btn-sm btn-info mb-0" title="{{ __('Edit') }}" wire:click="onShowEditRedirectModal( {{ $redirect['id'] }} )"><i class="fas fa-edit fa-fw"></i> {{ __('Edit') }}</a>
                                            <a class="btn btn-sm btn-danger mb-0" title="{{ __('Delete') }}" wire:click="onDeleteConfirmRedirect( {{ $redirect['id'] }} )"><i class="fas fa-trash fa-fw"></i> {{ __('Delete') }}</a>
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
    <!-- End:Redirects -->

    <!-- Begin::Add New Redirect -->
    <div class="modal fade" id="addNewRedirect" tabindex="-1" role="dialog" aria-labelledby="addNewRedirectLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addNewRedirectModalLabel">{{ __('Add New Redirect') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            @livewire('admin.settings.redirects.create')
          </div>

        </div>
      </div>
    </div>
    <!-- End::Add New Redirect -->

    <!-- Begin::Edit Redirect -->
    <div class="modal fade" id="editRedirect" tabindex="-1" role="dialog" aria-labelledby="editRedirectLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editRedirectModalLabel">{{ __('Edit Redirect') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            @livewire('admin.settings.redirects.edit')
          </div>

        </div>
      </div>
    </div>
    <!-- End::Edit Redirect -->

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
                window.livewire.emit('onDeleteRedirect', event.detail.id)
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