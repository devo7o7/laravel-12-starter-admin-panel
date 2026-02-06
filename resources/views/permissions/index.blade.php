@extends('layouts.admin')

@section('title', 'Permissions')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Permissions</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active">Permissions</li>
            </ol>
        </nav>
    </div>
    @can('permission.create')
    <a href="{{ route('permissions.create') }}" class="btn btn-primary shadow-sm">
        <i class="bi bi-plus-lg me-1"></i> New Permission
    </a>
    @endcan
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white py-3 border-bottom border-light">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="mb-0 fw-bold text-dark">Available Permissions</h6>
            </div>
            <div class="col-auto">
                <div class="input-group input-group-sm" style="width: 250px;">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" class="form-control bg-light border-start-0" placeholder="Search permissions...">
                </div>
            </div>
        </div>
    </div>
    
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4" style="width: 70%;">Permission Name</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($permissions as $permission)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-warning bg-opacity-10 p-2 rounded-2 me-3">
                                    <i class="bi bi-key text-warning"></i>
                                </div>
                                <div>
                                    <span class="fw-semibold text-dark">{{ $permission->name }}</span>
                                    <div class="small text-muted">ID: #{{ $permission->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-end pe-4">
                            <div class="btn-group shadow-sm">
                                @can('permission.update')
                                <a href="{{ route('permissions.edit', $permission) }}" 
                                   class="btn btn-sm btn-white border border-end-0" 
                                   title="Edit">
                                    <i class="bi bi-pencil text-primary"></i>
                                </a>
                                @endcan
                                @can('permission.delete')
                                <form method="POST" action="{{ route('permissions.destroy', $permission) }}" 
                                      class="d-inline" 
                                      onsubmit="return confirm('Are you sure you want to delete this permission? This action cannot be undone.');">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-white border" title="Delete">
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="text-center py-5">
                            <i class="bi bi-shield-slash fs-1 text-muted d-block mb-3"></i>
                            <p class="text-muted mb-0">No permissions found. Click "New Permission" to get started.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    @if($permissions->hasPages())
    <div class="card-footer bg-white py-3">
        {{ $permissions->links() }}
    </div>
    @endif
</div>
@endsection