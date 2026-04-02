@extends('layouts.admin')

@section('title', 'Hero Section Management')

@section('content')
<nav class="flex items-center gap-2 text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6">
    <span class="text-gray-400">Landing Page</span>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <span class="text-indigo-600">Hero Section</span>
</nav>

<div class="mb-8 flex justify-between items-center">
    <p class="text-sm text-gray-500 font-medium">Kelola pesan utama yang muncul di bagian paling atas website Anda.</p>
    <div class="flex items-center gap-2 px-4 py-2 bg-indigo-50 text-indigo-700 rounded-xl text-xs font-bold uppercase tracking-wider">
        <i class="ti ti-info-circle text-lg"></i>
        <span>Maksimal 1 Hero Aktif</span>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach($heroes as $hero)
    <div class="card-wow overflow-hidden group hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-300 border-2 {{ $hero->is_active ? 'border-indigo-500' : 'border-transparent' }}">
        {{-- Preview Area --}}
        <div class="relative h-48 bg-gray-100 flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent z-10"></div>
            <img src="{{ $hero->image_path ? asset('storage/' . $hero->image_path) : 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&q=80&w=800' }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Hero Preview">
            
            <div class="absolute bottom-4 left-4 right-4 z-20">
                <h4 class="text-white font-bold text-lg line-clamp-1 mb-1">{{ $hero->headline }}</h4>
                <div class="flex gap-2">
                    @if($hero->is_active)
                    <span class="px-2 py-0.5 bg-indigo-500 text-white text-[10px] font-black uppercase rounded shadow-sm">ACTIVE</span>
                    @else
                    <span class="px-2 py-0.5 bg-gray-900/50 text-white text-[10px] font-black uppercase rounded backdrop-blur-sm">DRAFT</span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Content Area --}}
        <div class="p-6">
            <p class="text-sm text-gray-500 line-clamp-2 mb-6 font-medium leading-relaxed">{{ $hero->sub_headline }}</p>
            
            <div class="flex flex-wrap gap-2 mb-8">
                @if($hero->cta_text)
                <div class="flex items-center gap-1.5 px-3 py-1 bg-gray-50 text-gray-600 rounded-lg text-[11px] font-bold border border-gray-100">
                    <i class="ti ti-point-filled text-indigo-500"></i>
                    {{ $hero->cta_text }}
                </div>
                @endif
                @if($hero->cta_secondary_text)
                <div class="flex items-center gap-1.5 px-3 py-1 bg-gray-50 text-gray-600 rounded-lg text-[11px] font-bold border border-gray-100">
                    <i class="ti ti-point-filled text-gray-300"></i>
                    {{ $hero->cta_secondary_text }}
                </div>
                @endif
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-between gap-3 pt-6 border-t border-gray-50">
                <a href="{{ route('admin.hero-sections.edit', $hero) }}" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-white text-gray-700 border border-gray-200 rounded-xl text-sm font-bold hover:bg-gray-50 hover:border-indigo-600 hover:text-indigo-600 transition-all">
                    <i class="ti ti-edit-circle text-lg"></i>
                    Edit
                </a>
                
                @if(!$hero->is_active)
                <form action="{{ route('admin.hero-sections.update', $hero) }}" method="POST" class="flex-1">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="is_active" value="1">
                    <input type="hidden" name="headline" value="{{ $hero->headline }}">
                    <input type="hidden" name="sub_headline" value="{{ $hero->sub_headline }}">
                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-bold shadow-lg shadow-indigo-600/20 hover:bg-indigo-700 active:scale-95 transition-all">
                        <i class="ti ti-circle-check text-lg"></i>
                        Activate
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
    @endforeach

    {{-- Add New Card (Placeholder functionality if route exists) --}}
    <div class="card-wow border-2 border-dashed border-gray-200 bg-gray-50/50 flex flex-col items-center justify-center p-10 group hover:border-indigo-300 hover:bg-indigo-50/30 transition-all cursor-pointer">
        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-gray-400 group-hover:text-indigo-600 group-hover:scale-110 transition-all shadow-sm mb-4">
            <i class="ti ti-plus text-3xl"></i>
        </div>
        <h4 class="font-bold text-gray-400 group-hover:text-indigo-600 transition-colors">Add New Concept</h4>
        <p class="text-[11px] font-bold text-gray-300 uppercase tracking-widest mt-1">Coming Soon</p>
    </div>
</div>
@endsection
