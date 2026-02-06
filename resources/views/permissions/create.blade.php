@extends('layouts.admin')

@section('title', 'Create Permission')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Create New Permission</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}" class="text-decoration-none">Permissions</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </nav>
    </div>
    <a href="{{ route('permissions.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Back to List
    </a>
</div>

<div class="row">
    <div class="col-12 col-lg-6"> <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('permissions.store') }}">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="name" class="form-label fw-semibold">Permission Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted">
                                <i class="bi bi-shield-lock"></i>
                            </span>
                            <input type="text" 
                                   name="name" 
                                   id="name"
                                   class="form-control border-start-0 @error('name') is-invalid @enderror" 
                                   placeholder="e.g. edit-articles"
                                   value="{{ old('name') }}"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-text mt-2 text-muted">
                            Use lowercase and hyphens (e.g., user-create, post-delete).
                        </div>
                    </div>

                    <div class="d-flex gap-2 pt-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-circle me-1"></i> Save Permission
                        </button>
                        <a href="{{ route('permissions.index') }}" class="btn btn-light border px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-lg-4">
        <div class="card bg-primary bg-opacity-10 border-0 rounded-3">
            <div class="card-body">
                <h6 class="fw-bold text-primary"><i class="bi bi-info-circle me-2"></i> Quick Tip</h6>
                <p class="small text-muted mb-0">
                    Permissions allow you to define specific access levels. Once created, you can assign this permission to various <strong>Roles</strong>.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection