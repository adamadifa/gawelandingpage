@extends('layouts.admin')

@section('title', 'Edit Paket Langganan')

@section('breadcrumbs')
<nav class="flex items-center gap-1.5 text-xs text-gray-400 font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#007A87] transition-colors flex items-center gap-1">
        <i class="ti ti-home"></i>
        <span>Dashboard</span>
    </a>
    <i class="ti ti-chevron-right text-[10px]"></i>
    <a href="{{ route('admin.pricing-plans.index') }}" class="hover:text-[#007A87] transition-colors">Paket Langganan</a>
    <i class="ti ti-chevron-right text-[10px]"></i>
    <span class="text-gray-700 font-bold">Edit Paket</span>
</nav>
@endsection

@section('actions')
<div class="flex items-center gap-2.5">
    <a href="{{ route('admin.pricing-plans.index') }}" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 hover:border-gray-300 text-gray-600 text-xs font-bold transition-all shadow-2xs">
        <i class="ti ti-arrow-left text-sm"></i>
        <span>Kembali</span>
    </a>

    <button type="submit" 
            form="pricing-plan-edit-form" 
            class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
        <i class="ti ti-device-floppy text-sm"></i>
        <span>Simpan Perubahan</span>
    </button>
</div>
@endsection

@section('content')
<div class="space-y-6" x-data="{
    name: '{{ old('name', $pricing_plan->name) }}',
    badge: '{{ old('badge', $pricing_plan->badge) }}',
    target_audience: '{{ old('target_audience', $pricing_plan->target_audience) }}',
    monthly_price: '{{ old('monthly_price', $pricing_plan->monthly_price) }}',
    yearly_price: '{{ old('yearly_price', $pricing_plan->yearly_price) }}',
    yearly_savings: '{{ old('yearly_savings', $pricing_plan->yearly_savings) }}',
    max_employees: '{{ old('max_employees', $pricing_plan->max_employees) }}',
    server_spec: '{{ old('server_spec', $pricing_plan->server_spec) }}',
    sort_order: '{{ old('sort_order', $pricing_plan->sort_order) }}',
    is_featured: {{ old('is_featured', $pricing_plan->is_featured) ? 'true' : 'false' }},
    is_active: {{ old('is_active', $pricing_plan->is_active) ? 'true' : 'false' }},
    features: {{ json_encode(old('features', $pricing_plan->features->pluck('feature_text')->toArray())) }},
    newFeatureText: '',
    addFeature() {
        if (this.newFeatureText.trim()) {
            this.features.push(this.newFeatureText.trim());
            this.newFeatureText = '';
        }
    },
    removeFeature(index) {
        this.features.splice(index, 1);
    },
    formatRupiah(val) {
        let num = parseInt(val);
        if (isNaN(num) || num <= 0) return '0';
        return new Intl.NumberFormat('id-ID').format(num);
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

    <form id="pricing-plan-edit-form" 
          action="{{ route('admin.pricing-plans.update', $pricing_plan->id) }}" 
          method="POST" 
          class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        @csrf
        @method('PUT')

        <!-- Left Column: Primary Details & Features (7 Cols) -->
        <div class="lg:col-span-7 space-y-5">
            
            <!-- Card 1: Informasi Dasar -->
            <div class="card-clean p-5 lg:p-6 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-info-circle text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Informasi Dasar Paket</h3>
                        <p class="text-[11px] text-gray-400">Nama paket, badge promosi, dan target segmen pengguna</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-xs font-bold text-gray-700 mb-1">
                            Nama Paket <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               x-model="name"
                               value="{{ old('name', $pricing_plan->name) }}"
                               required 
                               placeholder="Contoh: Starter / Business"
                               class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-900 font-bold focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                    </div>

                    <div>
                        <label for="badge" class="block text-xs font-bold text-gray-700 mb-1">
                            Badge Text <span class="text-gray-400 font-normal">(Opsional)</span>
                        </label>
                        <input type="text" 
                               name="badge" 
                               id="badge" 
                               x-model="badge"
                               value="{{ old('badge', $pricing_plan->badge) }}"
                               placeholder="Contoh: Populer / Hemat / Skala Besar"
                               class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-800 font-medium focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                    </div>
                </div>

                <div>
                    <label for="target_audience" class="block text-xs font-bold text-gray-700 mb-1">
                        Target Audience / Sub Judul Singkat
                    </label>
                    <input type="text" 
                           name="target_audience" 
                           id="target_audience" 
                           x-model="target_audience"
                           value="{{ old('target_audience', $pricing_plan->target_audience) }}"
                           placeholder="Contoh: Cocok untuk: 1 - 50 User"
                           class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-800 font-medium focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                </div>
            </div>

            <!-- Card 2: Strategi Harga -->
            <div class="card-clean p-5 lg:p-6 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-currency-dollar text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Skema & Strategi Harga</h3>
                        <p class="text-[11px] text-gray-400">Atur nominal langganan bulanan, tahunan, serta penghematan</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="monthly_price" class="block text-xs font-bold text-gray-700 mb-1">
                            Harga Bulanan (Rp) <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative flex items-center">
                            <span class="absolute left-3 text-xs font-bold text-gray-400">Rp</span>
                            <input type="number" 
                                   name="monthly_price" 
                                   id="monthly_price" 
                                   x-model="monthly_price"
                                   value="{{ old('monthly_price', $pricing_plan->monthly_price) }}"
                                   required 
                                   placeholder="Contoh: 499000 (0 jika custom)"
                                   class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 pl-9 pr-3 text-xs text-gray-900 font-extrabold focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                        </div>
                        <p class="text-[10px] text-gray-400 mt-1">Masukkan <code>0</code> jika paket berbasis negosiasi/custom pricing.</p>
                    </div>

                    <div>
                        <label for="yearly_price" class="block text-xs font-bold text-gray-700 mb-1">
                            Harga Tahunan (Rp) <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative flex items-center">
                            <span class="absolute left-3 text-xs font-bold text-gray-400">Rp</span>
                            <input type="number" 
                                   name="yearly_price" 
                                   id="yearly_price" 
                                   x-model="yearly_price"
                                   value="{{ old('yearly_price', $pricing_plan->yearly_price) }}"
                                   required 
                                   placeholder="Contoh: 4990000 (0 jika custom)"
                                   class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 pl-9 pr-3 text-xs text-gray-900 font-extrabold focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                        </div>
                    </div>
                </div>

                <div>
                    <label for="yearly_savings" class="block text-xs font-bold text-gray-700 mb-1">
                        Teks Penghematan Tahunan <span class="text-gray-400 font-normal">(Highlight diskon)</span>
                    </label>
                    <input type="text" 
                           name="yearly_savings" 
                           id="yearly_savings" 
                           x-model="yearly_savings"
                           value="{{ old('yearly_savings', $pricing_plan->yearly_savings) }}"
                           placeholder="Contoh: Hemat Rp 998rb (2 Bulan Gratis)"
                           class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-800 font-medium focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                </div>
            </div>

            <!-- Card 3: Spesifikasi Teknis & Kapasitas -->
            <div class="card-clean p-5 lg:p-6 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-cpu text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Kapasitas & Infrastruktur Server</h3>
                        <p class="text-[11px] text-gray-400">Batasan jumlah karyawan dan spesifikasi resource server yang dialokasikan</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="max_employees" class="block text-xs font-bold text-gray-700 mb-1">
                            Maksimal Karyawan
                        </label>
                        <input type="number" 
                               name="max_employees" 
                               id="max_employees" 
                               x-model="max_employees"
                               value="{{ old('max_employees', $pricing_plan->max_employees) }}"
                               placeholder="Contoh: 50 (kosongkan jika unlimited)"
                               class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-800 font-semibold focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                    </div>

                    <div>
                        <label for="server_spec" class="block text-xs font-bold text-gray-700 mb-1">
                            Spesifikasi Server
                        </label>
                        <input type="text" 
                               name="server_spec" 
                               id="server_spec" 
                               x-model="server_spec"
                               value="{{ old('server_spec', $pricing_plan->server_spec) }}"
                               placeholder="Contoh: Biznet GIO Neo Lite MS 4.2"
                               class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-800 font-medium focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                    </div>
                </div>
            </div>

            <!-- Card 4: Fitur & Fasilitas Paket -->
            <div class="card-clean p-5 lg:p-6 space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                            <i class="ti ti-list-check text-base"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-[#0F172A]">Daftar Fitur Paket</h3>
                            <p class="text-[11px] text-gray-400">Rincian item checklist yang disertakan pada paket langganan ini</p>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-[#007A87] bg-teal-50 px-2.5 py-1 rounded-lg border border-teal-200/60" x-text="features.length + ' Fitur'"></span>
                </div>

                <!-- Input to add feature -->
                <div class="flex items-center gap-2">
                    <input type="text" 
                           x-model="newFeatureText"
                           @keydown.enter.prevent="addFeature()"
                           placeholder="Ketik nama fitur baru (misal: Tracking Kunjungan Lapangan)..."
                           class="flex-1 bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-800 font-medium focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                    <button type="button" 
                            @click="addFeature()"
                            class="inline-flex items-center gap-1 px-3.5 py-2 bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold rounded-xl transition-all shadow-2xs shrink-0">
                        <i class="ti ti-plus"></i>
                        <span>Tambah</span>
                    </button>
                </div>

                <!-- Features list items -->
                <div class="space-y-2 max-h-80 overflow-y-auto pr-1">
                    <template x-for="(item, index) in features" :key="index">
                        <div class="flex items-center justify-between gap-2 p-2.5 rounded-xl bg-slate-50/80 border border-gray-100 hover:border-teal-200 transition-all group">
                            <div class="flex items-center gap-2.5 flex-1">
                                <div class="w-5 h-5 rounded-full bg-teal-50 text-[#007A87] flex items-center justify-center shrink-0">
                                    <i class="ti ti-check text-xs font-bold"></i>
                                </div>
                                <input type="text" 
                                       name="features[]" 
                                       x-model="features[index]"
                                       required
                                       class="flex-1 bg-transparent border-none p-0 text-xs text-gray-700 font-medium focus:ring-0 focus:outline-none">
                            </div>
                            <button type="button" 
                                    @click="removeFeature(index)"
                                    class="w-6 h-6 flex items-center justify-center rounded-lg text-gray-400 hover:text-rose-600 hover:bg-rose-50 transition-colors opacity-70 group-hover:opacity-100"
                                    title="Hapus Fitur">
                                <i class="ti ti-x text-xs"></i>
                            </button>
                        </div>
                    </template>

                    <div x-show="features.length === 0" class="text-center py-6 text-gray-400 text-xs">
                        Belum ada fitur ditambahkan. Ketik fitur di atas dan klik Tambah.
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column: Settings & Live Preview (5 Cols) -->
        <div class="lg:col-span-5 space-y-5 lg:sticky lg:top-24">
            
            <!-- Card 5: Pengaturan Visibilitas & Urutan -->
            <div class="card-clean p-5 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-adjustments text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Pengaturan Tampilan</h3>
                        <p class="text-[11px] text-gray-400">Atur status publish, featured, dan nomor urut</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <!-- Urutan Tampilan -->
                    <div>
                        <label for="sort_order" class="block text-xs font-bold text-gray-700 mb-1">
                            Nomor Urutan Tampilan
                        </label>
                        <input type="number" 
                               name="sort_order" 
                               id="sort_order" 
                               x-model="sort_order"
                               value="{{ old('sort_order', $pricing_plan->sort_order) }}"
                               required
                               class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-800 font-semibold focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                        <p class="text-[10px] text-gray-400 mt-1">Kartu dengan angka lebih kecil akan tampil lebih awal dari kiri ke kanan.</p>
                    </div>

                    <!-- Toggle Featured / Populer -->
                    <div class="pt-3 border-t border-gray-100 flex items-center justify-between">
                        <div>
                            <span class="block text-xs font-bold text-gray-800">Paket Populer (Featured)</span>
                            <span class="text-[10px] text-gray-400">Disorot dengan aksen khusus di landing page</span>
                        </div>
                        <input type="hidden" name="is_featured" value="0">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1" x-model="is_featured" class="sr-only peer">
                            <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#007A87]"></div>
                        </label>
                    </div>

                    <!-- Toggle Status Aktif -->
                    <div class="pt-3 border-t border-gray-100 flex items-center justify-between">
                        <div>
                            <span class="block text-xs font-bold text-gray-800">Publikasikan Paket</span>
                            <span class="text-[10px] text-gray-400">Tampilkan di tabel pricing landing page</span>
                        </div>
                        <input type="hidden" name="is_active" value="0">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" x-model="is_active" class="sr-only peer">
                            <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#007A87]"></div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Card 6: Pratinjau Kartu Pricing -->
            <div class="card-clean p-5 space-y-3">
                <div class="flex items-center gap-2 pb-2 border-b border-gray-100">
                    <div class="w-6 h-6 rounded-md bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-eye text-xs"></i>
                    </div>
                    <h3 class="text-xs font-bold text-[#0F172A]">Simulasi Kartu Paket</h3>
                </div>

                <div class="p-4 rounded-xl bg-white border transition-all duration-300 relative"
                     :class="is_featured ? 'border-[#007A87] ring-2 ring-[#007A87]/15 shadow-md' : 'border-gray-200 shadow-2xs'">
                    
                    <!-- Populer Tag -->
                    <div x-show="is_featured" class="mb-2">
                        <span class="inline-flex items-center gap-1 py-0.5 px-2 rounded-full text-[9px] font-black bg-[#007A87] text-white uppercase tracking-wider">
                            <i class="ti ti-star-filled text-amber-300 text-[9px]"></i>
                            <span>Populer</span>
                        </span>
                    </div>

                    <!-- Header -->
                    <div class="flex items-center justify-between gap-2">
                        <h4 class="text-sm font-extrabold text-gray-900" x-text="name || 'Nama Paket'"></h4>
                        <span x-show="badge" class="px-2 py-0.5 rounded bg-teal-50 text-[#007A87] text-[10px] font-bold border border-teal-200/60" x-text="badge"></span>
                    </div>
                    <p class="text-[11px] text-gray-400 mt-0.5" x-text="target_audience || 'Target segmen bisnis'"></p>

                    <!-- Price -->
                    <div class="my-3 pb-3 border-b border-gray-100">
                        <template x-if="parseInt(monthly_price) > 0">
                            <div>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-[11px] font-bold text-gray-400">Rp</span>
                                    <span class="text-xl font-black text-gray-900" x-text="formatRupiah(monthly_price)"></span>
                                    <span class="text-[10px] text-gray-400 font-medium">/bln</span>
                                </div>
                                <div x-show="parseInt(yearly_price) > 0" class="text-[10px] text-teal-700 font-medium mt-0.5">
                                    Tahunan: Rp <span x-text="formatRupiah(yearly_price)"></span>
                                </div>
                                <div x-show="yearly_savings" class="mt-1">
                                    <span class="inline-block text-[9px] font-bold text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded" x-text="'🎉 ' + yearly_savings"></span>
                                </div>
                            </div>
                        </template>
                        <template x-if="!parseInt(monthly_price) || parseInt(monthly_price) <= 0">
                            <div>
                                <span class="text-base font-black text-[#007A87]">Custom Pricing</span>
                                <p class="text-[10px] text-gray-400 mt-0.5" x-text="yearly_savings || 'Sesuai penawaran sales'"></p>
                            </div>
                        </template>
                    </div>

                    <!-- Specs -->
                    <div class="space-y-1 text-[11px] text-gray-600 mb-3">
                        <div class="flex items-center gap-1.5">
                            <i class="ti ti-users text-[#007A87]"></i>
                            <span x-text="max_employees ? 'Maks ' + max_employees + ' Karyawan' : 'Unlimited Karyawan'"></span>
                        </div>
                        <div class="flex items-center gap-1.5 truncate">
                            <i class="ti ti-cpu text-[#007A87]"></i>
                            <span class="truncate" x-text="server_spec || 'Server Standar'"></span>
                        </div>
                    </div>

                    <!-- Features Preview (first 3) -->
                    <div class="space-y-1 pt-2 border-t border-gray-100">
                        <template x-for="(f, i) in features.slice(0, 3)" :key="i">
                            <div class="flex items-center gap-1.5 text-[10px] text-gray-600 truncate">
                                <i class="ti ti-check text-[#007A87] text-xs shrink-0"></i>
                                <span class="truncate" x-text="f"></span>
                            </div>
                        </template>
                        <div x-show="features.length > 3" class="text-[9px] font-bold text-gray-400 pl-4" x-text="'+' + (features.length - 3) + ' fitur lainnya'"></div>
                    </div>

                    <!-- Action Button Preview -->
                    <div class="mt-4">
                        <div class="w-full py-2 rounded-xl text-center text-xs font-bold"
                             :class="is_featured ? 'bg-[#007A87] text-white shadow-xs' : 'bg-teal-50 text-[#007A87] border border-teal-200/60'"
                             x-text="parseInt(monthly_price) > 0 ? 'Pilih Paket' : 'Hubungi Sales'">
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </form>

</div>
@endsection
