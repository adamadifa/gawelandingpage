@extends('layouts.admin')

@section('title', 'Pricing — Edit Paket')

@section('breadcrumbs')
<nav class="flex items-center gap-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest mb-2 font-poppins">
    <a href="{{ route('admin.hero-sections.index') }}" class="hover:text-brand-600 transition-colors">Landing Page</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <a href="{{ route('admin.pricing-plans.index') }}" class="hover:text-brand-600 transition-colors">Pricing Plans</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <span class="text-brand-600 font-semibold">Edit Paket</span>
</nav>
@endsection

@section('actions')
<div class="flex items-center gap-3 font-poppins">
     <a href="{{ route('admin.pricing-plans.index') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-400 hover:text-gray-600 transition-colors">Batal</a>
     <button type="submit" form="pricing-plan-edit-form" class="inline-flex items-center gap-2 px-7 py-3.5 bg-brand-600 text-white rounded-xl font-bold text-sm shadow-xl shadow-brand-600/20 hover:bg-brand-700 active:scale-95 transition-all">
        <i class="ti ti-device-floppy text-lg"></i>
        <span>Simpan Perubahan</span>
    </button>
</div>
@endsection

@section('content')
<div class="w-full -mt-6 space-y-6 pb-20 font-poppins text-inter">

    <form id="pricing-plan-edit-form" action="{{ route('admin.pricing-plans.update', $pricing_plan->id) }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        @csrf
        @method('PUT')

        {{-- Left: Main Details --}}
        <div class="lg:col-span-8 space-y-6">
            {{-- Basic Information --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-8">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-brand-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-brand-50">
                        <i class="ti ti-info-circle"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none tracking-tight">Informasi Dasar</h3>
                        <p class="text-[12px] text-gray-400 font-semibold mt-1.5 uppercase tracking-wider">Identifikasi Paket</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700 px-1">Nama Paket</label>
                        <input type="text" name="name" value="{{ old('name', $pricing_plan->name) }}" required placeholder="Contoh: Paket STARTER"
                            class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 px-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all placeholder:text-gray-300 shadow-sm">
                    </div>
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700 px-1">Badge Text (Optional)</label>
                        <input type="text" name="badge" value="{{ old('badge', $pricing_plan->badge) }}" placeholder="Contoh: Hemat, Populer"
                            class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 px-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all placeholder:text-gray-300 shadow-sm">
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-gray-700 px-1">Target Audience / Deskripsi Singkat</label>
                    <input type="text" name="target_audience" value="{{ old('target_audience', $pricing_plan->target_audience) }}" placeholder="Contoh: Cocok untuk UMKM & Startup Kecil"
                        class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 px-6 text-gray-900 font-medium focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all placeholder:text-gray-300 shadow-sm">
                </div>
            </div>

            {{-- Dynamic Features --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-8">
                <div class="flex items-center justify-between border-b border-gray-50 pb-6 mb-8">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gray-50 text-brand-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-brand-50">
                            <i class="ti ti-list-check"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-display font-bold text-gray-900 leading-none tracking-tight">Fitur Paket</h3>
                            <p class="text-[12px] text-gray-400 font-semibold mt-1.5 uppercase tracking-wider">Checklist Manual</p>
                        </div>
                    </div>
                    <button type="button" id="add-feature" class="inline-flex items-center gap-2 px-4 py-2 bg-brand-50 text-brand-600 rounded-xl font-bold text-[10px] uppercase tracking-widest hover:bg-brand-600 hover:text-white transition-all shadow-sm border border-brand-100/50">
                        <i class="ti ti-plus"></i> Tambah Fitur
                    </button>
                </div>

                <div id="features-container" class="space-y-4">
                    @forelse($pricing_plan->features as $feature)
                    <div class="flex items-center gap-4 group/feature bg-gray-50/50 p-4 rounded-xl border border-gray-100/50 focus-within:bg-white focus-within:border-brand-100/50 transition-all shadow-sm">
                        <div class="w-8 h-8 rounded-lg bg-white border border-gray-100 flex items-center justify-center text-brand-400 group-hover/feature:bg-brand-600 group-hover/feature:text-white transition-all">
                            <i class="ti ti-check"></i>
                        </div>
                        <input type="text" name="features[]" value="{{ $feature->feature_text }}" placeholder="Contoh: Unlimited Produk" required 
                            class="flex-1 bg-transparent border-none text-sm font-bold text-gray-900 focus:ring-0 placeholder:text-gray-300">
                        <button type="button" onclick="this.parentElement.remove()" class="w-8 h-8 flex items-center justify-center text-gray-300 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition-all opacity-0 group-hover/feature:opacity-100">
                            <i class="ti ti-trash"></i>
                        </button>
                    </div>
                    @empty
                    <div class="flex items-center gap-4 group/feature bg-gray-50/50 p-4 rounded-xl border border-gray-100/50 focus-within:bg-white focus-within:border-brand-100/50 transition-all shadow-sm">
                        <div class="w-8 h-8 rounded-lg bg-white border border-gray-100 flex items-center justify-center text-brand-400 group-hover/feature:bg-brand-600 group-hover/feature:text-white transition-all">
                            <i class="ti ti-check"></i>
                        </div>
                        <input type="text" name="features[]" placeholder="Contoh: Unlimited Produk" required 
                            class="flex-1 bg-transparent border-none text-sm font-bold text-gray-900 focus:ring-0 placeholder:text-gray-300">
                        <button type="button" onclick="this.parentElement.remove()" class="w-8 h-8 flex items-center justify-center text-gray-300 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition-all opacity-0 group-hover/feature:opacity-100">
                            <i class="ti ti-trash"></i>
                        </button>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Right: Side Details --}}
        <div class="lg:col-span-4 space-y-6">
            {{-- Pricing Card --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-8">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-brand-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-brand-50">
                        <i class="ti ti-coin"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none tracking-tight">Strategi Harga</h3>
                        <p class="text-[12px] text-gray-400 font-semibold mt-1.5 uppercase tracking-wider">Monetisasi</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700 px-1">Harga Bulanan (Rp)</label>
                        <input type="number" name="monthly_price" value="{{ old('monthly_price', $pricing_plan->monthly_price) }}" required placeholder="0"
                            class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 px-6 text-gray-900 font-black focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all text-2xl shadow-sm">
                    </div>

                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700 px-1">Harga Tahunan (Rp)</label>
                        <input type="number" name="yearly_price" value="{{ old('yearly_price', $pricing_plan->yearly_price) }}" required placeholder="0"
                            class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 px-6 text-gray-900 font-black focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all text-2xl shadow-sm">
                    </div>

                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700 px-1">Teks Penghematan Tahunan</label>
                        <input type="text" name="yearly_savings" value="{{ old('yearly_savings', $pricing_plan->yearly_savings) }}" placeholder="Contoh: Hemat Rp 800rb"
                            class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 px-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all placeholder:text-gray-300 shadow-sm">
                    </div>
                </div>
            </div>

            {{-- Technical Specification --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-8">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-brand-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-brand-50">
                        <i class="ti ti-cpu"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none tracking-tight">Spesifikasi Teknis</h3>
                        <p class="text-[12px] text-gray-400 font-semibold mt-1.5 uppercase tracking-wider">Infrastruktur</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700 px-1">Maksimal Karyawan</label>
                        <input type="number" name="max_employees" value="{{ old('max_employees', $pricing_plan->max_employees) }}" placeholder="0"
                            class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 px-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all shadow-sm">
                    </div>

                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700 px-1">Server Specification</label>
                        <input type="text" name="server_spec" value="{{ old('server_spec', $pricing_plan->server_spec) }}" placeholder="Contoh: 2 vCPU, 2 GB RAM"
                            class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 px-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all shadow-sm">
                    </div>
                </div>
            </div>

            {{-- Visibility Status --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 space-y-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-brand-50 text-brand-600 rounded-xl flex items-center justify-center text-xl shadow-inner border border-brand-50">
                            <i class="ti ti-star"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-900 leading-none tracking-tight">Featured</h4>
                            <p class="text-[10px] text-gray-400 font-semibold mt-1 uppercase tracking-wider">Paling Populer</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ $pricing_plan->is_featured ? 'checked' : '' }}>
                        <div class="w-12 h-6.5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[3px] after:left-[3px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-600 transition-all shadow-sm"></div>
                    </label>
                </div>
                <div class="flex items-center justify-between pt-6 border-t border-gray-50">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl shadow-inner border border-emerald-50">
                            <i class="ti ti-eye"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-900 leading-none tracking-tight">Visibility</h4>
                            <p class="text-[10px] text-gray-400 font-semibold mt-1 uppercase tracking-wider">Status Aktif</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ $pricing_plan->is_active ? 'checked' : '' }}>
                        <div class="w-12 h-6.5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[3px] after:left-[3px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-600 transition-all shadow-sm"></div>
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
        div.className = 'flex items-center gap-4 group/feature bg-gray-50/50 p-4 rounded-xl border border-gray-100/50 focus-within:bg-white focus-within:border-brand-100/50 transition-all shadow-sm';
        div.innerHTML = `
            <div class="w-8 h-8 rounded-lg bg-white border border-gray-100 flex items-center justify-center text-brand-400 group-hover/feature:bg-brand-600 group-hover/feature:text-white transition-all">
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
