@extends('layouts.admin')

@section('title', 'Edit Role')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Edit Role: {{ ucfirst($role->name) }}</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('roles.index') }}" class="text-decoration-none">Roles</a></li>
                <li class="breadcrumb-item active">{{ ucfirst($role->name) }}</li>
            </ol>
        </nav>
    </div>
    <a href="{{ route('roles.index') }}" class="btn btn-sm btn-outline-secondary shadow-sm">
        <i class="bi bi-arrow-left me-1"></i> Back to List
    </a>
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('roles.update', $role) }}">
            @csrf 
            @method('PUT')

            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="name" class="form-label fw-bold">Role Name</label>
                    <input type="text" name="name" id="name" 
                           class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $role->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="border-top pt-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0">Assign Permissions</h6>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="selectAll">
                        <label class="form-check-label small fw-semibold" for="selectAll">Select All Permissions</label>
                    </div>
                </div>

                <div class="row g-3">
                    @foreach($permissions as $permission)
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="permission-card p-2 border rounded-3 transition-all">
                            <div class="form-check d-flex align-items-center mb-0">
                                <input class="form-check-input permission-checkbox me-2" type="checkbox" 
                                       name="permissions[]" value="{{ $permission->name }}" 
                                       id="perm_{{ $permission->id }}"
                                       {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                <label class="form-check-label cursor-pointer text-dark small fw-medium text-truncate" for="perm_{{ $permission->id }}">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-5 pt-3 border-top d-flex gap-2">
                  @can('role.update')
                <button type="submit" class="btn btn-primary px-4 shadow-sm">
                    <i class="bi bi-check-circle me-1"></i> Update Role
                </button>
                @endcan
                <a href="{{ route('roles.index') }}" class="btn btn-light border px-4">Cancel</a>
            </div>
        </form>
    </div>
</div>

<style>
    .permission-card:hover { background-color: #f8f9fa; border-color: #0d6efd !important; }
    .cursor-pointer { cursor: pointer; }
    .transition-all { transition: all 0.2s ease; }
</style>

@push('scripts')
<script>
    // Handle "Select All" logic
    document.getElementById('selectAll').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.permission-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });
</script>
@endpush
@endsection