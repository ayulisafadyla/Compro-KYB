@extends('admin.layouts.app')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col">
        <h2 style="font-size: 22px; font-weight: 700; color: #1a1d29; margin-bottom: 4px;">Dashboard</h2>
        <p class="text-muted mb-0" style="font-size: 13px;">Welcome back, {{ Auth::user()->name ?? 'Admin' }}! Here's an overview of your content.</p>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0" style="background: linear-gradient(135deg, #eb0a1e 0%, #eb0a1e 100%); color: white;">
            <div class="card-body" style="padding: 20px;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-uppercase mb-1" style="font-size: 11px; font-weight: 600; opacity: 0.85; letter-spacing: 0.5px;">Total Products</p>
                        <h3 class="mb-1" style="font-size: 28px; font-weight: 700;">{{ \App\Models\Product::count() }}</h3>
                        <small style="opacity: 0.75; font-size: 12px;">
                            <i class="bi bi-check-circle me-1"></i>{{ \App\Models\Product::where('is_active', true)->count() }} Active
                        </small>
                    </div>
                    <div style="background: rgba(255,255,255,0.15); border-radius: 12px; padding: 12px;">
                        <i class="bi bi-box-seam" style="font-size: 24px;"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer border-0" style="background: rgba(0,0,0,0.1); padding: 10px 20px;">
                <a href="{{ route('admin.products.index') }}" class="text-white text-decoration-none" style="font-size: 12px; font-weight: 500;">
                    View All Products <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0" style="background: linear-gradient(135deg, #1a1d29 0%, #252a3a 100%); color: white;">
            <div class="card-body" style="padding: 20px;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-uppercase mb-1" style="font-size: 11px; font-weight: 600; opacity: 0.85; letter-spacing: 0.5px;">Total Categories</p>
                        <h3 class="mb-1" style="font-size: 28px; font-weight: 700;">{{ \App\Models\Category::count() }}</h3>
                        <small style="opacity: 0.75; font-size: 12px;">
                        <i class="bi bi-folder me-1"></i>{{ $totalCategory }} Categories
                        </small>
                    </div>
                    <div style="background: rgba(255,255,255,0.15); border-radius: 12px; padding: 12px;">
                        <i class="bi bi-tags" style="font-size: 24px;"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer border-0" style="background: rgba(0,0,0,0.1); padding: 10px 20px;">
                <a href="{{ route('admin.categories.index') }}" class="text-white text-decoration-none" style="font-size: 12px; font-weight: 500;">
                    View All Categories <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0" style="background: linear-gradient(135deg, #eb0a1e 0%, #eb0a1e 100%); color: white;">
            <div class="card-body" style="padding: 20px;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-uppercase mb-1" style="font-size: 11px; font-weight: 600; opacity: 0.85; letter-spacing: 0.5px;">Total Event</p>
                        <h3 class="mb-1" style="font-size: 28px; font-weight: 700;">{{ \App\Models\Event::count() }}</h3>
                        <small style="opacity: 0.75; font-size: 12px;">
                            <i class="bi bi-check-circle me-1"></i>{{ \App\Models\Event::where('is_published', true)->count() }} Event
                        </small>
                    </div>
                    <div style="background: rgba(255,255,255,0.15); border-radius: 12px; padding: 12px;">
                        <i class="bi bi-newspaper" style="font-size: 24px;"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer border-0" style="background: rgba(0,0,0,0.15); padding: 10px 20px;">
                <a href="{{ route('admin.events.index') }}" class="text-white text-decoration-none" style="font-size: 12px; font-weight: 500;">
                    View All Event <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Product Analytics Section -->
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
            <div class="card-header bg-white border-0 py-4 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width: 40px; height: 3px; background: #eb0a1e;"></div>
                        <h2 style="font-size: 20px; font-weight: 700; color: #1a1d29; margin: 0; text-transform: uppercase; letter-spacing: 1px;">PRODUK ANALYTICS</h2>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light rounded-pill px-3 border" type="button" disabled>
                            <i class="bi bi-calendar3 me-2"></i>Last 7 Days
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body px-4 pb-4">
                <div style="height: 350px; position: relative;">
                    <canvas id="productGrowthChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Activity Log at Bottom -->
<div class="row">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between bg-white border-0 py-3">
                <h5 class="mb-0" style="font-size: 15px; font-weight: 600;">
                    <i class="bi bi-clock-history me-2" style="color: #eb0a1e;"></i>Log Aktivitas Terkini
                </h5>
                <a href="{{ route('admin.logs.activity') }}" style="font-size: 12px; color: #eb0a1e; text-decoration: none;">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="font-size: 12px;">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Aksi</th>
                                <th>Modul</th>
                                <th>Deskripsi</th>
                                <th>Pengguna</th>
                                <th class="pe-4 text-end">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentActivities as $activity)
                                <tr>
                                    <td class="ps-4">
                                        <span class="badge {{ $activity->action == 'created' ? 'bg-success' : ($activity->action == 'updated' ? 'bg-info' : 'bg-danger') }}" style="font-size: 9px; min-width: 60px;">
                                            {{ strtoupper($activity->action) }}
                                        </span>
                                    </td>
                                    <td><span class="text-muted">{{ $activity->module }}</span></td>
                                    <td><span style="font-weight: 500;">{{ $activity->description }}</span></td>
                                    <td>{{ $activity->user->name ?? 'System' }}</td>
                                    <td class="pe-4 text-end text-muted">{{ $activity->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">Belum ada log aktivitas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('productGrowthChart').getContext('2d');

        const colors = [
            { border: '#eb0a1e', bg: 'rgba(235, 10, 30, 0.2)' }, 
            { border: '#1a1d29', bg: 'rgba(26, 29, 41, 0.2)' },
            { border: '#0d6efd', bg: 'rgba(13, 110, 253, 0.2)' },
            { border: '#198754', bg: 'rgba(25, 135, 84, 0.2)' },
            { border: '#ffc107', bg: 'rgba(255, 193, 7, 0.2)' },
            { border: '#6c757d', bg: 'rgba(108, 117, 125, 0.2)' }
        ];

        const chartData = {!! json_encode($chartData) !!};
        const categories = {!! json_encode($categories) !!};

        const datasets = categories.map((cat, index) => {
            const color = colors[index % colors.length];
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, color.bg);
            gradient.addColorStop(1, 'rgba(0, 0, 0, 0)');

            return {
                label: cat,
                data: chartData[cat],
                borderColor: color.border,
                backgroundColor: gradient,
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointBackgroundColor: color.border,
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            };
        });

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($days) !!},
                datasets: datasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                size: 12,
                                weight: '500'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1a1d29',
                        padding: 12,
                        titleFont: { size: 13 },
                        bodyFont: { size: 13 },
                        cornerRadius: 8,
                        displayColors: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            stepSize: 1,
                            font: { size: 11 }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: { size: 11 }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
    });
</script>
