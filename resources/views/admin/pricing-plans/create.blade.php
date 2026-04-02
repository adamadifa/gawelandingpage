@extends('layouts.admin')

@section('title', 'Pricing — Tambah Paket')

@section('content')
<div class="w-full space-y-8 pb-20 text-inter font-poppins">
    
    {{-- Page Header --}}
    <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-100">
        <div>
            <nav class="flex items-center gap-2 text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">
                <a href="{{ route('admin.hero-sections.index') }}" class="hover:text-indigo-600 transition-colors">Landing Page</a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <a href="{{ route('admin.pricing-plans.index') }}" class="hover:text-indigo-600 transition-colors uppercase tracking-widest">Pricing Plans</a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <span class="text-indigo-600 font-bold uppercase tracking-widest">Tambah Paket</span>
            </nav>
            <h1 class="text-3xl font-display font-black text-gray-900 leading-tight">Buat Paket Baru</h1>
            <p class="text-sm text-gray-500 font-medium">Definisikan tier langganan, harga, dan fitur unggulan untuk pengguna Anda.</p>
        </div>
        <div class="flex items-center gap-3">
             <a href="{{ route('admin.pricing-plans.index') }}" class="px-5 py-2.5 text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">Batal</a>
             <button type="submit" form="pricing-plan-create-form" class="inline-flex items-center gap-2 px-7 py-3.5 bg-indigo-600 text-white rounded-2xl font-bold text-sm shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 active:scale-95 transition-all">
                <i class="ti ti-device-floppy text-lg"></i>
                Simpan Paket
            </button>
        </div>
    </div>

    <form id="pricing-plan-create-form" action="{{ route('admin.pricing-plans.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        @csrf

        {{-- Left: Main Details --}}
        <div class="lg:col-span-8 space-y-8">
            {{-- Basic Information --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-8">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-indigo-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-indigo-50">
                        <i class="ti ti-info-circle"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none">Informasi Dasar</h3>
                        <p class="text-[12px] text-gray-400 font-bold mt-1.5 uppercase tracking-wider">Identifikasi Paket</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 px-1">Nama Paket</label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Paket STARTER"
                            class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-4 px-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all placeholder:text-gray-300">
                    </div>
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 px-1">Badge Text (Optional)</label>
                        <input type="text" name="badge" value="{{ old('badge') }}" placeholder="Contoh: Hemat, Populer"
                            class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-4 px-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all placeholder:text-gray-300">
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="block text-sm font-bold text-gray-700 px-1">Target Audience / Deskripsi Singkat</label>
                    <input type="text" name="target_audience" value="{{ old('target_audience') }}" placeholder="Contoh: Cocok untuk UMKM & Startup Kecil"
                        class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-4 px-6 text-gray-900 font-medium focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all placeholder:text-gray-300">
                </div>
            </div>

            {{-- Dynamic Features --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-8">
                <div class="flex items-center justify-between border-b border-gray-50 pb-6 mb-8">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gray-50 text-indigo-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-indigo-50">
                            <i class="ti ti-list-check"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-display font-bold text-gray-900 leading-none">Fitur Paket</h3>
                            <p class="text-[12px] text-gray-400 font-bold mt-1.5 uppercase tracking-wider">Checklist Manual</p>
                        </div>
                    </div>
                    <button type="button" id="add-feature" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold text-[10px] uppercase tracking-widest hover:bg-indigo-600 hover:text-white transition-all shadow-sm">
                        <i class="ti ti-plus"></i> Tambah Fitur
                    </button>
                </div>

                <div id="features-container" class="space-y-4">
                    <div class="flex items-center gap-4 group/feature bg-gray-50/50 p-4 rounded-[1.5rem] border border-gray-100/50 focus-within:bg-white focus-within:border-indigo-100 transition-all">
                        <div class="w-8 h-8 rounded-lg bg-white border border-gray-100 flex items-center justify-center text-indigo-400 group-hover/feature:bg-indigo-600 group-hover/feature:text-white transition-all">
                            <i class="ti ti-check"></i>
                        </div>
                        <input type="text" name="features[]" placeholder="Contoh: Unlimited Produk" required 
                            class="flex-1 bg-transparent border-none text-sm font-bold text-gray-900 focus:ring-0 placeholder:text-gray-300">
                        <button type="button" onclick="this.parentElement.remove()" class="w-8 h-8 flex items-center justify-center text-gray-300 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition-all opacity-0 group-hover/feature:opacity-100">
                            <i class="ti ti-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Side Details --}}
        <div class="lg:col-span-4 space-y-8">
            {{-- Pricing Card --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-8">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-indigo-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-indigo-50">
                        <i class="ti ti-coin"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none">Strategi Harga</h3>
                        <p class="text-[12px] text-gray-400 font-bold mt-1.5 uppercase tracking-wider">Monetisasi</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 px-1">Harga Bulanan (Rp)</label>
                        <input type="number" name="monthly_price" required placeholder="0"
                            class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-4 px-6 text-gray-900 font-black focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all text-2xl">
                    </div>

                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 px-1">Harga Tahunan (Rp)</label>
                        <input type="number" name="yearly_price" required placeholder="0"
                            class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-4 px-6 text-gray-900 font-black focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all text-2xl">
                    </div>

                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 px-1">Teks Penghematan Tahunan</label>
                        <input type="text" name="yearly_savings" placeholder="Contoh: Hemat Rp 800rb"
                            class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-4 px-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all placeholder:text-gray-300">
                    </div>
                </div>
            </div>

            {{-- Technical Specification --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-8">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-indigo-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-indigo-50">
                        <i class="ti ti-cpu"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none">Spesifikasi Teknis</h3>
                        <p class="text-[12px] text-gray-400 font-bold mt-1.5 uppercase tracking-wider">Infrastruktur</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 px-1">Maksimal Karyawan</label>
                        <input type="number" name="max_employees" placeholder="0"
                            class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-4 px-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all">
                    </div>

                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 px-1">Server Specification</label>
                        <input type="text" name="server_spec" placeholder="Contoh: 2 vCPU, 2 GB RAM"
                            class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-4 px-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all">
                    </div>
                </div>
            </div>

            {{-- Visibility Status --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-black/[0.02] p-8 space-y-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center text-xl shadow-inner">
                            <i class="ti ti-star"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-black text-gray-900 leading-none">Featured</h4>
                            <p class="text-[10px] text-gray-400 font-bold mt-1 uppercase tracking-wider">Paling Populer</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" class="sr-only peer">
                        <div class="w-12 h-6.5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[3px] after:left-[3px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600 transition-all"></div>
                    </label>
                </div>
                <div class="flex items-center justify-between pt-6 border-t border-gray-50">
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

@push('scripts')
<script>
    document.getElementById('add-feature').addEventListener('click', function() {
        const container = document.getElementById('features-container');
        const div = document.createElement('div');
        div.className = 'flex items-center gap-4 group/feature bg-gray-50/50 p-4 rounded-[1.5rem] border border-gray-100/50 focus-within:bg-white focus-within:border-indigo-100 transition-all';
        div.innerHTML = `
            <div class="w-8 h-8 rounded-lg bg-white border border-gray-100 flex items-center justify-center text-indigo-400 group-hover/feature:bg-indigo-600 group-hover/feature:text-white transition-all">
                <i class="ti ti-check"></i>
            </div>
            <input type="text" name="features[]" placeholder="Contoh: Unlimited Produk" required 
                class="flex-1 bg-transparent border-none text-sm font-bold text-gray-900 focus:ring-0 placeholder:text-gray-300">
            <button type="button" onclick="this.parentElement.remove()" class="w-8 h-8 flex items-center justify-center text-gray-300 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition-all opacity-0 group-hover/feature:opacity-100">
                <i class="ti ti-trash"></i>
            </button>
        `;
        container.appendChild(div);
        div.querySelector('input').focus();
    });
</script>
@endpush
@endsection
