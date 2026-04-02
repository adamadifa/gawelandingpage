@extends('layouts.admin')

@section('title', 'Features — Tambah Item')

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
                <a href="{{ route('admin.features.index') }}" class="hover:text-indigo-600 transition-colors">Daftar Item</a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <span class="text-indigo-600">Tambah Fitur</span>
            </nav>
            <h1 class="text-3xl font-display font-black text-gray-900 leading-tight">Buat Item Fitur Baru</h1>
            <p class="text-sm text-gray-500 font-medium font-poppins">Tambahkan poin keunggulan aplikasi yang akan ditampilkan di landing page.</p>
        </div>
        <div class="flex items-center gap-3">
             <a href="{{ route('admin.features.index') }}" class="px-5 py-2.5 text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors font-poppins">Batal</a>
             <button type="submit" form="feature-item-create-form" class="inline-flex items-center gap-2 px-7 py-3.5 bg-indigo-600 text-white rounded-2xl font-bold text-sm shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 active:scale-95 transition-all font-poppins">
                <i class="ti ti-device-floppy text-lg"></i>
                Simpan Item Fitur
            </button>
        </div>
    </div>

    <form id="feature-item-create-form" action="{{ route('admin.features.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start font-poppins">
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

        {{-- Left: Content Details --}}
        <div class="lg:col-span-7 space-y-8">
            {{-- Primary Info Card --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-8">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-indigo-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-indigo-50">
                        <i class="ti ti-info-circle"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none">Informasi Fitur</h3>
                        <p class="text-[12px] text-gray-400 font-bold mt-1.5 uppercase tracking-wider">Judul & Deskripsi</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 px-1">Judul Fitur</label>
                        <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Absensi Geofencing Pintar"
                            class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-4 px-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all placeholder:text-gray-300">
                    </div>
                    
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 px-1">Deskripsi Singkat</label>
                        <textarea name="description" rows="6" required placeholder="Jelaskan secara singkat kegunaan fitur ini bagi pengguna..."
                            class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-4 px-6 text-gray-900 font-medium focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all placeholder:text-gray-300 leading-relaxed">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Technical & Status --}}
        <div class="lg:col-span-5 space-y-8 sticky top-8">
            {{-- Icon & Styling Card --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-8">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-indigo-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-indigo-50">
                        <i class="ti ti-icons"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none">Visual & Urutan</h3>
                        <p class="text-[12px] text-gray-400 font-bold mt-1.5 uppercase tracking-wider">Icon & Susunan</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="space-y-4">
                        <label class="block text-sm font-bold text-gray-700 px-1">Tabler Icon Class</label>
                        <div class="relative group">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center transition-all group-focus-within:bg-indigo-600 group-focus-within:text-white" id="icon-preview-box">
                                <i class="ti {{ old('icon', 'ti-star') }} text-xl" id="icon-preview-el"></i>
                            </span>
                            <input type="text" name="icon" id="icon-input" value="{{ old('icon', 'ti-star') }}" required
                                class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-4 pl-16 pr-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all placeholder:text-gray-300">
                        </div>
                        <div class="p-4 bg-indigo-900 rounded-2xl text-white/90 shadow-lg shadow-indigo-900/10 border border-white/5">
                             <p class="text-[10px] font-black uppercase tracking-widest mb-1.5 opacity-60">Instruksi Icon</p>
                             <p class="text-[11px] leading-relaxed">Gunakan class dari <a href="https://tabler.io/icons" target="_blank" class="text-indigo-300 hover:text-indigo-200 underline font-bold transition-colors">Tabler Icons</a>. Contoh: `ti-star`, `ti-device-mobile`, dsb.</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 px-1">Urutan Tampilan</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 p-0.5"><i class="ti ti-sort-ascending-numbers"></i></span>
                            <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" required
                                class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-4 pl-12 pr-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all">
                        </div>
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
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                        <div class="w-12 h-6.5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[3px] after:left-[3px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600 shadow-sm transition-all"></div>
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
