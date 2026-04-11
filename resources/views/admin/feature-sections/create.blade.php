@extends('layouts.admin')

@section('title', 'Features — Tambah Versi')

@section('breadcrumbs')
<nav class="flex items-center gap-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest mb-2 font-poppins">
    <a href="{{ route('admin.hero-sections.index') }}" class="hover:text-brand-600 transition-colors">Landing Page</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <a href="{{ route('admin.feature-sections.index') }}" class="hover:text-brand-600 transition-colors">Feature Section</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <span class="text-brand-600 font-semibold">Tambah Versi</span>
</nav>
@endsection

@section('actions')
<div class="flex items-center gap-3 font-poppins">
     <a href="{{ route('admin.feature-sections.index') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-400 hover:text-gray-600 transition-colors">Batal</a>
     <button type="submit" form="feature-create-form" class="inline-flex items-center gap-2 px-7 py-3.5 bg-brand-600 text-white rounded-xl font-bold text-sm shadow-xl shadow-brand-600/20 hover:bg-brand-700 active:scale-95 transition-all">
        <i class="ti ti-device-floppy text-lg"></i>
        Simpan Versi Baru
    </button>
</div>
@endsection

@section('content')
<div class="w-full -mt-6 space-y-6 pb-0 font-poppins">

    <form id="feature-create-form" action="{{ route('admin.feature-sections.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start font-poppins">
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

        {{-- Left: Narrative & Branding --}}
        <div class="lg:col-span-7 space-y-6">
            {{-- Primary Content Card --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-6">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8 font-poppins">
                    <div class="w-12 h-12 bg-gray-50 text-brand-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-brand-50">
                        <i class="ti ti-typography"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none tracking-tight">Branding & Headline</h3>
                        <p class="text-[12px] text-gray-400 font-semibold mt-1.5 uppercase tracking-wider">Identitas & Pesan Utama</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 font-poppins">
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700 px-1">Judul Lencana (Title Badge)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 p-0.5"><i class="ti ti-tag"></i></span>
                            <input type="text" name="title_badge" value="{{ old('title_badge', 'Keunggulan Kami') }}" required
                                class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 pl-12 pr-6 text-gray-900 font-semibold focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all placeholder:text-gray-300 shadow-sm">
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700 px-1">Ikon Lencana (Emoji/Char)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 p-0.5"><i class="ti ti-sparkles"></i></span>
                            <input type="text" name="title_badge_icon" value="{{ old('title_badge_icon', '🔥') }}" required
                                class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 pl-12 pr-6 text-gray-900 font-semibold focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all placeholder:text-gray-300 shadow-sm">
                        </div>
                    </div>
                </div>

                <div class="space-y-3 font-poppins">
                    <label class="block text-sm font-semibold text-gray-700 px-1">Headline Utama</label>
                    <input type="text" name="headline" value="{{ old('headline') }}" required placeholder="Contoh: Solusi Terpadu untuk Bisnis Anda"
                        class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-5 px-8 text-gray-900 font-bold text-lg focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all placeholder:text-gray-300 shadow-sm">
                    <p class="text-[11px] text-gray-400 font-semibold mt-2 px-1 italic">Headline ini akan tampil mencolok di bagian atas daftar fitur.</p>
                </div>
            </div>
        </div>

        {{-- Right: Media & Visibility --}}
        <div class="lg:col-span-5 space-y-6 sticky top-8 font-poppins">
            {{-- Visual Media Card --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 space-y-6">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-brand-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-brand-50">
                        <i class="ti ti-device-mobile-message"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none tracking-tight">Media Mockup</h3>
                        <p class="text-[12px] text-gray-400 font-semibold mt-1.5 uppercase tracking-wider">Central Phone Preview</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="relative group bg-white border-2 border-dashed border-gray-200 rounded-xl overflow-hidden hover:border-brand-600 hover:bg-white transition-all cursor-pointer shadow-inner">
                        <div class="aspect-[16/10] w-full flex flex-col items-center justify-center p-6">
                            <i class="ti ti-photo-plus text-5xl text-brand-200 mb-3 group-hover:scale-110 transition-transform" id="icon-preview"></i>
                            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest text-center" id="text-preview">Unggah Gambar Mockup</p>
                            <input type="file" name="image_path" class="absolute inset-0 opacity-0 cursor-pointer z-20" onchange="previewImage(this, 'preview-img', 'icon-preview', 'text-preview')">
                            <img id="preview-img" class="absolute inset-0 w-full h-full object-contain hidden z-10 p-4 transition-all duration-500">
                            
                            <div class="absolute inset-0 bg-brand-900/60 opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-center justify-center z-30 pointer-events-none">
                                <div class="bg-white text-brand-600 text-[10px] font-bold uppercase tracking-widest px-6 py-3 rounded-full shadow-2xl scale-90 group-hover:scale-100 transition-transform">Pilih File Baru</div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 space-y-1.5 shadow-sm">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">💡 Rekomendasi Format</p>
                        <p class="text-[11px] text-gray-500 font-medium leading-relaxed">Gunakan gambar **PNG Transparan** (Phone Mockup) dengan lebar minimal **1000px** untuk hasil yang tajam dan elegan.</p>
                    </div>
                </div>
            </div>

            {{-- Visibility Card --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 space-y-6">
                <div class="flex items-center gap-4 justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl shadow-inner border border-emerald-50">
                            <i class="ti ti-eye-check"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-900 leading-none tracking-tight">Visibility</h4>
                            <p class="text-[10px] text-gray-400 font-semibold mt-1 uppercase tracking-wider">Status Publikasi</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                        <div class="w-12 h-6.5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[3px] after:left-[3px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-600 shadow-sm"></div>
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
                preview.classList.add('animate-fade-in');
                document.getElementById(iconId).classList.add('hidden');
                document.getElementById(textId).classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    .animate-fade-in {
        animation: fadeIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
</style>
@endsection
