<div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
    @php

        $languages = json_decode($languages, true);

    @endphp

    <form wire:submit.prevent="onAddLanguage">
        <div class="form-group">
            <label for="name" class="form-control-label">{{ __('Name') }}</label>
            <input class="form-control" type="text" id="name" wire:model="name">
        </div>

        <div class="form-group" wire:ignore>
            <label for="name" class="form-control-label">{{ __('Language') }}</label>
            <select id="lang_code" class="form-control" wire:model="code">
                <optgroup label="{{ __('Languages') }}">
                    @foreach ($languages as $key => $value)
                        <option value="{{ $key }}">{{ $value['name'] }}</option>
                    @endforeach
                </optgroup>
            </select>
        </div>

        <div class="float-end mt-3">
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
            <button type="submit" class="btn bg-gradient-primary">
                <span>
                    <div wire:loading wire:target="onAddLanguage">
                        <x-loading />
                    </div>
                    <span>{{ __('Add new') }}</span>
                </span>
            </button>
        </div>
    </form>

</div>

<script>
(function( $ ) {
    "use strict";

    jQuery(document).ready(function(){

        const lang_code = new Choices( document.querySelector('#lang_code') );

        jQuery('#lang_code').on('change', function (e) {
            var lang_data = jQuery(this).find(":selected").val();
            @this.set('code', lang_data);
        });

    });

})( jQuery );
</script>
