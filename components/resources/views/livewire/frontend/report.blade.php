<div>

    <div id="page-content" class="py-3">

      <!-- Session Status -->
      <x-auth-session-status class="mb-4" :status="session('status')" />

      <!-- Validation Errors -->
      <x-auth-validation-errors class="mb-4" :errors="$errors" />

      <!-- Report Form -->
      <form id="formReportLinks" wire:submit.prevent="sendReport">
         
        <div class="form-group">

          <label for="report-links" class="col-form-label d-flex">{{ __('Enter one URL per line in the text area below') }}</label>

          <textarea id="report-links" wire:model="links" class="form-control @error('links') is-invalid @enderror" rows="10" placeholder="E.g. https://soundcloud.com/justinbieber/we-were-born-for-this" required></textarea>

        </div>

        <button class="btn bg-gradient-primary mt-3 mb-0">
            <span>
                <div wire:loading wire:target="sendReport">
                    <x-loading />
                </div>
                <span>{{ __('Submit') }}</span>
            </span>
        </button>

      </form>

    </div>

</div>
