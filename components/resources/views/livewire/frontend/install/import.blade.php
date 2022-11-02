<div class="text-center">
    <p class="h1 py-3">📝</p>
    <p>{{ __('It\'s time to insert some default content for your new website.') }}</p>
    <p>{{ __('Once inserted, you can manage from the Admin Dashboard.') }}</p>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
    <form wire:submit.prevent="onImportData">
        <div class="col-md-12 text-center">
            <button class="btn bg-gradient-primary mt-3 mb-0">
                <span>
                    <div wire:loading wire:target="onImportData">
                        <x-loading />
                    </div>
                    <span>{{ __('Continue') }}</span>
                </span>
            </button>
        </div>
    </form>

</div>
