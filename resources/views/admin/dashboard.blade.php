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
            <p class="text-[13px] font-bold text-gray-400 uppercase tracking-wider mb-1">New Users</p>
            <div class="flex items-end gap-3">
                <h3 class="text-2xl font-bold text-gray-900 leading-none">15,000</h3>
                <span class="text-[13px] font-bold text-emerald-500 mb-0.5">+200 <i class="ti ti-trending-up"></i></span>
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
            <p class="text-[13px] font-bold text-gray-400 uppercase tracking-wider mb-1">Active Users</p>
            <div class="flex items-end gap-3">
                <h3 class="text-2xl font-bold text-gray-900 leading-none">8,000</h3>
                <span class="text-[13px] font-bold text-emerald-500 mb-0.5">+200 <i class="ti ti-trending-up"></i></span>
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
            <p class="text-[13px] font-bold text-gray-400 uppercase tracking-wider mb-1">Total Sales</p>
            <div class="flex items-end gap-3">
                <h3 class="text-2xl font-bold text-gray-900 leading-none">$5,00,000</h3>
                <span class="text-[13px] font-bold text-rose-500 mb-0.5">-$10k <i class="ti ti-trending-down"></i></span>
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
            <p class="text-[13px] font-bold text-gray-400 uppercase tracking-wider mb-1">Total Profit</p>
            <div class="flex items-end gap-3">
                <h3 class="text-2xl font-bold text-gray-900 leading-none">$3,00,700</h3>
                <span class="text-[13px] font-bold text-emerald-500 mb-0.5">+$15k <i class="ti ti-trending-up"></i></span>
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

    {{-- Campaigns --}}
    <div class="card-wow lg:col-span-4 p-8">
        <div class="flex justify-between items-center mb-10">
            <h3 class="text-xl font-bold text-gray-900">Campaigns</h3>
            <div class="bg-gray-50 border border-gray-100 px-3 py-1.5 rounded-lg text-xs font-bold text-gray-500 flex items-center gap-2 cursor-pointer hover:bg-gray-100">
                <span>Yearly</span>
                <i class="ti ti-chevron-down"></i>
            </div>
        </div>

        <div class="space-y-8">
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-orange-50 text-orange-500 flex items-center justify-center"><i class="ti ti-mail"></i></div>
                        <span class="text-sm font-bold text-gray-700 uppercase tracking-wide">Email</span>
                    </div>
                    <span class="text-sm font-bold text-gray-900">80%</span>
                </div>
                <div class="h-2 w-full bg-gray-50 rounded-full overflow-hidden">
                    <div class="h-full bg-orange-500 rounded-full" style="width: 80%"></div>
                </div>
            </div>

            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-500 flex items-center justify-center"><i class="ti ti-world"></i></div>
                        <span class="text-sm font-bold text-gray-700 uppercase tracking-wide">Website</span>
                    </div>
                    <span class="text-sm font-bold text-gray-900">80%</span>
                </div>
                <div class="h-2 w-full bg-gray-50 rounded-full overflow-hidden">
                    <div class="h-full bg-emerald-500 rounded-full" style="width: 80%"></div>
                </div>
            </div>

            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-500 flex items-center justify-center"><i class="ti ti-brand-facebook"></i></div>
                        <span class="text-sm font-bold text-gray-700 uppercase tracking-wide">Facebook</span>
                    </div>
                    <span class="text-sm font-bold text-gray-900">80%</span>
                </div>
                <div class="h-2 w-full bg-gray-50 rounded-full overflow-hidden">
                    <div class="h-full bg-indigo-600 rounded-full" style="width: 80%"></div>
                </div>
            </div>

            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-purple-50 text-purple-500 flex items-center justify-center"><i class="ti ti-mail-opened"></i></div>
                        <span class="text-sm font-bold text-gray-700 uppercase tracking-wide">Direct Mail</span>
                    </div>
                    <span class="text-sm font-bold text-gray-900">80%</span>
                </div>
                <div class="h-2 w-full bg-gray-50 rounded-full overflow-hidden">
                    <div class="h-full bg-purple-600 rounded-full" style="width: 80%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Second Row --}}
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mt-8">
    {{-- Earning Statistics --}}
    <div class="card-wow lg:col-span-12 p-8">
        <div class="flex justify-between items-center mb-10">
            <div>
                <h3 class="text-xl font-bold text-gray-900 leading-tight">Earning Statistic</h3>
                <p class="text-sm text-gray-400 mt-1 font-medium">Yearly earning overview</p>
            </div>
            <div class="bg-gray-50 border border-gray-100 px-3 py-1.5 rounded-lg text-xs font-bold text-gray-500 flex items-center gap-2 cursor-pointer hover:bg-gray-100">
                <span>Yearly</span>
                <i class="ti ti-chevron-down"></i>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-10">
            <div class="lg:col-span-2">
                <div id="earning-chart" class="h-[300px]"></div>
            </div>
            <div class="flex flex-col justify-center gap-10">
                <div class="flex items-center gap-5">
                    <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-gray-400 group hover:bg-indigo-50 hover:text-indigo-600 transition-all cursor-pointer">
                        <i class="ti ti-shopping-cart text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-400 text-[11px] font-bold uppercase tracking-widest mb-1">Sales</p>
                        <h4 class="text-2xl font-bold text-gray-900 leading-none">$200k</h4>
                    </div>
                </div>
                <div class="flex items-center gap-5">
                    <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-gray-400 group hover:bg-emerald-50 hover:text-emerald-600 transition-all cursor-pointer">
                        <i class="ti ti-chart-bar text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-400 text-[11px] font-bold uppercase tracking-widest mb-1">Income</p>
                        <h4 class="text-2xl font-bold text-gray-900 leading-none">$200k</h4>
                    </div>
                </div>
                <div class="flex items-center gap-5">
                    <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-gray-400 group hover:bg-amber-50 hover:text-amber-600 transition-all cursor-pointer">
                        <i class="ti ti-trending-up text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-400 text-[11px] font-bold uppercase tracking-widest mb-1">Profit</p>
                        <h4 class="text-2xl font-bold text-gray-900 leading-none">$200k</h4>
                    </div>
                </div>
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
        series: [{ name: 'Revenue', data: [31, 40, 28, 51, 42, 109, 100] }],
        xaxis: { categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'] },
        colors: ['#6366f1'],
        fill: { gradient: { enabled: true, opacityFrom: 0.55, opacityTo: 0 } },
    }).render();

    // Earning Stat Chart
    new ApexCharts(document.querySelector("#earning-chart"), {
        chart: { height: 300, type: 'line', toolbar: { show: false } },
        series: [{ name: 'Sales', type: 'column', data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30] }],
        stroke: { width: [0, 4] },
        labels: ['01 Jan', '02 Jan', '03 Jan', '04 Jan', '05 Jan', '06 Jan', '07 Jan', '08 Jan', '09 Jan', '10 Jan', '11 Jan'],
        colors: ['#6366f1'],
    }).render();
</script>
@endpush
@endsection
