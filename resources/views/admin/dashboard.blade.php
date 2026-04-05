@extends('layouts.admin')

@section('title', 'Dashboard overview')
@section('description', 'Pantau performa aplikasi dan statistik pengguna secara real-time.')

@section('content')
{{-- Stats Cards Grid --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    {{-- New Users --}}
    <div class="card-wow p-6 flex flex-col justify-between group hover:border-indigo-100 transition-all">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center">
                <i class="ti ti-users text-2xl"></i>
            </div>
            <div id="chart-users" class="w-20 h-10"></div>
        </div>
        <div>
            <p class="text-[13px] font-bold text-gray-400 uppercase tracking-wider mb-1">Total Members</p>
            <div class="flex items-end gap-3">
                <h3 class="text-2xl font-bold text-gray-900 leading-none">{{ number_format($business_stats['total_members']) }}</h3>
                <span class="text-[11px] font-bold text-gray-400 mb-0.5 uppercase tracking-tighter">Registered</span>
            </div>
        </div>
    </div>

    {{-- Active Users --}}
    <div class="card-wow p-6 flex flex-col justify-between group hover:border-emerald-100 transition-all">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
                <i class="ti ti-user-check text-2xl"></i>
            </div>
            <div id="chart-active" class="w-20 h-10"></div>
        </div>
        <div>
            <p class="text-[13px] font-bold text-gray-400 uppercase tracking-wider mb-1">Active Licenses</p>
            <div class="flex items-end gap-3">
                <h3 class="text-2xl font-bold text-gray-900 leading-none">{{ number_format($business_stats['active_licenses']) }}</h3>
                <span class="text-[11px] font-bold text-emerald-500 mb-0.5 uppercase tracking-tighter">Healthy</span>
            </div>
        </div>
    </div>

    {{-- Total Sales --}}
    <div class="card-wow p-6 flex flex-col justify-between group hover:border-amber-100 transition-all">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center">
                <i class="ti ti-shopping-cart text-2xl"></i>
            </div>
            <div id="chart-sales" class="w-20 h-10"></div>
        </div>
        <div>
            <p class="text-[13px] font-bold text-gray-400 uppercase tracking-wider mb-1">Total Revenue</p>
            <div class="flex items-end gap-3">
                <h3 class="text-xl font-bold text-gray-900 leading-none">Rp {{ number_format($business_stats['total_revenue']) }}</h3>
                <span class="text-[11px] font-bold text-brand-600 mb-0.5 uppercase tracking-tighter">Approved</span>
            </div>
        </div>
    </div>

    {{-- Total Profit --}}
    <div class="card-wow p-6 flex flex-col justify-between group hover:border-cyan-100 transition-all">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 bg-cyan-50 text-cyan-600 rounded-xl flex items-center justify-center">
                <i class="ti ti-coin text-2xl"></i>
            </div>
            <div id="chart-profit" class="w-20 h-10"></div>
        </div>
        <div>
            <p class="text-[13px] font-bold text-gray-400 uppercase tracking-wider mb-1">Pending Orders</p>
            <div class="flex items-end gap-3">
                <h3 class="text-2xl font-bold text-gray-900 leading-none">{{ number_format($business_stats['pending_orders']) }}</h3>
                <span class="text-[11px] font-bold text-amber-500 mb-0.5 uppercase tracking-tighter">Waiting</span>
            </div>
        </div>
    </div>
</div>

{{-- Main Charts Grid --}}
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    {{-- Revenue Growth --}}
    <div class="card-wow lg:col-span-8 p-8">
        <div class="flex justify-between items-center mb-10">
            <div>
                <h3 class="text-xl font-bold text-gray-900 leading-tight">Revenue Growth</h3>
                <p class="text-sm text-gray-400 mt-1 font-medium">Weekly Report</p>
            </div>
            <div class="text-right">
                <h4 class="text-2xl font-bold text-gray-900 leading-none mb-1">$50,000.00</h4>
                <span class="inline-block px-2 py-0.5 bg-emerald-50 text-emerald-600 text-[11px] font-bold rounded-md">$10k</span>
            </div>
        </div>
        <div id="revenue-chart" class="h-[350px]"></div>
    </div>

    {{-- Recent Transactions --}}
    <div class="card-wow lg:col-span-4 p-8">
        <div class="flex justify-between items-center mb-8">
            <h3 class="text-lg font-bold text-gray-900">Recent Activity</h3>
            <a href="{{ route('admin.memberships.index') }}" class="text-[10px] font-bold text-brand-600 uppercase tracking-widest hover:text-brand-700">View All</a>
        </div>

        <div class="space-y-6">
            @forelse($recent_transactions as $trx)
            <div class="flex items-start gap-4 group cursor-pointer">
                <div class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-brand-50 group-hover:text-brand-600 transition-all border border-gray-100 flex-shrink-0">
                    <i class="ti ti-receipt text-xl"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <div class="flex justify-between items-baseline gap-2">
                        <h4 class="text-[13px] font-bold text-gray-900 truncate leading-none mb-1.5 uppercase tracking-tight">{{ $trx->user->name }}</h4>
                        <span class="text-[9px] font-bold text-gray-400 whitespace-nowrap">{{ $trx->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-[10px] font-semibold text-gray-500">{{ $trx->pricingPlan->name }}</span>
                        <span class="w-1 h-1 bg-gray-200 rounded-full"></span>
                        <span class="text-[10px] font-bold {{ $trx->status == 'approved' ? 'text-emerald-500' : ($trx->status == 'pending' ? 'text-amber-500' : 'text-rose-500') }} uppercase tracking-widest">{{ $trx->status }}</span>
                    </div>
                </div>
            </div>
            @empty
            <div class="py-10 text-center">
                <i class="ti ti-inbox text-4xl text-gray-200 mb-3 block"></i>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">No activity</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

{{-- Second Row --}}
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mt-8">
    {{-- CMS Content Statistics --}}
    <div class="card-wow lg:col-span-12 p-8">
        <div class="flex justify-between items-center mb-10">
            <div>
                <h3 class="text-xl font-bold text-gray-900 leading-tight">Content Overview</h3>
                <p class="text-sm text-gray-400 mt-1 font-medium">Statistics for landing page components</p>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-5 gap-8">
            <div class="text-center p-6 bg-gray-50/50 rounded-2xl border border-gray-100/50">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 leading-none">Features</p>
                <h4 class="text-2xl font-bold text-gray-900 leading-none">{{ $cms_stats['features'] }}</h4>
            </div>
            <div class="text-center p-6 bg-gray-50/50 rounded-2xl border border-gray-100/50">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 leading-none">Plans</p>
                <h4 class="text-2xl font-bold text-gray-900 leading-none">{{ $cms_stats['plans'] }}</h4>
            </div>
            <div class="text-center p-6 bg-gray-50/50 rounded-2xl border border-gray-100/50">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 leading-none">FAQs</p>
                <h4 class="text-2xl font-bold text-gray-900 leading-none">{{ $cms_stats['faqs'] }}</h4>
            </div>
            <div class="text-center p-6 bg-gray-50/50 rounded-2xl border border-gray-100/50">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 leading-none">Clients</p>
                <h4 class="text-2xl font-bold text-gray-900 leading-none">{{ $cms_stats['companies'] }}</h4>
            </div>
            <div class="text-center p-6 bg-gray-50/50 rounded-2xl border border-gray-100/50">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 leading-none">Reviews</p>
                <h4 class="text-2xl font-bold text-gray-900 leading-none">{{ $cms_stats['testimonials'] }}</h4>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // General Chart Options
    const sparklineOptions = {
        chart: { type: 'area', sparkline: { enabled: true }, stroke: { curve: 'smooth', width: 2 } },
        fill: { opacity: 0.1 },
        tooltip: { enabled: false }
    };

    // User Sparkline
    new ApexCharts(document.querySelector("#chart-users"), {
        ...sparklineOptions,
        series: [{ data: [12, 14, 2, 47, 42, 15, 47] }],
        colors: ['#6366f1']
    }).render();

    // Active Sparkline
    new ApexCharts(document.querySelector("#chart-active"), {
        ...sparklineOptions,
        series: [{ data: [15, 75, 47, 65, 14, 32, 19] }],
        colors: ['#10b981']
    }).render();

    // Sales Sparkline
    new ApexCharts(document.querySelector("#chart-sales"), {
        ...sparklineOptions,
        series: [{ data: [47, 45, 74, 14, 56, 74, 14] }],
        colors: ['#f59e0b']
    }).render();

    // Profit Sparkline
    new ApexCharts(document.querySelector("#chart-profit"), {
        ...sparklineOptions,
        series: [{ data: [12, 47, 14, 2, 47, 75, 14] }],
        colors: ['#06b6d4']
    }).render();

    // Main Revenue Chart
    new ApexCharts(document.querySelector("#revenue-chart"), {
        chart: { height: 350, type: 'area', toolbar: { show: false }, zoom: { enabled: false } },
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 3 },
        series: [{ name: 'Revenue', data: @json($revenue_data) }],
        xaxis: { categories: @json($months) },
        colors: ['#6366f1'],
        fill: { gradient: { enabled: true, opacityFrom: 0.55, opacityTo: 0 } },
        yaxis: {
            labels: {
                formatter: function (val) {
                    return "Rp " + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
            }
        }
    }).render();
</script>
@endpush
@endsection
