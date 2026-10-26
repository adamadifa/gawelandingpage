@extends('layouts.admin')

@section('title', 'Verifikasi Transaksi #' . str_pad($membershipTransaction->id, 5, '0', STR_PAD_LEFT))
@section('subtitle', 'Tinjau bukti pembayaran, verifikasi keabsahan dana, dan kelola lisensi keanggotaan pengguna.')

@section('breadcrumbs')
<div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white border border-[#E2E8F0]/70 text-xs text-[#64748B] shadow-2xs font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#007A87] flex items-center gap-1">
        <i class="ti ti-home text-sm"></i>
        <span>Dashboard</span>
    </a>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <a href="{{ route('admin.memberships.index') }}" class="hover:text-[#007A87]">
        <span>Pelanggan & Member</span>
    </a>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <span class="text-[#0F172A] font-semibold">#TRX-{{ str_pad($membershipTransaction->id, 5, '0', STR_PAD_LEFT) }}</span>
</div>
@endsection

@section('actions')
<a href="{{ route('admin.memberships.index') }}" 
   class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 text-xs font-bold shadow-2xs transition-all">
    <i class="ti ti-arrow-left text-sm"></i>
    <span>Kembali ke Daftar</span>
</a>
@endsection

@section('content')
<div class="space-y-6">

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- Left Column: Bukti Pembayaran / Struk (5 Cols) -->
        <div class="lg:col-span-5 space-y-4 lg:sticky lg:top-24">
            
            <div class="card-clean p-5">
                <div class="flex items-center justify-between pb-3 mb-3 border-b border-gray-100">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                            <i class="ti ti-receipt text-base"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-[#0F172A]">Bukti Pembayaran</h3>
                            <p class="text-[11px] text-gray-400">Lampiran transfer member</p>
                        </div>
                    </div>

                    @if($membershipTransaction->payment_proof)
                        <a href="{{ asset('storage/' . $membershipTransaction->payment_proof) }}" 
                           target="_blank" 
                           class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-teal-50 hover:bg-teal-100 text-[#007A87] text-[11px] font-bold transition-all">
                            <i class="ti ti-external-link text-xs"></i>
                            <span>Buka Asli</span>
                        </a>
                    @endif
                </div>

                <!-- Preview Area -->
                <div class="rounded-xl overflow-hidden bg-slate-50 border border-gray-200/80 group relative flex items-center justify-center">
                    @if($membershipTransaction->payment_proof)
                        <div class="relative w-full overflow-hidden bg-slate-900/5">
                            <img src="{{ asset('storage/' . $membershipTransaction->payment_proof) }}" 
                                 alt="Bukti Transfer" 
                                 class="w-full h-auto max-h-[460px] object-contain mx-auto transition-transform duration-300 group-hover:scale-[1.02]">
                            
                            <!-- Overlay Hover Action -->
                            <div class="absolute inset-0 bg-slate-900/30 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-2xs">
                                <a href="{{ asset('storage/' . $membershipTransaction->payment_proof) }}" 
                                   target="_blank" 
                                   class="px-4 py-2 bg-white text-gray-800 rounded-xl text-xs font-bold shadow-lg flex items-center gap-2 hover:bg-teal-50 hover:text-[#007A87] transition-all">
                                    <i class="ti ti-zoom-in text-base"></i>
                                    <span>Lihat Ukuran Penuh</span>
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="py-16 px-6 text-center">
                            <div class="w-14 h-14 rounded-2xl bg-gray-100 flex items-center justify-center mx-auto text-gray-400 text-3xl mb-3">
                                <i class="ti ti-receipt-off"></i>
                            </div>
                            <h4 class="text-xs font-bold text-gray-700">Tidak Ada Bukti Transfer</h4>
                            <p class="text-[11px] text-gray-400 mt-1 max-w-[220px] mx-auto">
                                Pengguna belum melampirkan berkas bukti pembayaran untuk transaksi ini.
                            </p>
                        </div>
                    @endif
                </div>

                <div class="mt-3.5 p-3 rounded-xl bg-slate-50 border border-gray-100 flex items-start gap-2.5">
                    <i class="ti ti-info-circle text-[#007A87] text-base shrink-0 mt-0.5"></i>
                    <p class="text-[11px] text-gray-500 leading-relaxed">
                        Harap cocokkan nama pengirim, bank tujuan, dan nominal transfer dengan mutasi rekening sebelum melakukan persetujuan.
                    </p>
                </div>
            </div>

        </div>

        <!-- Right Column: Detail Transaksi & Formulir Aksi (7 Cols) -->
        <div class="lg:col-span-7 space-y-5">
            
            <!-- Card 1: Informasi Status & Rincian Transaksi -->
            <div class="card-clean p-5 lg:p-6 space-y-5">
                
                <!-- Status Banner Top -->
                @if($membershipTransaction->status == 'pending')
                    <div class="p-4 rounded-xl bg-amber-50 border border-amber-200/80 flex items-start gap-3">
                        <div class="w-9 h-9 rounded-xl bg-white border border-amber-200 text-amber-600 flex items-center justify-center shrink-0 shadow-2xs">
                            <i class="ti ti-clock text-xl animate-pulse"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <h4 class="text-xs font-bold text-amber-800 uppercase tracking-wider">Menunggu Verifikasi Admin</h4>
                                <span class="w-2 h-2 rounded-full bg-amber-500 animate-ping"></span>
                            </div>
                            <p class="text-xs text-amber-700/80 mt-0.5">
                                Bukti transfer siap diverifikasi. Anda dapat menyetujui untuk menerbitkan lisensi atau menolak transaksi.
                            </p>
                        </div>
                    </div>
                @elseif($membershipTransaction->status == 'approved')
                    <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200/80 flex items-start gap-3">
                        <div class="w-9 h-9 rounded-xl bg-white border border-emerald-200 text-emerald-600 flex items-center justify-center shrink-0 shadow-2xs">
                            <i class="ti ti-circle-check text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-xs font-bold text-emerald-800 uppercase tracking-wider">Transaksi Telah Disetujui</h4>
                            <p class="text-xs text-emerald-700/80 mt-0.5">
                                Disetujui pada {{ $membershipTransaction->approved_at ? $membershipTransaction->approved_at->format('d M Y, H:i') : '-' }} WIB. Lisensi member telah aktif.
                            </p>
                        </div>
                    </div>
                @else
                    <div class="p-4 rounded-xl bg-rose-50 border border-rose-200/80 flex items-start gap-3">
                        <div class="w-9 h-9 rounded-xl bg-white border border-rose-200 text-rose-600 flex items-center justify-center shrink-0 shadow-2xs">
                            <i class="ti ti-alert-triangle text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-xs font-bold text-rose-800 uppercase tracking-wider">Transaksi Ditolak</h4>
                            <p class="text-xs text-rose-700/80 mt-0.5">
                                Transaksi ini telah dibatalkan atau ditolak. Pengguna menerima notifikasi penolakan.
                            </p>
                        </div>
                    </div>
                @endif

                <!-- User Profile Header -->
                <div class="flex items-center gap-3.5 p-4 rounded-xl bg-[#F8FAFC] border border-[#F1F5F9]">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-[#005B60] to-[#007A87] text-white flex items-center justify-center font-bold text-lg shadow-sm">
                        {{ substr($membershipTransaction->user->name, 0, 1) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center gap-2">
                            <h4 class="font-bold text-sm text-[#0F172A] truncate">{{ $membershipTransaction->user->name }}</h4>
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-slate-100 text-slate-600 border border-slate-200">
                                ID: #USR-{{ $membershipTransaction->user->id }}
                            </span>
                        </div>
                        <p class="text-xs text-gray-400 mt-0.5 truncate">{{ $membershipTransaction->user->email }}</p>
                    </div>
                </div>

                <!-- Transaction Details Grid -->
                <div>
                    <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Rincian Pembelian & Paket</h4>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        
                        <div class="p-3.5 rounded-xl border border-gray-100 bg-white">
                            <span class="text-[10.5px] font-bold text-gray-400 uppercase">Nomor Transaksi</span>
                            <p class="text-sm font-bold text-gray-900 mt-0.5 font-mono">
                                #TRX-{{ str_pad($membershipTransaction->id, 5, '0', STR_PAD_LEFT) }}
                            </p>
                        </div>

                        <div class="p-3.5 rounded-xl border border-gray-100 bg-white">
                            <span class="text-[10.5px] font-bold text-gray-400 uppercase">Waktu Pengajuan</span>
                            <p class="text-xs font-semibold text-gray-800 mt-1">
                                {{ $membershipTransaction->created_at->format('d M Y, H:i') }} WIB
                            </p>
                        </div>

                        <div class="p-3.5 rounded-xl border border-gray-100 bg-white">
                            <span class="text-[10.5px] font-bold text-gray-400 uppercase">Paket & Tipe Durasi</span>
                            <div class="flex items-center gap-1.5 mt-1">
                                <span class="px-2 py-0.5 rounded text-[11px] font-bold uppercase bg-teal-50 text-[#007A87] border border-teal-200/60">
                                    {{ $membershipTransaction->pricingPlan->name ?? 'Paket' }}
                                </span>
                                <span class="px-2 py-0.5 rounded text-[11px] font-bold uppercase bg-purple-50 text-purple-600 border border-purple-200/60">
                                    {{ $membershipTransaction->plan_type === 'yearly' ? 'Tahunan' : 'Bulanan' }}
                                </span>
                            </div>
                        </div>

                        <div class="p-3.5 rounded-xl border border-gray-100 bg-white">
                            <span class="text-[10.5px] font-bold text-gray-400 uppercase">Total Dana Diterima</span>
                            <p class="text-base font-extrabold text-[#007A87] mt-0.5">
                                Rp {{ number_format($membershipTransaction->amount) }}
                            </p>
                        </div>

                    </div>
                </div>

                <!-- Admin Note (If exists) -->
                @if($membershipTransaction->admin_note)
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-gray-200/80">
                        <span class="text-[10.5px] font-bold text-gray-400 uppercase flex items-center gap-1">
                            <i class="ti ti-notes text-gray-500"></i>
                            <span>Catatan Admin Sebelumnya</span>
                        </span>
                        <p class="text-xs text-gray-700 italic mt-1 font-medium">
                            "{{ $membershipTransaction->admin_note }}"
                        </p>
                    </div>
                @endif

            </div>

            <!-- Card 2: Aksi Persetujuan / Penolakan (Pending Mode) -->
            @if($membershipTransaction->status == 'pending')
                <div class="card-clean p-5 lg:p-6 border-teal-100">
                    <div class="flex items-center gap-2 pb-3 mb-4 border-b border-gray-100">
                        <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                            <i class="ti ti-shield-check text-base"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-[#0F172A]">Tindakan Verifikasi</h3>
                            <p class="text-[11px] text-gray-400">Persetujuan dana & aktivasi lisensi otomatis</p>
                        </div>
                    </div>

                    <form id="action-form" action="" method="POST" class="space-y-4">
                        @csrf
                        
                        <!-- URL Aplikasi -->
                        <div>
                            <label for="app_url" class="block text-xs font-bold text-gray-700 mb-1">
                                URL Aplikasi Client <span class="text-gray-400 font-normal">(Opsional)</span>
                            </label>
                            <div class="relative">
                                <i class="ti ti-world text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2 text-sm"></i>
                                <input type="url" 
                                       name="app_url" 
                                       id="app_url" 
                                       placeholder="https://app.client-domain.com" 
                                       class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 pl-9 pr-3 text-xs text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                            </div>
                            <p class="text-[10.5px] text-gray-400 mt-1">Kosongkan apabila sistem client belum running / diinstal.</p>
                        </div>

                        <!-- Catatan Admin -->
                        <div>
                            <label for="admin_note" class="block text-xs font-bold text-gray-700 mb-1">
                                Catatan Admin <span class="text-gray-400 font-normal">(Wajib jika menolak)</span>
                            </label>
                            <textarea name="admin_note" 
                                      id="admin_note" 
                                      rows="2" 
                                      placeholder="Contoh: Bukti transfer terverifikasi valid, atau alasan penolakan..." 
                                      class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl p-3 text-xs text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all"></textarea>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row items-center gap-3 pt-2">
                            <button type="button" 
                                    onclick="handleRejectAction()" 
                                    class="w-full sm:w-1/2 px-4 py-2.5 rounded-xl border border-rose-200 bg-rose-50 hover:bg-rose-600 hover:text-white text-rose-700 font-bold text-xs transition-all flex items-center justify-center gap-2">
                                <i class="ti ti-x text-sm"></i>
                                <span>Tolak Pembayaran</span>
                            </button>

                            <button type="button" 
                                    onclick="handleApproveAction()" 
                                    class="w-full sm:w-1/2 px-4 py-2.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white font-bold text-xs shadow-sm shadow-[#007A87]/20 transition-all flex items-center justify-center gap-2">
                                <i class="ti ti-check text-sm"></i>
                                <span>Setujui & Terbitkan Lisensi</span>
                            </button>
                        </div>

                    </form>
                </div>

            <!-- Card 2: Pengaturan Lisensi & Aplikasi (Approved Mode) -->
            @elseif($membershipTransaction->status == 'approved' && $subscription)
                <div class="card-clean p-5 lg:p-6 space-y-4">
                    <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                        <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                            <i class="ti ti-key text-base"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-[#0F172A]">Lisensi & Konfigurasi Aplikasi</h3>
                            <p class="text-[11px] text-gray-400">Kelola status dan URL aplikasi langganan</p>
                        </div>
                    </div>

                    <!-- License Code Badge -->
                    <div class="p-3.5 rounded-xl bg-teal-50/60 border border-teal-200/80 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div>
                            <span class="text-[10px] font-bold text-teal-800 uppercase tracking-wider block">Kode Lisensi Gawe</span>
                            <span class="font-mono font-bold text-sm text-[#007A87] mt-0.5 block">
                                {{ $subscription->license_code }}
                            </span>
                        </div>
                        <div class="text-left sm:text-right">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Masa Berlaku</span>
                            <span class="text-xs font-semibold text-gray-700 mt-0.5 block">
                                {{ $subscription->starts_at->format('d/m/Y') }} – {{ $subscription->ends_at->format('d/m/Y') }}
                            </span>
                        </div>
                    </div>

                    <!-- Form Update Subscription -->
                    <form action="{{ route('admin.memberships.update-subscription', $subscription->id) }}" method="POST" class="space-y-4 pt-1">
                        @csrf
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                            <div>
                                <label for="app_status" class="block text-xs font-bold text-gray-700 mb-1">Status Aplikasi</label>
                                <select name="app_status" id="app_status" class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all cursor-pointer">
                                    <option value="pending" {{ $subscription->app_status == 'pending' ? 'selected' : '' }}>Pending (Belum Siap)</option>
                                    <option value="running" {{ $subscription->app_status == 'running' ? 'selected' : '' }}>Running (Online / Aktif)</option>
                                    <option value="maintenance" {{ $subscription->app_status == 'maintenance' ? 'selected' : '' }}>Maintenance (Pemeliharaan)</option>
                                </select>
                            </div>

                            <div>
                                <label for="app_url_update" class="block text-xs font-bold text-gray-700 mb-1">URL Aplikasi</label>
                                <input type="url" 
                                       name="app_url" 
                                       id="app_url_update" 
                                       value="{{ $subscription->app_url }}"
                                       placeholder="https://client.gawe.id" 
                                       class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-2">
                            <div>
                                @if($subscription->app_url)
                                    <a href="{{ $subscription->app_url }}" target="_blank" class="inline-flex items-center gap-1.5 text-[#007A87] hover:underline text-xs font-bold">
                                        <i class="ti ti-external-link"></i>
                                        <span>Kunjungi URL Aplikasi</span>
                                    </a>
                                @endif
                            </div>

                            <button type="submit" 
                                    class="px-4 py-2 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white font-bold text-xs shadow-sm shadow-[#007A87]/20 transition-all flex items-center gap-1.5">
                                <i class="ti ti-device-floppy text-sm"></i>
                                <span>Simpan Perubahan</span>
                            </button>
                        </div>
                    </form>
                </div>
            @endif

        </div>

    </div>

</div>

{{-- Global Dialog Callbacks --}}
@push('scripts')
<script>
    function handleApproveAction() {
        window.confirmDialog({
            title: 'Konfirmasi Persetujuan',
            message: 'Apakah Anda yakin bukti transfer sudah valid dan ingin menyetujui transaksi ini serta mengaktifkan lisensi member?',
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
        const note = document.getElementById('admin_note').value.trim();
        if(!note) {
            window.confirmDialog({
                title: 'Alasan Penolakan Diperlukan',
                message: 'Silakan isi kolom Catatan Admin terlebih dahulu untuk mencantumkan alasan penolakan kepada member.',
                type: 'warning',
                icon: 'ti ti-alert-triangle'
            });
            return;
        }

        window.confirmDialog({
            title: 'Konfirmasi Penolakan',
            message: 'Apakah Anda yakin ingin menolak transaksi pembayaran ini? Status akan ditandai Ditolak.',
            type: 'danger',
            icon: 'ti ti-trash',
            callback: () => {
                const form = document.getElementById('action-form');
                form.action = "{{ route('admin.memberships.reject', $membershipTransaction->id) }}";
                form.submit();
            }
        });
    }
</script>
@endpush
@endsection
