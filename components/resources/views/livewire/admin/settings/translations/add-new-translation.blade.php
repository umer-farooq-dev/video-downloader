<div>
    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form wire:submit.prevent="onAddTranslation">
        <div class="form-group">
            <label for="key" class="form-control-label">{{ __('Translation Key') }}</label>
            <input class="form-control @error('key') is-invalid @enderror" type="text" id="key" wire:model="key" required>
            <small>{{ __('Word or sentence you want to translate.') }}</small>
        </div>

        <div class="form-group">
            <label for="value" class="form-control-label">{{ __('Translation Value') }}</label>
            <input class="form-control @error('value') is-invalid @enderror" type="text" id="value" wire:model="value" required>
            <small>{{ __('What word or sentence should be translated to.') }}</small>
        </div>

        <div class="float-end mt-3">
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
            <button type="submit" class="btn bg-gradient-primary">
                <span>
                    <div wire:loading wire:target="onAddTranslation">
                        <x-loading />
                    </div>
                    <span>{{ __('Add new') }}</span>
                </span>
            </button>
        </div>
    </form>
</div>
