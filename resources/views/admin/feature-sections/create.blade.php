@extends('layouts.admin')

@section('title', 'Tambah Feature Section')
@section('subtitle', 'Buat versi header Feature section baru untuk menampilkan visual mockup dan headline fitur di landing page.')

@section('breadcrumbs')
<div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white border border-[#E2E8F0]/70 text-xs text-[#64748B] shadow-2xs font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#007A87] flex items-center gap-1">
        <i class="ti ti-home text-sm"></i>
        <span>Dashboard</span>
    </a>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <a href="{{ route('admin.feature-sections.index') }}" class="hover:text-[#007A87]">
        <span>Feature Section</span>
    </a>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <span class="text-[#0F172A] font-semibold">Tambah Versi</span>
</div>
@endsection

@section('actions')
<div class="flex items-center gap-2">
    <a href="{{ route('admin.feature-sections.index') }}" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 text-xs font-bold shadow-2xs transition-all">
        <i class="ti ti-arrow-left text-sm"></i>
        <span>Batal</span>
    </a>
    <button type="submit" 
            form="feature-create-form" 
            class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
        <i class="ti ti-device-floppy text-sm"></i>
        <span>Simpan Versi Baru</span>
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

    <form id="feature-create-form" 
          action="{{ route('admin.feature-sections.store') }}" 
          method="POST" 
          enctype="multipart/form-data" 
          class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        @csrf

        <!-- Left Column: Branding & Headline (7 Cols) -->
        <div class="lg:col-span-7 space-y-5">
            
            <!-- Card 1: Branding & Headline -->
            <div class="card-clean p-5 lg:p-6 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-typography text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Identitas & Headline Utama</h3>
                        <p class="text-[11px] text-gray-400">Atur lencana intro dan judul penarik perhatian pengunjung</p>
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
                                   value="{{ old('title_badge', 'Keunggulan Kami') }}" 
                                   required
                                   placeholder="Contoh: Keunggulan Kami"
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
                                   value="{{ old('title_badge_icon', '🔥') }}" 
                                   required
                                   placeholder="Contoh: 🔥 atau ⚡"
                                   class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 pl-9 pr-3 text-xs text-gray-900 font-semibold focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                        </div>
                    </div>
                </div>

                <div>
                    <label for="headline" class="block text-xs font-bold text-gray-700 mb-1">
                        Headline Utama Section <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="headline" 
                              id="headline" 
                              rows="3" 
                              required
                              placeholder="Contoh: Solusi Terpadu untuk Mempercepat Alur Kerja dan Pertumbuhan Bisnis Anda"
                              class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 px-3 text-xs text-gray-900 font-bold leading-relaxed focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">{{ old('headline') }}</textarea>
                    <p class="text-[11px] text-gray-400 mt-1 italic">Headline ini akan tampil dengan ukuran besar di bagian atas daftar fitur aplikasi.</p>
                </div>
            </div>

            <!-- Card 2: Panduan Konten -->
            <div class="card-clean p-4 bg-gradient-to-br from-teal-50/70 to-emerald-50/40 border-teal-200/60">
                <div class="flex items-start gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-[#007A87] text-white flex items-center justify-center shrink-0 shadow-2xs">
                        <i class="ti ti-bulb text-sm"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-teal-950">Headline yang Menjual</h4>
                        <p class="text-[11px] text-teal-800/80 leading-relaxed mt-1">
                            Fokuskan pesan pada transformasi dan hasil akhir yang dinikmati pengguna, bukan sekadar daftar teknis aplikasi.
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column: Media Mockup & Status (5 Cols) -->
        <div class="lg:col-span-5 space-y-5 lg:sticky lg:top-24">
            
            <!-- Card 3: Media Mockup -->
            <div class="card-clean p-5 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-device-mobile-message text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Gambar Mockup Sentral</h3>
                        <p class="text-[11px] text-gray-400">Mockup aplikasi yang diposisikan di tengah fitur</p>
                    </div>
                </div>

                <!-- Image Upload Dropzone -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">
                        File Mockup (PNG Transparan Disarankan)
                    </label>
                    <div class="relative group bg-[#F8FAFC] border-2 border-dashed border-gray-200 rounded-2xl overflow-hidden hover:border-[#007A87] transition-all cursor-pointer">
                        <div class="aspect-[16/10] w-full flex flex-col items-center justify-center p-4 text-center">
                            <i class="ti ti-photo-plus text-4xl text-gray-300 mb-2 group-hover:scale-110 transition-transform" id="icon-preview"></i>
                            <p class="text-[11px] font-bold text-gray-600" id="text-preview">Pilih atau Seret Gambar Mockup</p>
                            <span class="text-[10px] text-gray-400 mt-0.5">PNG, JPG, WEBP maks 2MB</span>
                            <input type="file" 
                                   name="image_path" 
                                   accept="image/*"
                                   class="absolute inset-0 opacity-0 cursor-pointer z-20" 
                                   onchange="previewImage(this, 'preview-img', 'icon-preview', 'text-preview')">
                            <img id="preview-img" class="absolute inset-0 w-full h-full object-contain p-3 hidden z-10" alt="Preview Mockup">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center z-30 pointer-events-none">
                                <span class="bg-white text-[#007A87] text-[11px] font-bold px-3 py-1.5 rounded-lg shadow-md">Ganti File Visual</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-slate-50 rounded-xl border border-gray-100 text-[11px] text-gray-500 leading-relaxed">
                    💡 <strong>Tips Mockup:</strong> Gunakan gambar smartphone atau laptop berlatar belakang transparan (PNG/WEBP) dengan resolusi minimal 1000px agar terlihat tajam di layar Retina.
                </div>
            </div>

            <!-- Card 4: Status Publikasi -->
            <div class="card-clean p-5 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-eye-check text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Status Publikasi</h3>
                        <p class="text-[11px] text-gray-400">Tentukan apakah versi ini langsung aktif di web</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#007A87]"></div>
                        <span class="ml-2.5 text-xs font-bold text-gray-700">Aktifkan Versi Ini di Landing Page</span>
                    </label>
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
                const preview = document.getElementById(previewId);
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                const icon = document.getElementById(iconId);
                const text = document.getElementById(textId);
                if (icon) icon.classList.add('hidden');
                if (text) text.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
