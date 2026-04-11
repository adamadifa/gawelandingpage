@extends('layouts.admin')

@section('title', 'About — Edit Content')

@section('breadcrumbs')
<nav class="flex items-center gap-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest mb-2 font-poppins">
    <a href="{{ route('admin.hero-sections.index') }}" class="hover:text-brand-600 transition-colors">Landing Page</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <a href="{{ route('admin.about-sections.index') }}" class="hover:text-brand-600 transition-colors">About Section</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <span class="text-brand-600 font-semibold">Edit Section</span>
</nav>
@endsection

@section('actions')
<div class="flex items-center gap-3 font-poppins">
     <a href="{{ route('admin.about-sections.index') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-400 hover:text-gray-600 transition-colors">Batal</a>
     <button type="submit" form="about-edit-form" class="inline-flex items-center gap-2 px-7 py-3.5 bg-brand-600 text-white rounded-xl font-bold text-sm shadow-xl shadow-brand-600/20 hover:bg-brand-700 active:scale-95 transition-all">
        <i class="ti ti-device-floppy text-lg"></i>
        <span>Simpan Perubahan</span>
    </button>
</div>
@endsection

@section('content')
<div class="w-full -mt-6 space-y-6 pb-0 font-poppins">

    <form id="about-edit-form" action="{{ route('admin.about-sections.update', $about_section->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
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

        {{-- Left: Content & Narrative --}}
        <div class="lg:col-span-8 space-y-6">
            {{-- Primary Content Card --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-6">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-brand-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-brand-50">
                        <i class="ti ti-blockquote"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none tracking-tight">Pesan & Narasi</h3>
                        <p class="text-[12px] text-gray-400 font-semibold mt-1.5 uppercase tracking-wider">Headline & Proposisi Nilai</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700 px-1">Judul Lencana (Title Badge)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 p-0.5"><i class="ti ti-tag"></i></span>
                            <input type="text" name="title_badge" value="{{ old('title_badge', $about_section->title_badge) }}" required
                                class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 pl-12 pr-6 text-gray-900 font-semibold focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all placeholder:text-gray-300 shadow-sm">
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700 px-1">Ikon Lencana (Emoji/Char)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 p-0.5"><i class="ti ti-sparkles"></i></span>
                            <input type="text" name="title_badge_icon" value="{{ old('title_badge_icon', $about_section->title_badge_icon) }}" required
                                class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 pl-12 pr-6 text-gray-900 font-semibold focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all placeholder:text-gray-300 shadow-sm">
                        </div>
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-gray-700 px-1">Headline Utama</label>
                    <input type="text" name="headline" value="{{ old('headline', $about_section->headline) }}" required
                        class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 px-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all placeholder:text-gray-300 shadow-sm">
                </div>

                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-gray-700 px-1">Deskripsi Detail</label>
                    <textarea name="description" rows="5" required
                        class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 px-6 text-gray-900 font-medium focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all leading-relaxed placeholder:text-gray-300 shadow-sm">{{ old('description', $about_section->description) }}</textarea>
                </div>
            </div>

            {{-- Feature Items Card --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-6">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-brand-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-brand-50">
                        <i class="ti ti-list-check"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none tracking-tight">Poin Unggulan</h3>
                        <p class="text-[12px] text-gray-400 font-semibold mt-1.5 uppercase tracking-wider">Highlight Fitur (Checklist)</p>
                    </div>
                </div>

                <div id="feature-items-container" class="space-y-4">
                    @php $items = old('feature_items', $about_section->feature_items ?? []); @endphp
                    @foreach($items as $index => $item)
                    <div class="flex items-center gap-4 feature-item group transition-all duration-300">
                        <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 shadow-sm border border-emerald-100/50 transition-all group-hover:bg-emerald-100 group-hover:scale-105">
                            <i class="ti ti-check text-xl"></i>
                        </div>
                        <input type="text" name="feature_items[]" value="{{ $item }}" required placeholder="Tulis poin keunggulan di sini..."
                            class="flex-1 bg-gray-50/50 border-gray-200 rounded-xl py-3.5 px-6 text-sm font-bold text-gray-700 focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all shadow-sm">
                        <button type="button" onclick="removeItem(this)" class="p-3 text-gray-300 hover:text-rose-500 transition-colors opacity-0 group-hover:opacity-100 focus:opacity-100">
                            <i class="ti ti-circle-x text-2xl"></i>
                        </button>
                    </div>
                    @endforeach
                </div>

                <button type="button" onclick="addItem()" class="inline-flex items-center gap-2.5 px-6 py-3.5 bg-gray-50 text-brand-600 rounded-xl font-bold text-[11px] uppercase tracking-widest hover:bg-brand-50 transition-all border border-brand-100/30">
                    <i class="ti ti-plus-circle text-lg"></i>
                    <span>Tambah Item Baru</span>
                </button>
            </div>
        </div>

        {{-- Right: Media & Configuration --}}
        <div class="lg:col-span-4 space-y-6 sticky top-8">
            {{-- Visual Media Card --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 space-y-6">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-brand-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-brand-50">
                        <i class="ti ti-photo-circle"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none tracking-tight">Media Visual</h3>
                        <p class="text-[12px] text-gray-400 font-semibold mt-1.5 uppercase tracking-wider">Foto & Floating Card</p>
                    </div>
                </div>

                <div class="space-y-8">
                    {{-- Main Image --}}
                    <div class="space-y-4">
                        <label class="block text-sm font-semibold text-gray-700 px-1">Foto Orang (Utama)</label>
                        <div class="relative group bg-white border-2 border-dashed border-gray-200 rounded-xl overflow-hidden hover:border-brand-600 hover:bg-white transition-all cursor-pointer shadow-inner">
                            <div class="aspect-[4/3] w-full flex flex-col items-center justify-center p-4">
                                @if($about_section->main_image)
                                    <img src="{{ str_starts_with($about_section->main_image, 'images/') ? asset($about_section->main_image) : asset('storage/' . $about_section->main_image) }}" 
                                         class="absolute inset-0 w-full h-full object-cover z-10" id="preview-main">
                                @else
                                    <i class="ti ti-user-plus text-4xl text-brand-200 mb-2 group-hover:scale-110 transition-transform" id="icon-main"></i>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest" id="text-main">Pilih Foto Utama</p>
                                @endif
                                <input type="file" name="main_image" class="absolute inset-0 opacity-0 cursor-pointer z-20" onchange="previewImage(this, 'preview-main', 'icon-main', 'text-main')">
                                <div class="absolute inset-0 bg-brand-900/40 opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-center justify-center z-30 pointer-events-none">
                                    <div class="bg-white text-brand-600 text-[10px] font-bold uppercase tracking-widest px-4 py-2 rounded-full shadow-2xl">Ganti Media</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Floating Image --}}
                    <div class="space-y-4">
                        <label class="block text-sm font-semibold text-gray-700 px-1">Floating Card Analytics</label>
                        <div class="relative group bg-white border-2 border-dashed border-gray-200 rounded-xl overflow-hidden hover:border-brand-600 hover:bg-white transition-all cursor-pointer shadow-inner">
                            <div class="aspect-[16/9] w-full flex flex-col items-center justify-center p-4">
                                @if($about_section->floating_image)
                                    <img src="{{ str_starts_with($about_section->floating_image, 'images/') ? asset($about_section->floating_image) : asset('storage/' . $about_section->floating_image) }}" 
                                         class="absolute inset-0 w-full h-full object-cover z-10" id="preview-floating">
                                @else
                                    <i class="ti ti-chart-dots text-4xl text-brand-200 mb-2 group-hover:scale-110 transition-transform" id="icon-floating"></i>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest" id="text-floating">Pilih Ikon Statistik</p>
                                @endif
                                <input type="file" name="floating_image" class="absolute inset-0 opacity-0 cursor-pointer z-20" onchange="previewImage(this, 'preview-floating', 'icon-floating', 'text-floating')">
                                <div class="absolute inset-0 bg-brand-900/40 opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-center justify-center z-30 pointer-events-none">
                                    <div class="bg-white text-brand-600 text-[10px] font-bold uppercase tracking-widest px-4 py-2 rounded-full shadow-2xl">Ganti Media</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Interaction & Status Card --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 space-y-6">
                <div class="flex items-center gap-3 p-1">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ $about_section->is_active ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-600"></div>
                        <span class="ml-3 text-sm font-semibold text-gray-700">Tampilkan Section Ini</span>
                    </label>
                </div>

                <div class="space-y-5 pt-4 border-t border-gray-50">
                    <div class="space-y-3">
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest px-1">CTA Button Label</label>
                        <input type="text" name="cta_text" value="{{ old('cta_text', $about_section->cta_text) }}"
                            class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-3 px-4 text-xs font-bold text-gray-700 focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all shadow-sm">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest px-1">CTA URL Destination</label>
                        <input type="text" name="cta_url" value="{{ old('cta_url', $about_section->cta_url) }}"
                            class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-3 px-4 text-xs font-medium text-gray-500 focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all shadow-sm">
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
                
                if (!preview) {
                    preview = document.createElement('img');
                    preview.id = previewId;
                    preview.className = "absolute inset-0 w-full h-full object-cover z-10 animate-fade-in";
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

    function removeItem(btn) {
        if(document.querySelectorAll('.feature-item').length > 1) {
            const item = btn.closest('.feature-item');
            item.classList.add('scale-95', 'opacity-0');
            setTimeout(() => item.remove(), 250);
        }
    }

    function addItem() {
        const container = document.getElementById('feature-items-container');
        const newItem = document.createElement('div');
        newItem.className = 'flex items-center gap-4 feature-item animate-fade-in transition-all duration-300 transform group';
        newItem.innerHTML = `
            <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 shadow-sm border border-emerald-100/50 transition-all group-hover:bg-emerald-100 group-hover:scale-105">
                <i class="ti ti-check text-xl"></i>
            </div>
            <input type="text" name="feature_items[]" required placeholder="Tulis poin keunggulan di sini..."
                class="flex-1 bg-gray-50/50 border-gray-200 rounded-xl py-3.5 px-6 text-sm font-bold text-gray-700 focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all shadow-sm">
            <button type="button" onclick="removeItem(this)" class="p-3 text-gray-300 hover:text-rose-500 transition-colors">
                <i class="ti ti-circle-x text-2xl"></i>
            </button>
        `;
        container.appendChild(newItem);
    }
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
</style>
@endsection
