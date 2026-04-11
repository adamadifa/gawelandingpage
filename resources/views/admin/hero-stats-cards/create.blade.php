@extends('layouts.admin')

@section('title', 'Hero — Tambah Statistik')

@section('breadcrumbs')
<nav class="flex items-center gap-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest mb-2 font-poppins">
    <a href="{{ route('admin.hero-sections.index') }}" class="hover:text-brand-600 transition-colors">Landing Page</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <a href="{{ route('admin.hero-stats-cards.index') }}" class="hover:text-brand-600 transition-colors">Hero Stats</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <span class="text-brand-600 font-semibold">Tambah Kartu</span>
</nav>
@endsection

@section('actions')
<div class="flex items-center gap-3 font-poppins">
     <a href="{{ route('admin.hero-stats-cards.index') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-400 hover:text-gray-600 transition-colors">Batal</a>
     <button type="submit" form="stats-create-form" class="inline-flex items-center gap-2 px-7 py-3.5 bg-brand-600 text-white rounded-xl font-bold text-sm shadow-xl shadow-brand-600/20 hover:bg-brand-700 active:scale-95 transition-all">
        <i class="ti ti-device-floppy text-lg"></i>
        Simpan Statistik
    </button>
</div>
@endsection

@section('content')
<div class="w-full -mt-6 space-y-6 pb-0 font-poppins">

    <form id="stats-create-form" action="{{ route('admin.hero-stats-cards.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        @csrf
        
        <div class="lg:col-span-12">
            @if ($errors->any())
                <div class="mb-8 p-4 bg-rose-50 border border-rose-100 rounded-2xl flex items-start gap-3">
                    <i class="ti ti-alert-triangle text-xl text-rose-500 mt-0.5"></i>
                    <ul class="text-sm text-rose-600 font-bold space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        {{-- Left: Content & Configuration --}}
        <div class="lg:col-span-8 space-y-6">
            {{-- Main Data Card --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-6">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-brand-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-brand-50">
                        <i class="ti ti-chart-bar"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none tracking-tight">Data Statistik</h3>
                        <p class="text-[12px] text-gray-400 font-semibold mt-1.5 uppercase tracking-wider">Metrik Utama & Konteks</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700 px-1">Nilai Statistik (Value)</label>
                        <input type="text" name="value" value="{{ old('value') }}" 
                            class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 px-6 text-gray-900 font-semibold focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all placeholder:text-gray-300" 
                            placeholder="Contoh: 98.5% atau 10k+" required>
                    </div>
                    
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700 px-1">Judul / Deskripsi Singkat</label>
                        <input type="text" name="title" value="{{ old('title') }}" 
                            class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 px-6 text-gray-900 font-semibold focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all placeholder:text-gray-300" 
                            placeholder="Contoh: Kepuasan Pengguna" required>
                    </div>
                </div>
            </div>

            {{-- Advanced Configuration Card --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-6">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-brand-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-brand-50">
                        <i class="ti ti-settings-2"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none tracking-tight">Konfigurasi Visual</h3>
                        <p class="text-[12px] text-gray-400 font-semibold mt-1.5 uppercase tracking-wider">Ikon, Warna & Penempatan</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700 px-1 tracking-tight uppercase text-[11px] font-bold text-gray-400">Tabler Icon Tag</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 flex items-center pointer-events-none">
                                <i class="ti ti-brand-tabler text-xl"></i>
                            </span>
                            <input type="text" name="icon" value="{{ old('icon', 'ti-circle-check') }}" 
                                class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 pl-12 pr-6 text-gray-900 font-medium focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all shadow-sm" 
                                placeholder="ti-user" required>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700 px-1 tracking-tight uppercase text-[11px] font-bold text-gray-400">Tema Warna</label>
                        <div class="relative">
                            <select name="color_theme" class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 px-6 text-gray-900 font-semibold focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all appearance-none cursor-pointer">
                                <option value="indigo">Indigo Blue</option>
                                <option value="emerald">Emerald Green</option>
                                <option value="amber">Amber Orange</option>
                                <option value="rose">Rose Red</option>
                                <option value="sky">Sky Cyan</option>
                            </select>
                            <i class="ti ti-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700 px-1 tracking-tight uppercase text-[11px] font-bold text-gray-400">Slot Posisi</label>
                        <div class="relative">
                            <select name="position_slot" class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 px-6 text-gray-900 font-semibold focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all appearance-none cursor-pointer">
                                <option value="TR">Top Right</option>
                                <option value="TL">Top Left</option>
                                <option value="MR">Middle Right</option>
                                <option value="ML">Middle Left</option>
                                <option value="BL">Bottom Left</option>
                                <option value="BR">Bottom Right</option>
                                <option value="TM">Top Middle</option>
                                <option value="BM">Bottom Middle</option>
                            </select>
                            <i class="ti ti-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                        </div>
                    </div>
                </div>

                <div class="pt-4 flex items-center gap-3">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-600"></div>
                        <span class="ml-3 text-sm font-semibold text-gray-700">Tampilkan Secara Aktif di Hero Section</span>
                    </label>
                </div>
            </div>
        </div>

        {{-- Right: Info & Tips --}}
        <div class="lg:col-span-4 space-y-6 sticky top-8">
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 space-y-6">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-brand-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-brand-50">
                        <i class="ti ti-bulb"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none tracking-tight">Tips Desain</h3>
                        <p class="text-[12px] text-gray-400 font-semibold mt-1.5 uppercase tracking-wider">Praktik Terbaik</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="flex gap-4">
                        <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                            <i class="ti ti-icons"></i>
                        </div>
                        <div class="space-y-1">
                            <h4 class="text-sm font-bold text-gray-900">Gunakan Ikon Tepat</h4>
                            <p class="text-xs text-gray-500 leading-relaxed font-medium">Pilih ikon yang secara visual mewakili data statistik Anda agar mudah dipahami.</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                            <i class="ti ti-layout-sidebar-right"></i>
                        </div>
                        <div class="space-y-1">
                            <h4 class="text-sm font-bold text-gray-900">Perhatikan Posisi</h4>
                            <p class="text-xs text-gray-500 leading-relaxed font-medium">Jangan menumpuk terlalu banyak kartu di satu sisi hero mockup agar tetap seimbang.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-8 bg-brand-900 rounded-xl text-white shadow-2xl shadow-brand-900/30 relative overflow-hidden">
                 <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-3xl opacity-50"></div>
                 <div class="relative z-10 space-y-4">
                     <div class="flex items-center gap-3">
                         <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center backdrop-blur-sm">
                            <i class="ti ti-rocket text-amber-300"></i>
                         </div>
                         <span class="text-[10px] font-semibold text-brand-200 uppercase tracking-widest">Growth Metric</span>
                     </div>
                     <h4 class="text-lg font-display font-bold leading-tight">Data Memberikan Kepercayaan.</h4>
                     <p class="text-xs text-brand-100/70 leading-relaxed font-medium tracking-wide">Tampilkan angka yang membuktikan kualitas atau kepuasan pengguna layanan Anda.</p>
                 </div>
            </div>
        </div>
    </form>
</div>
@endsection
