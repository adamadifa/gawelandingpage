@extends('layouts.admin')

@section('title', 'Tambah Item Fitur')
@section('subtitle', 'Tambahkan kartu fitur unggulan baru yang melengkapi landing page aplikasi Anda.')

@section('breadcrumbs')
<div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white border border-[#E2E8F0]/70 text-xs text-[#64748B] shadow-2xs font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#007A87] flex items-center gap-1">
        <i class="ti ti-home text-sm"></i>
        <span>Dashboard</span>
    </a>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <span class="text-gray-400">Landing Page CMS</span>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <a href="{{ route('admin.features.index') }}" class="hover:text-[#007A87]">
        <span>Item Fitur</span>
    </a>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <span class="text-[#0F172A] font-semibold">Tambah Fitur</span>
</div>
@endsection

@section('actions')
<div class="flex items-center gap-2">
    <a href="{{ route('admin.features.index') }}" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 text-xs font-bold shadow-2xs transition-all">
        <i class="ti ti-arrow-left text-sm"></i>
        <span>Batal</span>
    </a>
    <button type="submit" 
            form="feature-item-create-form" 
            class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
        <i class="ti ti-device-floppy text-sm"></i>
        <span>Simpan Fitur</span>
    </button>
</div>
@endsection

@section('content')
<div class="space-y-6" x-data="{
    title: '{{ old('title', '') }}',
    description: '{{ old('description', '') }}',
    icon: '{{ old('icon', 'star') }}',
    sort_order: '{{ old('sort_order', 0) }}',
    getIconClass() {
        let raw = (this.icon || '').trim();
        if (!raw) return 'ti ti-star';
        if (raw.startsWith('ti ti-')) return raw;
        if (raw.startsWith('ti-')) return 'ti ' + raw;
        return 'ti ti-' + raw;
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

    <form id="feature-item-create-form" 
          action="{{ route('admin.features.store') }}" 
          method="POST" 
          class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        @csrf

        <!-- Left Column: Content Details (7 Cols) -->
        <div class="lg:col-span-7 space-y-5">
            
            <!-- Card 1: Informasi Fitur -->
            <div class="card-clean p-5 lg:p-6 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-info-circle text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Informasi & Konten Fitur</h3>
                        <p class="text-[11px] text-gray-400">Judul singkat dan penjelasan nilai guna fitur</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-xs font-bold text-gray-700 mb-1">
                            Judul Fitur <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               x-model="title"
                               value="{{ old('title') }}" 
                               required 
                               placeholder="Contoh: Absensi Geofencing Pintar"
                               class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-900 font-bold focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                    </div>

                    <div>
                        <label for="description" class="block text-xs font-bold text-gray-700 mb-1">
                            Deskripsi Singkat <span class="text-rose-500">*</span>
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="5" 
                                  x-model="description"
                                  required 
                                  placeholder="Jelaskan secara ringkas bagaimana fitur ini mempermudah pengguna..."
                                  class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 px-3 text-xs text-gray-800 font-medium leading-relaxed focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Card 2: Panduan Penulisan -->
            <div class="card-clean p-4 bg-gradient-to-br from-teal-50/70 to-emerald-50/40 border-teal-200/60">
                <div class="flex items-start gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-[#007A87] text-white flex items-center justify-center shrink-0 shadow-2xs">
                        <i class="ti ti-bulb text-sm"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-teal-950">Fokus pada Solusi Pengguna</h4>
                        <p class="text-[11px] text-teal-800/80 leading-relaxed mt-1">
                            Gunakan kalimat aktif dan soroti masalah yang berhasil dipecahkan fitur ini agar calon pelanggan langsung tertarik mencoba.
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column: Visual, Urutan & Preview (5 Cols) -->
        <div class="lg:col-span-5 space-y-5 lg:sticky lg:top-24">
            
            <!-- Card 3: Ikon & Urutan -->
            <div class="card-clean p-5 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-icons text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Ikon & Posisi Tampilan</h3>
                        <p class="text-[11px] text-gray-400">Pilih ikon visual Tabler dan urutan kartu</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label for="icon-input" class="block text-xs font-bold text-gray-700 mb-1">
                            Kelas Tabler Icon <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative flex items-center">
                            <span class="absolute left-2.5 w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] border border-teal-100/60 flex items-center justify-center text-base">
                                <i :class="getIconClass()"></i>
                            </span>
                            <input type="text" 
                                   name="icon" 
                                   id="icon-input" 
                                   x-model="icon"
                                   value="{{ old('icon', 'ti-star') }}" 
                                   required
                                   placeholder="ti-star atau ti-device-mobile"
                                   class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 pl-12 pr-3 text-xs text-gray-800 font-mono focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                        </div>
                        <p class="text-[10px] text-gray-400 mt-1">
                            Lihat referensi nama ikon di <a href="https://tabler.io/icons" target="_blank" class="text-[#007A87] font-semibold underline">Tabler Icons</a> (contoh: <code>ti-shield-check</code>, <code>ti-chart-line</code>).
                        </p>
                    </div>

                    <div>
                        <label for="sort_order" class="block text-xs font-bold text-gray-700 mb-1">
                            Nomor Urutan Tampilan
                        </label>
                        <input type="number" 
                               name="sort_order" 
                               id="sort_order" 
                               x-model="sort_order"
                               value="{{ old('sort_order', 0) }}" 
                               required
                               class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-800 font-semibold focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                    </div>

                    <div class="pt-2 border-t border-gray-100 flex items-center gap-3">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" checked class="sr-only peer">
                            <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#007A87]"></div>
                            <span class="ml-2.5 text-xs font-bold text-gray-700">Tampilkan Fitur Ini di Web</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Card 4: Pratinjau Langsung -->
            <div class="card-clean p-5 space-y-3">
                <div class="flex items-center gap-2 pb-2 border-b border-gray-100">
                    <div class="w-6 h-6 rounded-md bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-eye text-xs"></i>
                    </div>
                    <h3 class="text-xs font-bold text-[#0F172A]">Simulasi Kartu Fitur</h3>
                </div>

                <div class="p-4 rounded-xl bg-slate-50 border border-gray-200/70 space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-teal-50 text-[#007A87] border border-teal-100/70 flex items-center justify-center text-lg shadow-2xs">
                        <i :class="getIconClass()"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-900 leading-tight" x-text="title || 'Judul Fitur Pintar'"></h4>
                        <p class="text-[11px] text-gray-500 line-clamp-2 mt-1 leading-relaxed" x-text="description || 'Deskripsi singkat mengenai fungsi dan kemudahan yang diberikan fitur ini...'"></p>
                    </div>
                </div>
            </div>

        </div>

    </form>

</div>
@endsection
