@extends('layouts.admin')

@section('title', 'Users List')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">User Management</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active">Users</li>
            </ol>
        </nav>
    </div>
    {{-- Permission Check for Creating Users --}}
    @can('user.create')
    <a href="{{ route('users.create') }}" class="btn btn-primary shadow-sm">
        <i class="bi bi-plus-lg me-1"></i> Add New User
    </a>
    @endcan
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white py-3 border-0">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="mb-0 fw-bold">All Users</h6>
            </div>
            <div class="col-auto">
                {{-- Permission Check for Viewing (Search is part of View) --}}
                @can('user.view')
                <form action="{{ route('users.index') }}" method="GET" class="d-flex gap-2">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" 
                               name="search" 
                               class="form-control border-start-0 bg-light" 
                               placeholder="Search name, email or mobile..." 
                               value="{{ request('search') }}">
                        @if(request('search'))
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif
                        <button type="submit" class="btn btn-dark">Search</button>
                    </div>
                </form>
                @endcan
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted small text-uppercase">
                    <tr>
                        <th class="ps-4">User</th>
                        <th>Contact Info</th>
                        <th>Roles</th>
                        <th>Joined Date</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td class="ps-4">
                            <div class="fw-bold text-dark">{{ $user->name }}</div>
                        </td>
                        <td>
                            <div class="small"><i class="bi bi-envelope me-1"></i> {{ $user->email }}</div>
                            @if($user->mobile)
                                <div class="small text-muted"><i class="bi bi-phone me-1"></i> {{ $user->mobile }}</div>
                            @endif
                        </td>
                        <td>
                            @foreach($user->roles as $role)
                                <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill">
                                    {{ $role->name }}
                                </span>
                            @endforeach
                        </td>
                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="text-end pe-4">
                            <div class="btn-group shadow-sm">
                                {{-- Permission Check for Updating Users --}}
                                @can('user.update')
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-white border border-end-0" title="Edit User">
                                    <i class="bi bi-pencil text-primary"></i>
                                </a>
                                @endcan

                                {{-- Permission Check for Deleting Users --}}
                                @can('user.delete')
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-white border" onclick="return confirm('Are you sure?')" title="Delete User">
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <p class="text-muted mb-0">No users found matching your criteria.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    @if($users instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="card-footer bg-white border-0 pt-0">
        {{ $users->appends(['search' => request('search')])->links() }}
    </div>
    @endif
</div>
@endsection