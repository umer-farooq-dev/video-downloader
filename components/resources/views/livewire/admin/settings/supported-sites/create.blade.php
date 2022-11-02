<div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form wire:submit.prevent="onCreateSite">
        <div class="form-group">
            <label for="title" class="form-control-label">{{ __('Title') }}</label>
            <input class="form-control" type="text" id="title" wire:model="title">
        </div>

        <div class="form-group">
            <label for="url" class="form-control-label">{{ __('Link') }}</label>
            <select class="form-control" wire:model="link">
                <option value selected style="display:none;">{{ __('Choose a page...') }}</option>
                @if ( !empty($pages) )
                    @foreach ($pages as $page)
                        <option value="{{ $page['slug'] }}">{{ __( $page['slug'] ) }}</option>
                    @endforeach
                @endif
                
            </select>
        </div>

        <div class="form-group">
            <label for="site-image" class="form-label">{{ __('Image') }}</label>
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="site-image" data-input="thumbnail" class="btn btn-primary mb-0 site-image">
                        <i class="fa fa-picture-o"></i> {{ __('Choose') }}
                    </a>
                </span>
                <input id="thumbnail" class="form-control ps-2" type="text" wire:model="image">
            </div>
        </div>

        <div class="float-end mt-3">
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
            <button type="submit" class="btn bg-gradient-primary">
                <span>
                    <div wire:loading wire:target="onCreateSite">
                        <x-loading />
                    </div>
                    <span>{{ __('Create') }}</span>
                </span>
            </button>
        </div>
    </form>

</div>

<script>
(function( $ ) {
    "use strict";

    document.addEventListener('livewire:load', function () {

        jQuery('.site-image').filemanager('image', {prefix: '{{ url('/') }}/filemanager'});

        jQuery('input#thumbnail').change(function() { 
            window.livewire.emit('onSetSiteImage', this.value)
        });

    });
    
})( jQuery );
</script>
