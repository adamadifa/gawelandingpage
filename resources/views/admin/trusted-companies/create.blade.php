@extends('layouts.admin')

@section('title', 'Partners — Tambah Partner')

@section('breadcrumbs')
<nav class="flex items-center gap-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest mb-2 font-poppins">
    <a href="{{ route('admin.hero-sections.index') }}" class="hover:text-brand-600 transition-colors">Landing Page</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <a href="{{ route('admin.trusted-companies.index') }}" class="hover:text-brand-600 transition-colors">Trusted Companies</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <span class="text-brand-600 font-semibold">Tambah Partner</span>
</nav>
@endsection

@section('actions')
<div class="flex items-center gap-3 font-poppins">
     <a href="{{ route('admin.trusted-companies.index') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-400 hover:text-gray-600 transition-colors">Batal</a>
     <button type="submit" form="partner-create-form" class="inline-flex items-center gap-2 px-7 py-3.5 bg-brand-600 text-white rounded-xl font-bold text-sm shadow-xl shadow-brand-600/20 hover:bg-brand-700 active:scale-95 transition-all">
        <i class="ti ti-device-floppy text-lg"></i>
        <span>Simpan Partner</span>
    </button>
</div>
@endsection

@section('content')
<div class="w-full -mt-6 space-y-6 pb-0 font-poppins text-inter">

    <form id="partner-create-form" action="{{ route('admin.trusted-companies.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        @csrf

        {{-- Left: Identity & Media --}}
        <div class="lg:col-span-8 space-y-6">
            {{-- Identitas Partner --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-8 text-inter">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-brand-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-brand-50">
                        <i class="ti ti-building"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none tracking-tight">Identitas Partner</h3>
                        <p class="text-[12px] text-gray-400 font-semibold mt-1.5 uppercase tracking-wider">Informasi Perusahaan</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700 px-1 uppercase tracking-widest">Nama Perusahaan / Brand</label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Biznet GIO, Google, Telkom"
                            class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 px-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all placeholder:text-gray-300 shadow-sm">
                    </div>
                </div>
            </div>

            {{-- Media Logo --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-8 text-inter">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-brand-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-brand-50">
                        <i class="ti ti-photo"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none tracking-tight">Logo Partner</h3>
                        <p class="text-[12px] text-gray-400 font-semibold mt-1.5 uppercase tracking-wider">Aset Visual (SVG/PNG)</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="relative group">
                        <input type="file" name="logo" id="logo-input" accept="image/*" class="hidden" onchange="previewImage(this, 'logo-preview-container')">
                        <label for="logo-input" id="logo-dropzone" class="relative flex flex-col items-center justify-center w-full min-h-[320px] bg-gray-50/50 border-2 border-dashed border-gray-200 rounded-2xl cursor-pointer hover:bg-white hover:border-brand-400 hover:shadow-2xl hover:shadow-brand-600/5 transition-all duration-500 overflow-hidden group/zone">
                            <div id="logo-preview-container" class="flex flex-col items-center justify-center py-10 px-6">
                                <div class="w-20 h-20 bg-white rounded-3xl shadow-lg border border-gray-100 flex items-center justify-center mb-6 group-hover/zone:scale-110 transition-transform duration-500">
                                    <i class="ti ti-cloud-upload text-3xl text-brand-500"></i>
                                </div>
                                <h4 class="text-lg font-bold text-gray-900 mb-2 uppercase tracking-widest">Upload Logo Partner</h4>
                                <p class="text-xs text-gray-400 font-semibold uppercase tracking-[0.1em] text-center max-w-[280px]">Drag and drop file logo atau klik untuk memilih asset (Max 2MB)</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Side Settings --}}
        <div class="lg:col-span-4 space-y-6">
            {{-- Order & Display --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-8 text-inter">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-brand-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-brand-50">
                        <i class="ti ti-sort-ascending"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none tracking-tight">Pengaturan</h3>
                        <p class="text-[12px] text-gray-400 font-semibold mt-1.5 uppercase tracking-wider">Urutan & Prioritas</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700 px-1 uppercase tracking-widest">Urutan Tampilan</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" required 
                            class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 px-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all shadow-sm">
                    </div>
                </div>
            </div>

            {{-- Visibility Status --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 text-inter">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl shadow-inner border border-emerald-50">
                            <i class="ti ti-eye"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-900 leading-none uppercase tracking-widest tracking-tight">Visibility</h4>
                            <p class="text-[10px] text-gray-400 font-semibold mt-1 uppercase tracking-wider">Status Publikasi</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                        <div class="w-12 h-6.5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[3px] after:left-[3px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-600 transition-all shadow-sm"></div>
                    </label>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function previewImage(input, containerId) {
        const container = document.getElementById(containerId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                container.innerHTML = `
                    <div class="relative w-full max-w-[280px] group/preview">
                        <img src="${e.target.result}" class="w-full h-auto max-h-[220px] object-contain rounded-xl shadow-xl shadow-brand-600/10 border border-gray-100 bg-white p-2">
                        <div class="absolute inset-0 bg-brand-900/60 opacity-0 group-hover/preview:opacity-100 flex items-center justify-center rounded-xl backdrop-blur-sm transition-all duration-500">
                            <span class="text-white font-bold text-xs uppercase tracking-widest">Klik untuk ganti</span>
                        </div>
                    </div>
                `;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Drag and Drop Logic
    const dropzone = document.getElementById('logo-dropzone');
    const input = document.getElementById('logo-input');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropzone.addEventListener(eventName, () => {
            dropzone.classList.add('border-brand-400', 'bg-white', 'shadow-2xl');
        });
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, () => {
            dropzone.classList.remove('border-brand-400', 'bg-white', 'shadow-2xl');
        });
    });

    dropzone.addEventListener('drop', (e) => {
        const dt = e.dataTransfer;
        const files = dt.files;
        input.files = files;
        previewImage(input, 'logo-preview-container');
    });
</script>
@endpush
@endsection
