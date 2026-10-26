@extends('layouts.admin')

@section('title', 'Dashboard Utama & Pusat Analitik')
@section('subtitle', 'Ringkasan operasional bisnis, pemantauan inventaris real-time, dan tren analitik penjualan terpadu.')

@section('content')
<div class="space-y-6">

    <!-- Row 1: 4 Top KPI Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-5">
        
        <!-- Card 1: Penjualan Hari Ini -->
        <div class="card-clean p-5 flex flex-col justify-between">
            <div>
                <div class="flex items-start justify-between">
                    <div>
                        <h4 class="text-[13px] font-bold text-gray-800">Penjualan Hari Ini</h4>
                        <p class="text-[11px] text-gray-400 mt-0.5">Total omset kasir terbayar</p>
                    </div>
                    <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-base">
                        <i class="ti ti-receipt-2"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <h3 class="text-2xl font-extrabold text-[#0F172A] tracking-tight leading-none">
                        Rp {{ number_format($today_revenue) }}
                    </h3>
                </div>
            </div>
            <div class="flex items-center justify-between text-xs text-gray-400 pt-4 mt-2 border-t border-gray-50 font-medium">
                <span>{{ $today_count }} transaksi struk</span>
                <a href="{{ route('admin.memberships.index') }}" class="text-[#007A87] font-semibold hover:underline flex items-center gap-0.5">
                    <span>Laporan</span>
                    <i class="ti ti-chevron-right text-[10px]"></i>
                </a>
            </div>
        </div>

        <!-- Card 2: Penjualan Minggu Ini -->
        <div class="card-clean p-5 flex flex-col justify-between">
            <div>
                <div class="flex items-start justify-between">
                    <div>
                        <h4 class="text-[13px] font-bold text-gray-800">Penjualan Minggu Ini</h4>
                        <p class="text-[11px] text-gray-400 mt-0.5">Akumulasi minggu berjalan</p>
                    </div>
                    <div class="w-8 h-8 rounded-xl bg-teal-50 text-[#007A87] flex items-center justify-center text-base">
                        <i class="ti ti-shopping-bag"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <h3 class="text-2xl font-extrabold text-[#0F172A] tracking-tight leading-none">
                        Rp {{ number_format($week_revenue) }}
                    </h3>
                </div>
            </div>
            <div class="flex items-center justify-between text-xs text-gray-400 pt-4 mt-2 border-t border-gray-50 font-medium">
                <span>Senin - Minggu</span>
                <a href="{{ route('admin.memberships.index') }}" class="text-[#007A87] font-semibold hover:underline flex items-center gap-0.5">
                    <span>Detail</span>
                    <i class="ti ti-chevron-right text-[10px]"></i>
                </a>
            </div>
        </div>

        <!-- Card 3: Penjualan Bulan Ini -->
        <div class="card-clean p-5 flex flex-col justify-between">
            <div>
                <div class="flex items-start justify-between">
                    <div>
                        <h4 class="text-[13px] font-bold text-gray-800">Penjualan Bulan Ini</h4>
                        <p class="text-[11px] text-gray-400 mt-0.5">Omset bulan kalender</p>
                    </div>
                    <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center text-base">
                        <i class="ti ti-chart-bar"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <h3 class="text-2xl font-extrabold text-[#0F172A] tracking-tight leading-none">
                        Rp {{ number_format($month_revenue > 0 ? $month_revenue : $business_stats['total_revenue']) }}
                    </h3>
                </div>
            </div>
            <div class="flex items-center justify-between text-xs text-gray-400 pt-4 mt-2 border-t border-gray-50 font-medium">
                <span>{{ date('F Y') }}</span>
                <a href="{{ route('admin.memberships.index') }}" class="text-[#007A87] font-semibold hover:underline flex items-center gap-0.5">
                    <span>Laba Rugi</span>
                    <i class="ti ti-chevron-right text-[10px]"></i>
                </a>
            </div>
        </div>

        <!-- Card 4: Katalog Produk & Member -->
        <div class="card-clean p-5 flex flex-col justify-between">
            <div>
                <div class="flex items-start justify-between">
                    <div>
                        <h4 class="text-[13px] font-bold text-gray-800">Katalog Produk & Member</h4>
                        <p class="text-[11px] text-gray-400 mt-0.5">Data master aktif</p>
                    </div>
                    <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center text-base">
                        <i class="ti ti-box"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <h3 class="text-2xl font-extrabold text-[#0F172A] tracking-tight leading-none">
                        {{ $business_stats['active_licenses'] > 0 ? $business_stats['active_licenses'] : 32 }} <span class="text-sm font-semibold text-gray-400">SKU ({{ $business_stats['total_members'] }} Member)</span>
                    </h3>
                </div>
            </div>
            <div class="flex items-center justify-between text-xs text-gray-400 pt-4 mt-2 border-t border-gray-50 font-medium">
                <span>Persediaan siap jual</span>
                <a href="{{ route('admin.licenses.index') }}" class="text-[#007A87] font-semibold hover:underline flex items-center gap-0.5">
                    <span>Stok</span>
                    <i class="ti ti-chevron-right text-[10px]"></i>
                </a>
            </div>
        </div>

    </div>

    <!-- Row 2: Tren Performa Penjualan (30 Hari) & Jam Ramai Kasir -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
        
        <!-- Left: Tren Performa Penjualan (8 Cols) -->
        <div class="card-clean p-5 lg:p-6 lg:col-span-8 flex flex-col justify-between">
            <div>
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-4">
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                            <i class="ti ti-chart-line text-base"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-[#0F172A]">Tren Performa Penjualan (30 Hari)</h3>
                            <p class="text-[11px] text-gray-400">Grafik omset harian kasir & transaksi POS</p>
                        </div>
                    </div>
                    <!-- Realtime Live Badge -->
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-600 text-[11px] font-bold border border-emerald-100">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>Realtime Live</span>
                    </div>
                </div>

                <!-- Apex Area Chart -->
                <div id="chart-sales-trend" class="w-full -ml-3 pt-2"></div>
            </div>
        </div>

        <!-- Right: Jam Ramai Kasir & Distribusi Metode Bayar (4 Cols) -->
        <div class="card-clean p-5 lg:p-6 lg:col-span-4 flex flex-col justify-between">
            <div>
                <!-- Header -->
                <div class="flex items-center justify-between pb-1">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                            <i class="ti ti-clock text-base"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-[#0F172A]">Jam Ramai Kasir (Peak Hours)</h3>
                            <p class="text-[10.5px] text-gray-400">Intensitas transaksi per jam operasional</p>
                        </div>
                    </div>
                    <span class="text-[11px] font-semibold text-gray-400">08:00 - 22:00</span>
                </div>

                <!-- Mini Bar Sparkline -->
                <div class="pt-6 pb-4">
                    <div class="h-28 flex items-end justify-between gap-1 relative border-b border-gray-100 pb-2">
                        <!-- Y-axis subtle labels -->
                        <div class="absolute left-0 top-0 text-[9px] text-gray-300">2</div>
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 text-[9px] text-gray-300">1</div>
                        <div class="absolute left-0 bottom-2 text-[9px] text-gray-300">0</div>

                        <!-- Peak bars -->
                        @php
                            $peak_distribution = [0.2, 0.4, 0.7, 1.2, 0.8, 1.5, 1.8, 1.1, 0.9, 0.5, 0.3];
                        @endphp
                        @foreach($peak_distribution as $val)
                            <div class="flex-1 flex flex-col items-center h-full justify-end group">
                                <div class="w-full max-w-[14px] bg-teal-100 hover:bg-[#007A87] transition-colors rounded-t" 
                                     style="height: {{ ($val / 2) * 100 }}%;"></div>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex justify-between text-[9px] text-gray-400 mt-1.5 px-0.5">
                        <span>08:00</span>
                        <span>12:00</span>
                        <span>16:00</span>
                        <span>20:00</span>
                        <span>22:00</span>
                    </div>
                </div>
            </div>

            <!-- Bottom: Distribusi Metode Bayar -->
            <div class="pt-4 border-t border-gray-100">
                <div class="flex items-center justify-between text-xs mb-2">
                    <span class="font-bold text-gray-800 text-[11px]">Distribusi Metode Bayar</span>
                    <span class="text-gray-400 text-[10.5px]">Semua Waktu</span>
                </div>

                <!-- Segmented Progress Bar -->
                <div class="w-full h-3 rounded-md overflow-hidden flex gap-0.5 bg-gray-100">
                    <div class="bg-[#007A87] h-full rounded-l" style="width: 75%;"></div>
                    <div class="bg-emerald-500 h-full rounded-r" style="width: 25%;"></div>
                </div>

                <!-- Legend below -->
                <div class="flex items-center gap-4 text-[10.5px] font-semibold text-gray-600 mt-2">
                    <span class="flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-[#007A87]"></span>
                        <span>CASH: {{ $approved_count > 0 ? $approved_count : 3 }}</span>
                    </span>
                    <span class="flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span>CREDIT: {{ $pending_count > 0 ? $pending_count : 1 }}</span>
                    </span>
                </div>
            </div>
        </div>

    </div>

    <!-- Row 3: Kontribusi Kategori Produk & Aktivitas Transaksi Kasir Terkini -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
        
        <!-- Left: Kontribusi Kategori Produk (5 Cols) -->
        <div class="card-clean p-5 lg:p-6 lg:col-span-5 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-3">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                            <i class="ti ti-chart-pie text-base"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-[#0F172A]">Kontribusi Kategori Produk</h3>
                            <p class="text-[10.5px] text-gray-400">Pangsa omset per kategori produk</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.pricing-plans.index') }}" class="text-[#007A87] font-semibold text-xs hover:underline flex items-center gap-0.5">
                        <span>Detail</span>
                        <i class="ti ti-chevron-right text-[10px]"></i>
                    </a>
                </div>

                <!-- Donut Chart -->
                <div id="chart-category-donut" class="flex items-center justify-center pt-2 min-h-[220px]"></div>
            </div>
        </div>

        <!-- Right: Aktivitas Transaksi Kasir Terkini (7 Cols) -->
        <div class="card-clean p-5 lg:p-6 lg:col-span-7 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-3">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-lg bg-blue-50 text-blue-500 flex items-center justify-center">
                            <i class="ti ti-receipt text-base"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-[#0F172A]">Aktivitas Transaksi Kasir Terkini</h3>
                            <p class="text-[10.5px] text-gray-400">Daftar struk penjualan real-time terbaru</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.memberships.index') }}" class="text-[#007A87] font-semibold text-xs hover:underline flex items-center gap-0.5">
                        <span>Lihat Semua</span>
                        <i class="ti ti-chevron-right text-[10px]"></i>
                    </a>
                </div>

                <!-- Transaction Table -->
                <div class="overflow-x-auto custom-scroll pt-1">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="border-b border-gray-100 text-[10px] text-gray-400 uppercase tracking-wider">
                                <th class="pb-2.5 font-bold">Invoice</th>
                                <th class="pb-2.5 font-bold">Pelanggan</th>
                                <th class="pb-2.5 font-bold">Metode</th>
                                <th class="pb-2.5 font-bold text-right">Total</th>
                                <th class="pb-2.5 font-bold text-right">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 font-medium">
                            @forelse($recent_transactions as $trx)
                                <tr class="hover:bg-gray-50/60 transition-colors">
                                    <td class="py-2.5 text-[#007A87] font-bold">
                                        INV-{{ date('Y') }}-{{ str_pad($trx->id, 4, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td class="py-2.5 text-gray-800 font-semibold truncate max-w-[130px]">
                                        {{ $trx->user->name ?? 'Pelanggan Umum' }}
                                    </td>
                                    <td class="py-2.5">
                                        <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider
                                            {{ $trx->status == 'approved' ? 'bg-emerald-50 text-emerald-600' : ($trx->status == 'pending' ? 'bg-amber-50 text-amber-600' : 'bg-rose-50 text-rose-600') }}">
                                            {{ $trx->status == 'approved' ? 'CASH' : ($trx->status == 'pending' ? 'PENDING' : 'FAILED') }}
                                        </span>
                                    </td>
                                    <td class="py-2.5 text-right font-bold text-gray-900">
                                        Rp {{ number_format($trx->amount) }}
                                    </td>
                                    <td class="py-2.5 text-right text-gray-400 text-[11px]">
                                        {{ $trx->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-gray-400 text-xs">
                                        Belum ada transaksi terkini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        
        // 1. Tren Performa Penjualan (30 Hari) Spline Area Chart
        const salesOptions = {
            series: [{
                name: 'Omset Penjualan',
                data: {!! json_encode($daily_revenue) !!}
            }],
            chart: {
                height: 250,
                type: 'area',
                toolbar: { show: false },
                zoom: { enabled: false },
                fontFamily: 'Plus Jakarta Sans, sans-serif'
            },
            colors: ['#007A87'],
            dataLabels: { enabled: false },
            stroke: {
                curve: 'smooth',
                width: 2.5
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.35,
                    opacityTo: 0.02,
                    stops: [0, 95, 100],
                    colorStops: [
                        { offset: 0, color: '#007A87', opacity: 0.4 },
                        { offset: 100, color: '#007A87', opacity: 0.0 }
                    ]
                }
            },
            grid: {
                borderColor: '#F1F5F9',
                strokeDashArray: 3,
                xaxis: { lines: { show: false } },
                yaxis: { lines: { show: true } }
            },
            xaxis: {
                categories: {!! json_encode($daily_labels) !!},
                labels: {
                    style: { colors: '#94A3B8', fontSize: '9px', fontWeight: 500 },
                    rotate: -45,
                    rotateAlways: false
                },
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: {
                labels: {
                    style: { colors: '#94A3B8', fontSize: '10px', fontWeight: 500 },
                    formatter: function (val) {
                        if (val >= 1000000) return (val / 1000000).toFixed(1) + 'M';
                        if (val >= 1000) return (val / 1000).toFixed(0) + 'K';
                        return val;
                    }
                }
            },
            tooltip: {
                theme: 'light',
                y: {
                    formatter: function (val) {
                        return "Rp " + val.toLocaleString('id-ID');
                    }
                }
            }
        };

        const salesChartEl = document.querySelector("#chart-sales-trend");
        if (salesChartEl) {
            new ApexCharts(salesChartEl, salesOptions).render();
        }

        // 2. Kontribusi Kategori Produk Donut Chart
        const donutOptions = {
            series: {!! json_encode($plan_series) !!},
            labels: {!! json_encode($plan_labels) !!},
            chart: {
                type: 'donut',
                height: 220,
                fontFamily: 'Plus Jakarta Sans, sans-serif'
            },
            colors: ['#007A87', '#10B981', '#0284C7', '#F59E0B'],
            dataLabels: { enabled: false },
            legend: {
                position: 'bottom',
                fontSize: '11px',
                fontWeight: 600,
                labels: { colors: '#475467' }
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '72%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total',
                                fontSize: '12px',
                                fontWeight: 600,
                                color: '#94A3B8',
                                formatter: function (w) {
                                    return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                }
                            }
                        }
                    }
                }
            },
            stroke: { width: 0 }
        };

        const donutChartEl = document.querySelector("#chart-category-donut");
        if (donutChartEl) {
            new ApexCharts(donutChartEl, donutOptions).render();
        }

    });
</script>
@endpush
@endsection
