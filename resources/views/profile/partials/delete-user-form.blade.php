<section class="mb-4">
    <header>
        <h5 class="fw-bold text-danger">
            {{ __('Delete Account') }}
        </h5>

        <p class="text-muted small">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button type="button" class="btn btn-danger px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#confirmUserDeletion">
        {{ __('Delete Account') }}
    </button>

    <div class="modal fade" id="confirmUserDeletion" tabindex="-1" aria-labelledby="confirmUserDeletionLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold" id="confirmUserDeletionLabel">{{ __('Are you sure?') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body py-4">
                        <p class="text-muted">
                            {{ __('Once your account is deleted, all data will be permanently removed. Please enter your password to confirm.') }}
                        </p>

                        <div class="mb-3">
                            <label for="password" class="form-label visually-hidden">{{ __('Password') }}</label>
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   class="form-control @if($errors->userDeletion->has('password')) is-invalid @endif" 
                                   placeholder="{{ __('Confirm Password') }}" 
                                   required>
                            
                            @if($errors->userDeletion->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->userDeletion->first('password') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit" class="btn btn-danger px-4">
                            {{ __('Delete Account') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

{{-- Script to keep modal open if there are errors --}}
@if($errors->userDeletion->isNotEmpty())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var deleteModal = new bootstrap.Modal(document.getElementById('confirmUserDeletion'));
        deleteModal.show();
    });
</script>
@endif