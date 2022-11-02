<div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
    @php

        $languages = json_decode($languages, true);

    @endphp

    <form wire:submit.prevent="onEditLanguage( {{ $lang_id }} )">
        <div class="form-group">
            <label for="edit_name" class="form-control-label">{{ __('Name') }}</label>
            <input class="form-control" type="text" id="edit_name" wire:model="name">
        </div>

        <div class="form-group">
            <label for="edit_lang" class="form-control-label">{{ __('Language') }}</label>
            <select class="form-control" id="edit_lang" wire:model="code">
                @foreach ($languages as $key => $value)
                <option value="{{ $key }}">{{ $value['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="float-end mt-3">
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
            <button type="submit" class="btn bg-gradient-primary">
                <span>
                    <div wire:loading wire:target="onEditLanguage( {{ $lang_id }} )">
                        <x-loading />
                    </div>
                    <span>{{ __('Save changes') }}</span>
                </span>
            </button>
        </div>
    </form>

</div>
