<div>
        <p class="text-center">{{ __('Below you should enter your database connection details. If you are not sure about these, contact your host.') }}</p>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="form-group">
            <label for="purchase_code">{{ __('Purchase code') }} ( <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code" class="text-gradient text-primary" target="_blank">{{ __('Where Is My Purchase Code?') }}</a> )</label>
            <input type="text" wire:model="purchase_code" id="purchase_code" class="form-control @error('purchase_code') is-invalid @enderror" required />
        </div>

        <form wire:submit.prevent="onCreateDatabase">

            <div class="form-group">
                <label for="database_host">{{ __('Database Host') }}</label>
                <input type="text" wire:model="database_host" id="database_host" class="form-control @error('database_host') is-invalid @enderror" required />
            </div>

            <div class="form-group">
                <label for="database_port">{{ __('Database Port') }}</label>
                <input type="text" wire:model="database_port" id="database_port" class="form-control @error('database_port') is-invalid @enderror" required />
            </div>

            <div class="form-group">
                <label for="database_name">{{ __('Database Name') }}</label>
                <input type="text" wire:model="database_name" id="database_name" class="form-control @error('database_name') is-invalid @enderror" required />
            </div>

            <div class="form-group">
                <label for="database_username">{{ __('Username') }}</label>
                <input type="text" wire:model="database_username" id="database_username" class="form-control @error('database_username') is-invalid @enderror" required />
            </div>

            <div class="form-group">
                <label for="database_password">{{ __('Password') }}</label>
                <input type="password" wire:model="database_password" id="database_password" class="form-control @error('database_password') is-invalid @enderror" autocomplete="off" />
            </div>

            <div class="col-md-12 text-center">
                <button class="btn bg-gradient-primary mt-3 mb-0">
                    <span>
                        <div wire:loading wire:target="onCreateDatabase">
                            <x-loading />
                        </div>
                        <span>{{ __('Save Changes') }}</span>
                    </span>
                </button>

                @if ( $continue == true )
                    <a class="btn bg-gradient-info mt-3 mb-0" href="{{ route('sw_admin') }}">{{ __('Continue') }}</a>
                @endif

            </div>
        </form>
</div>
