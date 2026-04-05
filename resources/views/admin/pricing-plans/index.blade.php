@extends('layouts.admin')

@section('title', 'Paket langganan')
@section('description', 'Kelola tier langganan dan fitur yang disertakan.')

@section('breadcrumbs')
<nav class="flex items-center gap-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest font-poppins">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-brand-600 transition-colors">Dashboard</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <span class="text-brand-600 font-semibold">Pricing plans</span>
</nav>
@endsection

@section('actions')
<a href="{{ route('admin.pricing-plans.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-brand-600 text-white rounded-xl font-bold text-[13px] shadow-lg shadow-brand-600/20 hover:bg-brand-700 active:scale-95 transition-all font-poppins">
    <i class="ti ti-plus text-lg"></i>
    <span>Tambah Baru</span>
</a>
@endsection

@section('content')
<div class="w-full -mt-6 space-y-6 pb-20 font-poppins">

    {{-- Pricing Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($plans as $plan)
        <div class="group relative bg-white rounded-xl border {{ $plan->is_featured ? 'border-brand-600 ring-4 ring-brand-50' : 'border-gray-100' }} shadow-xl shadow-black/[0.02] flex flex-col overflow-hidden hover:shadow-2xl hover:shadow-brand-600/5 transition-all duration-500">
            @if($plan->is_featured)
                <div class="absolute top-6 right-6">
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-4 rounded-full text-[10px] font-bold tracking-widest bg-brand-600 text-white shadow-lg shadow-brand-600/20 uppercase">
                        <i class="ti ti-star-filled"></i>
                        Populer
                    </span>
                </div>
            @endif
            <div class="p-8 lg:p-10 flex-1 flex flex-col">
                {{-- Plan Header --}}
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-3">
                        <h3 class="text-2xl font-bold text-gray-900 leading-none tracking-tight lowercase first-letter:uppercase">{{ $plan->name }}</h3>
                        @if($plan->badge)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-brand-50 text-brand-600 text-[10px] font-bold uppercase tracking-wider">
                                {{ $plan->badge }}
                            </span>
                        @endif
                    </div>
                   <p class="text-sm text-gray-400 font-medium leading-relaxed">{{ $plan->target_audience }}</p>
                </div>

                {{-- Price Display --}}
                <div class="mb-10 pb-8 border-b border-gray-50 flex items-baseline gap-2">
                    <span class="text-gray-400 text-lg font-bold">Rp</span>
                    <span class="text-4xl font-bold text-gray-900 tracking-widest">{{ number_format($plan->monthly_price, 0, ',', '.') }}</span>
                    <span class="text-gray-400 text-sm font-bold uppercase tracking-widest">/ bln</span>
                </div>

                {{-- Features List --}}
                <div class="space-y-4 mb-10 flex-1 text-sm">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-6">Fitur & Layanan</p>
                    @foreach($plan->features as $feature)
                    <div class="flex items-start gap-3 group/item">
                        <div class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5 group-hover/item:bg-emerald-500 group-hover/item:text-white transition-colors">
                            <i class="ti ti-check text-xs font-bold"></i>
                        </div>
                        <span class="text-gray-600 font-medium leading-tight">{{ $feature->feature_text }}</span>
                    </div>
                    @endforeach
                </div>

                {{-- Specs Box --}}
                <div class="p-6 bg-gray-50 rounded-xl border border-gray-100 flex items-center gap-4 mb-8 group-hover:bg-brand-50/50 group-hover:border-brand-100 transition-all">
                    <div class="w-10 h-10 bg-white rounded-xl shadow-sm border border-gray-100 flex items-center justify-center text-brand-600 flex-shrink-0">
                        <i class="ti ti-cpu text-xl"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest leading-none mb-1 pl-0.5">Server Spec</p>
                       <p class="text-[11px] font-bold text-gray-900 truncate max-w-[160px]">{{ $plan->server_spec }}</p>
                    </div>
                </div>

                {{-- Plan Actions --}}
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.pricing-plans.edit', $plan->id) }}" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-gray-50 text-gray-500 rounded-xl font-bold text-sm hover:bg-brand-600 hover:text-white hover:shadow-xl hover:shadow-brand-600/20 active:scale-95 transition-all">
                        <i class="ti ti-edit"></i>
                        Edit Paket
                    </a>
                    <button @click="$dispatch('confirm', {
                                    title: 'Hapus Paket',
                                    message: 'Apakah Anda yakin ingin menghapus paket ini?',
                                    type: 'danger',
                                    icon: 'ti ti-trash',
                                    callback: () => { document.getElementById('delete-form-{{ $plan->id }}').submit(); }
                                })" class="w-12 h-12 flex items-center justify-center bg-gray-50 text-rose-400 rounded-xl hover:bg-rose-600 hover:text-white hover:shadow-xl hover:shadow-rose-600/20 active:scale-95 transition-all" title="Hapus">
                        <i class="ti ti-trash text-lg"></i>
                    </button>
                    <form id="delete-form-{{ $plan->id }}" action="{{ route('admin.pricing-plans.destroy', $plan->id) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
           </div>
        </div>
        @empty
        <div class="col-span-full py-32 text-center bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02]">
            <div class="flex flex-col items-center">
                <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-6 border border-gray-100 shadow-inner">
                    <i class="ti ti-package-off text-4xl text-gray-200"></i>
                </div>
                <h3 class="text-2xl font-display font-bold text-gray-900 border-b-2 border-brand-100 pb-2 mb-4 tracking-tight">Belum Ada Paket</h3>
                <p class="text-sm text-gray-500 max-w-[280px] font-medium leading-relaxed">Mulai buat paket langganan untuk menawarkan layanan terbaik kepada pengguna.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
