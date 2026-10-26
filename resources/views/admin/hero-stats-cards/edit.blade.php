@extends('layouts.admin')

@section('title', 'Edit Kartu Statistik Hero')
@section('subtitle', 'Perbarui nilai metrik, label teks, tema warna, atau koordinat posisi kartu floating hero.')

@section('breadcrumbs')
<div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white border border-[#E2E8F0]/70 text-xs text-[#64748B] shadow-2xs font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#007A87] flex items-center gap-1">
        <i class="ti ti-home text-sm"></i>
        <span>Dashboard</span>
    </a>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <a href="{{ route('admin.hero-stats-cards.index') }}" class="hover:text-[#007A87]">
        <span>Counter Stats</span>
    </a>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <span class="text-[#0F172A] font-semibold">Edit #{{ $hero_stats_card->id }}</span>
</div>
@endsection

@section('actions')
<div class="flex items-center gap-2">
    <a href="{{ route('admin.hero-stats-cards.index') }}" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 text-xs font-bold shadow-2xs transition-all">
        <i class="ti ti-arrow-left text-sm"></i>
        <span>Batal</span>
    </a>

    <button type="submit" 
            form="stats-edit-form" 
            class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
        <i class="ti ti-device-floppy text-sm"></i>
        <span>Simpan Perubahan</span>
    </button>
</div>
@endsection

@section('content')
<div class="space-y-6" x-data="{
    title: '{{ old('title', $hero_stats_card->title) }}',
    value: '{{ old('value', $hero_stats_card->value) }}',
    icon: '{{ old('icon', $hero_stats_card->icon) }}',
    color_theme: '{{ old('color_theme', $hero_stats_card->color_theme) }}',
    position_slot: '{{ old('position_slot', $hero_stats_card->position_slot) }}'
}">

    @if ($errors->any())
        <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs">
            <div class="flex items-center gap-2 font-bold mb-1">
                <i class="ti ti-alert-triangle text-base"></i>
                <span>Terdapat kesalahan pada formulir:</span>
            </div>
            <ul class="list-disc pl-5 space-y-0.5 text-rose-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="stats-edit-form" 
          action="{{ route('admin.hero-stats-cards.update', $hero_stats_card) }}" 
          method="POST" 
          class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        @csrf
        @method('PUT')

        <!-- Left Column: Data & Configuration (7 Cols) -->
        <div class="lg:col-span-7 space-y-5">
            
            <!-- Card 1: Data Nilai & Judul -->
            <div class="card-clean p-5 lg:p-6 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-chart-bar text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Data & Teks Metrik</h3>
                        <p class="text-[11px] text-gray-400">Angka pencapaian dan label penjelasan</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="value" class="block text-xs font-bold text-gray-700 mb-1">
                            Nilai Statistik (Value) <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" 
                               name="value" 
                               id="value" 
                               x-model="value" 
                               value="{{ old('value', $hero_stats_card->value) }}" 
                               placeholder="Contoh: 98.5% atau 10k+" 
                               class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-900 font-bold placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all" 
                               required>
                    </div>

                    <div>
                        <label for="title" class="block text-xs font-bold text-gray-700 mb-1">
                            Judul / Label Singkat <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               x-model="title" 
                               value="{{ old('title', $hero_stats_card->title) }}" 
                               placeholder="Contoh: Kepuasan Pengguna" 
                               class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-900 font-semibold placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all" 
                               required>
                    </div>
                </div>
            </div>

            <!-- Card 2: Visual, Ikon & Posisi -->
            <div class="card-clean p-5 lg:p-6 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-palette text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Gaya Visual & Penempatan</h3>
                        <p class="text-[11px] text-gray-400">Pilih tema warna, ikon tabler, dan koordinat slot floating</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    
                    <!-- Ikon -->
                    <div>
                        <label for="icon" class="block text-xs font-bold text-gray-700 mb-1">
                            Kode Ikon (Tabler) <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <i class="ti ti-icons absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                            <input type="text" 
                                   name="icon" 
                                   id="icon" 
                                   x-model="icon" 
                                   value="{{ old('icon', $hero_stats_card->icon) }}" 
                                   placeholder="ti-users" 
                                   class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 pl-9 pr-3 text-xs text-gray-800 font-mono focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all" 
                                   required>
                        </div>
                    </div>

                    <!-- Warna -->
                    <div>
                        <label for="color_theme" class="block text-xs font-bold text-gray-700 mb-1">
                            Tema Warna <span class="text-rose-500">*</span>
                        </label>
                        <select name="color_theme" 
                                id="color_theme" 
                                x-model="color_theme" 
                                class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all cursor-pointer">
                            <option value="teal" {{ $hero_stats_card->color_theme == 'teal' ? 'selected' : '' }}>Teal (Primary)</option>
                            <option value="emerald" {{ $hero_stats_card->color_theme == 'emerald' ? 'selected' : '' }}>Emerald Green</option>
                            <option value="indigo" {{ $hero_stats_card->color_theme == 'indigo' ? 'selected' : '' }}>Indigo Blue</option>
                            <option value="amber" {{ $hero_stats_card->color_theme == 'amber' ? 'selected' : '' }}>Amber Orange</option>
                            <option value="rose" {{ $hero_stats_card->color_theme == 'rose' ? 'selected' : '' }}>Rose Red</option>
                            <option value="sky" {{ $hero_stats_card->color_theme == 'sky' ? 'selected' : '' }}>Sky Cyan</option>
                        </select>
                    </div>

                    <!-- Slot Posisi -->
                    <div>
                        <label for="position_slot" class="block text-xs font-bold text-gray-700 mb-1">
                            Slot Posisi <span class="text-rose-500">*</span>
                        </label>
                        <select name="position_slot" 
                                id="position_slot" 
                                x-model="position_slot" 
                                class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all cursor-pointer">
                            <option value="TR" {{ $hero_stats_card->position_slot == 'TR' ? 'selected' : '' }}>Top Right (Kanan Atas)</option>
                            <option value="TL" {{ $hero_stats_card->position_slot == 'TL' ? 'selected' : '' }}>Top Left (Kiri Atas)</option>
                            <option value="MR" {{ $hero_stats_card->position_slot == 'MR' ? 'selected' : '' }}>Middle Right (Kanan Tengah)</option>
                            <option value="ML" {{ $hero_stats_card->position_slot == 'ML' ? 'selected' : '' }}>Middle Left (Kiri Tengah)</option>
                            <option value="BL" {{ $hero_stats_card->position_slot == 'BL' ? 'selected' : '' }}>Bottom Left (Kiri Bawah)</option>
                            <option value="BR" {{ $hero_stats_card->position_slot == 'BR' ? 'selected' : '' }}>Bottom Right (Kanan Bawah)</option>
                            <option value="TM" {{ $hero_stats_card->position_slot == 'TM' ? 'selected' : '' }}>Top Middle (Tengah Atas)</option>
                            <option value="BM" {{ $hero_stats_card->position_slot == 'BM' ? 'selected' : '' }}>Bottom Middle (Tengah Bawah)</option>
                        </select>
                    </div>

                </div>

                <!-- Checkbox Aktif -->
                <div class="pt-2 flex items-center gap-3">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $hero_stats_card->is_active) ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#007A87]"></div>
                        <span class="ml-2.5 text-xs font-bold text-gray-700">Tampilkan Secara Aktif di Landing Page</span>
                    </label>
                </div>
            </div>

        </div>

        <!-- Right Column: Live Pratinjau Interaktif & Tips (5 Cols) -->
        <div class="lg:col-span-5 space-y-5 lg:sticky lg:top-24">
            
            <!-- Live Preview Card -->
            <div class="card-clean p-5 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-eye text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Pratinjau Kartu Melayang</h3>
                        <p class="text-[11px] text-gray-400">Simulasi tampilan kartu saat melayang di hero web</p>
                    </div>
                </div>

                <!-- Floating Badge Mockup Background -->
                <div class="p-8 rounded-xl bg-gradient-to-tr from-slate-100 to-slate-50 border border-gray-200 flex items-center justify-center relative min-h-[170px] overflow-hidden">
                    <div class="absolute inset-0 bg-[radial-gradient(#CBD5E1_1px,transparent_1px)] [background-size:12px_12px] opacity-40"></div>

                    <!-- The Live Badge Card -->
                    <div class="relative z-10 bg-white/95 backdrop-blur-md rounded-2xl border border-gray-200/90 shadow-xl p-4 flex items-center gap-3.5 max-w-[260px] transition-all">
                        <div class="w-11 h-11 rounded-xl bg-teal-50 text-[#007A87] border border-teal-200/60 flex items-center justify-center text-xl shrink-0 shadow-2xs">
                            <i :class="'ti ' + icon"></i>
                        </div>
                        <div class="min-w-0">
                            <h4 class="text-xl font-black text-gray-900 leading-tight tracking-tight" x-text="value || '10K+'"></h4>
                            <p class="text-[11.5px] font-semibold text-gray-500 leading-none truncate mt-0.5" x-text="title || 'Pengguna Aktif'"></p>
                        </div>
                    </div>
                </div>

                <div class="p-3 rounded-xl bg-slate-50 border border-gray-100 text-[11px] text-gray-500 leading-relaxed">
                    Slot posisi <span class="font-bold text-gray-700" x-text="position_slot"></span> menentukan sudut penempatan kartu di sekeliling mockup banner.
                </div>
            </div>

            <!-- Tips Card -->
            <div class="card-clean p-4 bg-gradient-to-br from-teal-50/70 to-emerald-50/40 border-teal-200/60">
                <div class="flex items-start gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-[#007A87] text-white flex items-center justify-center shrink-0 shadow-2xs">
                        <i class="ti ti-bulb text-sm"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-teal-950">Gunakan Metrik yang Kuat</h4>
                        <p class="text-[11px] text-teal-800/80 leading-relaxed mt-1">
                            Pilihlah angka konkret atau persentase yang membuktikan kepuasan pengguna dan kestabilan sistem Anda.
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </form>

</div>
@endsection
