<div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
    <form wire:submit.prevent="onClearCache" class="row">

        <!-- Begin:Cache -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p>{{ __('This feature will help you clear all stored caches.') }}</p>
                    <div class="form-group mb-0">
                        <button class="btn bg-gradient-primary">
                            <span>
                                <div wire:loading wire:target="onClearCache">
                                    <x-loading />
                                </div>
                                <span>{{ __('Clear all Cache') }}</span>
                            </span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
        <!-- End:Cache -->

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
