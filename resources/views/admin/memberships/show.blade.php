@extends('layouts.admin')

@section('title', 'Verifikasi Pembayaran')

@section('breadcrumbs')
<nav class="flex items-center gap-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest mb-1 font-poppins">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-brand-600 transition-colors">Dashboard</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <a href="{{ route('admin.memberships.index') }}" class="hover:text-brand-600 transition-colors">Membership</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <span class="text-brand-600 font-semibold tracking-widest">Detail Verifikasi</span>
</nav>
@endsection

@section('actions')
<div class="flex items-center gap-3 font-poppins">
    <div class="flex items-center gap-3 bg-white px-5 py-2.5 rounded-xl shadow-sm border border-gray-100">
        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Transaction ID</span>
        <span class="text-sm font-bold text-brand-600">#{{ str_pad($membershipTransaction->id, 5, '0', STR_PAD_LEFT) }}</span>
    </div>
</div>
@endsection

@section('content')
<div class="w-full -mt-6 space-y-6 pb-20 font-poppins text-inter max-w-5xl mx-auto">

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        {{-- Left Side: Receipt Preview (Sticky) --}}
        <div class="lg:col-span-5 space-y-6 sticky top-24">
            <div class="flex items-center justify-between px-2">
                <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest flex items-center gap-2">
                    <i class="ti ti-photo-check text-lg text-brand-600"></i>
                    Bukti Pembayaran
                </h3>
            </div>
            
            <div class="bg-white rounded-xl border border-gray-100 p-3 shadow-2xl shadow-black/5 group relative overflow-hidden ring-1 ring-gray-100/50">
                @if($membershipTransaction->payment_proof)
                    <div class="relative overflow-hidden rounded-xl aspect-[3/4] bg-gray-50">
                        <img src="{{ asset('storage/' . $membershipTransaction->payment_proof) }}" 
                             alt="Receipt" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        
                        <div class="absolute inset-0 bg-gray-900/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center backdrop-blur-[2px]">
                            <a href="{{ asset('storage/' . $membershipTransaction->payment_proof) }}" 
                               target="_blank" 
                               class="w-14 h-14 bg-white rounded-full flex items-center justify-center text-brand-600 shadow-2xl hover:scale-110 transition-transform">
                                <i class="ti ti-maximize text-2xl"></i>
                            </a>
                        </div>
                    </div>
                @else
                    <div class="aspect-[3/4] flex flex-col items-center justify-center bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                        <i class="ti ti-photo-off text-6xl text-gray-200 mb-4"></i>
                        <p class="text-sm font-bold text-gray-400 italic text-center px-8 text-balance">Lampiran bukti pembayaran tidak ditemukan oleh sistem.</p>
                    </div>
                @endif
            </div>
            <p class="text-center text-[10px] text-gray-400 font-bold italic tracking-widest uppercase">NB: Periksa keaslian struk dengan teliti</p>
        </div>

        {{-- Right Side: Details & Actions --}}
        <div class="lg:col-span-7 space-y-8">
            {{-- Status Card --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 transition-all overflow-hidden relative">
                <div class="absolute top-0 right-0 p-4">
                    @if($membershipTransaction->status == 'pending')
                        <div class="w-3 h-3 bg-amber-500 rounded-full animate-ping"></div>
                    @endif
                </div>
                
                <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-8 flex items-center gap-2">
                    <i class="ti ti-info-circle text-lg text-brand-600"></i>
                    Informasi Transaksi
                </h3>

                <div class="space-y-8">
                    {{-- User Profile --}}
                    <div class="flex items-center gap-5 p-6 bg-gray-50/50 rounded-xl border border-gray-100">
                        <div class="w-16 h-16 rounded-xl bg-brand-600 flex items-center justify-center text-white text-2xl font-bold shadow-lg shadow-brand-200 border-4 border-white ring-1 ring-brand-100">
                            {{ substr($membershipTransaction->user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 leading-none">Informasi Pemilik</p>
                            <p class="text-xl font-bold text-gray-900 leading-tight uppercase tracking-tight">{{ $membershipTransaction->user->name }}</p>
                            <p class="text-xs font-bold text-gray-400 mt-1">{{ $membershipTransaction->user->email }}</p>
                        </div>
                    </div>

                    {{-- Plan Details --}}
                    <div class="grid grid-cols-2 gap-6 p-2">
                        <div class="space-y-1">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Paket Pilihan</p>
                            <p class="text-lg font-bold text-gray-900 leading-tight uppercase tracking-tight">{{ $membershipTransaction->pricingPlan->name }}</p>
                            <span class="inline-block text-[9px] font-bold bg-brand-50 text-brand-600 px-2 py-0.5 rounded-lg border border-brand-100 uppercase tracking-widest mt-1">
                                {{ $membershipTransaction->plan_type }} Plan
                            </span>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Dana Diterima</p>
                            <div class="flex items-baseline gap-1">
                                <span class="text-xs font-bold text-gray-400 uppercase">Rp</span>
                                <p class="text-2xl font-bold text-gray-900 tracking-tight">{{ number_format($membershipTransaction->amount) }}</p>
                            </div>
                            <p class="text-[9px] font-bold text-gray-400 italic uppercase mt-1 leading-none tracking-wider opacity-60">* Termasuk kode unik (jika ada)</p>
                        </div>
                    </div>

                    {{-- Current Status Badge --}}
                    <div class="pt-8 border-t border-gray-50">
                        <div class="flex items-center justify-between mb-4">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status Pengajuan</p>
                        </div>
                        <div class="flex">
                            @if($membershipTransaction->status == 'pending')
                                <div class="w-full bg-amber-50 border border-amber-100 rounded-xl p-5 flex items-center gap-4">
                                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-amber-600 shadow-sm shadow-amber-200/50 border border-amber-50">
                                        <i class="ti ti-loader-2 animate-spin text-2xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-amber-700 leading-none mb-1.5 uppercase tracking-wider">Menunggu Aproval</p>
                                        <p class="text-[11px] font-bold text-amber-600/70 uppercase tracking-tight">Silakan tinjau bukti transfer sebelum menyetujui.</p>
                                    </div>
                                </div>
                            @elseif($membershipTransaction->status == 'approved')
                                <div class="w-full bg-emerald-50 border border-emerald-100 rounded-xl p-5 flex items-center gap-4">
                                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-emerald-600 shadow-sm shadow-emerald-200/50 border border-emerald-50">
                                        <i class="ti ti-discount-check-filled text-3xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-emerald-700 leading-none mb-1.5 uppercase tracking-wider">Transaksi Disetujui</p>
                                        <p class="text-[11px] font-bold text-emerald-600/70 uppercase tracking-tight">Disetujui pada {{ $membershipTransaction->approved_at->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>
                            @else
                                <div class="w-full bg-rose-50 border border-rose-100 rounded-xl p-5 flex items-center gap-4">
                                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-rose-600 shadow-sm shadow-rose-200/50 border border-rose-50">
                                        <i class="ti ti-circle-x-filled text-3xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-rose-700 leading-none mb-1.5 uppercase tracking-wider">Transaksi Ditolak</p>
                                        <p class="text-[11px] font-bold text-rose-600/70 uppercase tracking-tight">Cek alasan penolakan pada catatan admin.</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Section --}}
            @if($membershipTransaction->status == 'pending')

                <div class="bg-gray-900 rounded-xl border-none p-10 relative overflow-hidden shadow-2xl shadow-gray-900/40">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-brand-600/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
                    
                    <form id="action-form" action="" method="POST" class="space-y-8 relative z-10">
                        @csrf
                        <div class="space-y-6">
                            <div class="space-y-4">
                                <label for="app_url" class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest pl-1 leading-none mb-2">URL Aplikasi (Link App)</label>
                                <div class="relative group">
                                    <div class="absolute left-6 top-1/2 -translate-y-1/2 text-gray-600 group-focus-within:text-brand-500 transition-colors">
                                        <i class="ti ti-world-www text-xl"></i>
                                    </div>
                                    <input type="url" name="app_url" id="app_url" 
                                           class="w-full bg-white/5 border border-white/10 rounded-xl py-4 pl-14 pr-6 text-sm text-white focus:ring-4 focus:ring-brand-500/20 focus:border-brand-500 transition-all placeholder:text-gray-600 font-medium" 
                                           placeholder="https://client-gawe.domain.com">
                                </div>
                                <p class="text-[9px] font-bold text-gray-600 uppercase tracking-widest pl-1 italic">Kosongkan jika aplikasi belum siap / belum running.</p>
                            </div>

                            <div class="space-y-4">
                                <label for="admin_note" class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest pl-1">Catatan Internal (Opsional)</label>
                                <textarea name="admin_note" id="admin_note" rows="3" class="w-full bg-white/5 border border-white/10 rounded-xl py-4 px-6 text-sm text-white focus:ring-4 focus:ring-brand-500/20 focus:border-brand-500 transition-all placeholder:text-gray-600" placeholder="Contoh: Bukti transfer valid atau alasan penolakan..."></textarea>
                            </div>
                        </div>
                        
                        <div class="pt-2">
                            <div class="flex flex-col sm:flex-row gap-4">
                                <button type="button" onclick="handleRejectAction()" class="flex-1 bg-white/5 border border-white/10 text-white hover:bg-rose-600 hover:border-rose-600 font-bold py-4 rounded-xl transition-all flex items-center justify-center gap-3 group shadow-lg">
                                    <i class="ti ti-circle-x text-xl transition-transform group-hover:rotate-90"></i>
                                    <span class="uppercase tracking-widest text-xs">Tolak Pembayaran</span>
                                </button>
                                <button type="button" onclick="handleApproveAction()" class="flex-1 bg-brand-600 hover:bg-brand-700 text-white font-bold py-4 rounded-xl transition-all shadow-xl shadow-brand-600/40 flex items-center justify-center gap-3 group">
                                    <i class="ti ti-shield-check text-xl transition-transform group-hover:scale-125"></i>
                                    <span class="uppercase tracking-widest text-xs">Setujui & Aktivasi</span>
                                </button>
                            </div>
                            <p class="text-center text-[10px] text-gray-600 font-bold mt-8 uppercase tracking-[0.3em] italic opacity-50">Otoritas Manajemen Gawe &copy; 2026</p>
                        </div>
                    </form>
                </div>
            @elseif($membershipTransaction->status == 'approved' && $subscription)
                <div class="bg-gray-900 rounded-xl border-none p-10 relative overflow-hidden shadow-2xl shadow-gray-900/40">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-brand-600/10 rounded-full -mr-32 -mt-32 blur-3xl opacity-20"></div>
                    
                    <h3 class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em] mb-8 relative z-10">Konfigurasi Aplikasi Member</h3>
                    
                    <form action="{{ route('admin.memberships.update-subscription', $subscription->id) }}" method="POST" class="space-y-8 relative z-10">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <label for="app_status" class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest pl-1">Status Aplikasi</label>
                                <select name="app_status" id="app_status" class="w-full bg-white/5 border border-white/10 rounded-xl py-4 px-6 text-sm text-white focus:ring-4 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-bold tracking-widest appearance-none">
                                    <option value="pending" {{ $subscription->app_status == 'pending' ? 'selected' : '' }} class="bg-slate-800">PENDING (BELUM RUNNING)</option>
                                    <option value="running" {{ $subscription->app_status == 'running' ? 'selected' : '' }} class="bg-slate-800">RUNNING (AKTIF)</option>
                                    <option value="maintenance" {{ $subscription->app_status == 'maintenance' ? 'selected' : '' }} class="bg-slate-800">MAINTENANCE</option>
                                </select>
                            </div>
                            <div class="space-y-4">
                                <label for="app_url_update" class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest pl-1 leading-none mb-2">Update URL Aplikasi</label>
                                <div class="relative">
                                    <div class="absolute left-6 top-1/2 -translate-y-1/2 text-gray-600">
                                        <i class="ti ti-link text-xl"></i>
                                    </div>
                                    <input type="url" name="app_url" id="app_url_update" value="{{ $subscription->app_url }}"
                                           class="w-full bg-white/5 border border-white/10 rounded-xl py-4 pl-14 pr-6 text-sm text-white focus:ring-4 focus:ring-brand-500/20 focus:border-brand-500 transition-all placeholder:text-gray-600 font-bold" 
                                           placeholder="https://client.gawe.id">
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 gap-6">
                            <div class="flex-1">
                                @if($subscription->app_url)
                                    <a href="{{ $subscription->app_url }}" target="_blank" class="inline-flex items-center gap-2 text-brand-400 hover:text-brand-300 font-bold text-[10px] uppercase tracking-widest transition-colors">
                                        <i class="ti ti-external-link"></i> Kunjungi Aplikasi
                                    </a>
                                @else
                                    <span class="text-rose-500/60 font-bold text-[10px] uppercase tracking-widest"><i class="ti ti-unlink"></i> Link Belum Dihubungkan</span>
                                @endif
                            </div>
                            <button type="submit" class="bg-brand-600 hover:bg-brand-700 text-white font-bold py-3 px-8 rounded-xl transition-all shadow-lg flex items-center gap-2 text-xs uppercase tracking-widest">
                                <i class="ti ti-device-floppy"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            @if($membershipTransaction->admin_note)
                <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8">
                    <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-6 flex items-center gap-2">
                        <i class="ti ti-notes text-lg text-brand-600"></i>
                        Catatan Admin
                    </h3>
                    <div class="p-6 bg-gray-50/50 rounded-xl border border-gray-100">
                        <p class="text-sm font-bold text-gray-700 italic leading-relaxed">"{{ $membershipTransaction->admin_note }}"</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Script for handling actions with Custom Dialog --}}
<script>
    function handleApproveAction() {
        window.confirmDialog({
            title: 'Konfirmasi Aproval',
            message: 'Apakah Anda yakin bukti transfer sudah benar dan ingin mengaktifkan LISENSI GAWE untuk pengguna ini sekarang?',
            type: 'info',
            icon: 'ti ti-circle-check',
            callback: () => {
                const form = document.getElementById('action-form');
                form.action = "{{ route('admin.memberships.approve', $membershipTransaction->id) }}";
                form.submit();
            }
        });
    }

    function handleRejectAction() {
        const note = document.getElementById('admin_note').value;
        if(!note) {
            window.confirmDialog({
                title: 'Alasan Dibutuhkan',
                message: 'Silakan berikan alasan penolakan pada catatan admin sebelum menolak pembayaran ini.',
                type: 'warning',
                icon: 'ti ti-alert-triangle'
            });
            return;
        }

        window.confirmDialog({
            title: 'Konfirmasi Penolakan',
            message: 'Apakah Anda yakin ingin MENOLAK pembayaran ini? Tindakan ini akan mengirimkan notifikasi penolakan ke pengguna.',
            type: 'danger',
            icon: 'ti ti-trash-x',
            callback: () => {
                const form = document.getElementById('action-form');
                form.action = "{{ route('admin.memberships.reject', $membershipTransaction->id) }}";
                form.submit();
            }
        });
    }
</script>
@endsection
