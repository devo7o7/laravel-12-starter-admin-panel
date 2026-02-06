@extends('layouts.admin')

@section('title', 'My Activity Logs')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Activity History</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active">My Logs</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white py-3 border-0">
        <h6 class="mb-0 fw-bold"><i class="bi bi-clock-history me-2"></i>Recent Activities</h6>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted small text-uppercase">
                    <tr>
                        <th class="ps-4">Date & Time</th>
                        <th>Action</th>
                        <th>IP Address</th>
                        <th>Device/Browser</th>
                        <th class="text-end pe-4">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        @php
                            $meta = json_decode($log->meta, true);
                        @endphp
                        <tr>
                            <td class="ps-4">
                                <span class="text-dark fw-medium">{{ $log->created_at->format('M d, Y') }}</span>
                                <div class="text-muted x-small" style="font-size: 0.75rem;">{{ $log->created_at->format('h:i A') }}</div>
                            </td>
                            <td>
                                <span class="badge {{ $log->action == 'login' ? 'bg-success-subtle text-success' : 'bg-primary-subtle text-primary' }} border rounded-pill px-3">
                                    {{ ucfirst($log->action) }}
                                </span>
                            </td>
                            <td><code>{{ $meta['ip'] ?? 'N/A' }}</code></td>
                            <td>
                                <div class="text-truncate small text-muted" style="max-width: 250px;" title="{{ $meta['user_agent'] ?? '' }}">
                                    {{ $meta['user_agent'] ?? 'Unknown' }}
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <span class="text-success small"><i class="bi bi-check-circle-fill me-1"></i> Success</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-journal-x fs-1 d-block mb-3"></i>
                                    No activity logs found for your account.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($logs->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            {{ $logs->links() }}
        </div>
    @endif
</div>
@endsection