<section>
    <header>
        <h5 class="fw-bold text-dark">
            {{ __('Profile Information') }}
        </h5>
        <p class="text-muted small">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    {{-- Hidden form for email verification resend --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" 
                   class="form-control @error('name') is-invalid @enderror" 
                   value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3 bg-light border rounded">
                    <p class="text-sm text-dark mb-2">
                        {{ __('Your email address is unverified.') }}
                    </p>
                    <button form="send-verification" class="btn btn-sm btn-outline-secondary">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <div class="mt-2 text-success small fw-medium">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <div class="mb-4">
            <label for="mobile" class="form-label fw-semibold">{{ __('Mobile Number') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-light text-muted"><i class="bi bi-telephone"></i></span>
                <input id="mobile" name="mobile" type="text" 
                       class="form-control @error('mobile') is-invalid @enderror" 
                       value="{{ old('mobile', $user->mobile) }}" placeholder="e.g. +1234567890">
            </div>
            @error('mobile')
                <div class="small text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary px-4 shadow-sm">
                <i class="bi bi-check2-circle me-1"></i> {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <span class="text-success small fw-medium animate__animated animate__fadeOut animate__delay-2s">
                    {{ __('Saved successfully.') }}
                </span>
            @endif
        </div>
    </form>
</section>