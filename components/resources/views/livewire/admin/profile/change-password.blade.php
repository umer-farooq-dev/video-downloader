<div class="card h-100 tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab" wire:ignore.self>
	<div class="card-header pb-0 p-3">
		<h6 class="mb-0">{{ __('Change Password') }}</h6>
	</div>
	<div class="card-body p-3">

		<!-- Validation Errors -->
		<x-auth-validation-errors class="mb-4" :errors="$errors" />

		<form wire:submit.prevent="onChangePassword">
			
			<div class="form-group">
				<label for="current_password" class="form-control-label">{{ __('Current Password') }}</label>
				<input class="form-control @error('current_password') is-invalid @enderror" type="password" id="current_password" wire:model="current_password" required>
			</div>

			<div class="form-group">
				<label for="new_password" class="form-control-label">{{ __('New Password') }}</label>
				<input class="form-control @error('new_password') is-invalid @enderror" type="password" id="new_password" wire:model="new_password" required>
			</div>

			<div class="form-group">
				<label for="retype_new_password" class="form-control-label">{{ __('Retype New Password') }}</label>
				<input class="form-control @error('retype_new_password') is-invalid @enderror" type="password" id="retype_new_password" wire:model="retype_new_password" required>
			</div>

			<div class="form-group text-end mb-0">
				<button class="btn bg-gradient-primary">
					<span>
						<div wire:loading wire:target="onChangePassword">
							<x-loading />
						</div>
						<span>{{ __('Save Changes') }}</span>
					</span>
				</button>
			</div>

		</form>

	</div>
</div>
					          
