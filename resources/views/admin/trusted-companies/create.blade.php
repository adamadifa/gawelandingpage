@extends('layouts.admin')

@section('title', 'Tambah Partner Perusahaan')

@section('breadcrumbs')
<nav class="flex items-center gap-1.5 text-xs text-gray-400 font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#007A87] transition-colors flex items-center gap-1">
        <i class="ti ti-home"></i>
        <span>Dashboard</span>
    </a>
    <i class="ti ti-chevron-right text-[10px]"></i>
    <a href="{{ route('admin.trusted-companies.index') }}" class="hover:text-[#007A87] transition-colors">Partner Logos</a>
    <i class="ti ti-chevron-right text-[10px]"></i>
    <span class="text-gray-700 font-bold">Tambah Partner</span>
</nav>
@endsection

@section('actions')
<div class="flex items-center gap-2.5">
    <a href="{{ route('admin.trusted-companies.index') }}" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 hover:border-gray-300 text-gray-600 text-xs font-bold transition-all shadow-2xs">
        <i class="ti ti-arrow-left text-sm"></i>
        <span>Kembali</span>
    </a>

    <button type="submit" 
            form="partner-create-form" 
            class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
        <i class="ti ti-device-floppy text-sm"></i>
        <span>Simpan Partner</span>
    </button>
</div>
@endsection

@section('content')
<div class="space-y-6" x-data="{
    name: '{{ old('name', '') }}',
    sort_order: '{{ old('sort_order', 0) }}',
    logoPreview: null,
    previewLogo(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.logoPreview = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
}">

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

    <form id="partner-create-form" 
          action="{{ route('admin.trusted-companies.store') }}" 
          method="POST" 
          enctype="multipart/form-data" 
          class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        @csrf

        <!-- Left Column: Primary Details & Logo (7 Cols) -->
        <div class="lg:col-span-7 space-y-5">
            
            <!-- Card 1: Nama Perusahaan -->
            <div class="card-clean p-5 lg:p-6 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-building text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Identitas Partner</h3>
                        <p class="text-[11px] text-gray-400">Nama resmi perusahaan atau entitas partner</p>
                    </div>
                </div>

                <div>
                    <label for="name" class="block text-xs font-bold text-gray-700 mb-1">
                        Nama Perusahaan / Brand <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           x-model="name"
                           required 
                           placeholder="Contoh: Biznet GIO, Google Cloud, Telkom Indonesia"
                           class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-900 font-bold focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                </div>
            </div>

            <!-- Card 2: Logo File -->
            <div class="card-clean p-5 lg:p-6 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-photo text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Aset Logo Brand</h3>
                        <p class="text-[11px] text-gray-400">Unggah file logo PNG, SVG, atau WebP berlatar transparan</p>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1.5">
                        File Logo Perusahaan
                    </label>
                    <div class="relative w-full h-44 rounded-xl border-2 border-dashed border-gray-200 hover:border-[#007A87] bg-[#F8FAFC] flex flex-col items-center justify-center p-4 text-center transition-all overflow-hidden group">
                        <template x-if="logoPreview">
                            <img :src="logoPreview" class="absolute inset-0 w-full h-full object-contain p-4 z-10 bg-white">
                        </template>
                        <div x-show="!logoPreview" class="flex flex-col items-center justify-center text-gray-400">
                            <div class="w-12 h-12 rounded-xl bg-teal-50 text-[#007A87] flex items-center justify-center mb-2">
                                <i class="ti ti-cloud-upload text-2xl"></i>
                            </div>
                            <span class="text-xs font-bold text-gray-700">Pilih atau Seret File Logo</span>
                            <span class="text-[10px] text-gray-400 mt-0.5">Format SVG, PNG transparan (Maks. 2MB)</span>
                        </div>
                        <input type="file" 
                               name="logo" 
                               id="logo"
                               accept="image/*"
                               @change="previewLogo($event)"
                               class="absolute inset-0 opacity-0 cursor-pointer z-20">
                        <div class="absolute inset-0 bg-[#007A87]/10 opacity-0 group-hover:opacity-100 transition-opacity z-10 flex items-center justify-center pointer-events-none">
                            <span class="px-3 py-1 bg-white text-[#007A87] text-xs font-bold rounded-lg shadow-sm">Pilih File Logo</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column: Settings & Live Preview (5 Cols) -->
        <div class="lg:col-span-5 space-y-5 lg:sticky lg:top-24">
            
            <!-- Card 3: Pengaturan Urutan & Status -->
            <div class="card-clean p-5 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-adjustments text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Pengaturan Tampilan</h3>
                        <p class="text-[11px] text-gray-400">Urutan dan status visibilitas partner</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label for="sort_order" class="block text-xs font-bold text-gray-700 mb-1">
                            Nomor Urutan Tampilan
                        </label>
                        <input type="number" 
                               name="sort_order" 
                               id="sort_order" 
                               x-model="sort_order"
                               required
                               class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-800 font-semibold focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                        <p class="text-[10px] text-gray-400 mt-1">Angka lebih kecil tampil lebih dulu pada deretan logo.</p>
                    </div>

                    <div class="pt-3 border-t border-gray-100 flex items-center justify-between">
                        <div>
                            <span class="block text-xs font-bold text-gray-800">Publikasikan Partner</span>
                            <span class="text-[10px] text-gray-400">Tampilkan logo di landing page</span>
                        </div>
                        <input type="hidden" name="is_active" value="0">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                            <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#007A87]"></div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Card 4: Simulasi Card Logo -->
            <div class="card-clean p-5 space-y-3">
                <div class="flex items-center gap-2 pb-2 border-b border-gray-100">
                    <div class="w-6 h-6 rounded-md bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-eye text-xs"></i>
                    </div>
                    <h3 class="text-xs font-bold text-[#0F172A]">Simulasi Kartu Partner</h3>
                </div>

                <div class="p-4 rounded-xl bg-slate-50 border border-gray-200/80 flex flex-col items-center text-center">
                    <div class="w-full h-24 bg-white rounded-xl border border-gray-200/80 p-3 flex items-center justify-center shadow-2xs mb-2.5 overflow-hidden">
                        <template x-if="logoPreview">
                            <img :src="logoPreview" class="max-w-full max-h-full object-contain">
                        </template>
                        <template x-if="!logoPreview">
                            <div class="text-center text-gray-300">
                                <i class="ti ti-photo text-2xl text-teal-600/40"></i>
                                <span class="text-[9px] block text-gray-400 mt-0.5">Logo Perusahaan</span>
                            </div>
                        </template>
                    </div>
                    <h4 class="text-xs font-bold text-gray-900 truncate max-w-full" x-text="name || 'Nama Perusahaan Partner'"></h4>
                    <span class="text-[10px] text-gray-400 font-medium">Partner Terpercaya</span>
                </div>
            </div>

        </div>

    </form>

</div>
@endsection
