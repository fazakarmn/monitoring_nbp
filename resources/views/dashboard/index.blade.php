@extends('layouts.app')
@section('title', __('messages.dashboard'))

@section('content')

{{-- Page Header --}}
<div class="page-header">
    <h1 class="page-title">{{ __('messages.dashboard') }}</h1>
    <nav class="breadcrumb">
        <span class="current">{{ __('messages.dashboard') }}</span>
    </nav>
</div>

{{-- ── Stats Cards ── --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card-info">
            <span class="stat-label">{{ __('messages.total_order') }}</span>
            <span class="stat-value">{{ number_format($totalOrder) }}</span>
        </div>
        <div class="stat-icon orange"><img src="img/order.png" alt="Total Order"></div>
    </div>

    <div class="stat-card">
        <div class="stat-card-info">
            <span class="stat-label">{{ __('messages.total_done') }}</span>
            <span class="stat-value">{{ number_format($totalDone) }}</span>
        </div>
        <div class="stat-icon purple"><img src="img/check.png" alt="Total Done"></div>
    </div>

    <div class="stat-card">
        <div class="stat-card-info">
            <span class="stat-label">{{ __('messages.total_ongoing') }}</span>
            <span class="stat-value">{{ number_format($totalOnGoing) }}</span>
        </div>
        <div class="stat-icon green"><img src="img/ongoing.png" alt="Total On-Going"></div>
    </div>

    <div class="stat-card">
        <div class="stat-card-info">
            <span class="stat-label">{{ __('messages.total_pending') }}</span>
            <span class="stat-value">{{ number_format($totalPending) }}</span>
        </div>
        <div class="stat-icon pink"><img src="img/pending.png" alt="Total Pending"></div>
    </div>
</div>

{{-- ── Order Details Chart ── --}}
<div class="card">
    <div class="card-header">
        <h2 class="card-title">{{ __('messages.order_details') }}</h2>
        <select class="year-select" id="yearSelect">
            @foreach(range(2030, 2025) as $y)
            <option value="{{ $y }}" {{ $y == now()->year ? 'selected' : '' }}>{{ $y }}</option>
            @endforeach
        </select>
    </div>
    <div class="chart-container">
        <canvas id="orderChart"></canvas>
    </div>
</div>

{{-- ── Bottom Grid ── --}}
<div class="dash-bottom-grid">

    {{-- Last Activities --}}
    <div class="card" style="margin-bottom:0;">
        <div class="card-header">
            <h2 class="card-title">{{ __('messages.last_activities') }}</h2>
        </div>

        @if($activities->count())
            <div style="overflow-x:auto;">
                <table>
                    <thead>
                        <tr>
                            <th>{{ __('messages.name') }}</th>
                            <th>{{ __('messages.activities') }}</th>
                            <th>{{ __('messages.date_time') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activities as $log)
                        <tr>
                            <td>
                                <div style="display:flex; align-items:center; gap:8px;">
                                    <div class="activity-avatar" style="width:28px; height:28px; font-size:11px;">
                                        {{ strtoupper(substr($log->user->name, 0, 1)) }}
                                    </div>
                                    <span class="fw-600">{{ $log->user->name }}</span>
                                </div>
                            </td>
                            <td style="color:var(--text-mid);">{{ $log->activity }}</td>
                            <td style="color:var(--text-light); font-size:12px;">
                                {{ $log->created_at->format('d.m.Y - h:i A') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted text-sm" style="padding:16px 0;">{{ __('messages.no_activity') }}</p>
        @endif
    </div>

    {{-- Sales Analytics --}}
    <div class="card" style="margin-bottom:0;">
        <div class="card-header">
            <h2 class="card-title">{{ __('messages.sales_analytics') }}</h2>
        </div>
        <div class="chart-container-sm">
            <canvas id="salesChart"></canvas>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// ── Order Details Line Chart ──
const orderCtx = document.getElementById('orderChart').getContext('2d');

const orderGradient = orderCtx.createLinearGradient(0, 0, 0, 260);
orderGradient.addColorStop(0, 'rgba(0,191,255,0.25)');
orderGradient.addColorStop(1, 'rgba(0,191,255,0.00)');

const monthLabels = {!! json_encode(app()->getLocale() === 'id'
    ? ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des']
    : ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']) !!};

const orderChart = new Chart(orderCtx, {
    type: 'line',
    data: {
        labels: monthLabels,
        datasets: [{
            data: @json($monthlyData),
            borderColor: '#00BFFF',
            backgroundColor: orderGradient,
            borderWidth: 2,
            pointBackgroundColor: '#00BFFF',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverRadius: 6,
            fill: true,
            tension: 0.4,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: '#1A1D2E',
                titleColor: '#fff',
                bodyColor: '#9CA3AF',
                padding: 10,
                callbacks: {
                    label: ctx => ` {{ __('messages.orders_label') }}: ${ctx.parsed.y}`
                }
            }
        },
        scales: {
            x: {
                grid: { display: false },
                ticks: { color: '#9CA3AF', font: { size: 11 } }
            },
            y: {
                min: 0,
                grid: { color: '#F1F5F9', drawBorder: false },
                ticks: { color: '#9CA3AF', font: { size: 11 }, stepSize: 1, precision: 0 }
            }
        }
    }
});

// ── Year switcher: fetch monthly data via AJAX ──
document.getElementById('yearSelect').addEventListener('change', function () {
    const year = this.value;
    const url  = '{{ route("dashboard.chartData") }}?year=' + year;

    fetch(url, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(res => res.json())
    .then(json => {
        orderChart.data.datasets[0].data = json.data;
        orderChart.update();
    })
    .catch(err => console.error('Chart fetch error:', err));
});

// ── Sales Analytics Line Chart ──
const salesCtx = document.getElementById('salesChart').getContext('2d');

new Chart(salesCtx, {
    type: 'line',
    data: {
        labels: @json($salesYears),
        datasets: [{
            data: @json($salesData),
            borderColor: '#00BFFF',
            backgroundColor: 'transparent',
            borderWidth: 2.5,
            pointBackgroundColor: '#00BFFF',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverRadius: 6,
            tension: 0.45,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: '#1A1D2E',
                titleColor: '#fff',
                bodyColor: '#9CA3AF',
                padding: 10,
            }
        },
        scales: {
            x: {
                grid: { display: false },
                ticks: { color: '#9CA3AF', font: { size: 11 } }
            },
            y: {
                min: 0,
                grid: { color: '#F1F5F9' },
                ticks: { color: '#9CA3AF', font: { size: 11 }, stepSize: 1, precision: 0 }
            }
        }
    }
});
</script>
@endpush

