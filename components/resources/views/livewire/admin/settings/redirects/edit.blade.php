<div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form wire:submit.prevent="onEditRedirect({{ $redirect_id }})">
        <div class="form-group">
            <label for="old_slug" class="form-control-label">{{ __('Old Slug') }}</label>
            <input class="form-control" type="text" id="old_slug" wire:model="old_slug">
        </div>

        <div class="form-group">
            <label for="new_slug" class="form-control-label">{{ __('New Slug or URL') }}</label>
            <input class="form-control" type="text" id="new_slug" wire:model="new_slug">
        </div>

        <div class="float-end mt-3">
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
            <button type="submit" class="btn bg-gradient-primary">
                <span>
                    <div wire:loading wire:target="onEditRedirect{{ $redirect_id }}">
                        <x-loading />
                    </div>
                    <span>{{ __('Save changes') }}</span>
                </span>
            </button>
        </div>
    </form>

</div>
