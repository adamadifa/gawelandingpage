@extends('layouts.admin')

@section('title', 'Edit Hero Section')
@section('subtitle', 'Ubah headline pesan, deskripsi pendukung, tombol aksi, dan visual banner landing page.')

@section('breadcrumbs')
<div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white border border-[#E2E8F0]/70 text-xs text-[#64748B] shadow-2xs font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#007A87] flex items-center gap-1">
        <i class="ti ti-home text-sm"></i>
        <span>Dashboard</span>
    </a>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <a href="{{ route('admin.hero-sections.index') }}" class="hover:text-[#007A87]">
        <span>Hero Layout</span>
    </a>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <span class="text-[#0F172A] font-semibold">Edit #{{ $hero_section->id }}</span>
</div>
@endsection

@section('actions')
<div class="flex items-center gap-2">
    <a href="{{ route('admin.hero-sections.index') }}" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 text-xs font-bold shadow-2xs transition-all">
        <i class="ti ti-arrow-left text-sm"></i>
        <span>Batal</span>
    </a>

    <button type="submit" 
            form="hero-edit-form" 
            class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
        <i class="ti ti-device-floppy text-sm"></i>
        <span>Simpan Perubahan</span>
    </button>
</div>
@endsection

@section('content')
<div class="space-y-6">

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

    <form id="hero-edit-form" 
          action="{{ route('admin.hero-sections.update', $hero_section) }}" 
          method="POST" 
          enctype="multipart/form-data" 
          class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        @csrf
        @method('PUT')

        <!-- Left Column: Content Text & Actions (7 Cols) -->
        <div class="lg:col-span-7 space-y-5">
            
            <!-- Card 1: Pesan & Narasi Utama -->
            <div class="card-clean p-5 lg:p-6 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-text-recognition text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Pesan & Narasi Utama</h3>
                        <p class="text-[11px] text-gray-400">Headline utama dan deskripsi penawaran nilai produk</p>
                    </div>
                </div>

                <!-- Headline Input -->
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label for="headline" class="block text-xs font-bold text-gray-700">
                            Headline Utama <span class="text-rose-500">*</span>
                        </label>
                        <span class="text-[10.5px] text-gray-400">Saran: 8 – 12 kata ringkas & kuat</span>
                    </div>
                    <input type="text" 
                           name="headline" 
                           id="headline" 
                           value="{{ old('headline', $hero_section->headline) }}" 
                           placeholder="Contoh: Aplikasi POS & Kehadiran Modern untuk Bisnis Anda" 
                           class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 px-3.5 text-xs text-gray-900 font-bold placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all" 
                           required>
                </div>

                <!-- Sub-Headline Textarea -->
                <div>
                    <label for="sub_headline" class="block text-xs font-bold text-gray-700 mb-1">
                        Deskripsi Pendukung (Sub-Headline) <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="sub_headline" 
                              id="sub_headline" 
                              rows="4" 
                              placeholder="Tuliskan penjelasan singkat mengenai keuntungan dan fitur unggulan..." 
                              class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl p-3.5 text-xs text-gray-800 leading-relaxed placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all" 
                              required>{{ old('sub_headline', $hero_section->sub_headline) }}</textarea>
                </div>

                <!-- Status Aktif Switch -->
                <div class="pt-2 flex items-center gap-3">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $hero_section->is_active) ? 'checked' : '' }}>
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#007A87]"></div>
                        <span class="ml-2.5 text-xs font-bold text-gray-700">Jadikan Hero Aktif di Halaman Depan</span>
                    </label>
                </div>
            </div>

            <!-- Card 2: Tombol Aksi (Call To Action) -->
            <div class="card-clean p-5 lg:p-6 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-click text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Tombol Call To Action (CTA)</h3>
                        <p class="text-[11px] text-gray-400">Arahkan pengunjung ke formulir pendaftaran atau demo produk</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    
                    <!-- Tombol Utama (Primary) -->
                    <div class="p-4 rounded-xl bg-teal-50/50 border border-teal-200/60 space-y-3">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[#007A87]"></span>
                            <span class="text-[11px] font-bold text-[#007A87] uppercase tracking-wider">Tombol Utama (Primary)</span>
                        </div>
                        
                        <div>
                            <label for="cta_text" class="block text-[10.5px] font-bold text-gray-500 mb-1">Teks Tombol</label>
                            <input type="text" 
                                   name="cta_text" 
                                   id="cta_text" 
                                   value="{{ old('cta_text', $hero_section->cta_text) }}" 
                                   placeholder="Contoh: Coba Gratis Sekarang" 
                                   class="w-full bg-white border border-gray-200 rounded-lg py-2 px-3 text-xs text-gray-800 font-semibold focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87]">
                        </div>

                        <div>
                            <label for="cta_url" class="block text-[10.5px] font-bold text-gray-500 mb-1">Tautan / URL</label>
                            <input type="text" 
                                   name="cta_url" 
                                   id="cta_url" 
                                   value="{{ old('cta_url', $hero_section->cta_url) }}" 
                                   placeholder="#pricing atau /register" 
                                   class="w-full bg-white border border-gray-200 rounded-lg py-2 px-3 text-xs text-gray-700 font-medium focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87]">
                        </div>
                    </div>

                    <!-- Tombol Sekunder (Secondary) -->
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/70 space-y-3">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-gray-400"></span>
                            <span class="text-[11px] font-bold text-gray-600 uppercase tracking-wider">Tombol Sekunder (Secondary)</span>
                        </div>

                        <div>
                            <label for="cta_secondary_text" class="block text-[10.5px] font-bold text-gray-500 mb-1">Teks Tombol</label>
                            <input type="text" 
                                   name="cta_secondary_text" 
                                   id="cta_secondary_text" 
                                   value="{{ old('cta_secondary_text', $hero_section->cta_secondary_text) }}" 
                                   placeholder="Contoh: Lihat Fitur Unggulan" 
                                   class="w-full bg-white border border-gray-200 rounded-lg py-2 px-3 text-xs text-gray-800 font-semibold focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87]">
                        </div>

                        <div>
                            <label for="cta_secondary_url" class="block text-[10.5px] font-bold text-gray-500 mb-1">Tautan / URL</label>
                            <input type="text" 
                                   name="cta_secondary_url" 
                                   id="cta_secondary_url" 
                                   value="{{ old('cta_secondary_url', $hero_section->cta_secondary_url) }}" 
                                   placeholder="#features atau https://youtu.be/..." 
                                   class="w-full bg-white border border-gray-200 rounded-lg py-2 px-3 text-xs text-gray-700 font-medium focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87]">
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- Right Column: Media Mockup & Preview (5 Cols) -->
        <div class="lg:col-span-5 space-y-5 lg:sticky lg:top-24">
            
            <div class="card-clean p-5 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-photo text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Media Visual Mockup</h3>
                        <p class="text-[11px] text-gray-400">Ilustrasi atau tangkapan layar dashboard aplikasi</p>
                    </div>
                </div>

                <!-- Live Image Preview Container -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1.5">Pratinjau Gambar Mockup</label>
                    <div class="relative rounded-xl overflow-hidden bg-slate-100 border border-gray-200 group aspect-[16/10] flex items-center justify-center">
                        <img src="{{ $hero_section->image_path ? asset('storage/' . $hero_section->image_path) : 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&q=80&w=800' }}" 
                             id="image-preview" 
                             alt="Hero Preview Image" 
                             class="w-full h-full object-cover transition-all duration-300 group-hover:scale-105">
                        
                        <div class="absolute bottom-2 right-2 px-2 py-0.5 rounded bg-black/60 text-white text-[10px] font-bold backdrop-blur-2xs">
                            Pratinjau Banner
                        </div>
                    </div>
                </div>

                <!-- Upload Drag-Drop Box -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Ganti Berkas Gambar</label>
                    <div class="relative border-2 border-dashed border-gray-200 hover:border-[#007A87] bg-[#F8FAFC] hover:bg-teal-50/20 rounded-xl p-5 text-center transition-all cursor-pointer group">
                        <input type="file" 
                               name="image_path" 
                               id="image-input" 
                               accept="image/png,image/jpeg,image/webp" 
                               class="absolute inset-0 opacity-0 cursor-pointer z-10">
                        
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-10 h-10 rounded-xl bg-white border border-gray-200 text-[#007A87] flex items-center justify-center text-lg shadow-2xs group-hover:scale-110 transition-transform mb-2">
                                <i class="ti ti-cloud-upload"></i>
                            </div>
                            <p class="text-xs font-bold text-gray-800 group-hover:text-[#007A87] transition-colors">
                                Klik untuk pilih file baru
                            </p>
                            <p class="text-[10.5px] text-gray-400 mt-0.5">PNG, JPG, atau WebP (Maksimal 2MB)</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Design Tips Card -->
            <div class="card-clean p-4 bg-gradient-to-br from-teal-50/70 to-emerald-50/40 border-teal-200/60">
                <div class="flex items-start gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-[#007A87] text-white flex items-center justify-center shrink-0 shadow-2xs">
                        <i class="ti ti-bulb text-sm"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-teal-950">Tips Landing Page Berkualitas</h4>
                        <p class="text-[11px] text-teal-800/80 leading-relaxed mt-1">
                            Gunakan gambar mockup dengan background transparan atau rasio lebar 16:9 beresolusi tajam agar serasi dengan tata letak hero di perangkat mobile dan desktop.
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </form>

</div>

@push('scripts')
<script>
    // Live instant preview for image file upload
    const imageInput = document.getElementById('image-input');
    const imagePreview = document.getElementById('image-preview');

    if (imageInput && imagePreview) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    imagePreview.src = evt.target.result;
                    imagePreview.classList.add('opacity-80');
                    setTimeout(() => imagePreview.classList.remove('opacity-80'), 250);
                };
                reader.readAsDataURL(file);
            }
        });
    }
</script>
@endpush
@endsection
