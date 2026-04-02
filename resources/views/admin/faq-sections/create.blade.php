@extends('layouts.admin')

@section('title', 'FAQ — Tambah Section')

@section('content')
<div class="w-full space-y-8 pb-20 text-inter font-poppins">
    
    {{-- Page Header --}}
    <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-100">
        <div>
            <nav class="flex items-center gap-2 text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">
                <a href="{{ route('admin.hero-sections.index') }}" class="hover:text-indigo-600 transition-colors">Landing Page</a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <a href="{{ route('admin.faq-sections.index') }}" class="hover:text-indigo-600 transition-colors">FAQ Section</a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <span class="text-indigo-600 font-bold">New Section</span>
            </nav>
            <h1 class="text-3xl font-display font-black text-gray-900 leading-tight">Buat Section FAQ Baru</h1>
            <p class="text-sm text-gray-500 font-medium">Buat pesan headline dan visual mockup yang memukau untuk Tanya Jawab.</p>
        </div>
        <div class="flex items-center gap-3">
             <a href="{{ route('admin.faq-sections.index') }}" class="px-5 py-2.5 text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">Batal</a>
             <button type="submit" form="faq-section-create-form" class="inline-flex items-center gap-2 px-7 py-3.5 bg-indigo-600 text-white rounded-2xl font-bold text-sm shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 active:scale-95 transition-all">
                <i class="ti ti-device-floppy text-lg"></i>
                Simpan Section
            </button>
        </div>
    </div>

    <form id="faq-section-create-form" action="{{ route('admin.faq-sections.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        @csrf

        {{-- Left: Messaging & Branding --}}
        <div class="lg:col-span-7 space-y-8">
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-8">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-indigo-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-indigo-50">
                        <i class="ti ti-message-2"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none">Pesan & Branding</h3>
                        <p class="text-[12px] text-gray-400 font-bold mt-1.5 uppercase tracking-wider">Headline & Badge</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 px-1">Teks Badge</label>
                        <input type="text" name="title_badge" value="{{ old('title_badge', 'FAQs') }}" required placeholder="Contoh: FAQs"
                            class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-4 px-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all placeholder:text-gray-300">
                    </div>
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 px-1">Icon Badge</label>
                        <input type="text" name="title_badge_icon" value="{{ old('title_badge_icon', '🔥') }}" required placeholder="Emoji atau Icon"
                            class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-4 px-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all text-center">
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="block text-sm font-bold text-gray-700 px-1">Judul Headline</label>
                    <input type="text" name="headline" value="{{ old('headline') }}" required placeholder="Frequently Asked Questions"
                        class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-4 px-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all placeholder:text-gray-300">
                </div>

                <div class="space-y-3">
                    <label class="block text-sm font-bold text-gray-700 px-1">Deskripsi FAQ</label>
                    <textarea name="description" rows="5" required placeholder="Tuliskan paragraf pengantar untuk daftar pertanyaan..."
                        class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-4 px-6 text-gray-900 font-medium focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all placeholder:text-gray-300 leading-relaxed">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>

        {{-- Right: Visual Mockups --}}
        <div class="lg:col-span-5 space-y-8">
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-8">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-indigo-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-indigo-50">
                        <i class="ti ti-device-laptop"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none">Visual Assets</h3>
                        <p class="text-[12px] text-gray-400 font-bold mt-1.5 uppercase tracking-wider">Dual Mockup Display</p>
                    </div>
                </div>

                <div class="space-y-8">
                    {{-- Primary Mockup --}}
                    <div class="space-y-4">
                        <label class="block text-sm font-bold text-gray-700 px-1">Main Mockup (Landscape)</label>
                        <div class="w-full aspect-video bg-gray-50 rounded-[2rem] border-2 border-dashed border-gray-200 flex flex-col items-center justify-center p-4 relative group overflow-hidden hover:border-indigo-400 transition-all">
                            <i class="ti ti-photo-plus text-4xl text-gray-300 group-hover:scale-110 transition-transform" id="icon-primary"></i>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mt-2" id="text-primary">Click to Upload</p>
                            <input type="file" name="primary_image" required class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImage(this, 'preview-primary', 'icon-primary', 'text-primary')">
                            <img id="preview-primary" class="absolute inset-0 w-full h-full object-cover hidden group-hover:scale-105 transition-transform duration-500">
                        </div>
                    </div>

                    {{-- Secondary Mockup --}}
                    <div class="space-y-4">
                        <label class="block text-sm font-bold text-gray-700 px-1">Support Mockup (Portrait)</label>
                        <div class="w-full aspect-square bg-gray-50 rounded-[2rem] border-2 border-dashed border-gray-200 flex flex-col items-center justify-center p-4 relative group overflow-hidden hover:border-indigo-400 transition-all">
                            <i class="ti ti-photo-plus text-4xl text-gray-300 group-hover:scale-110 transition-transform" id="icon-secondary"></i>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mt-2" id="text-secondary">Click to Upload</p>
                            <input type="file" name="secondary_image" required class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImage(this, 'preview-secondary', 'icon-secondary', 'text-secondary')">
                            <img id="preview-secondary" class="absolute inset-0 w-full h-full object-cover hidden group-hover:scale-105 transition-transform duration-500">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Visibility Status --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-black/[0.02] p-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl shadow-inner">
                            <i class="ti ti-eye"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-black text-gray-900 leading-none">Visibility</h4>
                            <p class="text-[10px] text-gray-400 font-bold mt-1 uppercase tracking-wider">Status Aktif</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                        <div class="w-12 h-6.5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[3px] after:left-[3px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600 transition-all"></div>
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
                document.getElementById(iconId).classList.add('hidden');
                document.getElementById(textId).classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
