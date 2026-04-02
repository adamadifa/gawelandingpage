@extends('layouts.admin')

@section('title', 'Verifikasi Pembayaran')

@section('content')
<div class="max-w-5xl mx-auto space-y-8 pb-20">
    {{-- Header Actions --}}
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.memberships.index') }}" class="group flex items-center gap-3 text-sm font-bold text-gray-400 hover:text-brand-600 transition-all uppercase tracking-widest">
            <div class="w-8 h-8 rounded-lg bg-white shadow-sm flex items-center justify-center group-hover:bg-brand-50 group-hover:text-brand-600 transition-all">
                <i class="ti ti-chevron-left text-lg"></i>
            </div>
            Kembali ke Daftar
        </a>
        <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-50">
            <span class="text-[10px] font-bold text-gray-300 uppercase tracking-[0.2em]">Transaction ID</span>
            <span class="text-sm font-bold text-brand-600">#{{ str_pad($membershipTransaction->id, 5, '0', STR_PAD_LEFT) }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        {{-- Left Side: Receipt Preview (Sticky) --}}
        <div class="lg:col-span-5 space-y-6 sticky top-24">
            <div class="flex items-center justify-between px-2">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest flex items-center gap-2">
                    <i class="ti ti-photo-check text-lg text-brand-600"></i>
                    Bukti Pembayaran
                </h3>
            </div>
            
            <div class="card-wow p-3 bg-white shadow-2xl shadow-black/5 group relative overflow-hidden ring-1 ring-gray-100">
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
            <p class="text-center text-[11px] text-gray-400 font-bold italic tracking-wide uppercase">NB: Periksa keaslian struk dengan teliti</p>
        </div>

        {{-- Right Side: Details & Actions --}}
        <div class="lg:col-span-7 space-y-8">
            {{-- Status Card --}}
            <div class="card-wow p-8 transition-all overflow-hidden relative">
                <div class="absolute top-0 right-0 p-4">
                    @if($membershipTransaction->status == 'pending')
                        <div class="w-3 h-3 bg-amber-500 rounded-full animate-ping"></div>
                    @endif
                </div>
                
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-6 flex items-center gap-2">
                    <i class="ti ti-info-circle text-lg text-brand-600"></i>
                    Detail Verifikasi
                </h3>

                <div class="space-y-8">
                    {{-- User Profile --}}
                    <div class="flex items-center gap-5 p-5 bg-gray-50/50 rounded-xl border border-gray-100/50">
                        <div class="w-16 h-16 rounded-xl bg-brand-600 flex items-center justify-center text-white text-2xl font-bold shadow-lg shadow-brand-200 border-4 border-white">
                            {{ substr($membershipTransaction->user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-0.5">Informasi Pemilik</p>
                            <p class="text-xl font-bold text-gray-900 leading-tight">{{ $membershipTransaction->user->name }}</p>
                            <p class="text-sm font-bold text-gray-500">{{ $membershipTransaction->user->email }}</p>
                        </div>
                    </div>

                    {{-- Plan Details --}}
                    <div class="grid grid-cols-2 gap-6 p-2">
                        <div class="space-y-1">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Paket Pilihan</p>
                            <p class="text-lg font-bold text-gray-900 leading-tight">{{ $membershipTransaction->pricingPlan->name }}</p>
                            <span class="inline-block text-[9px] font-bold bg-indigo-50 text-indigo-600 px-2 py-0.5 rounded-md uppercase tracking-widest mt-1">
                                {{ $membershipTransaction->plan_type }} Plan
                            </span>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Dana Diterima</p>
                            <div class="flex items-baseline gap-1">
                                <span class="text-xs font-bold text-gray-400 uppercase">Rp</span>
                                <p class="text-2xl font-bold text-gray-900">{{ number_format($membershipTransaction->amount) }}</p>
                            </div>
                            <p class="text-[10px] font-bold text-gray-400 italic">* Termasuk kode unik (jika ada)</p>
                        </div>
                    </div>

                    {{-- Current Status Badge --}}
                    <div class="pt-6 border-t border-gray-50">
                        <div class="flex items-center justify-between mb-4">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status Pengajuan</p>
                        </div>
                        <div class="flex">
                            @if($membershipTransaction->status == 'pending')
                                <div class="w-full bg-amber-50 border border-amber-100 rounded-xl p-4 flex items-center gap-4">
                                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-amber-600 shadow-sm shadow-amber-200/50">
                                        <i class="ti ti-loader-2 animate-spin text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-amber-700 leading-none mb-1 uppercase tracking-wider">Menunggu Aproval</p>
                                        <p class="text-[11px] font-medium text-amber-600/70">Silakan tinjau bukti transfer sebelum menyetujui.</p>
                                    </div>
                                </div>
                            @elseif($membershipTransaction->status == 'approved')
                                <div class="w-full bg-emerald-50 border border-emerald-100 rounded-xl p-4 flex items-center gap-4">
                                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-emerald-600 shadow-sm shadow-emerald-200/50">
                                        <i class="ti ti-discount-check-filled text-2xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-emerald-700 leading-none mb-1 uppercase tracking-wider">Transaksi Disetujui</p>
                                        <p class="text-[11px] font-medium text-emerald-600/70">Disetujui pada {{ $membershipTransaction->approved_at->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>
                            @else
                                <div class="w-full bg-rose-50 border border-rose-100 rounded-xl p-4 flex items-center gap-4">
                                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-rose-600 shadow-sm shadow-rose-200/50">
                                        <i class="ti ti-circle-x-filled text-2xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-rose-700 leading-none mb-1 uppercase tracking-wider">Transaksi Ditolak</p>
                                        <p class="text-[11px] font-medium text-rose-600/70">Cek alasan penolakan pada catatan admin.</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Section --}}
            @if($membershipTransaction->status == 'pending')
                <div class="card-wow p-10 bg-gray-900 border-none relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-brand-600/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
                    
                    <form id="action-form" action="" method="POST" class="space-y-6 relative z-10">
                        @csrf
                        <div class="space-y-3">
                            <label for="admin_note" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest pl-1">Catatan Internal (Opsional)</label>
                            <textarea name="admin_note" id="admin_note" rows="3" class="w-full bg-white/5 border-white/10 rounded-xl py-4 px-5 text-sm text-white focus:ring-2 focus:ring-brand-500/50 transition-all placeholder:text-gray-600" placeholder="Contoh: Bukti transfer valid atau alasan penolakan..."></textarea>
                        </div>
                        
                        <div class="pt-2">
                            <div class="flex flex-col sm:flex-row gap-4">
                                <button type="button" onclick="handleRejectAction()" class="flex-1 bg-white/5 border border-white/10 text-white hover:bg-rose-600 hover:border-rose-600 font-bold py-4 rounded-xl transition-all flex items-center justify-center gap-3 group">
                                    <i class="ti ti-circle-x text-xl transition-transform group-hover:rotate-90"></i>
                                    <span>Tolak Pembayaran</span>
                                </button>
                                <button type="button" onclick="handleApproveAction()" class="flex-1 bg-brand-600 hover:bg-brand-700 text-white font-bold py-4 rounded-xl transition-all shadow-xl shadow-brand-600/30 flex items-center justify-center gap-3 group">
                                    <i class="ti ti-shield-check text-xl transition-transform group-hover:scale-125"></i>
                                    <span>Setujui & Aktivasi</span>
                                </button>
                            </div>
                            <p class="text-center text-[10px] text-gray-500 font-bold mt-6 uppercase tracking-[0.2em] italic">Otoritas Manajemen Gawe &copy; 2026</p>
                        </div>
                    </form>
                </div>
            @elseif($membershipTransaction->admin_note)
                <div class="card-wow p-8 bg-white/50 border-gray-100">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                        <i class="ti ti-notes text-lg text-brand-600"></i>
                        Catatan Admin
                    </h3>
                    <div class="p-6 bg-gray-50 rounded-xl border border-gray-100">
                        <p class="text-sm font-bold text-gray-600 italic">"{{ $membershipTransaction->admin_note }}"</p>
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
