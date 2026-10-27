@extends('layouts.admin')

@section('title', 'Klaim & Verifikasi Source Code')
@section('subtitle', 'Validasi bukti transaksi dan ulasan pembeli On-Premise untuk mengaktifkan akses pembaruan source code.')

@section('breadcrumbs')
<div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white border border-[#E2E8F0]/70 text-xs text-[#64748B] shadow-2xs font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#007A87] flex items-center gap-1">
        <i class="ti ti-home text-sm"></i>
        <span>Dashboard</span>
    </a>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <span class="text-gray-400">Master Data</span>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <span class="text-[#0F172A] font-semibold">Klaim Source Code</span>
</div>
@endsection

@section('actions')
<div class="flex items-center gap-2">
    <!-- Quick link to public claim portal -->
    <a href="{{ route('source-code-claim.create') }}" 
       target="_blank" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 text-xs font-bold shadow-2xs transition-all">
        <i class="ti ti-external-link text-sm text-[#007A87]"></i>
        <span>Buka Form Klaim</span>
    </a>

    <!-- Scroll to settings button -->
    <a href="#sc-settings-card" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
        <i class="ti ti-settings text-sm"></i>
        <span>Pengaturan Link Update</span>
    </a>
</div>
@endsection

@section('content')
<div class="space-y-6" x-data="{
    detailModal: false,
    approveModal: false,
    rejectModal: false,
    activeClaim: null,
    openDetail(claim) {
        this.activeClaim = claim;
        this.detailModal = true;
    },
    openApprove(claim) {
        this.activeClaim = claim;
        this.approveModal = true;
    },
    openReject(claim) {
        this.activeClaim = claim;
        this.rejectModal = true;
    }
}">

    <!-- Top Stats Banner (Dark Teal Gradient) -->
    <div class="rounded-2xl p-6 bg-gradient-to-r from-[#005B60] via-[#006D75] to-[#007A87] text-white shadow-sm border border-teal-800/30 relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.08),transparent_50%)] pointer-events-none"></div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 relative z-10">
            
            <!-- Col 1: Total Klaim -->
            <div class="border-b md:border-b-0 md:border-r border-white/15 pb-4 md:pb-0 md:pr-4">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-teal-100/80">TOTAL PERMOHONAN</span>
                    <span class="px-2 py-0.5 rounded-md bg-white/15 text-white text-[10px] font-bold">Semua</span>
                </div>
                <div class="mt-2">
                    <h3 class="text-3xl font-black tracking-tight leading-none text-white">{{ $stats['total'] }}</h3>
                </div>
                <div class="flex items-center justify-between text-[11px] text-teal-100/70 mt-3 font-semibold">
                    <span>Klaim Masuk</span>
                    <span>100%</span>
                </div>
            </div>

            <!-- Col 2: Menunggu Verifikasi -->
            <div class="border-b md:border-b-0 md:border-r border-white/15 pb-4 md:pb-0 md:px-4">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-teal-100/80">MENUNGGU VERIFIKASI</span>
                    <span class="px-2 py-0.5 rounded-md bg-amber-400/25 text-amber-200 text-[10px] font-bold">Pending</span>
                </div>
                <div class="mt-2">
                    <h3 class="text-3xl font-black tracking-tight leading-none text-white">{{ $stats['pending'] }}</h3>
                </div>
                <div class="flex items-center justify-between text-[11px] text-teal-100/70 mt-3 font-semibold">
                    <span>Perlu Tindakan</span>
                    <span>{{ $stats['total'] > 0 ? round(($stats['pending'] / $stats['total']) * 100) : 0 }}%</span>
                </div>
            </div>

            <!-- Col 3: Disetujui -->
            <div class="border-b md:border-b-0 md:border-r border-white/15 pb-4 md:pb-0 md:px-4">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-teal-100/80">TELAH DISETUJUI</span>
                    <span class="px-2 py-0.5 rounded-md bg-emerald-400/25 text-emerald-100 text-[10px] font-bold">Approved</span>
                </div>
                <div class="mt-2">
                    <h3 class="text-3xl font-black tracking-tight leading-none text-white">{{ $stats['approved'] }}</h3>
                </div>
                <div class="flex items-center justify-between text-[11px] text-teal-100/70 mt-3 font-semibold">
                    <span>Lisensi Aktif</span>
                    <span>{{ $stats['total'] > 0 ? round(($stats['approved'] / $stats['total']) * 100) : 0 }}%</span>
                </div>
            </div>

            <!-- Col 4: Ditolak -->
            <div class="md:pl-4">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-teal-100/80">DITOLAK</span>
                    <span class="px-2 py-0.5 rounded-md bg-rose-400/25 text-rose-200 text-[10px] font-bold">Rejected</span>
                </div>
                <div class="mt-2">
                    <h3 class="text-3xl font-black tracking-tight leading-none text-white">{{ $stats['rejected'] }}</h3>
                </div>
                <div class="flex items-center justify-between text-[11px] text-teal-100/70 mt-3 font-semibold">
                    <span>Tidak Valid</span>
                    <span>{{ $stats['total'] > 0 ? round(($stats['rejected'] / $stats['total']) * 100) : 0 }}%</span>
                </div>
            </div>

        </div>
    </div>

    <!-- Filter & Search Toolbar -->
    <div class="card-clean p-4">
        <form method="GET" action="{{ route('admin.source-code-claims.index') }}" class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            
            <!-- Status Tabs -->
            <div class="flex items-center gap-1.5 overflow-x-auto text-xs pb-1 sm:pb-0">
                <a href="{{ route('admin.source-code-claims.index', ['status' => 'all', 'q' => request('q')]) }}" 
                   class="px-3.5 py-2 rounded-xl font-bold transition-all whitespace-nowrap {{ $status === 'all' ? 'bg-[#007A87] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Semua ({{ $stats['total'] }})
                </a>
                <a href="{{ route('admin.source-code-claims.index', ['status' => 'pending', 'q' => request('q')]) }}" 
                   class="px-3.5 py-2 rounded-xl font-bold transition-all whitespace-nowrap {{ $status === 'pending' ? 'bg-amber-500 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Menunggu ({{ $stats['pending'] }})
                </a>
                <a href="{{ route('admin.source-code-claims.index', ['status' => 'approved', 'q' => request('q')]) }}" 
                   class="px-3.5 py-2 rounded-xl font-bold transition-all whitespace-nowrap {{ $status === 'approved' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Disetujui ({{ $stats['approved'] }})
                </a>
                <a href="{{ route('admin.source-code-claims.index', ['status' => 'rejected', 'q' => request('q')]) }}" 
                   class="px-3.5 py-2 rounded-xl font-bold transition-all whitespace-nowrap {{ $status === 'rejected' ? 'bg-rose-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Ditolak ({{ $stats['rejected'] }})
                </a>
            </div>

            <!-- Search Field -->
            <div class="relative w-full sm:w-72">
                <i class="ti ti-search absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input type="hidden" name="status" value="{{ $status }}">
                <input type="text" 
                       name="q" 
                       value="{{ request('q') }}" 
                       placeholder="Cari nama, email, whatsapp, order..." 
                       class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 pl-9 pr-8 text-xs font-semibold text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
            </div>

        </form>
    </div>

    <!-- Main Table of Claims -->
    <div class="card-clean overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-gray-50/80 border-b border-gray-100 text-[10px] font-bold text-gray-400 uppercase tracking-wider">
                        <th class="py-3.5 px-4">Pembeli & Kontak</th>
                        <th class="py-3.5 px-4">Platform Asal</th>
                        <th class="py-3.5 px-4">Bukti Transaksi</th>
                        <th class="py-3.5 px-4">Testimoni & Rating</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 font-medium">
                    @forelse($claims as $claim)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        
                        <!-- Col 1: Pembeli -->
                        <td class="py-4 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-teal-50 text-[#007A87] flex items-center justify-center font-bold text-xs uppercase shrink-0 border border-teal-100">
                                    {{ substr($claim->name, 0, 1) }}
                                </div>
                                <div>
                                    <span class="font-bold text-gray-900 block leading-tight">{{ $claim->name }}</span>
                                    <span class="text-[11px] text-gray-400 block">{{ $claim->email }}</span>
                                    <a href="https://wa.me/{{ $claim->whatsapp_number }}" target="_blank" class="text-[10.5px] text-emerald-600 font-bold hover:underline flex items-center gap-1 mt-0.5">
                                        <i class="ti ti-brand-whatsapp"></i>
                                        <span>+{{ $claim->whatsapp_number }}</span>
                                    </a>
                                </div>
                            </div>
                        </td>

                        <!-- Col 2: Platform & Order ID -->
                        <td class="py-4 px-4">
                            <div>
                                <span class="px-2 py-0.5 rounded-md bg-gray-100 text-gray-800 text-[10.5px] font-bold inline-block">
                                    {{ $claim->getPlatformLabel() }}
                                </span>
                                @if($claim->order_id)
                                    <span class="text-[10px] text-gray-400 font-mono block mt-1">ID: {{ $claim->order_id }}</span>
                                @endif
                                <span class="text-[10px] text-gray-400 block mt-0.5">
                                    {{ $claim->created_at->format('d M Y, H:i') }}
                                </span>
                            </div>
                        </td>

                        <!-- Col 3: Bukti Transaksi -->
                        <td class="py-4 px-4">
                            <a href="{{ asset('storage/' . $claim->proof_file) }}" 
                               target="_blank" 
                               class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg bg-teal-50 hover:bg-teal-100 text-[#007A87] text-[11px] font-bold transition-colors">
                                <i class="ti ti-file-search text-sm"></i>
                                <span>Lihat Bukti</span>
                            </a>
                        </td>

                        <!-- Col 4: Testimoni & Rating -->
                        <td class="py-4 px-4 max-w-xs">
                            <div>
                                <div class="flex items-center text-amber-400 text-xs">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="ti ti-star-filled {{ $i <= $claim->rating ? 'text-amber-400' : 'text-gray-200' }}"></i>
                                    @endfor
                                    <span class="text-gray-600 font-bold text-[10.5px] ml-1.5">{{ $claim->rating }}/5</span>
                                </div>
                                <p class="text-[11px] text-gray-600 truncate mt-1 italic" title="{{ $claim->testimonial_content }}">
                                    "{{ $claim->testimonial_content }}"
                                </p>
                                @if($claim->company || $claim->position)
                                    <span class="text-[9.5px] text-gray-400 block mt-0.5">
                                        {{ $claim->position ? $claim->position . ', ' : '' }}{{ $claim->company }}
                                    </span>
                                @endif
                            </div>
                        </td>

                        <!-- Col 5: Status -->
                        <td class="py-4 px-4">
                            @if($claim->isPending())
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-amber-50 text-amber-700 text-[10.5px] font-extrabold border border-amber-200">
                                    <i class="ti ti-clock text-xs"></i>
                                    <span>Menunggu</span>
                                </span>
                            @elseif($claim->isApproved())
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 text-[10.5px] font-extrabold border border-emerald-200">
                                    <i class="ti ti-check text-xs"></i>
                                    <span>Disetujui</span>
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-rose-50 text-rose-700 text-[10.5px] font-extrabold border border-rose-200">
                                    <i class="ti ti-x text-xs"></i>
                                    <span>Ditolak</span>
                                </span>
                            @endif
                        </td>

                        <!-- Col 6: Aksi -->
                        <td class="py-4 px-4 text-right">
                            <div class="inline-flex items-center gap-1.5">
                                
                                @if($claim->isPending())
                                    <!-- Tombol Setujui -->
                                    <button type="button" 
                                            @click="openApprove({{ json_encode($claim) }})" 
                                            class="p-1.5 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-xs font-bold transition-colors cursor-pointer" 
                                            title="Setujui Klaim">
                                        <i class="ti ti-check text-sm"></i>
                                    </button>

                                    <!-- Tombol Tolak -->
                                    <button type="button" 
                                            @click="openReject({{ json_encode($claim) }})" 
                                            class="p-1.5 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-bold transition-colors cursor-pointer" 
                                            title="Tolak Klaim">
                                        <i class="ti ti-x text-sm"></i>
                                    </button>
                                @endif

                                <!-- Tombol Detail Lengkap -->
                                <button type="button" 
                                        @click="openDetail({{ json_encode($claim) }})" 
                                        class="p-1.5 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold transition-colors cursor-pointer" 
                                        title="Detail Lengkap">
                                    <i class="ti ti-info-circle text-sm"></i>
                                </button>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-gray-400">
                            <i class="ti ti-inbox text-3xl mb-1 block"></i>
                            <span class="text-xs font-medium">Belum ada permohonan klaim source code pada filter ini.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($claims->hasPages())
            <div class="p-4 border-t border-gray-100">
                {{ $claims->links() }}
            </div>
        @endif
    </div>

    <!-- Section: Pengaturan Tautan Unduhan & Versi Source Code -->
    <div id="sc-settings-card" class="card-clean p-6 space-y-5 bg-gradient-to-br from-teal-50/20 via-white to-white">
        <div class="flex items-center justify-between pb-3 border-b border-gray-100">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-teal-50 text-[#007A87] flex items-center justify-center font-bold">
                    <i class="ti ti-cloud-download text-lg"></i>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-[#0F172A] uppercase tracking-wide">Konfigurasi Rilis & Tautan Update Source Code</h3>
                    <p class="text-[11px] text-gray-400">Parameter ini otomatis ditampilkan pada halaman member yang telah disetujui (approved).</p>
                </div>
            </div>
            <span class="px-2 py-0.5 rounded-md bg-teal-50 text-[#007A87] text-[10px] font-bold uppercase tracking-wider">
                Distribution Hub
            </span>
        </div>

        <form action="{{ route('admin.source-code-claims.settings') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Versi Aplikasi Terkini -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">
                        Versi Rilis Terkini (Tag/Release Version) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           name="source_code_version" 
                           value="{{ old('source_code_version', $scSettings['version']) }}" 
                           required 
                           placeholder="Contoh: v2.4.0 (Latest Release)" 
                           class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 px-3.5 text-xs font-bold text-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87]">
                </div>

                <!-- Tautan Unduhan / Repository -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">
                        Tautan Unduhan / Repo Source Code (URL) <span class="text-rose-500">*</span>
                    </label>
                    <input type="url" 
                           name="source_code_update_url" 
                           value="{{ old('source_code_update_url', $scSettings['update_url']) }}" 
                           required 
                           placeholder="https://drive.google.com/... atau https://github.com/..." 
                           class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 px-3.5 text-xs font-bold text-gray-900 font-mono focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87]">
                </div>

                <!-- Tautan Grup Komunitas WhatsApp VIP -->
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-gray-700 mb-1">
                        Tautan Undangan Komunitas / Grup WhatsApp VIP Pembeli SC
                    </label>
                    <input type="url" 
                           name="source_code_group_url" 
                           value="{{ old('source_code_group_url', $scSettings['group_url']) }}" 
                           placeholder="https://chat.whatsapp.com/..." 
                           class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 px-3.5 text-xs font-bold text-gray-900 font-mono focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87]">
                </div>

                <!-- Changelog Rilis Terkini -->
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-gray-700 mb-1">
                        Catatan Rilis & Changelog Terkini
                    </label>
                    <textarea name="source_code_changelog" 
                              rows="3" 
                              placeholder="Tuliskan daftar fitur baru, patch keamanan, atau perbaikan bug..." 
                              class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl p-3 text-xs text-gray-900 font-mono leading-relaxed focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87]">{{ old('source_code_changelog', $scSettings['changelog']) }}</textarea>
                </div>
            </div>

            <div class="pt-2 flex justify-end">
                <button type="submit" 
                        class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all cursor-pointer">
                    <i class="ti ti-device-floppy text-sm"></i>
                    <span>Simpan Pengaturan Rilis SC</span>
                </button>
            </div>
        </form>
    </div>

    <!-- MODAL 1: Detail Bukti & Testimoni Lengkap -->
    <div x-cloak 
         x-show="detailModal" 
         class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div class="bg-white rounded-3xl max-w-2xl w-full p-6 space-y-5 shadow-2xl border border-gray-100 max-h-[90vh] overflow-y-auto custom-scroll"
             @click.outside="detailModal = false">
            
            <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-xl bg-teal-50 text-[#007A87] flex items-center justify-center text-base">
                        <i class="ti ti-id"></i>
                    </div>
                    <h3 class="text-sm font-bold text-gray-900">Detail Klaim & Verifikasi</h3>
                </div>
                <button type="button" @click="detailModal = false" class="text-gray-400 hover:text-gray-600">
                    <i class="ti ti-x text-lg"></i>
                </button>
            </div>

            <template x-if="activeClaim">
                <div class="space-y-4 text-xs">
                    
                    <!-- Buyer Info Grid -->
                    <div class="grid grid-cols-2 gap-3 p-4 rounded-2xl bg-gray-50 border border-gray-100">
                        <div>
                            <span class="text-[10px] text-gray-400 font-bold uppercase block">Nama Pembeli</span>
                            <span class="font-bold text-gray-900 text-sm" x-text="activeClaim.name"></span>
                        </div>
                        <div>
                            <span class="text-[10px] text-gray-400 font-bold uppercase block">Email Akun</span>
                            <span class="font-bold text-gray-800" x-text="activeClaim.email"></span>
                        </div>
                        <div>
                            <span class="text-[10px] text-gray-400 font-bold uppercase block">WhatsApp</span>
                            <span class="font-bold text-emerald-600 font-mono" x-text="'+' + activeClaim.whatsapp_number"></span>
                        </div>
                        <div>
                            <span class="text-[10px] text-gray-400 font-bold uppercase block">Platform Asal</span>
                            <span class="font-bold text-gray-800" x-text="activeClaim.platform"></span>
                        </div>
                    </div>

                    <!-- Bukti Transaksi -->
                    <div>
                        <span class="text-[10.5px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Bukti Transaksi Dilampirkan:</span>
                        <div class="p-2 rounded-2xl bg-gray-50 border border-gray-200 text-center">
                            <a :href="'/storage/' + activeClaim.proof_file" target="_blank" class="inline-block group">
                                <img :src="'/storage/' + activeClaim.proof_file" class="max-h-64 mx-auto rounded-xl shadow-xs group-hover:scale-102 transition-transform" alt="Bukti Transaksi">
                                <span class="text-[10.5px] text-[#007A87] font-bold mt-2 inline-flex items-center gap-1 group-hover:underline">
                                    <i class="ti ti-external-link"></i> Buka Gambar Ukuran Asli
                                </span>
                            </a>
                        </div>
                    </div>

                    <!-- Testimoni Content -->
                    <div class="p-4 rounded-2xl bg-teal-50/50 border border-teal-200/60 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-[10.5px] font-bold text-[#007A87] uppercase tracking-wider">Ulasan & Testimoni:</span>
                            <span class="text-xs font-bold text-amber-500" x-text="'★ ' + activeClaim.rating + '/5 Bintang'"></span>
                        </div>
                        <p class="text-xs text-gray-800 italic leading-relaxed" x-text="'\"' + activeClaim.testimonial_content + '\"'"></p>
                    </div>

                </div>
            </template>

            <div class="pt-2 flex justify-end">
                <button type="button" @click="detailModal = false" class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-xs font-bold text-gray-700">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- MODAL 2: Approve Form -->
    <div x-cloak 
         x-show="approveModal" 
         class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
        
        <div class="bg-white rounded-3xl max-w-md w-full p-6 space-y-4 shadow-2xl border border-gray-100"
             @click.outside="approveModal = false">
            
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">
                    <i class="ti ti-circle-check"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-gray-900">Setujui Klaim Source Code</h3>
                    <p class="text-[11px] text-gray-400">Pembeli akan langsung mendapatkan akses update.</p>
                </div>
            </div>

            <template x-if="activeClaim">
                <form :action="'/admin/source-code-claims/' + activeClaim.id + '/approve'" method="POST" class="space-y-4 text-xs">
                    @csrf
                    
                    <p class="text-gray-600 leading-relaxed">
                        Anda akan menyetujui klaim kepemilikan untuk <strong class="text-gray-900" x-text="activeClaim.name"></strong>.
                    </p>

                    <label class="flex items-start gap-2 p-3 rounded-xl bg-teal-50 border border-teal-200 text-teal-900 cursor-pointer">
                        <input type="checkbox" name="publish_testimonial" value="1" checked class="mt-0.5 rounded border-teal-300 text-[#007A87]">
                        <span class="text-[11px] font-semibold leading-relaxed">
                            Terbitkan ulasan testimoni pembeli ini ke Landing Page (Menu Testimoni) secara otomatis.
                        </span>
                    </label>

                    <div>
                        <label class="block text-[10.5px] font-bold text-gray-500 mb-1">Catatan Verifikasi (Opsional):</label>
                        <input type="text" name="admin_note" value="Bukti transaksi telah diverifikasi dan valid." class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl p-2.5 text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87]">
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-2">
                        <button type="button" @click="approveModal = false" class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 font-bold text-gray-700">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold shadow-sm">
                            Ya, Setujui Sekarang
                        </button>
                    </div>
                </form>
            </template>
        </div>
    </div>

    <!-- MODAL 3: Reject Form -->
    <div x-cloak 
         x-show="rejectModal" 
         class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
        
        <div class="bg-white rounded-3xl max-w-md w-full p-6 space-y-4 shadow-2xl border border-gray-100"
             @click.outside="rejectModal = false">
            
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl">
                    <i class="ti ti-alert-triangle"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-gray-900">Tolak Permohonan Klaim</h3>
                    <p class="text-[11px] text-gray-400">Sertakan alasan penolakan bagi pembeli.</p>
                </div>
            </div>

            <template x-if="activeClaim">
                <form :action="'/admin/source-code-claims/' + activeClaim.id + '/reject'" method="POST" class="space-y-4 text-xs">
                    @csrf
                    
                    <div>
                        <label class="block text-[10.5px] font-bold text-gray-700 mb-1">
                            Alasan Penolakan <span class="text-rose-500">*</span>
                        </label>
                        <textarea name="admin_note" 
                                  rows="3" 
                                  required 
                                  placeholder="Contoh: Bukti transaksi tidak terbaca / Nomor invoice tidak ditemukan di platform terkait..." 
                                  class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl p-2.5 text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500"></textarea>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-2">
                        <button type="button" @click="rejectModal = false" class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 font-bold text-gray-700">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold shadow-sm">
                            Tolak Permohonan
                        </button>
                    </div>
                </form>
            </template>
        </div>
    </div>

</div>
@endsection
