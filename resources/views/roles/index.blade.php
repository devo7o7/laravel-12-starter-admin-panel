@extends('layouts.admin')

@section('title', 'Role Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Roles</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active">Roles</li>
            </ol>
        </nav>
    </div>
    @can('role.create')
    <a href="{{ route('roles.create') }}" class="btn btn-primary shadow-sm">
        <i class="bi bi-plus-lg me-1"></i> New Role
    </a>
    @endcan
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white py-3 border-bottom border-light">
        <div class="row align-items-center g-2">
            <div class="col">
                <h6 class="mb-0 fw-bold text-dark">System Roles</h6>
            </div>
            <div class="col-auto">
                <form action="{{ route('roles.index') }}" method="GET" class="d-flex">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control border-end-0" 
                               placeholder="Search roles..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary border-start-0 bg-white text-muted" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Role Name</th>
                        <th>Permissions Count</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roles as $role)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 p-2 rounded-2 me-3">
                                    <i class="bi bi-shield-lock text-success"></i>
                                </div>
                                <span class="fw-bold text-dark">{{ ucfirst($role->name) }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-3">
                                {{ $role->permissions_count }} Permissions
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <div class="btn-group shadow-sm">
                                  @can('role.update')
                                <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-white border border-end-0">
                                    <i class="bi bi-pencil-square text-primary me-1"></i> Edit
                                </a>
                                @endcan
                                  @can('role.delete')
                                <form method="POST" action="{{ route('roles.destroy', $role) }}" 
                                      class="d-inline" 
                                      onsubmit="return confirm('Deleting this role will remove access for all users assigned to it. Proceed?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-white border">
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-5">
                            <p class="text-muted mb-0">No roles found.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($roles->hasPages())
    <div class="card-footer bg-white border-top-0 py-3 d-flex justify-content-center">
        {!! $roles->links() !!}
    </div>
    @endif
</div>
@endsection