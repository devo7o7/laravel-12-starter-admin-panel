@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Edit User: {{ $user->name }}</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}" class="text-decoration-none">Users</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>
    <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Back to List
    </a>
</div>

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Mobile Number</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="bi bi-telephone"></i></span>
                                <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{ old('mobile', $user->mobile) }}">
                            </div>
                            @error('mobile') <div class="small text-danger mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Leave blank to keep current">
                            <div class="form-text">Only fill this if you want to change the password.</div>
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <hr class="my-4 text-muted opacity-25">

                    <div class="mb-4">
                        <label class="form-label fw-semibold d-block mb-3">Update Roles</label>
                        <div class="row g-3">
                            @foreach($roles as $role)
                            <div class="col-md-4">
                                <div class="form-check p-2 border rounded shadow-sm bg-light-subtle">
                                    <input class="form-check-input ms-1" 
                                           type="checkbox" 
                                           name="roles[]" 
                                           value="{{ $role->name }}" 
                                           id="role_{{ $role->id }}"
                                           {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                                    <label class="form-check-label ms-2 fw-medium" for="role_{{ $role->id }}">
                                        {{ ucfirst($role->name) }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @error('roles') <div class="small text-danger mt-2">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex gap-2 pt-2 border-top mt-4">
                           @can('user.update')
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i> Update User
                        </button>
                        @endcan
                        <a href="{{ route('users.index') }}" class="btn btn-light border px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="card bg-info bg-opacity-10 border-0 rounded-3 mb-3">
            <div class="card-body">
                <h6 class="fw-bold text-info"><i class="bi bi-info-circle me-2"></i> Editing Note</h6>
                <p class="small text-muted mb-0">
                    Updating a user's role will take effect immediately upon their next page load or login session.
                </p>
            </div>
        </div>
        
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body">
                <h6 class="fw-bold small text-muted text-uppercase mb-3">User Stats</h6>
                <div class="d-flex justify-content-between mb-2">
                    <span class="small text-muted">Created:</span>
                    <span class="small fw-bold">{{ $user->created_at->format('M d, Y') }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="small text-muted">Last Updated:</span>
                    <span class="small fw-bold">{{ $user->updated_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection