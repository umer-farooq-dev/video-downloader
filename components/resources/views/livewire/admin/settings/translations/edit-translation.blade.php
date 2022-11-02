<div>
    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
    <div class="row">
        <div class="col-12">

            <div class="position-relative pb-0">
                <button class="btn bg-gradient-info" data-bs-toggle="modal" data-bs-target="#addNewTranslation">{{ __('Add New Translation') }}</button>
            </div>

            <div class="card shadow-lg mb-5">
                <div class="card-body">

              <div class="alert alert-secondary text-white" role="alert">
                  <strong>{{ __('You are translating :langNative language.', ['langNative' => $lang_name]) }}</strong>
              </div>

                <!-- begin:Form Search -->
                <form id="formSearchTranslation">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg" wire:model="searchQuery" placeholder="{{ __('Search here...') }}">
                    </div>
                </form>
                <!-- end:Form Search -->

                    <div class="table-responsive">
                        <form wire:submit.prevent="onUpdateTranslation">
                            <div class="form-group">
                                <button class="btn bg-gradient-primary">
                                    <span>
                                        <div wire:loading wire:target="onUpdateTranslation">
                                            <x-loading />
                                        </div>
                                        <span>{{ __('Save Changes') }}</span>
                                    </span>
                                </button>
                            </div>

                            <table class="table align-items-center mb-0">
                                <tbody>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Default Text') }}</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Translation') }}</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                    @if ( !empty($translations) )

                                        @foreach ($translations as $index => $translation)

                                        <tr>
                                            <td class="align-middle"><input type="text" class="form-control" wire:model.defer="translations.{{ $index }}.key" readonly></td>
                                            <td class="align-middle"><input type="text" class="form-control" wire:model.defer="translations.{{ $index }}.value" wire:ignore></td>
                                            <td class="align-middle"><a title="Delete" class="float-end" href="javascript:;" wire:click="onDeleteTranslation({{ $translation['id'] }})"><i class="fas fa-trash"></i></a></td>
                                        </tr>
                                        @endforeach

                                    @else
                                        <tr><td class="align-middle">{{ __('No record found') }}</td></tr>
                                    @endif

                                </tbody>
                            </table>
                        </form>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Begin::Add New Translation -->
    <div class="modal fade" id="addNewTranslation" tabindex="-1" role="dialog" aria-labelledby="addNewTranslationLabel" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title" id="addNewTranslationModalLabel">{{ __('Add New Translation') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
             </div>
             <div class="modal-body">
                @livewire('admin.settings.translations.add-new-translation', ['lang_id' => Route::current()->parameter('lang_id') ])
             </div>
          </div>
       </div>
    </div>
    <!-- End::Add New Translation -->

</div>
