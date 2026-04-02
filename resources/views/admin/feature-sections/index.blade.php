@extends('layouts.admin')

@section('title', 'Daftar section fitur')
@section('description', 'Kelola headline dan visual utama yang membungkus daftar fitur unggulan.')

@section('breadcrumbs')
<nav class="flex items-center gap-2 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
    <a href="{{ route('admin.hero-sections.index') }}" class="hover:text-brand-600 transition-colors">Landing page</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <span class="text-brand-600">Feature Section</span>
</nav>
@endsection

@section('actions')
<a href="{{ route('admin.feature-sections.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-brand-600 text-white rounded-xl font-bold text-[13px] shadow-lg shadow-brand-600/20 hover:bg-brand-700 active:scale-95 transition-all">
    <i class="ti ti-plus text-lg"></i>
    <span>Tambah Baru</span>
</a>
@endsection

@section('content')
<div class="w-full space-y-8 pb-20">
    
    {{-- Data Card --}}


    {{-- Data Card --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100 font-poppins">
                        <th class="py-6 px-8 font-bold text-gray-400 text-[10px] uppercase tracking-widest">Visual Mockup</th>
                        <th class="py-6 px-8 font-bold text-gray-400 text-[10px] uppercase tracking-widest">Badge & Judul</th>
                        <th class="py-6 px-8 font-bold text-gray-400 text-[10px] uppercase tracking-widest text-center">Status</th>
                        <th class="py-6 px-8 font-bold text-gray-400 text-[10px] uppercase tracking-widest text-right">Manajemen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 font-poppins">
                    @forelse($feature_sections as $section)
                    <tr class="group hover:bg-gray-50/30 transition-colors">
                        <td class="py-6 px-8">
                            <div class="w-24 h-16 rounded-xl bg-gray-50 border border-gray-100 overflow-hidden shadow-inner group-hover:scale-105 transition-transform duration-500">
                                @if($section->image_path)
                                    <img src="{{ str_starts_with($section->image_path, 'images/') ? asset($section->image_path) : asset('storage/' . $section->image_path) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-200">
                                        <i class="ti ti-photo text-2xl"></i>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="py-6 px-8">
                            <div class="max-w-md space-y-2">
                                <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-indigo-50 text-indigo-600 rounded-lg text-[10px] font-bold uppercase tracking-widest">
                                    <span>{{ $section->title_badge_icon }}</span>
                                    <span>{{ $section->title_badge }}</span>
                                </div>
                                <h4 class="text-sm font-bold text-gray-900 leading-tight group-hover:text-indigo-600 transition-colors">{{ $section->headline }}</h4>
                            </div>
                        </td>
                        <td class="py-6 px-8">
                            <div class="flex justify-center">
                                @if($section->is_active)
                                    <span class="inline-flex items-center gap-2 py-2 px-4 rounded-xl text-[10px] font-bold tracking-widest bg-emerald-50 text-emerald-600 border border-emerald-100 shadow-sm shadow-emerald-600/5">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                        AKTIF
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-2 py-2 px-4 rounded-xl text-[10px] font-bold tracking-widest bg-gray-50 text-gray-400 border border-gray-100">
                                        <span class="w-2 h-2 rounded-full bg-gray-300"></span>
                                        NONAKTIF
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td class="py-6 px-8">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('admin.feature-sections.edit', $section->id) }}" class="w-10 h-10 flex items-center justify-center bg-gray-50 text-gray-400 hover:bg-indigo-600 hover:text-white rounded-xl transition-all shadow-sm hover:shadow-lg hover:shadow-indigo-600/20 active:scale-95" title="Edit Section">
                                    <i class="ti ti-edit text-xl"></i>
                                </a>
                                <form action="{{ route('admin.feature-sections.destroy', $section->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus content ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-10 h-10 flex items-center justify-center bg-gray-50 text-gray-400 hover:bg-rose-600 hover:text-white rounded-xl transition-all shadow-sm hover:shadow-lg hover:shadow-rose-600/20 active:scale-95" title="Hapus Section">
                                        <i class="ti ti-trash text-xl"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-20 text-center font-poppins">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4 border border-gray-100">
                                    <i class="ti ti-database-off text-3xl text-gray-200"></i>
                                </div>
                                <h3 class="text-lg font-display font-bold text-gray-900">Belum Ada Konten</h3>
                                <p class="text-sm text-gray-500 mt-1 max-w-[240px]">Mulai tambahkan section Fitur pertama Anda untuk mengisi halaman pendaratan.</p>
                                <a href="{{ route('admin.feature-sections.create') }}" class="mt-6 text-sm font-bold text-indigo-600 hover:text-indigo-700 border-b-2 border-indigo-100 hover:border-indigo-600 transition-all uppercase tracking-widest pb-1">
                                    Klik di Sini untuk Memulai
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Contextual Info Card --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-12">
        <div class="p-8 bg-indigo-950 rounded-xl text-white shadow-2xl shadow-indigo-950/20 relative overflow-hidden h-full flex flex-col justify-center group">
             <div class="absolute -top-10 -right-10 w-64 h-64 bg-brand-600/20 rounded-full blur-3xl opacity-50 group-hover:scale-150 transition-transform duration-700"></div>
             <div class="relative z-10 space-y-3">
                 <h4 class="text-xl font-display font-bold leading-tight italic opacity-90">"Fitur memberitahu, keuntungan menjual."</h4>
                 <p class="text-sm text-indigo-300 font-medium leading-relaxed">Section ini membungkus daftar fitur Anda dengan visual yang menarik dan headline yang kuat.</p>
             </div>
        </div>

        <div class="p-8 bg-gradient-to-br from-white to-gray-50/50 rounded-xl border border-gray-100 shadow-sm flex items-center gap-8 group hover:shadow-lg transition-all duration-500">
            <div class="w-20 h-20 bg-indigo-600 text-white rounded-xl flex items-center justify-center text-4xl shadow-lg shadow-indigo-600/20 group-hover:scale-110 group-hover:rotate-6 transition-all">
                <i class="ti ti-stack-2"></i>
            </div>
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Total Versi</p>
                <h5 class="text-3xl font-display font-bold text-gray-900 leading-none">{{ $feature_sections->count() }} Section</h5>
                <p class="text-xs text-brand-600 font-bold mt-2 uppercase tracking-wider">Hanya 1 yang aktif di landing page</p>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 0.4s ease-out forwards;
    }
</style>
@endsection
