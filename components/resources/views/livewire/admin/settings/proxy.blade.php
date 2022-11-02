<div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    
    <div class="row">
        <div class="col-12">

            <button class="btn bg-gradient-info" data-bs-toggle="modal" data-bs-target="#addNewProxy"><i class="fas fa-plus fa-fw"></i> {{ __('Add New Proxy') }}</button>

            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>{{ __('IP') }}</th>
                                <th>{{ __('Port') }}</th>
                                <th>{{ __('Username') }}</th>
                                <th>{{ __('Password') }}</th>
                                <th>{{ __('Type') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>

                            @if ( $proxies->isNotEmpty() )

                                @foreach ($proxies as $proxy)
                                    <tr>
                                        <td class="align-middle">{{ $proxy['ip'] }}</td>
                                        <td class="align-middle">{{ $proxy['port'] }}</td>
                                        <td class="align-middle">{{ ($proxy['username']) ? $proxy['username']: 'none' }}</td>
                                        <td class="align-middle">{{ ($proxy['password']) ? $proxy['password'] : 'none' }}</td>
                                        <td class="align-middle">{{ $proxy['type'] }}</td>
                                        <td class="align-middle">
                                            @if ( $proxy['banned'] == true)
                                                <span class="badge bg-gradient-danger"><i class="fas fa-times"></i></span>
                                            @else
                                                <span class="badge bg-gradient-success"><i class="fas fa-check"></i></span>
                                            @endif

                                        </td>
                                        <td class="align-middle w-15 py-3">
                                            <a class="btn btn-sm btn-primary mb-0" title="{{ __('Check Proxy') }}" wire:click="onProxyCheck( {{ $proxy['id'] }} )">
                                                <i class="fas fa-check fa-fw" wire:loading.remove wire:target="onProxyCheck( {{ $proxy['id'] }} )"></i>
                                                <i class="fas fa-spinner fa-spin fa-fw" wire:loading wire:target="onProxyCheck( {{ $proxy['id'] }} )"></i>
                                                {{ __('Check Proxy') }}
                                            </a>
                                            <a class="btn btn-sm btn-info mb-0" title="{{ __('Edit') }}" wire:click="onShowEditProxyModal( {{ $proxy['id'] }} )"><i class="fas fa-edit fa-fw"></i> {{ __('Edit') }}</a>
                                            <a class="btn btn-sm btn-danger mb-0" title="{{ __('Delete') }}" wire:click="onDeleteProxyConfirm( {{ $proxy['id'] }} )"><i class="fas fa-trash fa-fw"></i> {{ __('Delete') }}</a>
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

                    <div class="float-end">
                        <!-- begin:pagination -->
                        {{ $proxies->links() }}
                        <!-- begin:pagination -->
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Begin::Add New Proxy -->
    <div class="modal fade" id="addNewProxy" tabindex="-1" role="dialog" aria-labelledby="addNewProxyLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addNewProxyModalLabel">{{ __('Add New Proxy') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            @livewire('admin.proxy.create')
          </div>

        </div>
      </div>
    </div>
    <!-- End::Add New Proxy -->

    <!-- Begin::Edit Proxy -->
    <div class="modal fade" id="editProxy" tabindex="-1" role="dialog" aria-labelledby="editProxyLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editProxyModalLabel">{{ __('Edit Proxy') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            @livewire('admin.proxy.edit')
          </div>

        </div>
      </div>
    </div>
    <!-- End::Edit Proxy -->

</div>