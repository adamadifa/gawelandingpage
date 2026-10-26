@extends('layouts.admin')

@section('title', 'Edit FAQ Section')

@section('breadcrumbs')
<nav class="flex items-center gap-1.5 text-xs text-gray-400 font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#007A87] transition-colors flex items-center gap-1">
        <i class="ti ti-home"></i>
        <span>Dashboard</span>
    </a>
    <i class="ti ti-chevron-right text-[10px]"></i>
    <a href="{{ route('admin.faq-sections.index') }}" class="hover:text-[#007A87] transition-colors">FAQ Section</a>
    <i class="ti ti-chevron-right text-[10px]"></i>
    <span class="text-gray-700 font-bold">Edit Versi</span>
</nav>
@endsection

@section('actions')
<div class="flex items-center gap-2.5">
    <a href="{{ route('admin.faq-sections.index') }}" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 hover:border-gray-300 text-gray-600 text-xs font-bold transition-all shadow-2xs">
        <i class="ti ti-arrow-left text-sm"></i>
        <span>Kembali</span>
    </a>

    <button type="submit" 
            form="faq-section-edit-form" 
            class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
        <i class="ti ti-device-floppy text-sm"></i>
        <span>Simpan Perubahan</span>
    </button>
</div>
@endsection

@section('content')
@php
    $primaryUrl = $faq_section->primary_image ? (str_starts_with($faq_section->primary_image, 'images/') ? asset($faq_section->primary_image) : asset('storage/' . $faq_section->primary_image)) : '';
    $secondaryUrl = $faq_section->secondary_image ? (str_starts_with($faq_section->secondary_image, 'images/') ? asset($faq_section->secondary_image) : asset('storage/' . $faq_section->secondary_image)) : '';
@endphp

<div class="space-y-6" x-data="{
    title_badge: '{{ old('title_badge', $faq_section->title_badge) }}',
    title_badge_icon: '{{ old('title_badge_icon', $faq_section->title_badge_icon) }}',
    headline: '{{ old('headline', $faq_section->headline) }}',
    description: '{{ old('description', $faq_section->description) }}',
    primaryPreview: '{{ $primaryUrl }}',
    secondaryPreview: '{{ $secondaryUrl }}',
    previewImage(event, type) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                if (type === 'primary') this.primaryPreview = e.target.result;
                if (type === 'secondary') this.secondaryPreview = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
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

    <form id="faq-section-edit-form" 
          action="{{ route('admin.faq-sections.update', $faq_section->id) }}" 
          method="POST" 
          enctype="multipart/form-data" 
          class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        @csrf
        @method('PUT')

        <!-- Left Column: Branding, Content & Mockups (7 Cols) -->
        <div class="lg:col-span-7 space-y-5">
            
            <!-- Card 1: Branding & Headline -->
            <div class="card-clean p-5 lg:p-6 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-message-2 text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Branding & Pesan Utama</h3>
                        <p class="text-[11px] text-gray-400">Tentukan badge pengenal, headline, dan teks pengantar</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="title_badge" class="block text-xs font-bold text-gray-700 mb-1">
                            Judul Lencana (Title Badge) <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" 
                               name="title_badge" 
                               id="title_badge" 
                               x-model="title_badge"
                               value="{{ old('title_badge', $faq_section->title_badge) }}"
                               required 
                               placeholder="Contoh: FAQs"
                               class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-900 font-bold focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                    </div>

                    <div>
                        <label for="title_badge_icon" class="block text-xs font-bold text-gray-700 mb-1">
                            Ikon / Emoji Lencana <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" 
                               name="title_badge_icon" 
                               id="title_badge_icon" 
                               x-model="title_badge_icon"
                               value="{{ old('title_badge_icon', $faq_section->title_badge_icon) }}"
                               required 
                               placeholder="Contoh: 🔥 atau 💬"
                               class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-800 font-medium focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                    </div>
                </div>

                <div>
                    <label for="headline" class="block text-xs font-bold text-gray-700 mb-1">
                        Headline Utama <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           name="headline" 
                           id="headline" 
                           x-model="headline"
                           value="{{ old('headline', $faq_section->headline) }}"
                           required 
                           placeholder="Contoh: Pertanyaan yang Sering Diajukan"
                           class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-900 font-bold focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                </div>

                <div>
                    <label for="description" class="block text-xs font-bold text-gray-700 mb-1">
                        Deskripsi Pengantar
                    </label>
                    <textarea name="description" 
                              id="description" 
                              rows="4" 
                              x-model="description"
                              placeholder="Tuliskan kalimat pembuka yang ramah dan menenangkan keraguan calon pelanggan..."
                              class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 px-3 text-xs text-gray-800 font-medium leading-relaxed focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">{{ old('description', $faq_section->description) }}</textarea>
                </div>
            </div>

            <!-- Card 2: Visual Mockups -->
            <div class="card-clean p-5 lg:p-6 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-photo-check text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Visual Mockup Aplikasi</h3>
                        <p class="text-[11px] text-gray-400">Mockup utama (landscape) dan mockup pendukung (portrait)</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Primary Mockup -->
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1.5">
                            Mockup Utama (Landscape)
                        </label>
                        <div class="relative w-full aspect-video rounded-xl border-2 border-dashed border-gray-200 hover:border-[#007A87] bg-[#F8FAFC] flex flex-col items-center justify-center p-3 text-center transition-all overflow-hidden group">
                            <template x-if="primaryPreview">
                                <img :src="primaryPreview" class="absolute inset-0 w-full h-full object-contain p-2 z-10 bg-white">
                            </template>
                            <div x-show="!primaryPreview" class="flex flex-col items-center justify-center text-gray-400">
                                <i class="ti ti-photo-up text-2xl text-teal-600 mb-1"></i>
                                <span class="text-[11px] font-bold text-gray-600">Pilih Mockup Utama</span>
                                <span class="text-[9px] text-gray-400">Format PNG/WebP transparan</span>
                            </div>
                            <input type="file" 
                                   name="primary_image" 
                                   accept="image/*"
                                   @change="previewImage($event, 'primary')"
                                   class="absolute inset-0 opacity-0 cursor-pointer z-20">
                            <div class="absolute inset-0 bg-[#007A87]/10 opacity-0 group-hover:opacity-100 transition-opacity z-10 flex items-center justify-center pointer-events-none">
                                <span class="px-2.5 py-1 bg-white text-[#007A87] text-[10px] font-bold rounded-lg shadow-sm">Ganti Gambar</span>
                            </div>
                        </div>
                    </div>

                    <!-- Secondary Mockup -->
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1.5">
                            Mockup Pendukung (Portrait)
                        </label>
                        <div class="relative w-full aspect-video rounded-xl border-2 border-dashed border-gray-200 hover:border-[#007A87] bg-[#F8FAFC] flex flex-col items-center justify-center p-3 text-center transition-all overflow-hidden group">
                            <template x-if="secondaryPreview">
                                <img :src="secondaryPreview" class="absolute inset-0 w-full h-full object-contain p-2 z-10 bg-white">
                            </template>
                            <div x-show="!secondaryPreview" class="flex flex-col items-center justify-center text-gray-400">
                                <i class="ti ti-device-mobile text-2xl text-teal-600 mb-1"></i>
                                <span class="text-[11px] font-bold text-gray-600">Pilih Mockup Smartphone</span>
                                <span class="text-[9px] text-gray-400">Format PNG/WebP transparan</span>
                            </div>
                            <input type="file" 
                                   name="secondary_image" 
                                   accept="image/*"
                                   @change="previewImage($event, 'secondary')"
                                   class="absolute inset-0 opacity-0 cursor-pointer z-20">
                            <div class="absolute inset-0 bg-[#007A87]/10 opacity-0 group-hover:opacity-100 transition-opacity z-10 flex items-center justify-center pointer-events-none">
                                <span class="px-2.5 py-1 bg-white text-[#007A87] text-[10px] font-bold rounded-lg shadow-sm">Ganti Gambar</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column: Status & Live Preview (5 Cols) -->
        <div class="lg:col-span-5 space-y-5 lg:sticky lg:top-24">
            
            <!-- Card 3: Status Publikasi -->
            <div class="card-clean p-5 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-toggle-right text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Status Publikasi</h3>
                        <p class="text-[11px] text-gray-400">Tentukan apakah versi ini langsung aktif di web</p>
                    </div>
                </div>

                <div class="pt-1 flex items-center justify-between">
                    <div>
                        <span class="block text-xs font-bold text-gray-800">Aktifkan Section Ini</span>
                        <span class="text-[10px] text-gray-400">Otomatis menonaktifkan versi FAQ lain</span>
                    </div>
                    <input type="hidden" name="is_active" value="0">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $faq_section->is_active) ? 'checked' : '' }}>
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#007A87]"></div>
                    </label>
                </div>
            </div>

            <!-- Card 4: Simulasi Pratinjau Langsung -->
            <div class="card-clean p-5 space-y-3">
                <div class="flex items-center gap-2 pb-2 border-b border-gray-100">
                    <div class="w-6 h-6 rounded-md bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-eye text-xs"></i>
                    </div>
                    <h3 class="text-xs font-bold text-[#0F172A]">Simulasi Tampilan Header FAQ</h3>
                </div>

                <div class="p-4 rounded-xl bg-slate-50 border border-gray-200/80 space-y-3">
                    <!-- Badge -->
                    <div>
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md bg-teal-50 text-[#007A87] border border-teal-200/60 text-[10px] font-bold">
                            <span x-text="title_badge_icon || '🔥'"></span>
                            <span x-text="title_badge || 'FAQs'"></span>
                        </span>
                    </div>

                    <!-- Headline & Desc -->
                    <div>
                        <h4 class="text-xs font-extrabold text-gray-900 leading-tight" x-text="headline || 'Pertanyaan yang Sering Diajukan'"></h4>
                        <p class="text-[11px] text-gray-500 mt-1 line-clamp-3 leading-relaxed" x-text="description || 'Temukan jawaban lengkap seputar cara penggunaan sistem, aktivasi, dan integrasi modul...'"></p>
                    </div>

                    <!-- Visual Mockup Box Simulation -->
                    <div class="mt-2 pt-2 border-t border-gray-200/60">
                        <div class="text-[10px] font-bold text-gray-400 mb-1.5 uppercase tracking-wider">Pratinjau Visual:</div>
                        <div class="relative h-28 bg-white rounded-lg border border-gray-200/70 overflow-hidden flex items-center justify-center p-2">
                            <template x-if="primaryPreview">
                                <img :src="primaryPreview" class="h-full object-contain">
                            </template>
                            <template x-if="!primaryPreview">
                                <div class="flex flex-col items-center justify-center text-gray-300">
                                    <i class="ti ti-device-laptop text-2xl text-teal-700/40"></i>
                                    <span class="text-[9px]">Mockup Utama</span>
                                </div>
                            </template>

                            <template x-if="secondaryPreview">
                                <div class="absolute bottom-1 right-2 w-7 h-11 bg-white rounded shadow-sm border border-gray-100 overflow-hidden p-0.5">
                                    <img :src="secondaryPreview" class="w-full h-full object-contain">
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </form>

</div>
@endsection
