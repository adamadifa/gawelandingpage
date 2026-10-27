@extends('layouts.member')

@section('title', 'Akses & Pembaruan Source Code')
@section('subtitle', 'Kelola hak akses pembaruan versi terbaru, repository kode sumber, dan dokumentasi teknis instalasi.')

@section('actions')
@if(!$claim || $claim->isRejected())
    <a href="{{ route('source-code-claim.create') }}" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
        <i class="ti ti-plus text-sm"></i>
        <span>Ajukan Klaim Pembelian</span>
    </a>
@endif
@endsection

@section('content')
<div class="space-y-6" x-data="{
    copied: false,
    copyKey(text) {
        navigator.clipboard.writeText(text);
        this.copied = true;
        setTimeout(() => this.copied = false, 2500);
    }
}">

    {{-- CASE 1: Belum Pernah Mengajukan Klaim --}}
    @if(!$claim)
        <div class="bg-white rounded-3xl p-8 lg:p-12 border border-gray-100 shadow-sm text-center max-w-3xl mx-auto space-y-5">
            <div class="w-16 h-16 rounded-3xl bg-teal-50 text-[#007A87] flex items-center justify-center mx-auto text-3xl shadow-inner">
                <i class="ti ti-file-certificate"></i>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-900">Belum Ada Lisensi Source Code Terverifikasi</h3>
                <p class="text-xs text-gray-500 max-w-md mx-auto mt-2 leading-relaxed font-medium">
                    Jika Anda sebelumnya telah membeli Source Code aplikasi kami melalui platform luar (Mayar, Lynk.id, CodeCanyon, dll.) atau transfer langsung, silakan ajukan verifikasi dengan menyertakan bukti pembayaran dan ulasan Anda.
                </p>
            </div>
            <div class="pt-2">
                <a href="{{ route('source-code-claim.create') }}" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#007A87] hover:bg-[#005B60] text-white rounded-xl text-xs font-semibold shadow-sm transition-all active:scale-95">
                    <i class="ti ti-certificate text-base"></i>
                    <span>Klaim Pembaruan Source Code Sekarang</span>
                </a>
            </div>
        </div>

    {{-- CASE 2: Status PENDING --}}
    @elseif($claim->isPending())
        <div class="space-y-6 max-w-4xl mx-auto">
            
            <!-- Pending Top Hero Card (Themed Deep Teal & Slate) -->
            <div class="rounded-3xl p-6 lg:p-8 bg-gradient-to-br from-[#0F172A] via-[#004D54] to-[#007A87] text-white shadow-xl shadow-teal-950/20 border border-teal-800/40 relative overflow-hidden">
                <!-- Subtle Radial Glow Background -->
                <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-teal-400/10 blur-3xl pointer-events-none"></div>
                <div class="absolute -left-16 -bottom-16 w-64 h-64 rounded-full bg-amber-400/10 blur-3xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="flex items-start gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 text-amber-300 flex items-center justify-center shrink-0 text-2xl shadow-lg shadow-black/20">
                            <i class="ti ti-hourglass-high animate-pulse"></i>
                        </div>
                        <div class="space-y-1">
                            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-400/20 border border-amber-300/30 text-amber-300 text-xs font-medium backdrop-blur-sm">
                                <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                                <span>Sedang Diverifikasi Admin</span>
                            </div>
                            <h3 class="text-xl sm:text-2xl font-bold text-white tracking-tight">
                                Permohonan Klaim Sedang Ditinjau
                            </h3>
                            <p class="text-xs sm:text-[13px] text-teal-100/90 leading-relaxed font-normal max-w-2xl">
                                Tim kami sedang memeriksa keabsahan bukti transaksi dan ulasan Anda (estimasi maksimal 1x24 jam kerja). Begitu disetujui, tautan unduhan source code terbaru dan grup VIP otomatis aktif.
                            </p>
                        </div>
                    </div>

                    <div class="shrink-0 flex flex-col items-start md:items-end gap-2 w-full md:w-auto">
                        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}?text=Halo%20Admin,%20saya%20sudah%20mengajukan%20klaim%20Source%20Code%20dengan%20email%20{{ urlencode(auth()->user()->email) }}" 
                           target="_blank" 
                           class="w-full md:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-white text-xs font-bold shadow-lg shadow-emerald-500/25 transition-all hover:scale-[1.02] active:scale-98">
                            <i class="ti ti-brand-whatsapp text-base"></i>
                            <span>Konfirmasi Cepat via CS</span>
                        </a>
                        <div class="text-[11px] text-teal-200/80 font-mono flex items-center gap-1.5">
                            <i class="ti ti-ticket text-xs text-amber-300"></i>
                            <span>ID Pengajuan: #{{ str_pad($claim->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Verification Progress Steps Card -->
            <div class="bg-white rounded-3xl p-5 border border-gray-100 shadow-sm">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <!-- Step 1: Terkirim -->
                    <div class="flex items-center gap-3 p-3.5 rounded-2xl bg-teal-50/70 border border-teal-100/80">
                        <div class="w-9 h-9 rounded-xl bg-[#007A87] text-white flex items-center justify-center font-bold text-sm shrink-0 shadow-sm shadow-[#007A87]/20">
                            <i class="ti ti-check"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="text-xs font-semibold text-[#007A87] block">Langkah 1</span>
                            <h5 class="text-xs font-bold text-gray-900 truncate">Form & Bukti Terkirim</h5>
                            <span class="text-[11px] text-gray-500 font-normal">{{ $claim->created_at->format('d M Y, H:i') }} WIB</span>
                        </div>
                    </div>

                    <!-- Step 2: Pemeriksaan Admin (Active) -->
                    <div class="flex items-center gap-3 p-3.5 rounded-2xl bg-amber-50/80 border border-amber-200/80 ring-2 ring-amber-400/20">
                        <div class="w-9 h-9 rounded-xl bg-amber-500 text-white flex items-center justify-center font-bold text-sm shrink-0 shadow-sm shadow-amber-500/20">
                            <i class="ti ti-clock-hour-4"></i>
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-1.5">
                                <span class="text-xs font-semibold text-amber-700 block">Langkah 2</span>
                            </div>
                            <h5 class="text-xs font-bold text-amber-950 truncate">Pemeriksaan Berkas</h5>
                            <span class="text-[11px] text-amber-700 font-medium">Sedang Ditinjau Admin</span>
                        </div>
                    </div>

                    <!-- Step 3: Akses SC Terbuka -->
                    <div class="flex items-center gap-3 p-3.5 rounded-2xl bg-gray-50/70 border border-gray-100 opacity-60">
                        <div class="w-9 h-9 rounded-xl bg-gray-200 text-gray-500 flex items-center justify-center font-bold text-sm shrink-0">
                            <i class="ti ti-lock"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="text-xs font-semibold text-gray-400 block">Langkah 3</span>
                            <h5 class="text-xs font-bold text-gray-700 truncate">Akses Source Code</h5>
                            <span class="text-[11px] text-gray-500 font-normal">Aktif Otomatis</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Pengajuan Card (Ringkasan Data Themed) -->
            <div class="bg-white rounded-3xl p-6 lg:p-8 border border-gray-100 shadow-sm space-y-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 border-b border-gray-100 gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-teal-50 text-[#007A87] flex items-center justify-center font-bold text-lg shadow-2xs">
                            <i class="ti ti-receipt-2"></i>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-gray-900">
                                Ringkasan Data yang Dikirimkan
                            </h4>
                            <p class="text-[11px] text-gray-500">Rincian invoice pembelian & ulasan yang telah tersimpan di sistem</p>
                        </div>
                    </div>
                    <div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-teal-50 border border-teal-200 text-[#007A87] text-[11px] font-semibold">
                            <i class="ti ti-shield-check text-xs"></i>
                            <span>Data Terverifikasi Aman</span>
                        </span>
                    </div>
                </div>

                <!-- 4 Attribute Mini-Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    <!-- Platform Beli -->
                    <div class="p-4 rounded-2xl bg-[#F8FAFC] border border-gray-100 hover:border-teal-200/60 transition-colors">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-medium text-gray-500">Platform Beli</span>
                            <div class="w-6 h-6 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center text-xs">
                                <i class="ti ti-building-store"></i>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-gray-900 block truncate">{{ $claim->getPlatformLabel() }}</span>
                        <span class="text-[11px] text-gray-500 mt-0.5 block">Kanal Transaksi</span>
                    </div>

                    <!-- Nomor Order -->
                    <div class="p-4 rounded-2xl bg-[#F8FAFC] border border-gray-100 hover:border-teal-200/60 transition-colors">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-medium text-gray-500">Nomor Order / Invoice</span>
                            <div class="w-6 h-6 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-xs">
                                <i class="ti ti-hash"></i>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-gray-900 font-mono block truncate">{{ $claim->order_id ?: '-' }}</span>
                        <span class="text-[11px] text-gray-500 mt-0.5 block">Referensi Bukti</span>
                    </div>

                    <!-- Tanggal Pengajuan -->
                    <div class="p-4 rounded-2xl bg-[#F8FAFC] border border-gray-100 hover:border-teal-200/60 transition-colors">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-medium text-gray-500">Tanggal Pengajuan</span>
                            <div class="w-6 h-6 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center text-xs">
                                <i class="ti ti-calendar"></i>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-gray-900 block truncate">{{ $claim->created_at->format('d M Y') }}</span>
                        <span class="text-[11px] text-gray-500 mt-0.5 block">{{ $claim->created_at->format('H:i') }} WIB</span>
                    </div>

                    <!-- Bukti Transaksi -->
                    <div class="p-4 rounded-2xl bg-[#F8FAFC] border border-gray-100 hover:border-teal-200/60 transition-colors flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <span class="text-xs font-medium text-gray-500">Bukti Transaksi</span>
                                <div class="w-6 h-6 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs">
                                    <i class="ti ti-file-check"></i>
                                </div>
                            </div>
                        </div>
                        <div class="pt-1">
                            <a href="{{ asset('storage/' . $claim->proof_file) }}" 
                               target="_blank" 
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-teal-50 hover:bg-[#007A87] text-[#007A87] hover:text-white border border-teal-200 text-[11px] font-bold transition-all shadow-2xs group">
                                <i class="ti ti-eye text-xs"></i>
                                <span>Buka Berkas</span>
                                <i class="ti ti-external-link text-[10px] opacity-70 group-hover:translate-x-0.5 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Testimoni & Penilaian Card (Rich Preview) -->
                <div class="rounded-2xl p-5 bg-gradient-to-br from-[#F8FAFC] via-white to-teal-50/40 border border-teal-100/80 shadow-2xs space-y-3.5">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            @if($claim->avatar)
                                <img src="{{ asset('storage/' . $claim->avatar) }}" 
                                     alt="{{ $claim->name }}" 
                                     class="w-10 h-10 rounded-xl object-cover border border-teal-200 shadow-2xs">
                            @else
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#005B60] to-[#007A87] text-white font-bold flex items-center justify-center text-sm shadow-2xs">
                                    {{ substr($claim->name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <h5 class="text-xs font-bold text-gray-900">{{ $claim->name }}</h5>
                                <p class="text-[11px] text-[#007A87] font-semibold flex items-center gap-1">
                                    <i class="ti ti-briefcase text-xs"></i>
                                    <span>{{ $claim->company ?: 'Pemilik Lisensi Source Code' }}</span>
                                </p>
                            </div>
                        </div>

                        <!-- Rating Badge -->
                        <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-amber-50 border border-amber-200/80 w-fit">
                            <div class="flex items-center text-amber-400 text-xs">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="ti ti-star-filled {{ $i <= $claim->rating ? 'text-amber-400' : 'text-gray-200' }}"></i>
                                @endfor
                            </div>
                            <span class="text-xs font-black text-amber-900 ml-1">{{ $claim->rating }}.0</span>
                        </div>
                    </div>

                    <!-- Quote Text -->
                    <div class="text-xs sm:text-[13px] text-gray-700 font-normal leading-relaxed italic bg-white p-3.5 rounded-xl border border-gray-200/70">
                        "{{ $claim->testimonial_content }}"
                    </div>

                        <!-- Footer Note -->
                        <div class="pt-2 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between text-[11px] text-gray-400 gap-1.5">
                            <span class="flex items-center gap-1.5">
                                <i class="ti ti-sparkles text-amber-500"></i>
                                <span>Ulasan ini akan otomatis terbit di landing page setelah disetujui.</span>
                            </span>
                            <span class="text-teal-700 font-semibold text-xs">Verified Testimonial</span>
                        </div>
                    </div>

                </div>

            </div>

        {{-- CASE 3: Status DITOLAK (REJECTED) --}}
        @elseif($claim->isRejected())
            <div class="space-y-6 max-w-4xl mx-auto">
                
                <!-- Rejection Alert -->
                <div class="rounded-3xl p-6 lg:p-8 bg-rose-50 border border-rose-200 text-rose-900 space-y-4">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-rose-600 text-white flex items-center justify-center shrink-0 text-2xl shadow-md shadow-rose-600/20">
                            <i class="ti ti-alert-triangle"></i>
                        </div>
                        <div>
                            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-rose-200 text-rose-800 text-xs font-semibold mb-1">
                                Klaim Ditolak
                            </div>
                            <h3 class="text-base font-bold text-rose-900">Verifikasi Belum Dapat Disetujui</h3>
                            <p class="text-xs text-rose-700 mt-1 leading-relaxed font-normal">
                                Admin telah meninjau berkas yang Anda kirimkan dan menemukan ketidaksesuaian data.
                            </p>
                        </div>
                    </div>

                    <!-- Catatan Admin -->
                    <div class="p-4 rounded-2xl bg-white border border-rose-200/80">
                        <span class="text-xs font-semibold text-rose-500 block mb-1">Catatan dari Admin:</span>
                        <p class="text-xs font-semibold text-gray-800">
                            {{ $claim->admin_note ?: 'Bukti pembayaran tidak terbaca atau tidak sesuai dengan data transaksi.' }}
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center gap-3 pt-1">
                        <a href="{{ route('source-code-claim.create') }}" 
                           class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#007A87] hover:bg-[#005B60] text-white rounded-xl text-xs font-semibold shadow-sm transition-all">
                            <i class="ti ti-refresh text-sm"></i>
                            <span>Kirim Ulang Berkas Klaim</span>
                        </a>

                        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}?text=Halo%20Admin,%20klaim%20Source%20Code%20saya%20dengan%20email%20{{ urlencode(auth()->user()->email) }}%20ditolak,%20bisa%20bantu%20cek?" 
                           target="_blank" 
                           class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 text-xs font-semibold transition-colors">
                            <i class="ti ti-brand-whatsapp text-emerald-600 text-sm"></i>
                            <span>Tanyakan ke Admin WhatsApp</span>
                        </a>
                    </div>
                </div>

            </div>

        {{-- CASE 4: Status DISETUJUI (APPROVED) - THE PRIZE! --}}
        @elseif($claim->isApproved())
            <div class="space-y-8">
                
                <!-- Verified Top Banner -->
                <div class="rounded-3xl p-6 lg:p-8 bg-gradient-to-r from-[#005B60] via-[#006D75] to-[#007A87] text-white shadow-lg border border-teal-800/30 relative overflow-hidden">
                    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.1),transparent_50%)] pointer-events-none"></div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center relative z-10">
                        <div class="lg:col-span-8 space-y-2">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 text-teal-100 text-xs font-semibold backdrop-blur-xs">
                                <i class="ti ti-badge-check text-base text-teal-300"></i>
                                <span>Lisensi On-Premise Terverifikasi</span>
                            </div>
                            <h2 class="text-xl lg:text-3xl font-bold text-white tracking-tight">
                                Selamat Datang, Pemilik Lisensi Source Code!
                            </h2>
                            <p class="text-xs lg:text-sm text-teal-100/90 leading-relaxed font-normal max-w-2xl">
                                Status kepemilikan Anda telah valid. Anda memiliki akses penuh ke tautan repository pembaruan versi terbaru, grup komunitas VIP, dan panduan instalasi.
                            </p>
                        </div>

                        <!-- License Key Pill -->
                        <div class="lg:col-span-4 bg-slate-900/40 border border-white/20 backdrop-blur-md rounded-2xl p-4 space-y-2 text-right lg:text-left">
                            <span class="text-xs font-medium text-teal-200 block">Kode Lisensi Resmi</span>
                            <div class="flex items-center justify-between bg-black/30 p-2.5 rounded-xl border border-white/10 font-mono text-xs font-bold text-white tracking-wider">
                                <span class="truncate">{{ $claim->license_key }}</span>
                                <button type="button" 
                                        @click="copyKey('{{ $claim->license_key }}')" 
                                        class="ml-2 text-teal-300 hover:text-white transition-colors cursor-pointer shrink-0" 
                                        title="Salin Kode">
                                    <i :class="copied ? 'ti ti-check text-emerald-400' : 'ti ti-copy'"></i>
                                </button>
                            </div>
                            <span class="text-[11px] text-teal-200/70 block" x-text="copied ? 'Berhasil disalin ke clipboard!' : 'Platform: {{ $claim->getPlatformLabel() }}'"></span>
                        </div>
                    </div>
                </div>

                <!-- Action Grid: Source Code Repository & Updates -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                    
                    <!-- Left: Big CTA & Release Notes (8 Cols) -->
                    <div class="lg:col-span-8 space-y-6">
                        
                        <!-- Main Update Card -->
                        <div class="bg-white rounded-3xl p-6 lg:p-8 border border-gray-100 shadow-sm space-y-6">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-gray-100">
                                <div>
                                    <span class="text-xs font-medium text-gray-500">Rilis Terbaru Aplikasi</span>
                                    <div class="flex items-center gap-3 mt-1">
                                        <h3 class="text-xl font-bold text-gray-900">{{ $version }}</h3>
                                        <span class="px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold border border-emerald-200">
                                            Active Stable
                                        </span>
                                    </div>
                                </div>

                                <a href="{{ $updateUrl }}" 
                                   target="_blank" 
                                   class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-[#007A87] hover:bg-[#005B60] text-white rounded-xl text-xs font-semibold shadow-sm transition-all active:scale-95 cursor-pointer">
                                    <i class="ti ti-download text-base"></i>
                                    <span>Akses / Unduh Source Code</span>
                                </a>
                            </div>

                        <!-- Changelog Details -->
                        <div class="space-y-3">
                            <div class="flex items-center gap-2 text-xs font-bold text-gray-700">
                                <i class="ti ti-notes text-base text-[#007A87]"></i>
                                <span>Catatan Rilis & Changelog Terkini:</span>
                            </div>
                            <div class="p-4 rounded-2xl bg-gray-50 border border-gray-200/80 font-mono text-xs text-gray-800 leading-relaxed whitespace-pre-line">
                                {{ $changelog }}
                            </div>
                        </div>

                        <!-- Instruksi Singkat Git / Update -->
                        <div class="p-4 rounded-2xl bg-teal-50/50 border border-teal-200/60 text-xs text-teal-900 space-y-2">
                            <div class="font-bold flex items-center gap-1.5">
                                <i class="ti ti-bulb text-base text-[#007A87]"></i>
                                <span>Tips Instalasi & Pembaruan:</span>
                            </div>
                            <p class="text-[11.5px] text-teal-800/90 leading-relaxed font-medium">
                                Selalu lakukan backup database (<code>mysqldump</code>) dan folder <code>.env</code> sebelum melakukan overwrite file pembaruan ke server production Anda.
                            </p>
                        </div>
                    </div>

                </div>

                <!-- Right: VIP Support & Info (4 Cols) -->
                <div class="lg:col-span-4 space-y-6">
                    
                    <!-- VIP Group Card -->
                    <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm space-y-4">
                        <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                            <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-sm">
                                <i class="ti ti-users-group text-lg"></i>
                            </div>
                            <h4 class="text-xs font-bold text-gray-900">Komunitas VIP Pemilik SC</h4>
                        </div>

                        <p class="text-xs text-gray-500 leading-relaxed font-normal">
                            Bergabunglah bersama para developer & pemilik bisnis lainnya untuk saling berbagi tips kustomisasi, info update, dan diskusi implementasi.
                        </p>

                        @if($groupUrl)
                            <a href="{{ $groupUrl }}" 
                               target="_blank" 
                               class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs transition-colors shadow-sm">
                                <i class="ti ti-brand-whatsapp text-base"></i>
                                <span>Gabung Grup VIP Pembeli</span>
                            </a>
                        @else
                            <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}?text=Halo%20Admin,%20saya%20pemilik%20SC%20ingin%20gabung%20ke%20grup%20VIP" 
                               target="_blank" 
                               class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs transition-colors shadow-sm">
                                <i class="ti ti-brand-whatsapp text-base"></i>
                                <span>Minta Tautan Grup via Admin</span>
                            </a>
                        @endif
                    </div>

                    <!-- Verified Details Card -->
                    <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm space-y-3">
                        <h4 class="text-xs font-bold text-gray-800 pb-2 border-b border-gray-100">
                            Detail Kepemilikan
                        </h4>

                        <div class="space-y-2 text-xs">
                            <div class="flex justify-between py-1 border-b border-gray-50">
                                <span class="text-gray-500">Atas Nama</span>
                                <span class="font-semibold text-gray-900">{{ $claim->name }}</span>
                            </div>
                            <div class="flex justify-between py-1 border-b border-gray-50">
                                <span class="text-gray-400">Email</span>
                                <span class="font-bold text-gray-800 truncate max-w-[150px]">{{ $claim->email }}</span>
                            </div>
                            <div class="flex justify-between py-1 border-b border-gray-50">
                                <span class="text-gray-400">Platform Beli</span>
                                <span class="font-bold text-gray-800">{{ $claim->getPlatformLabel() }}</span>
                            </div>
                            <div class="flex justify-between py-1">
                                <span class="text-gray-400">Status Testimoni</span>
                                <span class="font-bold text-emerald-600 flex items-center gap-1">
                                    <i class="ti ti-circle-check"></i> Terbit
                                </span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    @endif

</div>
@endsection
