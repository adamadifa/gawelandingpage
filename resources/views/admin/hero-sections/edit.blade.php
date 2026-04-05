@extends('layouts.admin')

@section('breadcrumbs')
<nav class="flex items-center gap-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest mb-2">
    <a href="{{ route('admin.hero-sections.index') }}" class="hover:text-brand-600 transition-colors">Landing Page</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <span class="text-brand-600 font-semibold">Hero Section</span>
</nav>
@endsection

@section('actions')
<div class="flex items-center gap-3">
     <a href="{{ route('admin.hero-sections.index') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-400 hover:text-gray-600 transition-colors">Batal</a>
     <button type="submit" form="hero-edit-form" class="inline-flex items-center gap-2 px-7 py-3.5 bg-brand-600 text-white rounded-xl font-bold text-sm shadow-xl shadow-brand-600/20 hover:bg-brand-700 active:scale-95 transition-all font-poppins">
        <i class="ti ti-device-floppy text-lg"></i>
        Simpan Perubahan
    </button>
</div>
@endsection

@section('content')
<div class="w-full -mt-6 space-y-6 pb-20 font-poppins">

    <form id="hero-edit-form" action="{{ route('admin.hero-sections.update', $hero_section) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
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

        {{-- Left: Content Controls --}}
        <div class="lg:col-span-7 space-y-6">
            {{-- Main Content Card --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-6">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-brand-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-brand-50">
                        <i class="ti ti-text-recognition"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none tracking-tight">Pesan Utama</h3>
                        <p class="text-[12px] text-gray-400 font-semibold mt-1.5 uppercase tracking-wider">Headline & Narrative</p>
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="space-y-3">
                        <label class="flex justify-between items-end px-1">
                            <span class="text-sm font-semibold text-gray-700 tracking-wider">Headline Utama</span>
                            <span class="text-[10px] font-semibold text-gray-400 italic uppercase">Direkomendasikan max 10 kata</span>
                        </label>
                        <input type="text" name="headline" value="{{ old('headline', $hero_section->headline) }}" 
                            class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 px-6 text-gray-900 font-semibold focus:bg-white focus:ring-4 focus:ring-brand-100/50 focus:border-brand-600 transition-all placeholder:text-gray-300" 
                            placeholder="Contoh: Kelola Presensi dengan Cerdas..." required>
                    </div>
                    
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700 tracking-wider px-1">Deskripsi Pendukung (Sub-Headline)</label>
                        <textarea name="sub_headline" rows="5" 
                            class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 px-6 text-gray-900 font-medium focus:bg-white focus:ring-4 focus:ring-brand-100/50 focus:border-brand-600 transition-all leading-relaxed placeholder:text-gray-300" 
                            placeholder="Tuliskan proposisi nilai yang menarik bagi calon pelanggan..." required>{{ old('sub_headline', $hero_section->sub_headline) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Call to Actions Card --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-6">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-brand-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-brand-50">
                        <i class="ti ti-click"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none tracking-tight">Interaksi Tombol</h3>
                        <p class="text-[12px] text-gray-400 font-semibold mt-1.5 uppercase tracking-wider">Primary & Secondary Actions</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">
                    {{-- Primary --}}
                    <div class="space-y-5 p-6 bg-brand-50/50 rounded-2xl border border-brand-100/50">
                        <div class="flex items-center gap-2 mb-2">
                             <div class="w-2 h-2 rounded-full bg-brand-500"></div>
                             <span class="text-[11px] font-bold text-brand-700 tracking-wide uppercase">Tombol Utama</span>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-[10px] font-semibold text-gray-400 mb-2 ml-1 px-1 uppercase tracking-widest">Label</label>
                                <input type="text" name="cta_text" value="{{ old('cta_text', $hero_section->cta_text) }}" 
                                    class="w-full bg-white border-gray-200 rounded-xl py-3 px-4 text-sm font-semibold text-gray-700 focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all shadow-sm">
                            </div>
                            <div>
                                <label class="block text-[10px] font-semibold text-gray-400 mb-2 ml-1 px-1 uppercase tracking-widest">Tautan URL</label>
                                <input type="text" name="cta_url" value="{{ old('cta_url', $hero_section->cta_url) }}" 
                                    class="w-full bg-white border-gray-200 rounded-xl py-3 px-4 text-sm font-medium text-gray-500 focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all shadow-sm">
                            </div>
                        </div>
                    </div>

                    {{-- Secondary --}}
                    <div class="space-y-5 p-6 bg-gray-50/50 rounded-3xl border border-gray-100">
                        <div class="flex items-center gap-2 mb-2">
                             <div class="w-2 h-2 rounded-full bg-gray-400"></div>
                             <span class="text-[11px] font-black text-gray-500 tracking-wide uppercase">Tombol Sekunder</span>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 mb-2 ml-1 px-1 uppercase">Label</label>
                                <input type="text" name="cta_secondary_text" value="{{ old('cta_secondary_text', $hero_section->cta_secondary_text) }}" 
                                    class="w-full bg-white border-gray-200 rounded-xl py-3 px-4 text-sm font-bold text-gray-700 focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 mb-2 ml-1 px-1 uppercase">Tautan URL</label>
                                <input type="text" name="cta_secondary_url" value="{{ old('cta_secondary_url', $hero_section->cta_secondary_url) }}" 
                                    class="w-full bg-white border-gray-200 rounded-xl py-3 px-4 text-sm font-medium text-gray-500 focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Media & Preview --}}
        <div class="lg:col-span-5 space-y-6 sticky top-8">
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 space-y-6">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-brand-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-brand-50">
                        <i class="ti ti-photo-circle"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none tracking-tight">Media Visual</h3>
                        <p class="text-[12px] text-gray-400 font-semibold mt-1.5 uppercase tracking-wider">Mockup & Illustrations</p>
                    </div>
                </div>

                <div class="space-y-8">
                    {{-- Large Preview --}}
                    <div class="space-y-4">
                        <label class="block text-sm font-semibold text-gray-700 tracking-wider px-1">Pratinjau Saat Ini</label>
                        <div class="relative group bg-gray-50 rounded-xl overflow-hidden border border-gray-100 shadow-inner group">
                            <div class="aspect-[4/3] w-full bg-gray-50 overflow-hidden">
                                <img src="{{ $hero_section->image_path ? asset('storage/' . $hero_section->image_path) : 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&q=80&w=800' }}" 
                                     id="image-preview" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="Current Image">
                                <div class="absolute inset-0 bg-brand-900/40 opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-center justify-center pointer-events-none">
                                    <div class="bg-white text-brand-600 text-[10px] font-bold uppercase tracking-widest px-4 py-2.5 rounded-full shadow-2xl">
                                        Current Preview
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Upload Interface --}}
                    <div class="space-y-4">
                        <label class="block text-sm font-semibold text-gray-700 tracking-wider px-1">Ganti Media Visual</label>
                        <div class="relative w-full aspect-video bg-gray-50 border-2 border-dashed border-gray-200 rounded-xl overflow-hidden hover:border-brand-600 hover:bg-white transition-all cursor-pointer shadow-inner group">
                            <div class="w-full h-full flex flex-col items-center justify-center p-6 text-center">
                                <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-brand-300 group-hover:text-brand-600 group-hover:scale-110 group-hover:rotate-6 transition-all shadow-sm mb-4">
                                    <i class="ti ti-cloud-upload text-2xl"></i>
                                </div>
                                <p class="text-sm font-bold text-gray-900 group-hover:text-brand-600">Tekan untuk ganti gambar</p>
                                <p class="text-[10px] text-gray-400 font-semibold mt-2">PNG, JPG, WebP <span class="mx-1">•</span> Max. 2MB</p>
                                <input type="file" name="image_path" class="absolute inset-0 opacity-0 cursor-pointer z-20" id="image-input" accept="image/*">
                                
                                <div class="absolute inset-0 bg-brand-900/60 opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-center justify-center z-30 pointer-events-none">
                                    <div class="bg-white text-brand-600 text-[10px] font-semibold uppercase tracking-widest px-6 py-3 rounded-full shadow-2xl scale-90 group-hover:scale-100 transition-transform">Pilih File Baru</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tips Card --}}
            <div class="p-8 bg-brand-900 rounded-xl text-white shadow-2xl shadow-brand-900/30 relative overflow-hidden">
                 <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-3xl opacity-50"></div>
                 <div class="relative z-10 space-y-4">
                     <div class="flex items-center gap-3">
                         <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center backdrop-blur-sm">
                            <i class="ti ti-bulb text-amber-300"></i>
                         </div>
                         <span class="text-[10px] font-semibold text-brand-200 uppercase tracking-widest">Tips Optimasi</span>
                     </div>
                     <h4 class="text-lg font-display font-bold leading-tight">Gunakan Headline yang Menghipnotis.</h4>
                     <p class="text-[11px] text-brand-100/70 leading-relaxed font-medium tracking-wide">Berikan solusi utama dalam 5 detik pertama.</p>
                 </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Live preview for image upload
    document.getElementById('image-input').addEventListener('change', function(e) {
        const preview = document.getElementById('image-preview');
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.add('scale-105');
                setTimeout(() => preview.classList.remove('scale-105'), 300);
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
@endsection
