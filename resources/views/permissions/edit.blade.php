@extends('layouts.admin')

@section('title', 'Edit Permission')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Edit Permission</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}" class="text-decoration-none">Permissions</a></li>
                <li class="breadcrumb-item active text-truncate" style="max-width: 150px;">{{ $permission->name }}</li>
            </ol>
        </nav>
    </div>
    <a href="{{ route('permissions.index') }}" class="btn btn-sm btn-outline-secondary shadow-sm">
        <i class="bi bi-arrow-left me-1"></i> Back to List
    </a>
</div>

<div class="row g-4">
    <div class="col-12 col-lg-7">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3 border-bottom border-light">
                <h6 class="mb-0 fw-bold text-dark">Permission Details</h6>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('permissions.update', $permission) }}">
                    @csrf 
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="name" class="form-label fw-semibold text-secondary">Permission Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted border-end-0">
                                <i class="bi bi-shield-check"></i>
                            </span>
                            <input type="text" 
                                   name="name" 
                                   id="name"
                                   class="form-control border-start-0 @error('name') is-invalid @enderror" 
                                   value="{{ old('name', $permission->name) }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="form-text text-muted mt-2 d-block">
                            <i class="bi bi-exclamation-circle me-1"></i> Changing this name may affect roles already using this permission.
                        </small>
                    </div>

                    <div class="d-flex align-items-center gap-2 pt-2">
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">
                            <i class="bi bi-save me-1"></i> Update Permission
                        </button>
                        <a href="{{ route('permissions.index') }}" class="btn btn-light border px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-5">
        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">System Information</h6>
                <div class="d-flex justify-content-between mb-2 pb-2 border-bottom border-light">
                    <span class="text-muted small">Created On</span>
                    <span class="small fw-semibold text-dark">{{ $permission->created_at->format('d M, Y') }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted small">Last Modified</span>
                    <span class="small fw-semibold text-dark">{{ $permission->updated_at->format('d M, Y H:i') }}</span>
                </div>
            </div>
        </div>

        <div class="alert alert-warning border-0 shadow-sm rounded-3 d-flex align-items-start" role="alert">
            <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
            <div>
                <h6 class="alert-heading fw-bold">Warning!</h6>
                <p class="small mb-0">Updating permission names in a live environment can cause access issues for users currently assigned to associated roles.</p>
            </div>
        </div>
    </div>
</div>
@endsection