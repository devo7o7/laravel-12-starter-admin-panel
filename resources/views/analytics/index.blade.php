@extends('layouts.admin')

@section('title', 'User Analytics')

@section('content')
@push('styles')
<style>
    @media print {
        .sidebar, .navbar, .btn-toolbar, .breadcrumb { display: none !important; }
        .main-content { margin-top: 0 !important; padding: 0 !important; }
        .card { box-shadow: none !important; border: 1px solid #ddd !important; }
    }
    /* Fixed container for Device Chart to control height */
    .chart-container-sm { position: relative; height: 220px; width: 100%; }
</style>
@endpush

<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb bg-transparent p-0 small">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">User Analytics</li>
    </ol>
</nav>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-4 border-bottom">
    <h4 class="fw-bold mb-0 text-primary"><i class="bi bi-graph-up-arrow me-2"></i>User Analytics Dashboard</h4>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('analytics.export') }}" class="btn btn-sm btn-outline-secondary me-2 shadow-sm">
            <i class="bi bi-download me-1"></i> Export CSV
        </a>
        <button type="button" onclick="window.print()" class="btn btn-sm btn-light border shadow-sm">
            <i class="bi bi-printer me-1"></i> Print
        </button>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm p-3 h-100">
            <div class="d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                    <i class="bi bi-person-check text-primary fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted small mb-0">Active Users (7d)</h6>
                    <h3 class="fw-bold mb-0">{{ $activeUsers7 }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm p-3 h-100">
            <div class="d-flex align-items-center">
                <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                    <i class="bi bi-people text-success fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted small mb-0">Active Users (30d)</h6>
                    <h3 class="fw-bold mb-0">{{ $activeUsers30 }}</h3>
                </div>
            </div>
        </div>
    </div>
    
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0">Login Activity Trend</h6>
                <span class="badge bg-primary-subtle text-primary">Last 30 Days</span>
            </div>
            <div style="position: relative; height: 300px; width: 100%;">
                <canvas id="loginsChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-12 col-lg-7">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold mb-0">Device Usage Statistics</h6>
                <i class="bi bi-laptop text-muted"></i>
            </div>
            <div class="chart-container-sm">
                <canvas id="deviceChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-5">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 border-0">
                <h6 class="fw-bold mb-0">Top IP Addresses</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr class="small text-uppercase text-muted">
                            <th class="ps-3">Network IP</th>
                            <th class="text-center">Activity</th>
                            <th class="text-end pe-3">Sessions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ipStats as $ip)
                        <tr>
                            <td class="ps-3">
                                <span class="badge bg-light text-primary border font-monospace">{{ $ip->ip }}</span>
                            </td>
                            <td class="text-center">
                                <div class="progress" style="height: 6px; width: 60px; margin: 0 auto;">
                                    <div class="progress-bar bg-primary" style="width: 75%"></div>
                                </div>
                            </td>
                            <td class="text-end pe-3 fw-bold text-dark">{{ $ip->count }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
 <div class="col-12">
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h6 class="fw-bold mb-0">Recent Activity Logs</h6>
            <a href="{{ route('logs.self') }}" class="btn btn-sm btn-link text-decoration-none p-0 small">View All</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">User Details</th>
                            <th>Action Type</th>
                            <th>Device</th> {{-- Changed from Platform --}}
                            <th class="text-end pe-4">Occurred</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentLogs as $log)
                        @php
                            // Decode meta to access user_agent
                            $meta = json_decode($log->meta, true);
                            $ua = $meta['user_agent'] ?? '';
                            
                            // Determine device icon
                            $isMobile = preg_match('/(android|iphone|ipad)/i', $ua);
                            $deviceIcon = $isMobile ? 'bi-phone' : 'bi-pc-display';
                        @endphp
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-dark">{{ $log->name }}</div>
                                <div class="small text-muted">{{ $log->email }}</div>
                            </td>
                            <td>
                                <span class="badge rounded-pill bg-light text-dark border px-3">
                                    {{ ucfirst($log->action) }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="bi {{ $deviceIcon }} me-2 text-primary"></i>
                                    <div class="small text-muted">
                                        {{-- Limit the user agent string so it doesn't stretch the table --}}
                                        <span title="{{ $ua }}">{{ Str::limit($ua, 25) }}</span>
                                        <br>
                                        <span style="font-size: 0.7rem;">IP: {{ $meta['ip'] ?? '0.0.0.0' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-end pe-4 text-muted small">
                                {{ $log->created_at->diffForHumans() }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Config common for all charts
    const commonOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } }
    };

    // 1. Logins per Day Chart
    new Chart(document.getElementById('loginsChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($loginsPerDay->pluck('date')) !!},
            datasets: [{
                data: {!! json_encode($loginsPerDay->pluck('total_logins')) !!},
                fill: true,
                backgroundColor: 'rgba(78, 115, 223, 0.1)',
                borderColor: '#4e73df',
                tension: 0.4,
                pointRadius: 4,
                borderWidth: 2,
            }]
        },
        options: commonOptions
    });

  

    // 3. Device Usage Chart (Height Corrected)
    new Chart(document.getElementById('deviceChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($deviceStats->pluck('device')) !!},
            datasets: [{
                data: {!! json_encode($deviceStats->pluck('count')) !!},
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
                borderRadius: 6,
                barThickness: 30
            }]
        },
        options: {
            ...commonOptions,
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(0, 0, 0, 0.05)' } },
                x: { grid: { display: false } }
            }
        }
    });
</script>
@endpush