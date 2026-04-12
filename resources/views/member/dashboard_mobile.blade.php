@extends('layouts.member_mobile')

@section('content')
<div x-data="{ openDetail: false, selectedTrx: null }" class="pb-10">
    
    {{-- Header Section --}}
    <section class="px-6 py-8 bg-white border-b border-gray-100 mb-6">
        <h2 class="text-2xl font-display font-bold text-gray-900 leading-tight">Overview</h2>
        <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-widest mt-1">Halo, {{ auth()->user()->name }}</p>
    </section>

    {{-- Stats Grid (Formal 3-Column) --}}
    <section class="px-6 mb-8">
        <div class="grid grid-cols-3 gap-3">
            <div class="card-formal p-4 text-center">
                <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Investasi</span>
                <span class="text-xs font-bold text-slate-900">Rp{{ number_format($totalSpent / 1000) }}K</span>
            </div>
            <div class="card-formal p-4 text-center">
                <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Lisensi</span>
                <span class="text-xs font-bold text-slate-900">{{ $activeCount }}</span>
            </div>
            <div class="card-formal p-4 text-center">
                <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Transaksi</span>
                <span class="text-xs font-bold text-slate-900">{{ $transactions->total() }}</span>
            </div>
        </div>
    </section>

    {{-- Active Licenses Section --}}
    <section class="px-6 space-y-4 mb-10">
        <div class="flex items-center justify-between pl-1">
            <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Layanan Aktif</h3>
        </div>

        <div class="space-y-4">
            @forelse($subscriptions as $sub)
                <div class="card-formal p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center text-primary">
                                @if($sub->pricingPlan->icon_type == 'image' && $sub->pricingPlan->icon)
                                    <img src="{{ asset('storage/' . $sub->pricingPlan->icon) }}" class="w-full h-full object-contain p-2.5">
                                @else
                                    <i class="ti ti-crown text-xl"></i>
                                @endif
                            </div>
                            <div class="space-y-0.5">
                                <h4 class="text-sm font-bold text-slate-900 tracking-tight">{{ $sub->pricingPlan->name }}</h4>
                                <div class="flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $sub->app_status == 'running' ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                                    <span class="text-[9px] font-medium text-slate-500 uppercase tracking-wide">Status: {{ ucfirst($sub->app_status ?: 'Offline') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="status-pill {{ $sub->status == 'active' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-50 text-slate-500' }}">
                            {{ $sub->status }}
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3 mb-6">
                        <div class="bg-slate-50/50 rounded-xl p-3 border border-slate-100">
                            <span class="text-[7px] font-bold text-slate-400 uppercase tracking-widest block mb-0.5">Berakhir</span>
                            <span class="text-[10px] font-bold text-slate-700">{{ \Carbon\Carbon::parse($sub->ends_at)->format('d M Y') }}</span>
                        </div>
                        <div class="bg-slate-50/50 rounded-xl p-3 border border-slate-100 flex justify-between items-center cursor-pointer active:bg-slate-100 transition-all" onclick="copyToClipboard('{{ $sub->license_code }}')">
                            <div>
                                <span class="text-[7px] font-bold text-slate-400 uppercase tracking-widest block mb-0.5">License Code</span>
                                <span class="text-[10px] font-bold text-primary truncate">{{ $sub->license_code }}</span>
                            </div>
                            <i class="ti ti-copy text-[10px] text-slate-300"></i>
                        </div>
                    </div>

                    <div class="flex gap-2.5">
                        <a href="{{ route('checkout.index', $sub->pricing_plan_id) }}?subscription_id={{ $sub->id }}" class="flex-1 py-3 bg-white text-slate-600 border border-slate-200 rounded-xl font-bold text-[9px] uppercase tracking-widest text-center active:bg-slate-50 transition-all">
                            Perpanjang
                        </a>
                        @if($sub->app_status == 'running' && $sub->app_url)
                            <a href="{{ $sub->app_url }}" target="_blank" class="flex-1 py-3 bg-primary text-white rounded-xl font-bold text-[9px] uppercase tracking-widest text-center shadow-sm shadow-emerald-200 active:bg-primary-700 transition-all">
                                Buka Aplikasi
                            </a>
                        @else
                            <button disabled class="flex-1 py-3 bg-slate-100 text-slate-400 rounded-xl font-bold text-[9px] uppercase tracking-widest opacity-60">
                                Pending
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="card-formal p-10 text-center">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-200">
                        <i class="ti ti-id-badge-off text-3xl"></i>
                    </div>
                    <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-widest mb-6">Belum ada layanan aktif</p>
                    <a href="{{ route('landing') }}#pricing" class="inline-block px-8 py-3 bg-primary text-white rounded-xl font-bold text-[9px] uppercase tracking-widest shadow-sm shadow-emerald-200 active:scale-95 transition-all">
                        Eksplor Paket
                    </a>
                </div>
            @endforelse
        </div>
    </section>

    {{-- Transactions Section --}}
    <section class="px-6 space-y-4">
        <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest pl-1">Riwayat Transaksi</h3>
        
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm divide-y divide-slate-100 overflow-hidden">
            @forelse($transactions as $trx)
                <div class="p-4 flex items-center justify-between active:bg-slate-50 transition-all"
                     @click="selectedTrx = {{ json_encode([
                         'id' => $trx->id,
                         'plan_name' => $trx->pricingPlan->name,
                         'amount' => number_format($trx->amount),
                         'status' => $trx->status,
                         'payment_proof' => $trx->payment_proof ? asset('storage/' . $trx->payment_proof) : null,
                         'admin_note' => $trx->admin_note,
                         'date' => $trx->created_at->format('d M Y'),
                         'time' => $trx->created_at->format('H:i'),
                     ]) }}; openDetail = true">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-slate-50 border border-slate-100 rounded-lg flex items-center justify-center text-slate-400">
                            @if($trx->pricingPlan->icon_type == 'image' && $trx->pricingPlan->icon)
                                <img src="{{ asset('storage/' . $trx->pricingPlan->icon) }}" class="w-full h-full object-cover p-1.5 rounded-lg">
                            @else
                                <i class="ti ti-receipt text-lg"></i>
                            @endif
                        </div>
                        <div>
                            <h5 class="text-xs font-bold text-slate-900 tracking-tight mb-0.5">{{ Str::limit($trx->pricingPlan->name, 20) }}</h5>
                            <p class="text-[8px] font-semibold text-slate-400 uppercase tracking-wider">{{ $trx->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xs font-bold text-slate-900 mb-1">Rp{{ number_format($trx->amount / 1000) }}K</p>
                        <span class="text-[7px] font-bold uppercase tracking-widest {{ $trx->status == 'approved' ? 'text-emerald-600' : ($trx->status == 'pending' ? 'text-amber-500' : 'text-rose-500') }}">
                            {{ ucfirst($trx->status) }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="py-10 text-center">
                    <p class="text-[9px] font-bold text-slate-300 uppercase tracking-widest">Tidak ada riwayat</p>
                </div>
            @endforelse
        </div>
    </section>

    {{-- Detail Drawer --}}
    <div x-show="openDetail" 
         x-cloak
         class="fixed inset-0 z-[100] flex items-end justify-center">
        <div x-show="openDetail"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             @click="openDetail = false" 
             class="absolute inset-0 bg-slate-900/40 backdrop-blur-[2px]"></div>
        
        <div x-show="openDetail"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-y-full"
             x-transition:enter-end="translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-y-0"
             x-transition:leave-end="translate-y-full"
             class="relative bg-white w-full rounded-t-3xl shadow-2xl p-8 pb-[calc(30px+var(--safe-bottom))] space-y-6">
            
            <div class="w-10 h-1 bg-slate-100 rounded-full mx-auto mb-2" @click="openDetail = false"></div>

            <div class="flex justify-between items-start">
                <div>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1.5 leading-none">Bukti Pembayaran</p>
                    <h3 class="text-lg font-bold text-slate-900 leading-none">#TRX-<span x-text="selectedTrx ? selectedTrx.id : ''"></span></h3>
                </div>
                <div :class="{
                         'bg-amber-50 text-amber-600': selectedTrx && selectedTrx.status === 'pending',
                         'bg-emerald-50 text-emerald-600': selectedTrx && selectedTrx.status === 'approved',
                         'bg-rose-50 text-rose-600': selectedTrx && selectedTrx.status === 'rejected'
                     }" class="status-pill" x-text="selectedTrx ? selectedTrx.status : ''"></div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                    <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Produk</span>
                    <span class="text-xs font-bold text-slate-900" x-text="selectedTrx ? selectedTrx.plan_name : ''"></span>
                </div>
                <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                    <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Nominal</span>
                    <span class="text-xs font-bold text-slate-900">Rp<span x-text="selectedTrx ? selectedTrx.amount : ''"></span></span>
                </div>
            </div>

            <template x-if="selectedTrx && selectedTrx.payment_proof">
                <div class="space-y-3">
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest pl-1">Attachment</p>
                    <div class="rounded-2xl overflow-hidden border border-slate-200 bg-slate-50 aspect-video relative">
                        <img :src="selectedTrx.payment_proof" class="w-full h-full object-contain">
                    </div>
                </div>
            </template>

            <button @click="openDetail = false" class="w-full py-4 bg-slate-900 text-white rounded-xl font-bold uppercase tracking-widest text-[9px] active:scale-[0.98] transition-all">
                Close Details
            </button>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            Swal.fire({
                title: 'Success!',
                text: 'Code copied to clipboard',
                icon: 'success',
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: false,
                background: '#ffffff',
                color: '#1E293B',
                iconColor: '#10B981',
            });
        });
    }
</script>
@endpush
