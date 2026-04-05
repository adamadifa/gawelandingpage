@extends('layouts.admin')

@section('title', 'Features — Tambah Item')

@section('breadcrumbs')
<nav class="flex items-center gap-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest mb-2 font-poppins">
    <a href="{{ route('admin.hero-sections.index') }}" class="hover:text-brand-600 transition-colors">Landing Page</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <a href="{{ route('admin.feature-sections.index') }}" class="hover:text-brand-600 transition-colors">Feature Section</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <a href="{{ route('admin.features.index') }}" class="hover:text-brand-600 transition-colors">Daftar Item</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <span class="text-brand-600 font-semibold">Tambah Fitur</span>
</nav>
@endsection

@section('actions')
<div class="flex items-center gap-3 font-poppins">
     <a href="{{ route('admin.features.index') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-400 hover:text-gray-600 transition-colors">Batal</a>
     <button type="submit" form="feature-item-create-form" class="inline-flex items-center gap-2 px-7 py-3.5 bg-brand-600 text-white rounded-xl font-bold text-sm shadow-xl shadow-brand-600/20 hover:bg-brand-700 active:scale-95 transition-all">
        <i class="ti ti-device-floppy text-lg"></i>
        <span>Simpan Item Fitur</span>
    </button>
</div>
@endsection

@section('content')
<div class="w-full -mt-6 space-y-6 pb-20 font-poppins">

    <form id="feature-item-create-form" action="{{ route('admin.features.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start font-poppins">
        @csrf
        
        <div class="lg:col-span-12">
            @if ($errors->any())
                <div class="mb-8 p-4 bg-rose-50 border border-rose-100 rounded-xl flex items-start gap-3 shadow-sm">
                    <i class="ti ti-alert-triangle text-xl text-rose-500 mt-0.5"></i>
                    <ul class="text-sm text-rose-600 font-bold space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        {{-- Left: Content Details --}}
        <div class="lg:col-span-7 space-y-6">
            {{-- Primary Info Card --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-8">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-brand-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-brand-50">
                        <i class="ti ti-info-circle"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none tracking-tight">Informasi Fitur</h3>
                        <p class="text-[12px] text-gray-400 font-semibold mt-1.5 uppercase tracking-wider">Judul & Deskripsi</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700 px-1">Judul Fitur</label>
                        <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Absensi Geofencing Pintar"
                            class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 px-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all placeholder:text-gray-300 shadow-sm">
                    </div>
                    
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700 px-1">Deskripsi Singkat</label>
                        <textarea name="description" rows="6" required placeholder="Jelaskan secara singkat kegunaan fitur ini bagi pengguna..."
                            class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 px-6 text-gray-900 font-medium focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all placeholder:text-gray-300 leading-relaxed shadow-sm">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Technical & Status --}}
        <div class="lg:col-span-5 space-y-6 sticky top-8">
            {{-- Icon & Styling Card --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-8">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-brand-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-brand-50">
                        <i class="ti ti-icons"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none tracking-tight">Visual & Urutan</h3>
                        <p class="text-[12px] text-gray-400 font-semibold mt-1.5 uppercase tracking-wider">Icon & Susunan</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="space-y-4">
                        <label class="block text-sm font-semibold text-gray-700 px-1">Tabler Icon Class</label>
                        <div class="relative group">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-brand-50 text-brand-600 rounded-lg flex items-center justify-center transition-all group-focus-within:bg-brand-600 group-focus-within:text-white border border-brand-100/50" id="icon-preview-box">
                                <i class="ti {{ old('icon', 'ti-star') }} text-xl" id="icon-preview-el"></i>
                            </span>
                            <input type="text" name="icon" id="icon-input" value="{{ old('icon', 'ti-star') }}" required
                                class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 pl-16 pr-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all placeholder:text-gray-300 shadow-sm">
                        </div>
                        <div class="p-4 bg-brand-900 rounded-xl text-white/90 shadow-xl shadow-brand-900/10 border border-white/5">
                             <p class="text-[10px] font-bold uppercase tracking-widest mb-1.5 opacity-60">Instruksi Icon</p>
                             <p class="text-[11px] leading-relaxed font-medium">Gunakan class dari <a href="https://tabler.io/icons" target="_blank" class="text-brand-300 hover:text-brand-200 underline font-bold transition-colors">Tabler Icons</a>. Contoh: `ti-star`, `ti-device-mobile`.</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700 px-1">Urutan Tampilan</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 p-0.5"><i class="ti ti-sort-ascending-numbers"></i></span>
                            <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" required
                                class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 pl-12 pr-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all shadow-sm">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Visibility Status --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8">
                <div class="flex items-center justify-between font-poppins">
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
                        <div class="w-12 h-6.5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[3px] after:left-[3px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-600 shadow-sm transition-all"></div>
                    </label>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    const iconInput = document.getElementById('icon-input');
    const iconPreviewEl = document.getElementById('icon-preview-el');
    
    iconInput.addEventListener('input', function() {
        const val = this.value.trim();
        iconPreviewEl.className = 'ti ' + (val ? val : 'ti-help');
    });
</script>
@endsection
