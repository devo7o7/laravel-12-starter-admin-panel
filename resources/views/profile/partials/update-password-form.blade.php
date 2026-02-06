<section>
    <header>
        <h5 class="fw-bold text-dark">
            {{ __('Update Password') }}
        </h5>

        <p class="text-muted small">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label fw-semibold">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" 
                   name="current_password" 
                   type="password" 
                   class="form-control @if($errors->updatePassword->has('current_password')) is-invalid @endif" 
                   autocomplete="current-password">
            
            @if($errors->updatePassword->has('current_password'))
                <div class="invalid-feedback">
                    {{ $errors->updatePassword->first('current_password') }}
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label fw-semibold">{{ __('New Password') }}</label>
            <input id="update_password_password" 
                   name="password" 
                   type="password" 
                   class="form-control @if($errors->updatePassword->has('password')) is-invalid @endif" 
                   autocomplete="new-password">

            @if($errors->updatePassword->has('password'))
                <div class="invalid-feedback">
                    {{ $errors->updatePassword->first('password') }}
                </div>
            @endif
        </div>

        <div class="mb-4">
            <label for="update_password_password_confirmation" class="form-label fw-semibold">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" 
                   name="password_confirmation" 
                   type="password" 
                   class="form-control @if($errors->updatePassword->has('password_confirmation')) is-invalid @endif" 
                   autocomplete="new-password">

            @if($errors->updatePassword->has('password_confirmation'))
                <div class="invalid-feedback">
                    {{ $errors->updatePassword->first('password_confirmation') }}
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary px-4 shadow-sm">
                {{ __('Save Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <span class="text-success small fw-medium animate__animated animate__fadeOut animate__delay-2s">
                    <i class="bi bi-check-lg"></i> {{ __('Saved.') }}
                </span>
            @endif
        </div>
    </form>
</section>