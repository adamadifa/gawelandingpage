@extends('layouts.admin')

@section('title', 'Hero — Edit Statistik')

@section('content')
<div class="w-full space-y-8 pb-20">
    
    {{-- Page Header --}}
    <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-100">
        <div>
            <nav class="flex items-center gap-2 text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">
                <a href="{{ route('admin.hero-sections.index') }}" class="hover:text-indigo-600 transition-colors">Landing Page</a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <a href="{{ route('admin.hero-stats-cards.index') }}" class="hover:text-indigo-600 transition-colors">Hero Stats</a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <span class="text-indigo-600">Edit Statistik</span>
            </nav>
            <h1 class="text-3xl font-display font-black text-gray-900 leading-tight">Perbarui Statistik</h1>
            <p class="text-sm text-gray-500 font-medium">Lakukan penyesuaian pada metrik atau data yang melayang di Hero Section.</p>
        </div>
        <div class="flex items-center gap-3">
             <a href="{{ route('admin.hero-stats-cards.index') }}" class="px-5 py-2.5 text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">Batal</a>
             <button type="submit" form="stats-edit-form" class="inline-flex items-center gap-2 px-7 py-3.5 bg-indigo-600 text-white rounded-2xl font-bold text-sm shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 active:scale-95 transition-all">
                <i class="ti ti-device-floppy text-lg"></i>
                Simpan Perubahan
            </button>
        </div>
    </div>

    <form id="stats-edit-form" action="{{ route('admin.hero-stats-cards.update', $hero_stats_card) }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        @csrf
        @method('PUT')
        
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
        <div class="lg:col-span-8 space-y-8">
            {{-- Main Data Card --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-8">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-indigo-600 rounded-xl flex items-center justify-center text-2xl shadow-inner">
                        <i class="ti ti-chart-bar"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none">Data Statistik</h3>
                        <p class="text-[12px] text-gray-400 font-bold mt-1.5 uppercase tracking-wider">Metrik Utama & Konteks</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 px-1">Nilai Statistik (Value)</label>
                        <input type="text" name="value" value="{{ old('value', $hero_stats_card->value) }}" 
                            class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-4 px-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all" 
                            required>
                    </div>
                    
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 px-1">Judul / Deskripsi Singkat</label>
                        <input type="text" name="title" value="{{ old('title', $hero_stats_card->title) }}" 
                            class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-4 px-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all" 
                            required>
                    </div>
                </div>
            </div>

            {{-- Advanced Configuration Card --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-8">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-indigo-600 rounded-xl flex items-center justify-center text-2xl shadow-inner">
                        <i class="ti ti-settings-2"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none">Konfigurasi Visual</h3>
                        <p class="text-[12px] text-gray-400 font-bold mt-1.5 uppercase tracking-wider">Ikon, Warna & Penempatan</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 px-1">Tabler Icon Tag</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 flex items-center pointer-events-none">
                                <i class="ti {{ $hero_stats_card->icon }} text-xl"></i>
                            </span>
                            <input type="text" name="icon" value="{{ old('icon', $hero_stats_card->icon) }}" 
                                class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-4 pl-12 pr-6 text-gray-900 font-medium focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all" 
                                required>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 px-1">Tema Warna</label>
                        <select name="color_theme" class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-4 px-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all appearance-none cursor-pointer">
                            <option value="indigo" {{ $hero_stats_card->color_theme == 'indigo' ? 'selected' : '' }}>Indigo Blue</option>
                            <option value="emerald" {{ $hero_stats_card->color_theme == 'emerald' ? 'selected' : '' }}>Emerald Green</option>
                            <option value="amber" {{ $hero_stats_card->color_theme == 'amber' ? 'selected' : '' }}>Amber Orange</option>
                            <option value="rose" {{ $hero_stats_card->color_theme == 'rose' ? 'selected' : '' }}>Rose Red</option>
                            <option value="sky" {{ $hero_stats_card->color_theme == 'sky' ? 'selected' : '' }}>Sky Cyan</option>
                        </select>
                    </div>

                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 px-1">Slot Posisi</label>
                        <select name="position_slot" class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-4 px-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all appearance-none cursor-pointer">
                            <option value="TR" {{ $hero_stats_card->position_slot == 'TR' ? 'selected' : '' }}>Top Right</option>
                            <option value="TL" {{ $hero_stats_card->position_slot == 'TL' ? 'selected' : '' }}>Top Left</option>
                            <option value="MR" {{ $hero_stats_card->position_slot == 'MR' ? 'selected' : '' }}>Middle Right</option>
                            <option value="ML" {{ $hero_stats_card->position_slot == 'ML' ? 'selected' : '' }}>Middle Left</option>
                            <option value="BL" {{ $hero_stats_card->position_slot == 'BL' ? 'selected' : '' }}>Bottom Left</option>
                            <option value="BR" {{ $hero_stats_card->position_slot == 'BR' ? 'selected' : '' }}>Bottom Right</option>
                            <option value="TM" {{ $hero_stats_card->position_slot == 'TM' ? 'selected' : '' }}>Top Middle</option>
                            <option value="BM" {{ $hero_stats_card->position_slot == 'BM' ? 'selected' : '' }}>Bottom Middle</option>
                        </select>
                    </div>
                </div>

                <div class="pt-4 flex items-center gap-3">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ $hero_stats_card->is_active ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                        <span class="ml-3 text-sm font-bold text-gray-700">Tampilkan Secara Aktif di Hero Section</span>
                    </label>
                </div>
            </div>
        </div>

        {{-- Right: Info & Tips --}}
        <div class="lg:col-span-4 space-y-8 sticky top-8">
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-black/[0.02] p-8 space-y-8">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-indigo-600 rounded-xl flex items-center justify-center text-2xl shadow-inner">
                        <i class="ti ti-bulb"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none">Tips Desain</h3>
                        <p class="text-[12px] text-gray-400 font-bold mt-1.5 uppercase tracking-wider">Praktik Terbaik</p>
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

            <div class="p-8 bg-indigo-900 rounded-[2rem] text-white shadow-2xl shadow-indigo-900/30 relative overflow-hidden">
                 <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-3xl opacity-50"></div>
                 <div class="relative z-10 space-y-4">
                     <div class="flex items-center gap-3">
                         <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center backdrop-blur-sm">
                            <i class="ti ti-rocket text-amber-300"></i>
                         </div>
                         <span class="text-[10px] font-black text-indigo-200 uppercase tracking-widest">Growth Metric</span>
                     </div>
                     <h4 class="text-lg font-display font-bold leading-tight">Data Memberikan Kepercayaan.</h4>
                     <p class="text-xs text-indigo-100/70 leading-relaxed font-medium tracking-wide">Tampilkan angka yang membuktikan kualitas atau kepuasan pengguna layanan Anda.</p>
                 </div>
            </div>
        </div>
    </form>
</div>
@endsection
