@extends('layouts.admin')

@section('title', 'Hero Stats Cards')

@section('content')
<nav class="flex items-center gap-2 text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6">
    <a href="{{ route('admin.hero-sections.index') }}" class="hover:text-indigo-600 transition-colors">Landing Page</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <span class="text-indigo-600">Hero Stats</span>
</nav>

<div class="mb-8 flex justify-between items-center">
    <div>
        <p class="text-sm text-gray-500 font-medium">Kelola kartu statistik yang melayang di bagian Hero Section.</p>
    </div>
    <a href="{{ route('admin.hero-stats-cards.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-bold shadow-lg shadow-indigo-600/20 hover:bg-indigo-700 transition-all">
        <i class="ti ti-plus text-lg"></i>
        Tambah Kartu
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($cards as $card)
    <div class="card-wow p-6 flex flex-col justify-between group">
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-{{ $card->color_theme }}-50 text-{{ $card->color_theme }}-600 flex items-center justify-center">
                <i class="ti {{ $card->icon }} text-2xl"></i>
            </div>
            <div class="flex gap-2">
                <form action="{{ route('admin.hero-stats-cards.destroy', $card) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2 text-gray-400 hover:text-red-500 transition-colors">
                        <i class="ti ti-trash text-lg"></i>
                    </button>
                </form>
                <a href="{{ route('admin.hero-stats-cards.edit', $card) }}" class="p-2 text-gray-400 hover:text-indigo-600 transition-colors">
                    <i class="ti ti-edit text-lg"></i>
                </a>
            </div>
        </div>

        <div>
            <h4 class="text-lg font-bold text-gray-900 mb-1">{{ $card->value }}</h4>
            <p class="text-sm text-gray-500 font-medium">{{ $card->title }}</p>
        </div>

        <div class="mt-6 pt-4 border-t border-gray-50 flex items-center justify-between">
            <span class="text-[10px] font-black uppercase tracking-widest text-{{ $card->color_theme }}-500 bg-{{ $card->color_theme }}-50 px-2 py-0.5 rounded">
                Slot: {{ $card->position_slot }}
            </span>
            <span class="text-[10px] font-black uppercase tracking-widest {{ $card->is_active ? 'text-emerald-500 bg-emerald-50' : 'text-gray-400 bg-gray-50' }} px-2 py-0.5 rounded">
                {{ $card->is_active ? 'Active' : 'Draft' }}
            </span>
        </div>
    </div>
    @endforeach
</div>
@endsection
