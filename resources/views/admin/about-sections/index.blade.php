@extends('layouts.admin')

@section('title', 'Manajemen about section')
@section('description', 'Kelola narasi dan poin unggulan yang menjelaskan nilai utama aplikasi Anda.')

@section('breadcrumbs')
<nav class="flex items-center gap-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest font-poppins">
    <a href="{{ route('admin.hero-sections.index') }}" class="hover:text-brand-600 transition-colors">Landing page</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <span class="text-brand-600 font-semibold">About section</span>
</nav>
@endsection

@section('actions')
<a href="{{ route('admin.about-sections.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-brand-600 text-white rounded-xl font-bold text-[13px] shadow-lg shadow-brand-600/20 hover:bg-brand-700 active:scale-95 transition-all font-poppins">
    <i class="ti ti-plus text-lg"></i>
    <span>Tambah Baru</span>
</a>
@endsection

@section('content')
<div class="w-full -mt-6 space-y-6 pb-20 font-poppins">
    
    {{-- Data Card --}}


    {{-- Data Card --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="py-6 px-8 font-bold text-gray-400 text-[10px] uppercase tracking-widest">Info Dasar</th>
                        <th class="py-6 px-8 font-bold text-gray-400 text-[10px] uppercase tracking-widest">Headline & Konteks</th>
                        <th class="py-6 px-8 font-bold text-gray-400 text-[10px] uppercase tracking-widest text-center">Status</th>
                        <th class="py-6 px-8 font-bold text-gray-400 text-[10px] uppercase tracking-widest text-right">Manajemen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($about_sections as $about)
                    <tr class="group hover:bg-gray-50/30 transition-colors">
                        <td class="py-6 px-8">
                            <div class="flex items-center gap-5">
                                <div class="w-16 h-16 rounded-2xl bg-gray-50 border border-gray-100 overflow-hidden shadow-inner group-hover:scale-105 transition-transform duration-500">
                                    @if($about->main_image)
                                        <img src="{{ str_starts_with($about->main_image, 'images/') ? asset($about->main_image) : asset('storage/' . $about->main_image) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-200">
                                            <i class="ti ti-photo text-2xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="space-y-1">
                                    <div class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-brand-50 text-brand-600 rounded-lg text-[10px] font-bold uppercase tracking-widest">
                                        <span>{{ $about->title_badge_icon }}</span>
                                        <span>{{ $about->title_badge }}</span>
                                    </div>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest pl-0.5">ID #{{ $about->id }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-6 px-8">
                            <div class="max-w-md space-y-1.5">
                                <h4 class="text-[14px] font-bold text-gray-900 leading-tight group-hover:text-brand-600 transition-colors">{{ $about->headline }}</h4>
                                <p class="text-[11px] text-gray-400 font-medium line-clamp-1 italic">"{{ Str::limit($about->description, 80) }}"</p>
                            </div>
                        </td>
                        <td class="py-6 px-8">
                            <div class="flex justify-center">
                                @if($about->is_active)
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
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.about-sections.edit', $about->id) }}" class="w-9 h-9 flex items-center justify-center bg-gray-50 text-gray-400 hover:bg-brand-600 hover:text-white rounded-xl transition-all shadow-sm hover:shadow-lg hover:shadow-brand-600/20 active:scale-95" title="Edit Section">
                                    <i class="ti ti-edit text-lg"></i>
                                </a>
                                <button @click="$dispatch('confirm', {
                                    title: 'Hapus About Section',
                                    message: 'Apakah Anda yakin ingin menghapus section ini?',
                                    type: 'danger',
                                    icon: 'ti ti-trash',
                                    callback: () => { document.getElementById('delete-form-{{ $about->id }}').submit(); }
                                })" class="w-9 h-9 flex items-center justify-center bg-gray-50 text-gray-400 hover:bg-rose-600 hover:text-white rounded-xl transition-all shadow-sm hover:shadow-lg hover:shadow-rose-600/20 active:scale-95" title="Hapus Section">
                                    <i class="ti ti-trash text-lg"></i>
                                </button>
                                <form id="delete-form-{{ $about->id }}" action="{{ route('admin.about-sections.destroy', $about->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-20 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4 border border-gray-100">
                                    <i class="ti ti-database-off text-3xl text-gray-200"></i>
                                </div>
                                <h3 class="text-lg font-display font-bold text-gray-900">Belum Ada Konten</h3>
                                <p class="text-sm text-gray-500 mt-1 max-w-[240px]">Mulai tambahkan section About pertama Anda untuk mengisi halaman pendaratan.</p>
                                <a href="{{ route('admin.about-sections.create') }}" class="mt-6 text-sm font-bold text-indigo-600 hover:text-indigo-700 border-b-2 border-indigo-100 hover:border-indigo-600 transition-all uppercase tracking-widest pb-1">
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

    {{-- Summary Info Card --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="p-6 bg-white rounded-xl border border-gray-100 shadow-sm flex items-center gap-5 group hover:shadow-lg hover:shadow-black/[0.02] transition-all duration-500">
            <div class="w-14 h-14 bg-brand-50 text-brand-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-brand-100/50 group-hover:scale-110 transition-transform">
                <i class="ti ti-layout-sidebar-right"></i>
            </div>
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 pl-0.5">Total Modul</p>
                <h5 class="text-xl font-display font-bold text-gray-900 leading-none tracking-tight">{{ $about_sections->count() }} Section</h5>
            </div>
        </div>
        
        <div class="p-6 bg-white rounded-xl border border-gray-100 shadow-sm flex items-center gap-5 group hover:shadow-lg hover:shadow-black/[0.02] transition-all duration-500">
            <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-emerald-100/50 group-hover:scale-110 transition-transform">
                <i class="ti ti-cloud-check"></i>
            </div>
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 pl-0.5">Status Publikasi</p>
                <h5 class="text-xl font-display font-bold text-gray-900 leading-none tracking-tight">{{ $about_sections->where('is_active', true)->count() }} Aktif</h5>
            </div>
        </div>

        <div class="p-8 bg-brand-900 rounded-xl text-white shadow-2xl shadow-brand-900/20 relative overflow-hidden h-full flex items-center group">
             <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-3xl opacity-50 group-hover:scale-150 transition-transform duration-700"></div>
             <div class="relative z-10 space-y-2">
                 <h4 class="text-md font-display font-bold leading-tight italic opacity-90 tracking-tight">"Desain adalah duta bisu dari merek Anda."</h4>
                 <p class="text-[10px] text-brand-200/70 font-bold uppercase tracking-widest pl-0.5">— Paul Rand</p>
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
