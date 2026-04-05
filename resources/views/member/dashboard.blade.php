@extends('layouts.member')

@section('content')
<div x-data="{ openDetail: false, selectedTrx: null }">
    <div class="main-container mt-6">
        
        {{-- Welcome Section --}}
        <div class="mb-12 flex flex-col lg:flex-row lg:items-end justify-between gap-6">
            <div>
                <h1 class="text-3xl lg:text-4xl font-display font-bold text-gray-900 leading-tight tracking-tight">Halo, <span class="text-brand-600">{{ auth()->user()->name }}</span>!</h1>
                <p class="text-gray-400 mt-1 text-base font-medium">Kelola semua lisensi dan pantau histori paket bisnis anda.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('landing') }}#pricing" class="px-8 py-4 bg-brand-600 hover:bg-brand-700 text-white rounded-2xl font-display font-bold transition-all shadow-xl shadow-brand-600/20 active:scale-95 flex items-center gap-3 text-[10px] uppercase tracking-widest">
                    <i class="ti ti-plus text-lg"></i>
                    Beli Lisensi Baru
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
            <div class="bg-white rounded-2xl p-6 border border-gray-100/50 shadow-sm relative overflow-hidden group">
                <div class="absolute -right-4 -bottom-4 w-16 h-16 bg-brand-50 rounded-full opacity-40 group-hover:scale-150 transition-transform duration-700"></div>
                <div class="relative z-10">
                    <p class="text-[9px] font-bold text-gray-400 uppercase tracking-[0.15em] mb-2 leading-none">Total Investasi</p>
                    <h4 class="text-xl font-display font-bold text-gray-900 leading-none">Rp {{ number_format($totalSpent) }}</h4>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-gray-100/50 shadow-sm relative overflow-hidden group">
                <div class="absolute -right-4 -bottom-4 w-16 h-16 bg-emerald-50 rounded-full opacity-40 group-hover:scale-150 transition-transform duration-700"></div>
                <div class="relative z-10">
                    <p class="text-[9px] font-bold text-gray-400 uppercase tracking-[0.15em] mb-2 leading-none">Lisensi Aktif</p>
                    <h4 class="text-xl font-display font-bold text-gray-900 leading-none">{{ $activeCount }} <span class="text-[9px] font-semibold text-gray-400 ml-1 uppercase">Unit</span></h4>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-gray-100/50 shadow-sm relative overflow-hidden group">
                <div class="absolute -right-4 -bottom-4 w-16 h-16 bg-amber-50 rounded-full opacity-40 group-hover:scale-150 transition-transform duration-700"></div>
                <div class="relative z-10">
                    <p class="text-[9px] font-bold text-gray-400 uppercase tracking-[0.15em] mb-2 leading-none">Total Transaksi</p>
                    <h4 class="text-xl font-display font-bold text-gray-900 leading-none">{{ $transactions->total() }} <span class="text-[9px] font-semibold text-gray-400 ml-1 uppercase">Record</span></h4>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-gray-100/50 shadow-sm relative overflow-hidden group">
                <div class="absolute -right-4 -bottom-4 w-16 h-16 bg-slate-50 rounded-full opacity-40 group-hover:scale-150 transition-transform duration-700"></div>
                <div class="relative z-10">
                    <p class="text-[9px] font-bold text-gray-400 uppercase tracking-[0.15em] mb-2 leading-none">Tier Akun</p>
                    <h4 class="text-xl font-display font-bold text-gray-900 leading-none">
                        @if(auth()->user()->isAdmin())
                            SUPER <span class="text-[9px] font-semibold text-brand-500 uppercase">ADM</span>
                        @else
                            MEMBER <span class="text-[9px] font-semibold text-gray-400 uppercase tracking-widest">STD</span>
                        @endif
                    </h4>
                </div>
            </div>
        </div>

            <div class="grid lg:grid-cols-4 gap-10">
                {{-- Left Side: Profile & Licenses --}}
                <div class="lg:col-span-1 space-y-10">
                    
                    {{-- User Profile Card --}}
                    <div class="bg-white rounded-2xl p-6 border border-gray-100/50 shadow-sm space-y-6 relative overflow-hidden">
                        {{-- Decoration --}}
                        <div class="absolute -top-12 -right-12 w-32 h-32 bg-brand-50 rounded-full blur-3xl opacity-30"></div>
                        
                        <div class="relative z-10 flex flex-col items-center text-center">
                            <div class="w-16 h-16 bg-brand-50 rounded-2xl flex items-center justify-center text-brand-600 border border-brand-100/50 mb-4 shadow-inner overflow-hidden">
                                <span class="text-2xl font-display font-bold uppercase">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                            <h3 class="text-base font-bold text-gray-900 uppercase tracking-tight leading-none">{{ auth()->user()->name }}</h3>
                            <p class="text-[11px] text-gray-400 font-medium mt-1.5">{{ auth()->user()->email }}</p>
                            
                            <div class="mt-4 flex items-center gap-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[9px] font-bold uppercase tracking-widest bg-brand-50 text-brand-600 border border-brand-100/30">
                                    Member Account
                                </span>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-gray-50 space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Bergabung</span>
                                <span class="text-[10px] font-bold text-gray-700 tracking-tight">{{ auth()->user()->created_at->format('M Y') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Status</span>
                                <span class="text-[10px] font-bold {{ auth()->user()->email_verified_at ? 'text-emerald-600' : 'text-amber-600' }} uppercase tracking-tight">
                                    {{ auth()->user()->email_verified_at ? 'Terverifikasi' : 'Belum Verifikasi' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl p-10 border border-gray-100 shadow-xl space-y-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center text-brand-600 shadow-sm border border-gray-100/50">
                                <i class="ti ti-headset text-2xl"></i>
                            </div>
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Bantuan</h4>
                        </div>
                        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" target="_blank" class="flex items-center justify-between group p-6 bg-gray-50 rounded-2xl hover:bg-brand-50 transition-all border border-transparent hover:border-brand-100 active:scale-95">
                            <div class="flex items-center gap-4">
                                <div class="w-9 h-9 bg-white rounded-xl shadow-sm flex items-center justify-center text-brand-600 group-hover:scale-110 group-hover:rotate-6 transition-all border border-gray-100">
                                    <i class="ti ti-brand-whatsapp text-lg"></i>
                                </div>
                                <span class="text-[10px] font-bold text-gray-700 uppercase tracking-widest">WhatsApp</span>
                            </div>
                            <i class="ti ti-arrow-right text-gray-300 group-hover:text-brand-500 group-hover:translate-x-1 transition-all"></i>
                        </a>
                    </div>
                </div>

                {{-- Right Column: Active Services & History --}}
                <div class="lg:col-span-3 space-y-12">
                    
                    {{-- Active Licenses Section --}}
                    <div class="space-y-6">
                        <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest pl-1">Layanan Aktif ({{ $subscriptions->count() }})</h3>
                        
                        <div class="grid sm:grid-cols-2 gap-6">
                            @forelse($subscriptions as $sub)
                                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm relative overflow-hidden group transition-all duration-500 hover:shadow-lg">
                                    <div class="absolute -top-10 -right-10 w-24 h-24 bg-brand-50 rounded-full blur-2xl group-hover:bg-brand-100 transition-all duration-700"></div>
                                    
                                    <div class="relative z-10 space-y-6">
                                        <div class="flex justify-between items-start">
                                            <div class="w-12 h-12 bg-brand-600 rounded-xl flex items-center justify-center shadow-md shadow-brand-600/10">
                                                @if($sub->pricingPlan->icon_type == 'image' && $sub->pricingPlan->icon)
                                                    <img src="{{ asset('storage/' . $sub->pricingPlan->icon) }}" class="w-full h-full object-contain p-2 filter brightness-0 invert">
                                                @else
                                                    <i class="ti ti-crown text-xl text-white"></i>
                                                @endif
                                            </div>
                                            <span class="bg-brand-50 text-brand-600 px-3 py-1 rounded-full text-[8px] font-bold uppercase tracking-widest border border-brand-100/30">Active</span>
                                        </div>

                                        <div class="space-y-3">
                                            <div>
                                                <h4 class="text-base font-display font-bold text-gray-900 uppercase tracking-tight leading-none mb-1">{{ $sub->pricingPlan->name }}</h4>
                                                <p class="text-[9px] font-semibold text-brand-600 uppercase tracking-widest flex items-center gap-1.5 pl-0.5 mt-2">
                                                    Expiry: {{ \Carbon\Carbon::parse($sub->ends_at)->format('d M Y') }}
                                                </p>
                                            </div>

                                            {{-- App Status Indicator --}}
                                            <div class="bg-gray-50/80 rounded-xl p-3 border border-gray-100 flex items-center justify-between">
                                                <div class="flex items-center gap-2">
                                                    <div class="w-2 h-2 rounded-full {{ $sub->app_status == 'running' ? 'bg-emerald-500 animate-pulse' : ($sub->app_status == 'maintenance' ? 'bg-amber-500' : 'bg-slate-300') }}"></div>
                                                    <span class="text-[9px] font-bold uppercase tracking-[0.1em] {{ $sub->app_status == 'running' ? 'text-emerald-700' : ($sub->app_status == 'maintenance' ? 'text-amber-700' : 'text-slate-500') }}">
                                                        Status: {{ $sub->app_status == 'running' ? 'Running' : ($sub->app_status == 'maintenance' ? 'Maintenance' : 'Belum Running') }}
                                                    </span>
                                                </div>
                                                @if($sub->app_status == 'running' && $sub->app_url)
                                                    <a href="{{ $sub->app_url }}" target="_blank" class="text-[9px] font-bold text-brand-600 hover:text-brand-700 uppercase tracking-widest flex items-center gap-1 transition-colors">
                                                        Visit <i class="ti ti-external-link"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="bg-gray-50/50 rounded-xl p-3 flex items-center justify-between border border-gray-100/30 group/code cursor-pointer active:scale-95 transition-all shadow-sm" onclick="copyToClipboard('{{ $sub->license_code }}')">
                                            <div class="flex flex-col">
                                                <span class="text-[7px] font-bold text-gray-400 uppercase tracking-widest leading-none mb-1">License Code</span>
                                                <span class="text-[10px] font-display font-bold tracking-widest text-gray-800">{{ $sub->license_code }}</span>
                                            </div>
                                            <i class="ti ti-copy text-xs text-gray-300 group-hover/code:text-brand-600 transition-all"></i>
                                        </div>

                                        <div class="grid grid-cols-2 gap-3">
                                            <a href="{{ route('checkout.index', $sub->pricing_plan_id) }}?subscription_id={{ $sub->id }}" class="flex items-center justify-center bg-slate-100 hover:bg-slate-200 text-slate-900 font-bold py-3 px-2 rounded-xl transition-all active:scale-95 uppercase tracking-widest text-[7px] border border-gray-200/50">
                                                Perpanjang
                                            </a>
                                            @if($sub->app_status == 'running' && $sub->app_url)
                                                <a href="{{ $sub->app_url }}" target="_blank" class="flex items-center justify-center bg-brand-600 hover:bg-brand-700 text-white font-bold py-3 px-2 rounded-xl transition-all shadow-lg shadow-brand-600/20 active:scale-95 uppercase tracking-widest text-[7px]">
                                                    Buka Aplikasi
                                                </a>
                                            @else
                                                <button disabled class="flex items-center justify-center bg-gray-100 text-gray-400 font-bold py-3 px-2 rounded-xl uppercase tracking-widest text-[7px] cursor-not-allowed opacity-60">
                                                    Belum Running
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="sm:col-span-2 bg-white rounded-3xl p-12 border border-gray-100 shadow-xl text-center space-y-6">
                                    <div class="w-20 h-20 bg-gray-50 rounded-2xl flex items-center justify-center mx-auto text-gray-200">
                                        <i class="ti ti-id-badge-off text-4xl"></i>
                                    </div>
                                    <p class="text-xs text-gray-400 font-medium leading-relaxed px-4">Anda belum memiliki lisensi aktif. Mulai bisnis anda dengan memilih paket premium.</p>
                                    <a href="{{ route('landing') }}#pricing" class="inline-flex items-center justify-center bg-brand-600 text-white font-black px-12 py-4 rounded-2xl transition-all shadow-xl shadow-brand-600/20 active:scale-95 uppercase tracking-widest text-[10px]">
                                        Pilih Paket
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- Transaction History Section --}}
                    <div class="space-y-6">
                        <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest pl-1">Histori Pembayaran</h3>
                    
                    <div class="bg-white rounded-3xl border border-gray-100 shadow-xl overflow-hidden">
                        @if($transactions->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <thead>
                                        <tr class="bg-gray-50/50">
                                            <th class="px-10 py-8 text-[11px] font-bold text-gray-400 uppercase tracking-widest">Paket / Layanan</th>
                                            <th class="px-10 py-8 text-[11px] font-bold text-gray-400 uppercase tracking-widest">Total</th>
                                            <th class="px-10 py-8 text-[11px] font-bold text-gray-400 uppercase tracking-widest">Status</th>
                                            <th class="px-10 py-8 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-50">
                                        @foreach($transactions as $trx)
                                            <tr class="group hover:bg-gray-50/30 transition-all duration-300">
                                                <td class="px-8 py-6">
                                                    <div class="flex items-center gap-5">
                                                        <div class="w-11 h-11 bg-white border border-gray-100 rounded-xl flex items-center justify-center text-brand-600 transition-all group-hover:bg-brand-600 group-hover:text-white shadow-sm overflow-hidden">
                                                            @if($trx->pricingPlan->icon_type == 'image' && $trx->pricingPlan->icon)
                                                                <img src="{{ asset('storage/' . $trx->pricingPlan->icon) }}" class="w-full h-full object-cover p-2 group-hover:brightness-0 group-hover:invert transition-all">
                                                            @else
                                                                <i class="ti ti-crown text-lg"></i>
                                                            @endif
                                                        </div>
                                                        <div class="space-y-0.5">
                                                            <p class="text-[13px] font-bold text-gray-900 leading-none uppercase tracking-tight">{{ $trx->pricingPlan->name }}</p>
                                                            <p class="text-[9px] font-semibold text-brand-500/80 uppercase tracking-widest flex items-center gap-1.5">
                                                                {{ $trx->plan_type }} / {{ $trx->pricingPlan->duration_months ?? 1 }} Mo
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-8 py-6">
                                                    <p class="text-[13px] font-bold text-gray-900 leading-none uppercase tracking-tight">Rp {{ number_format($trx->amount) }}</p>
                                                </td>
                                                <td class="px-8 py-6">
                                                    @if($trx->status == 'pending')
                                                        <span class="inline-flex items-center gap-2 bg-amber-50 text-amber-600 border border-amber-100/30 px-3 py-1 rounded-full text-[8px] font-bold uppercase tracking-widest">
                                                            Verification
                                                        </span>
                                                    @elseif($trx->status == 'approved')
                                                        <span class="inline-flex items-center gap-2 bg-emerald-50 text-emerald-600 border border-emerald-100/30 px-3 py-1 rounded-full text-[8px] font-bold uppercase tracking-widest">
                                                            Successful
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center gap-2 bg-rose-50 text-rose-600 border border-rose-100/30 px-3 py-1 rounded-full text-[8px] font-bold uppercase tracking-widest">
                                                            Rejected
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="px-8 py-6 text-right">
                                                    <button 
                                                        @click="selectedTrx = {{ json_encode([
                                                            'id' => $trx->id,
                                                            'plan_name' => $trx->pricingPlan->name,
                                                            'amount' => number_format($trx->amount),
                                                            'status' => $trx->status,
                                                            'payment_proof' => $trx->payment_proof ? asset('storage/' . $trx->payment_proof) : null,
                                                            'admin_note' => $trx->admin_note,
                                                            'date' => $trx->created_at->format('d M Y H:i'),
                                                            'plan_type' => $trx->plan_type,
                                                        ]) }}; openDetail = true"
                                                        class="w-9 h-9 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-brand-600 hover:text-white transition-all shadow-sm active:scale-95">
                                                        <i class="ti ti-chevron-right text-base"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if($transactions->hasPages())
                                <div class="px-8 py-6 bg-gray-50/50 border-t border-gray-100">
                                    {{ $transactions->links() }}
                                </div>
                            @endif
                        @else
                            <div class="px-12 py-32 text-center space-y-8">
                                <div class="w-24 h-24 bg-gray-50 rounded-[2.5rem] flex items-center justify-center mx-auto text-gray-200 shadow-inner border border-gray-100/50">
                                    <i class="ti ti-receipt-off text-5xl"></i>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xl font-bold text-gray-900 uppercase tracking-widest">Belum Ada Transaksi</p>
                                    <p class="text-xs text-gray-400 font-medium tracking-wide">Semua rincian pembelian anda akan terekam otomatis di sini.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Transaction Detail Modal --}}
        <template x-if="openDetail && selectedTrx">
            <div class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6">
                <div @click="openDetail = false" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
                
                <div class="relative bg-white w-full max-w-lg rounded-[2.5rem] shadow-2xl overflow-hidden transform transition-all border border-gray-100"
                     x-show="openDetail"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-8 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100">
                    
                    <div class="p-8 sm:p-10 space-y-8">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 leading-none">Detail Transaksi</p>
                                <h3 class="text-xl font-display font-bold text-gray-900 leading-none">#TRX-<span x-text="selectedTrx.id"></span></h3>
                            </div>
                            <button @click="openDetail = false" class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-brand-50 hover:text-brand-600 transition-all border border-gray-100">
                                <i class="ti ti-x text-lg"></i>
                            </button>
                        </div>

                        <div class="space-y-4">
                            <div class="bg-gray-50/50 rounded-2xl p-6 border border-gray-100/50 space-y-4">
                                <div class="flex justify-between">
                                    <span class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Plan</span>
                                    <span class="text-sm font-bold text-gray-900" x-text="selectedTrx.plan_name"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Nominal</span>
                                    <span class="text-sm font-bold text-gray-900">Rp <span x-text="selectedTrx.amount"></span></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Status</span>
                                    <span class="px-3 py-1 rounded-full text-[9px] font-bold uppercase tracking-widest"
                                          :class="{
                                              'bg-amber-50 text-amber-600 border border-amber-100/50': selectedTrx.status === 'pending',
                                              'bg-emerald-50 text-emerald-600 border border-emerald-100/50': selectedTrx.status === 'approved',
                                              'bg-rose-50 text-rose-600 border border-rose-100/50': selectedTrx.status === 'rejected'
                                          }" x-text="selectedTrx.status"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Tanggal</span>
                                    <span class="text-sm font-bold text-gray-900" x-text="selectedTrx.date"></span>
                                </div>
                            </div>

                            <template x-if="selectedTrx.payment_proof">
                                <div class="space-y-3">
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest pl-1">Bukti Transfer</p>
                                    <div class="rounded-2xl overflow-hidden border border-gray-100 bg-gray-50 aspect-video group relative">
                                        <img :src="selectedTrx.payment_proof" class="w-full h-full object-contain">
                                        <a :href="selectedTrx.payment_proof" target="_blank" class="absolute inset-0 bg-brand-900/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center text-white backdrop-blur-sm">
                                            <i class="ti ti-external-link text-2xl"></i>
                                        </a>
                                    </div>
                                </div>
                            </template>

                            <template x-if="selectedTrx.admin_note">
                                <div class="p-4 bg-amber-50 rounded-xl border border-amber-100/30">
                                    <p class="text-[10px] font-bold text-amber-600 uppercase tracking-widest mb-1.5">Catatan Admin</p>
                                    <p class="text-xs text-amber-800 font-medium leading-relaxed" x-text="selectedTrx.admin_note"></p>
                                </div>
                            </template>
                        </div>

                        <button @click="openDetail = false" class="w-full py-4 bg-slate-900 text-white rounded-2xl font-bold uppercase tracking-widest text-[10px] shadow-xl shadow-slate-900/10 hover:bg-slate-800 active:scale-[0.98] transition-all">
                            Tutup Detail
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            Swal.fire({
                title: 'Berhasil!',
                text: 'License Code telah disalin!',
                icon: 'success',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#ffffff',
                color: '#111827',
                iconColor: '#16a34a',
            });
        });
    }
</script>
@endpush
