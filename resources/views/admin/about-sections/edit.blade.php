@extends('layouts.admin')

@section('title', 'Edit About Section')
@section('subtitle', 'Perbarui konten narasi, poin keunggulan, CTA, dan media visual untuk section About.')

@section('breadcrumbs')
<div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white border border-[#E2E8F0]/70 text-xs text-[#64748B] shadow-2xs font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#007A87] flex items-center gap-1">
        <i class="ti ti-home text-sm"></i>
        <span>Dashboard</span>
    </a>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <a href="{{ route('admin.about-sections.index') }}" class="hover:text-[#007A87]">
        <span>About Section</span>
    </a>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <span class="text-[#0F172A] font-semibold">Edit #{{ $about_section->id }}</span>
</div>
@endsection

@section('actions')
<div class="flex items-center gap-2">
    <a href="{{ route('admin.about-sections.index') }}" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 text-xs font-bold shadow-2xs transition-all">
        <i class="ti ti-arrow-left text-sm"></i>
        <span>Batal</span>
    </a>
    <button type="submit" 
            form="about-edit-form" 
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

    <form id="about-edit-form" 
          action="{{ route('admin.about-sections.update', $about_section->id) }}" 
          method="POST" 
          enctype="multipart/form-data" 
          class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        @csrf
        @method('PUT')

        <!-- Left Column: Content & Features (7 Cols) -->
        <div class="lg:col-span-7 space-y-5">
            
            <!-- Card 1: Pesan & Narasi -->
            <div class="card-clean p-5 lg:p-6 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-blockquote text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Pesan & Narasi Utama</h3>
                        <p class="text-[11px] text-gray-400">Tentukan badge judul, ikon intro, headline, dan uraian lengkap</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="title_badge" class="block text-xs font-bold text-gray-700 mb-1">
                            Judul Lencana (Title Badge) <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <i class="ti ti-tag absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                            <input type="text" 
                                   name="title_badge" 
                                   id="title_badge"
                                   value="{{ old('title_badge', $about_section->title_badge) }}" 
                                   required
                                   class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 pl-9 pr-3 text-xs text-gray-900 font-semibold focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                        </div>
                    </div>

                    <div>
                        <label for="title_badge_icon" class="block text-xs font-bold text-gray-700 mb-1">
                            Ikon Lencana (Emoji/Icon) <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <i class="ti ti-sparkles absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                            <input type="text" 
                                   name="title_badge_icon" 
                                   id="title_badge_icon"
                                   value="{{ old('title_badge_icon', $about_section->title_badge_icon) }}" 
                                   required
                                   class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 pl-9 pr-3 text-xs text-gray-900 font-semibold focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                        </div>
                    </div>
                </div>

                <div>
                    <label for="headline" class="block text-xs font-bold text-gray-700 mb-1">
                        Headline Utama <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           name="headline" 
                           id="headline"
                           value="{{ old('headline', $about_section->headline) }}" 
                           required
                           class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-900 font-bold focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                </div>

                <div>
                    <label for="description" class="block text-xs font-bold text-gray-700 mb-1">
                        Deskripsi Lengkap <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="description" 
                              id="description" 
                              rows="4" 
                              required
                              class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 px-3 text-xs text-gray-900 font-medium leading-relaxed focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">{{ old('description', $about_section->description) }}</textarea>
                </div>
            </div>

            <!-- Card 2: Poin Unggulan / Checklist -->
            <div class="card-clean p-5 lg:p-6 space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                            <i class="ti ti-list-check text-base"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-[#0F172A]">Poin Unggulan (Checklist)</h3>
                            <p class="text-[11px] text-gray-400">Daftar kelebihan yang langsung meyakinkan calon pelanggan</p>
                        </div>
                    </div>
                    <button type="button" 
                            onclick="addItem()" 
                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-teal-50 hover:bg-teal-100 text-[#007A87] text-[11px] font-bold transition-all">
                        <i class="ti ti-plus text-xs"></i>
                        <span>Tambah Poin</span>
                    </button>
                </div>

                <div id="feature-items-container" class="space-y-2.5">
                    @php $items = old('feature_items', $about_section->feature_items ?? []); @endphp
                    @forelse($items as $index => $item)
                        <div class="flex items-center gap-2 feature-item group">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 border border-emerald-100">
                                <i class="ti ti-check text-sm font-bold"></i>
                            </div>
                            <input type="text" 
                                   name="feature_items[]" 
                                   value="{{ $item }}" 
                                   required 
                                   placeholder="Tulis poin keunggulan..."
                                   class="flex-1 bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-800 font-semibold focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                            <button type="button" 
                                    onclick="removeItem(this)" 
                                    class="p-2 text-gray-300 hover:text-rose-500 transition-colors"
                                    title="Hapus baris ini">
                                <i class="ti ti-trash text-base"></i>
                            </button>
                        </div>
                    @empty
                        <div class="flex items-center gap-2 feature-item group">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 border border-emerald-100">
                                <i class="ti ti-check text-sm font-bold"></i>
                            </div>
                            <input type="text" 
                                   name="feature_items[]" 
                                   required 
                                   placeholder="Contoh: Akses dashboard real-time 24/7"
                                   class="flex-1 bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-800 font-semibold focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                            <button type="button" 
                                    onclick="removeItem(this)" 
                                    class="p-2 text-gray-300 hover:text-rose-500 transition-colors"
                                    title="Hapus baris ini">
                                <i class="ti ti-trash text-base"></i>
                            </button>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

        <!-- Right Column: Media & Actions (5 Cols) -->
        <div class="lg:col-span-5 space-y-5 lg:sticky lg:top-24">
            
            <!-- Card 3: Media Visual -->
            <div class="card-clean p-5 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-photo-circle text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Media Visual Ilustrasi</h3>
                        <p class="text-[11px] text-gray-400">Upload foto utama dan kartu statistik melayang</p>
                    </div>
                </div>

                <!-- Main Image Upload -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">
                        Foto Utama (Main Image)
                    </label>
                    <div class="relative group bg-[#F8FAFC] border-2 border-dashed border-gray-200 rounded-2xl overflow-hidden hover:border-[#007A87] transition-all cursor-pointer">
                        <div class="aspect-[4/3] w-full flex flex-col items-center justify-center p-4 text-center">
                            @if($about_section->main_image)
                                <img src="{{ str_starts_with($about_section->main_image, 'images/') ? asset($about_section->main_image) : asset('storage/' . $about_section->main_image) }}" 
                                     class="absolute inset-0 w-full h-full object-cover z-10" 
                                     id="preview-main" 
                                     alt="Foto Utama">
                            @else
                                <i class="ti ti-user-circle text-3xl text-gray-300 mb-1 group-hover:scale-110 transition-transform" id="icon-main"></i>
                                <p class="text-[11px] font-bold text-gray-600" id="text-main">Pilih atau Seret Foto Utama</p>
                                <span class="text-[10px] text-gray-400 mt-0.5">PNG, JPG, WEBP maks 2MB</span>
                                <img id="preview-main" class="absolute inset-0 w-full h-full object-cover hidden z-10" alt="Preview Utama">
                            @endif
                            <input type="file" 
                                   name="main_image" 
                                   accept="image/*"
                                   class="absolute inset-0 opacity-0 cursor-pointer z-20" 
                                   onchange="previewImage(this, 'preview-main', 'icon-main', 'text-main')">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center z-30 pointer-events-none">
                                <span class="bg-white text-[#007A87] text-[11px] font-bold px-3 py-1.5 rounded-lg shadow-md">Ganti Foto Utama</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Floating Image Upload -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">
                        Floating Card / Badge Melayang
                    </label>
                    <div class="relative group bg-[#F8FAFC] border-2 border-dashed border-gray-200 rounded-2xl overflow-hidden hover:border-[#007A87] transition-all cursor-pointer">
                        <div class="aspect-[16/9] w-full flex flex-col items-center justify-center p-4 text-center">
                            @if($about_section->floating_image)
                                <img src="{{ str_starts_with($about_section->floating_image, 'images/') ? asset($about_section->floating_image) : asset('storage/' . $about_section->floating_image) }}" 
                                     class="absolute inset-0 w-full h-full object-cover z-10" 
                                     id="preview-floating" 
                                     alt="Floating Card">
                            @else
                                <i class="ti ti-chart-dots text-3xl text-gray-300 mb-1 group-hover:scale-110 transition-transform" id="icon-floating"></i>
                                <p class="text-[11px] font-bold text-gray-600" id="text-floating">Pilih Kartu Ilustrasi Floating</p>
                                <span class="text-[10px] text-gray-400 mt-0.5">PNG, JPG, WEBP maks 2MB</span>
                                <img id="preview-floating" class="absolute inset-0 w-full h-full object-cover hidden z-10" alt="Preview Floating">
                            @endif
                            <input type="file" 
                                   name="floating_image" 
                                   accept="image/*"
                                   class="absolute inset-0 opacity-0 cursor-pointer z-20" 
                                   onchange="previewImage(this, 'preview-floating', 'icon-floating', 'text-floating')">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center z-30 pointer-events-none">
                                <span class="bg-white text-[#007A87] text-[11px] font-bold px-3 py-1.5 rounded-lg shadow-md">Ganti Kartu Floating</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Card 4: CTA & Status -->
            <div class="card-clean p-5 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-link text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Tombol CTA & Status</h3>
                        <p class="text-[11px] text-gray-400">Atur teks tombol pengarah aksi dan visibilitas</p>
                    </div>
                </div>

                <div class="space-y-3">
                    <div>
                        <label for="cta_text" class="block text-xs font-bold text-gray-700 mb-1">Label Tombol CTA</label>
                        <input type="text" 
                               name="cta_text" 
                               id="cta_text" 
                               value="{{ old('cta_text', $about_section->cta_text) }}" 
                               placeholder="Contoh: Pelajari Selengkapnya"
                               class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-800 font-semibold focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                    </div>

                    <div>
                        <label for="cta_url" class="block text-xs font-bold text-gray-700 mb-1">URL Tujuan CTA</label>
                        <input type="text" 
                               name="cta_url" 
                               id="cta_url" 
                               value="{{ old('cta_url', $about_section->cta_url) }}" 
                               placeholder="Contoh: #pricing atau /registrasi"
                               class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-700 font-mono focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                    </div>

                    <div class="pt-2 flex items-center gap-3">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $about_section->is_active) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#007A87]"></div>
                            <span class="ml-2.5 text-xs font-bold text-gray-700">Tampilkan Secara Aktif di Web</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Card 5: Tips Desain -->
            <div class="card-clean p-4 bg-gradient-to-br from-teal-50/70 to-emerald-50/40 border-teal-200/60">
                <div class="flex items-start gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-[#007A87] text-white flex items-center justify-center shrink-0 shadow-2xs">
                        <i class="ti ti-bulb text-sm"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-teal-950">Tips Konten Efektif</h4>
                        <p class="text-[11px] text-teal-800/80 leading-relaxed mt-1">
                            Sertakan 3-5 poin keunggulan singkat agar mudah dipindai oleh calon pelanggan saat menelusuri halaman.
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </form>

</div>

<script>
    function previewImage(input, previewId, iconId, textId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                let preview = document.getElementById(previewId);
                if (preview) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                const icon = document.getElementById(iconId);
                const text = document.getElementById(textId);
                if (icon) icon.classList.add('hidden');
                if (text) text.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeItem(btn) {
        if (document.querySelectorAll('.feature-item').length > 1) {
            const item = btn.closest('.feature-item');
            item.remove();
        }
    }

    function addItem() {
        const container = document.getElementById('feature-items-container');
        const newItem = document.createElement('div');
        newItem.className = 'flex items-center gap-2 feature-item group';
        newItem.innerHTML = `
            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 border border-emerald-100">
                <i class="ti ti-check text-sm font-bold"></i>
            </div>
            <input type="text" 
                   name="feature_items[]" 
                   required 
                   placeholder="Tulis poin keunggulan berikutnya..."
                   class="flex-1 bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-800 font-semibold focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
            <button type="button" 
                    onclick="removeItem(this)" 
                    class="p-2 text-gray-300 hover:text-rose-500 transition-colors"
                    title="Hapus baris ini">
                <i class="ti ti-trash text-base"></i>
            </button>
        `;
        container.appendChild(newItem);
    }
</script>
@endsection
