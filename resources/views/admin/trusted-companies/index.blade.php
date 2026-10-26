@extends('layouts.admin')

@section('title', 'Logo Partner Perusahaan')

@section('breadcrumbs')
<nav class="flex items-center gap-1.5 text-xs text-gray-400 font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#007A87] transition-colors flex items-center gap-1">
        <i class="ti ti-home"></i>
        <span>Dashboard</span>
    </a>
    <i class="ti ti-chevron-right text-[10px]"></i>
    <span class="text-gray-700 font-bold">Partner Logos</span>
</nav>
@endsection

@section('actions')
<div class="flex items-center gap-2.5">
    <a href="{{ route('landing') }}" 
       target="_blank"
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 hover:border-teal-300 text-gray-600 hover:text-[#007A87] text-xs font-bold transition-all shadow-2xs">
        <i class="ti ti-external-link text-sm"></i>
        <span>Lihat Live Web</span>
    </a>

    <a href="{{ route('admin.trusted-companies.create') }}" 
       class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
        <i class="ti ti-plus text-sm"></i>
        <span>Tambah Partner</span>
    </a>
</div>
@endsection

@section('content')
<div class="space-y-6">

    <!-- Top Statistics Row -->
    @php
        $totalCompanies = $companies->count();
        $activeCompanies = $companies->where('is_active', true)->count();
        $draftCompanies = $companies->where('is_active', false)->count();
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <!-- Stat 1 -->
        <div class="card-clean p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-teal-50 text-[#007A87] flex items-center justify-center text-lg shrink-0">
                <i class="ti ti-building-community"></i>
            </div>
            <div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Total Partner</span>
                <div class="flex items-baseline gap-1.5 mt-0.5">
                    <span class="text-lg font-extrabold text-gray-900 leading-none">{{ $totalCompanies }}</span>
                    <span class="text-[11px] font-semibold text-gray-500">Perusahaan</span>
                </div>
            </div>
        </div>

        <!-- Stat 2 -->
        <div class="card-clean p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg shrink-0">
                <i class="ti ti-circle-check"></i>
            </div>
            <div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Status Aktif</span>
                <div class="flex items-baseline gap-1.5 mt-0.5">
                    <span class="text-lg font-extrabold text-emerald-600 leading-none">{{ $activeCompanies }}</span>
                    <span class="text-[11px] font-semibold text-gray-500">Tampil di Web</span>
                </div>
            </div>
        </div>

        <!-- Stat 3 -->
        <div class="card-clean p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-slate-50 text-gray-400 flex items-center justify-center text-lg shrink-0">
                <i class="ti ti-eye-off"></i>
            </div>
            <div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Status Draft</span>
                <div class="flex items-baseline gap-1.5 mt-0.5">
                    <span class="text-lg font-extrabold text-gray-700 leading-none">{{ $draftCompanies }}</span>
                    <span class="text-[11px] font-semibold text-gray-500">Disembunyikan</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Notice Card -->
    <div class="card-clean p-4 border-l-4 border-l-[#007A87] flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-teal-50 text-[#007A87] flex items-center justify-center shrink-0">
                <i class="ti ti-info-circle text-lg"></i>
            </div>
            <div>
                <h4 class="text-xs font-bold text-gray-800">Logo Partner & Klien Terpercaya</h4>
                <p class="text-[11px] text-gray-400">Logo brand perusahaan ditampilkan pada section social proof di landing page untuk meningkatkan kredibilitas layanan.</p>
            </div>
        </div>
        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-[#007A87] bg-teal-50 px-2.5 py-1 rounded-lg border border-teal-200/60 self-start sm:self-auto shrink-0">
            <i class="ti ti-sort-ascending"></i>
            <span>Urutan Otomatis</span>
        </span>
    </div>

    <!-- Partner Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
        @forelse($companies as $company)
            <div class="card-clean p-4 flex flex-col justify-between group hover:border-teal-300 transition-all duration-200">
                
                <div>
                    <!-- Top Meta: Sort Order + Status -->
                    <div class="flex items-center justify-between gap-2 mb-3">
                        <span class="text-[10px] font-mono font-bold text-gray-400 bg-gray-50 px-2 py-0.5 rounded border border-gray-100" title="Nomor Urutan">
                            #{{ $company->sort_order }}
                        </span>

                        @if($company->is_active)
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                <span>Aktif</span>
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-gray-100 text-gray-500 border border-gray-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                <span>Draft</span>
                            </span>
                        @endif
                    </div>

                    <!-- Logo Container -->
                    <div class="w-full h-24 bg-slate-50/80 rounded-xl border border-gray-100 p-3 flex items-center justify-center overflow-hidden mb-3 group-hover:bg-white group-hover:border-teal-200 transition-all">
                        @if($company->logo)
                            <img src="{{ str_starts_with($company->logo, 'images/') ? asset($company->logo) : asset('storage/' . $company->logo) }}" 
                                 alt="{{ $company->name }}" 
                                 class="max-w-full max-h-full object-contain filter grayscale group-hover:grayscale-0 transition-all duration-300">
                        @else
                            <div class="text-center text-gray-300">
                                <i class="ti ti-photo-off text-2xl"></i>
                                <span class="text-[10px] block mt-0.5">No Logo</span>
                            </div>
                        @endif
                    </div>

                    <!-- Company Name -->
                    <h3 class="text-xs font-bold text-gray-900 group-hover:text-[#007A87] transition-colors truncate" title="{{ $company->name }}">
                        {{ $company->name }}
                    </h3>
                    <p class="text-[10px] text-gray-400 font-medium mt-0.5">Partner Perusahaan</p>
                </div>

                <!-- Bottom Actions -->
                <div class="pt-3 border-t border-gray-100 flex items-center justify-end gap-1.5 mt-3">
                    <a href="{{ route('admin.trusted-companies.edit', $company->id) }}" 
                       class="w-7 h-7 flex items-center justify-center rounded-lg bg-teal-50 hover:bg-[#007A87] text-[#007A87] hover:text-white border border-teal-200/60 transition-all shadow-2xs" 
                       title="Edit Partner">
                        <i class="ti ti-edit text-xs"></i>
                    </a>

                    <button type="button" 
                            @click="$dispatch('confirm', {
                                title: 'Hapus Logo Partner',
                                message: 'Apakah Anda yakin ingin menghapus partner «{{ $company->name }}»?',
                                type: 'danger',
                                icon: 'ti ti-trash',
                                callback: () => { document.getElementById('delete-form-{{ $company->id }}').submit(); }
                            })" 
                            class="w-7 h-7 flex items-center justify-center rounded-lg bg-gray-50 hover:bg-rose-50 text-gray-400 hover:text-rose-600 border border-gray-200 transition-colors shadow-2xs" 
                            title="Hapus Partner">
                        <i class="ti ti-trash text-xs"></i>
                    </button>

                    <form id="delete-form-{{ $company->id }}" action="{{ route('admin.trusted-companies.destroy', $company->id) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>

            </div>
        @empty
            <div class="col-span-full card-clean p-12 text-center">
                <div class="w-16 h-16 rounded-2xl bg-teal-50 text-[#007A87] flex items-center justify-center mx-auto mb-4 border border-teal-100 text-2xl shadow-sm">
                    <i class="ti ti-building-community"></i>
                </div>
                <h3 class="text-sm font-bold text-gray-900 mb-1">Belum Ada Partner</h3>
                <p class="text-xs text-gray-400 max-w-sm mx-auto mb-5 leading-relaxed">
                    Mulai tambahkan logo brand atau partner perusahaan yang bekerja sama dengan layanan Anda.
                </p>
                <a href="{{ route('admin.trusted-companies.create') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
                    <i class="ti ti-plus text-sm"></i>
                    <span>Tambah Partner Pertama</span>
                </a>
            </div>
        @endforelse
    </div>

</div>
@endsection
