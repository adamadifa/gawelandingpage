@extends('layouts.admin')

@section('title', 'Tambah Testimoni Pengguna')

@section('breadcrumbs')
<nav class="flex items-center gap-1.5 text-xs text-gray-400 font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#007A87] transition-colors flex items-center gap-1">
        <i class="ti ti-home"></i>
        <span>Dashboard</span>
    </a>
    <i class="ti ti-chevron-right text-[10px]"></i>
    <a href="{{ route('admin.testimonials.index') }}" class="hover:text-[#007A87] transition-colors">Testimoni</a>
    <i class="ti ti-chevron-right text-[10px]"></i>
    <span class="text-gray-700 font-bold">Tambah Ulasan</span>
</nav>
@endsection

@section('actions')
<div class="flex items-center gap-2.5">
    <a href="{{ route('admin.testimonials.index') }}" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 hover:border-gray-300 text-gray-600 text-xs font-bold transition-all shadow-2xs">
        <i class="ti ti-arrow-left text-sm"></i>
        <span>Kembali</span>
    </a>

    <button type="submit" 
            form="testimonial-create-form" 
            class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
        <i class="ti ti-device-floppy text-sm"></i>
        <span>Simpan Testimoni</span>
    </button>
</div>
@endsection

@section('content')
<div class="space-y-6" x-data="{
    name: '{{ old('name', '') }}',
    position: '{{ old('position', '') }}',
    company: '{{ old('company', '') }}',
    content: '{{ old('content', '') }}',
    rating: {{ old('rating', 5) }},
    sort_order: '{{ old('sort_order', 0) }}',
    avatarPreview: null,
    previewAvatar(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.avatarPreview = e.target.result;
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

    <form id="testimonial-create-form" 
          action="{{ route('admin.testimonials.store') }}" 
          method="POST" 
          enctype="multipart/form-data" 
          class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        @csrf

        <!-- Left Column: Details & Feedback (7 Cols) -->
        <div class="lg:col-span-7 space-y-5">
            
            <!-- Card 1: Identitas Klien -->
            <div class="card-clean p-5 lg:p-6 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-user text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Identitas Pemberi Ulasan</h3>
                        <p class="text-[11px] text-gray-400">Nama lengkap, peran, serta nama instansi atau perusahaan</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-xs font-bold text-gray-700 mb-1">
                            Nama Lengkap <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               x-model="name"
                               required 
                               placeholder="Contoh: Budi Santoso"
                               class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-900 font-bold focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                    </div>

                    <div>
                        <label for="position" class="block text-xs font-bold text-gray-700 mb-1">
                            Jabatan / Posisi
                        </label>
                        <input type="text" 
                               name="position" 
                               id="position" 
                               x-model="position"
                               placeholder="Contoh: HR Manager"
                               class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-800 font-medium focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                    </div>
                </div>

                <div>
                    <label for="company" class="block text-xs font-bold text-gray-700 mb-1">
                        Nama Perusahaan / Bisnis <span class="text-gray-400 font-normal">(Opsional)</span>
                    </label>
                    <input type="text" 
                           name="company" 
                           id="company" 
                           x-model="company"
                           placeholder="Contoh: PT. Tech Solusi Nusantara"
                           class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-800 font-medium focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                </div>
            </div>

            <!-- Card 2: Rating & Ulasan -->
            <div class="card-clean p-5 lg:p-6 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-star text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Rating & Isi Testimoni</h3>
                        <p class="text-[11px] text-gray-400">Pilih rating kepuasan dan kutipan kalimat review</p>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-2">
                        Skor Rating Bintang <span class="text-rose-500">*</span>
                    </label>
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-1.5 p-2 bg-[#F8FAFC] border border-gray-200 rounded-xl">
                            <template x-for="star in [1, 2, 3, 4, 5]" :key="star">
                                <button type="button" 
                                        @click="rating = star"
                                        class="p-1 text-lg transition-transform hover:scale-125 focus:outline-none"
                                        :class="star <= rating ? 'text-amber-400' : 'text-gray-300'">
                                    <i class="ti ti-star-filled"></i>
                                </button>
                            </template>
                        </div>
                        <input type="hidden" name="rating" :value="rating">
                        <span class="text-xs font-bold text-gray-800" x-text="rating + ' Bintang'"></span>
                    </div>
                </div>

                <div>
                    <label for="content" class="block text-xs font-bold text-gray-700 mb-1">
                        Isi Kutipan Ulasan <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="content" 
                              id="content" 
                              rows="5" 
                              x-model="content"
                              required 
                              placeholder="Tuliskan pengalaman nyata pelanggan yang menggambarkan kemudahan dan manfaat aplikasi..."
                              class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 px-3 text-xs text-gray-800 font-medium leading-relaxed focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">{{ old('content') }}</textarea>
                </div>
            </div>

            <!-- Card 3: Foto Profil / Avatar -->
            <div class="card-clean p-5 lg:p-6 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-camera text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Foto Profil (Avatar)</h3>
                        <p class="text-[11px] text-gray-400">Unggah foto pemberi ulasan untuk memperkuat autentisitas</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-full bg-slate-100 border-2 border-gray-200 overflow-hidden shrink-0 flex items-center justify-center relative shadow-xs">
                        <template x-if="avatarPreview">
                            <img :src="avatarPreview" class="w-full h-full object-cover">
                        </template>
                        <div x-show="!avatarPreview" class="text-gray-300 flex items-center justify-center">
                            <i class="ti ti-user text-2xl"></i>
                        </div>
                    </div>

                    <div class="flex-1">
                        <input type="file" 
                               name="avatar" 
                               id="avatar" 
                               accept="image/*"
                               @change="previewAvatar($event)"
                               class="text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-teal-50 file:text-[#007A87] hover:file:bg-teal-100 cursor-pointer">
                        <p class="text-[10px] text-gray-400 mt-1">Format PNG, JPG, atau WebP (Rasio 1:1, Maks. 2MB)</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column: Settings & Live Preview (5 Cols) -->
        <div class="lg:col-span-5 space-y-5 lg:sticky lg:top-24">
            
            <!-- Card 4: Pengaturan Urutan & Status -->
            <div class="card-clean p-5 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-adjustments text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Pengaturan Tampilan</h3>
                        <p class="text-[11px] text-gray-400">Urutan dan visibilitas pada landing page</p>
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
                        <p class="text-[10px] text-gray-400 mt-1">Angka lebih kecil tampil di urutan terdepan.</p>
                    </div>

                    <div class="pt-3 border-t border-gray-100 flex items-center justify-between">
                        <div>
                            <span class="block text-xs font-bold text-gray-800">Publikasikan Testimoni</span>
                            <span class="text-[10px] text-gray-400">Tampilkan di landing page</span>
                        </div>
                        <input type="hidden" name="is_active" value="0">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                            <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#007A87]"></div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Card 5: Simulasi Kartu Testimoni -->
            <div class="card-clean p-5 space-y-3">
                <div class="flex items-center gap-2 pb-2 border-b border-gray-100">
                    <div class="w-6 h-6 rounded-md bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-eye text-xs"></i>
                    </div>
                    <h3 class="text-xs font-bold text-[#0F172A]">Simulasi Kartu Testimoni</h3>
                </div>

                <div class="p-4 rounded-xl bg-white border border-gray-200 shadow-2xs space-y-3">
                    <!-- Rating Stars -->
                    <div class="flex items-center gap-1 text-amber-400">
                        <template x-for="i in 5" :key="i">
                            <i class="ti text-xs" :class="i <= rating ? 'ti-star-filled' : 'ti-star text-gray-200'"></i>
                        </template>
                    </div>

                    <!-- Quote Text -->
                    <p class="text-xs text-gray-600 font-medium italic leading-relaxed" 
                       x-text="content ? '“' + content + '”' : '“Aplikasi ini sangat mempermudah efisiensi manajemen presensi dan penggajian di perusahaan kami...”'">
                    </p>

                    <!-- Author Info -->
                    <div class="pt-3 border-t border-gray-100 flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-full bg-teal-50 border border-teal-100 text-[#007A87] overflow-hidden shrink-0 flex items-center justify-center text-xs font-bold">
                            <template x-if="avatarPreview">
                                <img :src="avatarPreview" class="w-full h-full object-cover">
                            </template>
                            <span x-show="!avatarPreview" x-text="(name ? name.substring(0, 2).toUpperCase() : 'KL')"></span>
                        </div>
                        <div class="min-w-0">
                            <h5 class="text-xs font-bold text-gray-900 leading-tight truncate" x-text="name || 'Nama Klien'"></h5>
                            <p class="text-[10px] text-gray-400 truncate" x-text="(position || 'HR Manager') + (company ? ' • ' + company : '')"></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </form>

</div>
@endsection
