@extends('layouts.admin')

@section('breadcrumbs')
<nav class="flex items-center gap-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest">
    <span class="text-gray-400">Landing Page</span>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <span class="text-brand-600">Hero Section</span>
</nav>
@endsection

@section('actions')
<div class="flex items-center gap-2 px-4 py-2 bg-brand-50 text-brand-700 rounded-xl text-[10px] font-bold uppercase tracking-wider border border-brand-100 shadow-sm">
    <i class="ti ti-info-circle text-lg"></i>
    <span>Maksimal 1 Hero Aktif</span>
</div>
@endsection

@section('content')
<div class="w-full -mt-6">

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach($heroes as $hero)
    <div class="rounded-xl border-2 border-brand-500 shadow-xl shadow-brand-500/5 transition-all duration-300">
        {{-- Preview Area --}}
        <div class="relative h-48 bg-gray-100 flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent z-10"></div>
            <img src="{{ $hero->image_path ? asset('storage/' . $hero->image_path) : 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&q=80&w=800' }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Hero Preview">
            
            <div class="absolute bottom-4 left-4 right-4 z-20">
                <h4 class="text-white font-bold text-lg line-clamp-1 mb-1">{{ $hero->headline }}</h4>
                <div class="flex gap-2">
                    @if($hero->is_active)
                    <span class="px-2 py-0.5 bg-brand-600 text-white text-[10px] font-bold uppercase rounded shadow-sm">ACTIVE</span>
                    @else
                    <span class="px-2 py-0.5 bg-gray-900/50 text-white text-[10px] font-bold uppercase rounded backdrop-blur-sm">DRAFT</span>
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
                <a href="{{ route('admin.hero-sections.edit', $hero) }}" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-white text-gray-700 border border-gray-200 rounded-xl text-sm font-semibold hover:bg-gray-50 hover:border-brand-600 hover:text-brand-600 transition-all">
                    <i class="ti ti-edit-circle text-lg blur-[0.3px]"></i>
                    Edit
                </a>
                
                @if(!$hero->is_active)
                <form action="{{ route('admin.hero-sections.update', $hero) }}" method="POST" class="flex-1">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="is_active" value="1">
                    <input type="hidden" name="headline" value="{{ $hero->headline }}">
                    <input type="hidden" name="sub_headline" value="{{ $hero->sub_headline }}">
                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-brand-600 text-white rounded-xl text-sm font-bold shadow-lg shadow-brand-600/20 hover:bg-brand-700 active:scale-95 transition-all">
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
    <div class="card-wow border-2 border-dashed border-gray-200 bg-white flex flex-col items-center justify-center p-10 group hover:border-brand-300 hover:bg-brand-50/30 transition-all cursor-pointer rounded-xl">
        <div class="w-16 h-16 bg-gray-50 text-gray-400 rounded-2xl flex items-center justify-center group-hover:text-brand-600 group-hover:scale-110 transition-all shadow-inner mb-4">
            <i class="ti ti-plus text-3xl"></i>
        </div>
        <h4 class="font-semibold text-gray-400 group-hover:text-brand-600 transition-colors">Add New Concept</h4>
        <p class="text-[11px] font-semibold text-gray-300 uppercase tracking-widest mt-1">Coming Soon</p>
    </div>
</div>
</div>
@endsection
