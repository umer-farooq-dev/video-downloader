<div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
    <form wire:submit.prevent="onEditProxy({{ $this->proxy_id }})">
        <div class="form-group">
            <label for="name" class="form-control-label">{{ __('IP Address') }}</label>
            <input class="form-control" type="text" wire:model="ip">
        </div>

        <div class="form-group">
            <label for="name" class="form-control-label">{{ __('Port') }}</label>
            <input class="form-control" type="text" wire:model="port">
        </div>

        <div class="form-group">
            <label for="name" class="form-control-label">{{ __('Type') }}</label>
            <select wire:model="type" class="form-control">
                <option value="http">HTTP</option>
                <option value="https">HTTPs</option>
                <option value="socks4">SOCKS4</option>
                <option value="socks5">SOCKS5</option>
            </select>
        </div>

        <div class="form-group">
            <label for="name" class="form-control-label">{{ __('Username') }}</label>
            <input class="form-control" type="text" wire:model="username">
        </div>

        <div class="form-group">
            <label for="name" class="form-control-label">{{ __('Password') }}</label>
            <input class="form-control" type="text" wire:model="password">
        </div>

        <div class="float-end mt-3">
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
            <button type="submit" class="btn bg-gradient-primary">
                <span>
                    <div wire:loading wire:target="onEditProxy({{ $this->proxy_id }})">
                        <x-loading />
                    </div>
                    <span>{{ __('Save changes') }}</span>
                </span>
            </button>
        </div>
    </form>

</div>