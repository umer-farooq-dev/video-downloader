<div>
        <p class="text-center">{{ __('Please fill in the login information for the admin account.') }}</p>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form wire:submit.prevent="onCreateAdmin">
            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input type="text" wire:model="email" id="email" class="form-control @error('email') is-invalid @enderror" />
            </div>

            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input type="password" wire:model="password" id="password" class="form-control @error('password') is-invalid @enderror" autocomplete="off" />
            </div>

            <div class="col-md-12 text-center">
                <button class="btn bg-gradient-primary mt-3 mb-0">
                    <span>
                        <div wire:loading wire:target="onCreateAdmin">
                            <x-loading />
                        </div>
                        <span>{{ __('Continue') }}</span>
                    </span>
                </button>
            </div>
      </form>
</div>
