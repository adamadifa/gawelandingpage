@extends('layouts.admin')

@section('breadcrumbs')
<nav class="flex items-center gap-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest">
    <a href="{{ route('admin.hero-sections.index') }}" class="hover:text-brand-600 transition-colors">Landing Page</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <span class="text-brand-600 font-semibold">Hero Stats</span>
</nav>
@endsection

@section('actions')
<a href="{{ route('admin.hero-stats-cards.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-brand-600 text-white rounded-xl text-[13px] font-bold shadow-lg shadow-brand-600/20 hover:bg-brand-700 active:scale-95 transition-all font-poppins">
    <i class="ti ti-plus text-lg"></i>
    <span>Tambah Kartu</span>
</a>
@endsection

@section('content')
<div class="w-full -mt-6">


<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 font-poppins">
    @foreach($cards as $card)
    <div class="bg-white rounded-xl border border-gray-100 p-6 flex flex-col justify-between group hover:shadow-xl hover:shadow-black/[0.02] transition-all duration-300">
        <div class="flex items-start justify-between mb-6">
            <div class="w-12 h-12 rounded-xl bg-{{ $card->color_theme }}-50 text-{{ $card->color_theme }}-600 flex items-center justify-center text-xl shadow-inner border border-{{ $card->color_theme }}-100/50">
                <i class="ti {{ $card->icon }}"></i>
            </div>
            <div class="flex gap-1">
                <a href="{{ route('admin.hero-stats-cards.edit', $card) }}" class="p-2 text-gray-400 hover:text-brand-600 transition-colors">
                    <i class="ti ti-edit text-lg"></i>
                </a>
                <button @click="$dispatch('confirm', {
                    title: 'Hapus Kartu Stat',
                    message: 'Apakah Anda yakin ingin menghapus kartu ini?',
                    type: 'danger',
                    icon: 'ti ti-trash',
                    callback: () => { document.getElementById('delete-form-{{ $card->id }}').submit(); }
                })" class="p-2 text-gray-400 hover:text-rose-600 transition-colors">
                    <i class="ti ti-trash text-lg"></i>
                </button>
                <form id="delete-form-{{ $card->id }}" action="{{ route('admin.hero-stats-cards.destroy', $card) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>

        <div>
            <h4 class="text-xl font-bold text-gray-900 leading-tight mb-1 tracking-tight">{{ $card->value }}</h4>
            <p class="text-[12px] text-gray-400 font-semibold uppercase tracking-wider">{{ $card->title }}</p>
        </div>

        <div class="mt-6 pt-6 border-t border-gray-50 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-{{ $card->color_theme }}-500 animate-pulse"></span>
                <span class="text-[10px] font-bold uppercase tracking-widest text-{{ $card->color_theme }}-600">
                    Slot {{ $card->position_slot }}
                </span>
            </div>
            <span class="text-[10px] font-bold uppercase tracking-widest {{ $card->is_active ? 'text-emerald-600 bg-emerald-50' : 'text-gray-400 bg-gray-50' }} px-3 py-1 rounded-full border {{ $card->is_active ? 'border-emerald-100' : 'border-gray-100' }}">
                {{ $card->is_active ? 'Active' : 'Draft' }}
            </span>
        </div>
    </div>
    @endforeach
</div>
</div>
@endsection
