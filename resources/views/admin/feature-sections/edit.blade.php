@extends('layouts.admin')

@section('title', 'Features — Edit Versi')

@section('content')
<div class="w-full space-y-8 pb-20 text-inter">
    
    {{-- Page Header --}}
    <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-100">
        <div>
            <nav class="flex items-center gap-2 text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">
                <a href="{{ route('admin.hero-sections.index') }}" class="hover:text-indigo-600 transition-colors">Landing Page</a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <a href="{{ route('admin.feature-sections.index') }}" class="hover:text-indigo-600 transition-colors">Feature Section</a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <span class="text-indigo-600">Edit Versi</span>
            </nav>
            <h1 class="text-3xl font-display font-black text-gray-900 leading-tight">Perbarui Versi Section</h1>
            <p class="text-sm text-gray-500 font-medium">Lakukan penyesuaian pada headline atau visual mockup utama.</p>
        </div>
        <div class="flex items-center gap-3">
             <a href="{{ route('admin.feature-sections.index') }}" class="px-5 py-2.5 text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">Batal</a>
             <button type="submit" form="feature-edit-form" class="inline-flex items-center gap-2 px-7 py-3.5 bg-indigo-600 text-white rounded-2xl font-bold text-sm shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 active:scale-95 transition-all font-poppins">
                <i class="ti ti-device-floppy text-lg"></i>
                Simpan Perubahan
            </button>
        </div>
    </div>

    <form id="feature-edit-form" action="{{ route('admin.feature-sections.update', $feature_section->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start font-poppins">
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

        {{-- Left: Narrative & Branding --}}
        <div class="lg:col-span-7 space-y-8 text-inter">
            {{-- Primary Content Card --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-8">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8 font-poppins">
                    <div class="w-12 h-12 bg-gray-50 text-indigo-600 rounded-xl flex items-center justify-center text-2xl shadow-inner">
                        <i class="ti ti-typography"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none">Branding & Headline</h3>
                        <p class="text-[12px] text-gray-400 font-bold mt-1.5 uppercase tracking-wider">Identitas & Pesan Utama</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 font-poppins">
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 px-1">Judul Lencana (Title Badge)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 p-0.5"><i class="ti ti-tag"></i></span>
                            <input type="text" name="title_badge" value="{{ old('title_badge', $feature_section->title_badge) }}" required
                                class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-4 pl-12 pr-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all placeholder:text-gray-300">
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 px-1">Ikon Lencana (Emoji/Char)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 p-0.5"><i class="ti ti-sparkles"></i></span>
                            <input type="text" name="title_badge_icon" value="{{ old('title_badge_icon', $feature_section->title_badge_icon) }}" required
                                class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-4 pl-12 pr-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all placeholder:text-gray-300">
                        </div>
                    </div>
                </div>

                <div class="space-y-3 font-poppins text-inter">
                    <label class="block text-xl font-bold text-gray-700 px-1">Headline Utama</label>
                    <input type="text" name="headline" value="{{ old('headline', $feature_section->headline) }}" required placeholder="Contoh: Solusi Terpadu untuk Bisnis Anda"
                        class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-5 px-8 text-gray-900 font-bold text-lg focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all placeholder:text-gray-300">
                    <p class="text-[11px] text-gray-400 font-bold mt-2 px-1 text-inter italic">Headline ini akan tampil mencolok di bagian atas daftar fitur.</p>
                </div>
            </div>
        </div>

        {{-- Right: Media & Visibility --}}
        <div class="lg:col-span-5 space-y-8 sticky top-8 font-poppins">
            {{-- Visual Media Card --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-black/[0.02] p-8 space-y-8">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-indigo-600 rounded-xl flex items-center justify-center text-2xl shadow-inner">
                        <i class="ti ti-device-mobile-message"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none">Media Mockup</h3>
                        <p class="text-[12px] text-gray-400 font-bold mt-1.5 uppercase tracking-wider">Central Phone Preview</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="relative group bg-white border-2 border-dashed border-gray-200 rounded-[2rem] overflow-hidden hover:border-indigo-600 hover:bg-white transition-all cursor-pointer shadow-inner">
                        <div class="aspect-[16/10] w-full flex flex-col items-center justify-center p-6 text-center">
                            @if($feature_section->image_path)
                                <img src="{{ str_starts_with($feature_section->image_path, 'images/') ? asset($feature_section->image_path) : asset('storage/' . $feature_section->image_path) }}" 
                                     class="absolute inset-0 w-full h-full object-contain z-10 p-4" id="preview-img">
                            @else
                                <i class="ti ti-photo-plus text-5xl text-indigo-100 mb-3 group-hover:scale-110 transition-transform" id="icon-preview"></i>
                                <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest" id="text-preview">Unggah Gambar Mockup</p>
                            @endif
                            <input type="file" name="image_path" class="absolute inset-0 opacity-0 cursor-pointer z-20" onchange="previewImage(this, 'preview-img', 'icon-preview', 'text-preview')">
                            
                            <div class="absolute inset-0 bg-indigo-900/60 opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-center justify-center z-30">
                                <div class="bg-white text-indigo-600 text-[10px] font-black uppercase tracking-widest px-6 py-3 rounded-full shadow-2xl scale-90 group-hover:scale-100 transition-transform">Ganti File Visual</div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 space-y-1.5">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">💡 Rekomendasi Format</p>
                        <p class="text-[11px] text-gray-500 font-medium">Gunakan gambar **PNG Transparan** (Phone Mockup) dengan lebar minimal **1000px** untuk hasil yang tajam dan elegan.</p>
                    </div>
                </div>
            </div>

            {{-- Visibility Card --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-black/[0.02] p-8 space-y-8">
                <div class="flex items-center gap-4 justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl shadow-inner">
                            <i class="ti ti-eye-check"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-black text-gray-900 leading-none">Visibility</h4>
                            <p class="text-[10px] text-gray-400 font-bold mt-1 uppercase tracking-wider">Status Publikasi</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ $feature_section->is_active ? 'checked' : '' }}>
                        <div class="w-12 h-6.5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[3px] after:left-[3px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600 shadow-sm"></div>
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
                let preview = document.getElementById(previewId);
                
                if (!preview) {
                    preview = document.createElement('img');
                    preview.id = previewId;
                    preview.className = "absolute inset-0 w-full h-full object-contain z-10 p-4 animate-fade-in";
                    input.parentElement.appendChild(preview);
                }
                
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                
                const icon = document.getElementById(iconId);
                const text = document.getElementById(textId);
                if(icon) icon.classList.add('hidden');
                if(text) text.classList.add('hidden');
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
