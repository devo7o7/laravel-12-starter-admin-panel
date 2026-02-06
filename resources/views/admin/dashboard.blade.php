@extends('layouts.admin')

{{-- Dynamically fetch role, capitalize it, and append Dashboard --}}
@section('title', ucfirst(auth()->user()->roles->first()->name ?? 'User') . ' Dashboard')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-4 border-bottom">
        <h4 class="fw-bold mb-0">Dashboard Overview</h4>
        <div class="btn-toolbar mb-2 mb-md-0">
            <span class="badge bg-light text-dark border py-2 px-3">
                <i class="bi bi-calendar3 me-1"></i> Updated: {{ date('d M, Y') }}
            </span>
        </div>
    </div>

    <div class="row g-4">
        @can('user.view')
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted text-uppercase fw-semibold small mb-1">Total Users</h6>
                                <h2 class="mb-0 fw-bold">{{ number_format($totalUsers) }}</h2>
                            </div>
                            <div class="bg-primary bg-opacity-10 p-3 rounded-3" style="height: fit-content;">
                                <i class="bi bi-people fs-3 text-primary"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('users.index') }}" class="text-primary text-decoration-none small fw-bold">Manage
                                Users <i class="bi bi-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
        @can('analytics')
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-white-50 text-uppercase fw-semibold small mb-1">Analytics</h6>
                                <h2 class="mb-0 fw-bold">Logs</h2>
                            </div>
                            <div class="bg-black bg-opacity-10 p-3 rounded-3">
                                <i class="bi bi-graph-up-arrow fs-3 text-secondary"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('analytics.index') }}" class="btn btn-sm btn-light rounded-pill px-3">View
                                Insights</a>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
        @can('role.view')
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted text-uppercase fw-semibold small mb-1">Active Roles</h6>
                                <h2 class="mb-0 fw-bold">{{ $totalRoles }}</h2>
                            </div>
                            <div class="bg-success bg-opacity-10 p-3 rounded-3">
                                <i class="bi bi-shield-lock fs-3 text-success"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('roles.index') }}" class="text-success text-decoration-none small fw-bold">View
                                Roles <i class="bi bi-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
        @can('permission.view')
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted text-uppercase fw-semibold small mb-1">Permissions</h6>
                                <h2 class="mb-0 fw-bold">{{ $totalPermissions }}</h2>
                            </div>
                            <div class="bg-warning bg-opacity-10 p-3 rounded-3">
                                <i class="bi bi-key fs-3 text-warning"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('permissions.index') }}"
                                class="text-warning text-decoration-none small fw-bold">Configure <i
                                    class="bi bi-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    </div>

    <div class="row g-4 mt-2">


        @can('analytics')
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold">Recent System Activity</h5>
                            <span class="badge bg-primary-subtle text-primary">Live Feed</span>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">User</th>
                                        <th>Action</th>
                                        <th>Device</th>
                                        <th class="text-end pe-4">Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentActivity as $log)
                                        @php
                                            // Decode the JSON meta column into an array
                                            $meta = json_decode($log->meta, true);
                                            $userAgent = $meta['user_agent'] ?? 'Unknown Device';

                                            // Simple logic to detect browser for the icon
                                            $browserIcon = 'bi-display'; // Default icon
                                            if (str_contains($userAgent, 'Mobile'))
                                                $browserIcon = 'bi-phone';
                                            elseif (str_contains($userAgent, 'Postman'))
                                                $browserIcon = 'bi-terminal';
                                        @endphp
                                        <tr>
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-light rounded-circle p-2 me-3">
                                                        <i class="bi bi-person text-secondary"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold text-dark">{{ $log->name ?? 'System' }}</div>
                                                        <div class="small text-muted">{{ $log->email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge {{ $log->action == 'login' ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }} px-3 rounded-pill">
                                                    {{ ucfirst($log->action) }}
                                                </span>
                                            </td>
                                            <td>
                                                {{-- Displaying IP and User Agent --}}
                                                <div class="d-flex flex-column">
                                                    <span class="text-dark small fw-medium">
                                                        <i class="bi {{ $browserIcon }} me-1"></i>
                                                        {{ Str::limit($userAgent, 30) }} {{-- Limits string length --}}
                                                    </span>
                                                    <span class="text-muted" style="font-size: 0.7rem;">IP:
                                                        {{ $meta['ip'] ?? '0.0.0.0' }}</span>
                                                </div>
                                            </td>
                                            <td class="text-end pe-4">
                                                <span class="text-muted small">{{ $log->created_at->diffForHumans() }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5 text-muted">No recent activity found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer bg-white border-top-0 text-center py-3">
                            <a href="{{ route('analytics.index') }}" class="btn btn-sm btn-outline-primary">View Full Audit
                                Log</a>
                        </div>
                    </div>
                </div>
        @endcan
        </div>
@endsection