@extends('layouts.admin')

@section('title', 'FAQ — Edit Section')

@section('breadcrumbs')
<nav class="flex items-center gap-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest mb-2 font-poppins">
    <a href="{{ route('admin.hero-sections.index') }}" class="hover:text-brand-600 transition-colors">Landing Page</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <a href="{{ route('admin.faq-sections.index') }}" class="hover:text-brand-600 transition-colors">FAQ Section</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <span class="text-brand-600 font-semibold">Edit Section</span>
</nav>
@endsection

@section('actions')
<div class="flex items-center gap-3 font-poppins">
     <a href="{{ route('admin.faq-sections.index') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-400 hover:text-gray-600 transition-colors">Batal</a>
     <button type="submit" form="faq-section-edit-form" class="inline-flex items-center gap-2 px-7 py-3.5 bg-brand-600 text-white rounded-xl font-bold text-sm shadow-xl shadow-brand-600/20 hover:bg-brand-700 active:scale-95 transition-all">
        <i class="ti ti-device-floppy text-lg"></i>
        <span>Simpan Perubahan</span>
    </button>
</div>
@endsection

@section('content')
<div class="w-full -mt-6 space-y-6 pb-0 font-poppins">
    
    <form id="faq-section-edit-form" action="{{ route('admin.faq-sections.update', $faq_section->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
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

        {{-- Left: Messaging & Branding --}}
        <div class="lg:col-span-7 space-y-6">
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-6 font-poppins">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-brand-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-brand-50">
                        <i class="ti ti-message-2"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none tracking-tight">Branding & Headline</h3>
                        <p class="text-[12px] text-gray-400 font-semibold mt-1.5 uppercase tracking-wider">Identitas & Pesan Utama</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700 px-1">Judul Lencana (Title Badge)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 p-0.5"><i class="ti ti-tag"></i></span>
                            <input type="text" name="title_badge" value="{{ old('title_badge', $faq_section->title_badge) }}" required
                                class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 pl-12 pr-6 text-gray-900 font-semibold focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all placeholder:text-gray-300 shadow-sm">
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700 px-1">Ikon Lencana (Emoji/Char)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 p-0.5"><i class="ti ti-sparkles"></i></span>
                            <input type="text" name="title_badge_icon" value="{{ old('title_badge_icon', $faq_section->title_badge_icon) }}" required
                                class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 pl-12 pr-6 text-gray-900 font-semibold focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all placeholder:text-gray-300 shadow-sm">
                        </div>
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-gray-700 px-1">Headline Utama</label>
                    <input type="text" name="headline" value="{{ old('headline', $faq_section->headline) }}" required placeholder="Frequently Asked Questions"
                        class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-5 px-8 text-gray-900 font-bold text-lg focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all placeholder:text-gray-300 shadow-sm">
                </div>

                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-gray-700 px-1">Deskripsi FAQ</label>
                    <textarea name="description" rows="5" required placeholder="Tuliskan paragraf pengantar untuk daftar pertanyaan..."
                        class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 px-6 text-gray-900 font-medium focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all placeholder:text-gray-300 leading-relaxed shadow-sm">{{ old('description', $faq_section->description) }}</textarea>
                </div>
            </div>
        </div>

        {{-- Right: Visual Mockups --}}
        <div class="lg:col-span-5 space-y-6 sticky top-8 font-poppins">
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-6">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-brand-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-brand-50">
                        <i class="ti ti-device-laptop"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none tracking-tight">Visual Assets</h3>
                        <p class="text-[12px] text-gray-400 font-semibold mt-1.5 uppercase tracking-wider">Dual Mockup Display</p>
                    </div>
                </div>

                <div class="space-y-8">
                    {{-- Primary Mockup --}}
                    <div class="space-y-4">
                        <label class="block text-sm font-bold text-gray-700 px-1">Main Mockup (Landscape)</label>
                        <div class="w-full aspect-video bg-white border-2 border-dashed border-gray-200 rounded-xl overflow-hidden hover:border-brand-600 hover:bg-white transition-all cursor-pointer shadow-inner relative group">
                            <div class="w-full h-full flex flex-col items-center justify-center p-6 text-center">
                                @if($faq_section->primary_image)
                                    <img src="{{ str_starts_with($faq_section->primary_image, 'images/') ? asset($faq_section->primary_image) : asset('storage/' . $faq_section->primary_image) }}" 
                                         class="absolute inset-0 w-full h-full object-contain z-10 p-4" id="preview-primary">
                                @else
                                    <i class="ti ti-photo-plus text-5xl text-brand-200 mb-3 group-hover:scale-110 transition-transform" id="icon-primary"></i>
                                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest" id="text-primary">Unggah Mockup Utama</p>
                                @endif
                                <input type="file" name="primary_image" class="absolute inset-0 opacity-0 cursor-pointer z-20" onchange="previewImage(this, 'preview-primary', 'icon-primary', 'text-primary')">
                                
                                <div class="absolute inset-0 bg-brand-900/60 opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-center justify-center z-30 pointer-events-none">
                                    <div class="bg-white text-brand-600 text-[10px] font-bold uppercase tracking-widest px-6 py-3 rounded-full shadow-2xl scale-90 group-hover:scale-100 transition-transform">Ganti Mockup Utama</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Secondary Mockup --}}
                    <div class="space-y-4">
                        <label class="block text-sm font-bold text-gray-700 px-1">Support Mockup (Portrait)</label>
                        <div class="w-full aspect-square bg-white border-2 border-dashed border-gray-200 rounded-xl overflow-hidden hover:border-brand-600 hover:bg-white transition-all cursor-pointer shadow-inner relative group">
                            <div class="w-full h-full flex flex-col items-center justify-center p-6 text-center">
                                @if($faq_section->secondary_image)
                                    <img src="{{ str_starts_with($faq_section->secondary_image, 'images/') ? asset($faq_section->secondary_image) : asset('storage/' . $faq_section->secondary_image) }}" 
                                         class="absolute inset-0 w-full h-full object-contain z-10 p-4" id="preview-secondary">
                                @else
                                    <i class="ti ti-photo-plus text-5xl text-brand-200 mb-3 group-hover:scale-110 transition-transform" id="icon-secondary"></i>
                                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest" id="text-secondary">Unggah Mockup Pendukung</p>
                                @endif
                                <input type="file" name="secondary_image" class="absolute inset-0 opacity-0 cursor-pointer z-20" onchange="previewImage(this, 'preview-secondary', 'icon-secondary', 'text-secondary')">
                                
                                <div class="absolute inset-0 bg-brand-900/60 opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-center justify-center z-30 pointer-events-none">
                                    <div class="bg-white text-brand-600 text-[10px] font-bold uppercase tracking-widest px-6 py-3 rounded-full shadow-2xl scale-90 group-hover:scale-100 transition-transform">Ganti Mockup Pendukung</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Visibility Status --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8">
                <div class="flex items-center justify-between font-poppins">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl shadow-inner border border-emerald-50">
                            <i class="ti ti-eye"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-900 leading-none tracking-tight">Visibility</h4>
                            <p class="text-[10px] text-gray-400 font-semibold mt-1 uppercase tracking-wider">Status Aktif</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ $faq_section->is_active ? 'checked' : '' }}>
                        <div class="w-12 h-6.5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[3px] after:left-[3px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-600 transition-all shadow-sm"></div>
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
                const icon = document.getElementById(iconId);
                const text = document.getElementById(textId);

                if (!preview) {
                    preview = document.createElement('img');
                    preview.id = previewId;
                    preview.className = "absolute inset-0 w-full h-full object-contain z-10 p-4 animate-fade-in";
                    input.parentElement.appendChild(preview);
                }

                preview.src = e.target.result;
                preview.classList.remove('hidden');
                
                if (icon) icon.classList.add('hidden');
                if (text) text.classList.add('hidden');
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
