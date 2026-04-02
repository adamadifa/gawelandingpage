@extends('layouts.admin')

@section('title', 'Partners — Trusted Companies')

@section('content')
<div class="w-full space-y-8 pb-20 text-inter font-poppins">
    
    {{-- Page Header --}}
    <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-100">
        <div>
            <nav class="flex items-center gap-2 text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">
                <a href="{{ route('admin.hero-sections.index') }}" class="hover:text-indigo-600 transition-colors">Landing Page</a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <span class="text-indigo-600">Trusted Companies</span>
            </nav>
            <h1 class="text-3xl font-display font-black text-gray-900 leading-tight">Partner Terpercaya</h1>
            <p class="text-sm text-gray-500 font-medium">Kelola logo perusahaan dan brand yang telah mempercayai layanan Anda.</p>
        </div>
        <div class="flex items-center gap-3">
             <a href="{{ route('admin.trusted-companies.create') }}" class="inline-flex items-center gap-2 px-7 py-3.5 bg-indigo-600 text-white rounded-2xl font-bold text-sm shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 active:scale-95 transition-all">
                <i class="ti ti-plus text-lg"></i>
                Tambah Partner
            </a>
        </div>
    </div>

    {{-- Data Table --}}
    <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-xl shadow-black/[0.02] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Logo & Partner</th>
                        <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Urutan</th>
                        <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Status</th>
                        <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($companies as $company)
                    <tr class="group hover:bg-indigo-50/30 transition-all duration-300">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-5">
                                <div class="w-20 h-12 bg-white border border-gray-100 rounded-xl p-2 flex items-center justify-center shadow-sm group-hover:scale-105 transition-transform overflow-hidden">
                                    @if($company->logo)
                                        <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}" class="max-w-full max-h-full object-contain">
                                    @else
                                        <div class="text-gray-300 italic text-[10px]">No Logo</div>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-gray-900 group-hover:text-indigo-600 transition-colors uppercase tracking-widest">{{ $company->name }}</h4>
                                    <p class="text-[10px] text-gray-400 font-bold mt-1 uppercase tracking-widest leading-none">Partner Perusahaan</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-50 text-gray-500 font-bold text-xs border border-gray-100">
                                {{ $company->sort_order }}
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            @if($company->is_active)
                                <span class="inline-flex items-center gap-1.5 py-1.5 px-4 rounded-full text-[10px] font-black tracking-widest bg-emerald-100 text-emerald-600 uppercase">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 py-1.5 px-4 rounded-full text-[10px] font-black tracking-widest bg-gray-100 text-gray-400 uppercase">
                                    Draft
                                </span>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.trusted-companies.edit', $company->id) }}" class="w-10 h-10 flex items-center justify-center bg-gray-50 text-gray-400 rounded-xl hover:bg-indigo-600 hover:text-white hover:shadow-lg hover:shadow-indigo-600/20 active:scale-95 transition-all">
                                    <i class="ti ti-edit text-lg"></i>
                                </a>
                                <form action="{{ route('admin.trusted-companies.destroy', $company->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-10 h-10 flex items-center justify-center bg-gray-50 text-rose-400 rounded-xl hover:bg-rose-600 hover:text-white hover:shadow-lg hover:shadow-rose-600/20 active:scale-95 transition-all">
                                        <i class="ti ti-trash text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-6 border border-gray-100 shadow-inner">
                                    <i class="ti ti-building-community text-4xl text-gray-200"></i>
                                </div>
                                <h3 class="text-xl font-display font-black text-gray-900 border-b-2 border-indigo-100 pb-1 mb-3">Belum Ada Partner</h3>
                                <p class="text-sm text-gray-500 max-w-[280px] font-medium leading-relaxed uppercase tracking-widest">Tampilkan brand terpercaya yang bekerja sama dengan Anda.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
