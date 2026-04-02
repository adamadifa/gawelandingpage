@extends('layouts.admin')

@section('title', 'Daftar fitur unggulan')
@section('description', 'Kelola setiap kartu fitur yang akan mengelilingi visual mockup utama.')

@section('breadcrumbs')
<nav class="flex items-center gap-2 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
    <a href="{{ route('admin.hero-sections.index') }}" class="hover:text-brand-600 transition-colors">Landing page</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <span class="text-brand-600">Feature section</span>
</nav>
@endsection

@section('actions')
<a href="{{ route('admin.features.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-brand-600 text-white rounded-xl font-bold text-[13px] shadow-lg shadow-brand-600/20 hover:bg-brand-700 active:scale-95 transition-all">
    <i class="ti ti-plus text-lg"></i>
    <span>Tambah Baru</span>
</a>
@endsection

@section('content')
<div class="w-full space-y-8 pb-20">
    
    {{-- Grid of Feature Cards --}}


    {{-- Grid of Feature Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @forelse($features as $feature)
        <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 flex flex-col justify-between group h-full hover:border-brand-600 hover:shadow-brand-600/[0.05] transition-all duration-500 relative overflow-hidden">
            {{-- Decoration --}}
            <div class="absolute -top-10 -right-10 w-24 h-24 bg-indigo-50/30 rounded-full blur-2xl group-hover:bg-indigo-100/50 transition-colors"></div>

            <div>
                <div class="flex items-start justify-between mb-8">
                    <div class="w-16 h-16 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shadow-inner group-hover:scale-110 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500">
                        <i class="ti {{ $feature->icon ?: 'ti-star' }} text-3xl"></i>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.features.edit', $feature) }}" class="w-9 h-9 flex items-center justify-center bg-gray-50 text-gray-400 hover:bg-indigo-600 hover:text-white rounded-xl transition-all shadow-sm active:scale-90" title="Edit Fitur">
                            <i class="ti ti-edit text-lg"></i>
                        </a>
                        <form action="{{ route('admin.features.destroy', $feature) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus fitur ini?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-9 h-9 flex items-center justify-center bg-gray-50 text-gray-400 hover:bg-rose-600 hover:text-white rounded-xl transition-all shadow-sm active:scale-90" title="Hapus Fitur">
                                <i class="ti ti-trash text-lg"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="space-y-3">
                    <h4 class="text-lg font-bold text-gray-900 group-hover:text-brand-600 transition-colors leading-tight">{{ $feature->title }}</h4>
                    <p class="text-sm text-gray-500 font-medium leading-relaxed line-clamp-3">
                        {{ $feature->description }}
                    </p>
                </div>
            </div>

            <div class="mt-10 pt-6 border-t border-gray-50 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="text-[9px] font-bold uppercase tracking-widest text-brand-500 bg-brand-50 px-3 py-1.5 rounded-lg border border-brand-100/50">
                        Urutan: {{ $feature->sort_order }}
                    </span>
                </div>
                
                @if($feature->is_active)
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-xl text-[9px] font-bold tracking-widest bg-emerald-50 text-emerald-600 border border-emerald-100">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        AKTIF
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-xl text-[9px] font-bold tracking-widest bg-gray-50 text-gray-400 border border-gray-100">
                        <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
                        DRAFT
                    </span>
                @endif
            </div>
        </div>
        @empty
        <div class="col-span-full py-24 text-center bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02]">
            <div class="flex flex-col items-center">
                <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-6 border border-gray-100">
                    <i class="ti ti-layers-intersect text-4xl text-gray-200"></i>
                </div>
                <h3 class="text-xl font-display font-bold text-gray-900">Belum Ada Item Fitur</h3>
                <p class="text-sm text-gray-500 mt-2 max-w-[320px] leading-relaxed">Kartu fitur akan muncul di sekitar gambar mockup utama. Tambahkan satu untuk memulai.</p>
                <a href="{{ route('admin.features.create') }}" class="mt-8 inline-flex items-center gap-2 px-8 py-4 bg-brand-600 text-white rounded-xl font-bold text-sm shadow-xl shadow-brand-600/20 hover:bg-brand-700 active:scale-95 transition-all">
                    <i class="ti ti-plus text-lg"></i>
                    Buat Fitur Pertama
                </a>
            </div>
        </div>
        @endforelse
    </div>

    {{-- Strategy Card --}}
    <div class="p-10 bg-indigo-950 rounded-xl text-white shadow-2xl shadow-indigo-950/20 relative overflow-hidden flex flex-col md:flex-row items-center gap-10 group mt-12">
        <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-brand-600/20 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
        <div class="w-24 h-24 bg-white/10 rounded-2xl flex items-center justify-center text-5xl shrink-0 backdrop-blur-md border border-white/10 shadow-xl group-hover:rotate-12 transition-transform">
            <i class="ti ti-bulb-filled text-yellow-400"></i>
        </div>
        <div class="space-y-2 relative z-10 text-center md:text-left flex-1">
            <h4 class="text-xl font-display font-bold">Tips Optimalisasi Fitur</h4>
            <p class="text-gray-300 text-sm leading-relaxed max-w-2xl">Pastikan judul fitur ringkas dan padat. Gunakan deskripsi yang fokus pada **Solusi** yang diberikan aplikasi Anda kepada pengguna, bukan sekadar daftar teknis.</p>
        </div>
        <div class="md:ml-auto shrink-0 relative z-10 px-8 py-5 bg-gradient-to-br from-white/10 to-transparent rounded-2xl border border-white/10 text-center shadow-inner backdrop-blur-sm">
            <p class="text-[10px] font-bold text-indigo-300 uppercase tracking-widest mb-1">Total Aktif</p>
            <h5 class="text-3xl font-display font-bold leading-none">{{ $features->where('is_active', true)->count() }} <span class="text-sm font-bold text-gray-500 tracking-normal ml-1">Items</span></h5>
        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 0.4s ease-out forwards;
    }
</style>
@endsection
