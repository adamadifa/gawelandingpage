@extends('layouts.admin')

@section('title', 'Hero Section Landing Page')
@section('subtitle', 'Kelola pesan utama, deskripsi penawaran, tombol Call to Action (CTA), dan gambar mockup visual di halaman depan.')

@section('breadcrumbs')
<div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white border border-[#E2E8F0]/70 text-xs text-[#64748B] shadow-2xs font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#007A87] flex items-center gap-1">
        <i class="ti ti-home text-sm"></i>
        <span>Dashboard</span>
    </a>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <span class="text-gray-400">Landing Page CMS</span>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <span class="text-[#0F172A] font-semibold">Hero Layout</span>
</div>
@endsection

@section('actions')
<div class="flex items-center gap-2">
    <!-- Counter Stats Link -->
    <a href="{{ route('admin.hero-stats-cards.index') }}" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 text-xs font-bold shadow-2xs transition-all">
        <i class="ti ti-numbers text-[#007A87] text-sm"></i>
        <span>Counter Stats</span>
    </a>

    <!-- Live Preview -->
    <a href="{{ route('landing') }}" target="_blank" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-teal-700/20 transition-all">
        <i class="ti ti-external-link text-sm"></i>
        <span>Lihat Live Site</span>
    </a>
</div>
@endsection

@section('content')
<div class="space-y-6">

    <!-- Information Header Notice -->
    <div class="card-clean p-4 border-l-4 border-l-[#007A87] flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-teal-50 text-[#007A87] flex items-center justify-center shrink-0">
                <i class="ti ti-layout-board text-lg"></i>
            </div>
            <div>
                <h4 class="text-xs font-bold text-gray-800">Manajemen Hero Banner Landing Page</h4>
                <p class="text-[11px] text-gray-400">Hero Section adalah bagian paling atas landing page yang pertama kali dilihat oleh pengunjung.</p>
            </div>
        </div>
        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-[#007A87] bg-teal-50 px-2.5 py-1 rounded-lg border border-teal-200/60 self-start sm:self-auto shrink-0">
            <i class="ti ti-check"></i>
            <span>Maksimal 1 Hero Aktif</span>
        </span>
    </div>

    <!-- Hero Cards Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @forelse($heroes as $hero)
            <div class="card-clean overflow-hidden flex flex-col justify-between transition-all hover:border-teal-200 {{ $hero->is_active ? 'ring-2 ring-[#007A87]/30 border-[#007A87]/50' : '' }}">
                
                <!-- Card Header Image & Status Badge -->
                <div class="relative h-56 bg-slate-100 overflow-hidden group">
                    <img src="{{ $hero->image_path ? asset('storage/' . $hero->image_path) : 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&q=80&w=800' }}" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" 
                         alt="Hero Banner Preview">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/30 to-transparent"></div>

                    <!-- Top Floating Status -->
                    <div class="absolute top-3.5 left-3.5 right-3.5 flex items-center justify-between z-10">
                        @if($hero->is_active)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-500/90 text-white text-[10px] font-extrabold uppercase tracking-wider rounded-lg backdrop-blur-xs shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                                <span>SEDANG AKTIF DI WEB</span>
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-slate-900/70 text-gray-300 text-[10px] font-bold uppercase tracking-wider rounded-lg backdrop-blur-xs">
                                <span>DRAFT / NONAKTIF</span>
                            </span>
                        @endif

                        <span class="text-[10px] font-mono text-white/80 bg-black/40 px-2 py-0.5 rounded backdrop-blur-xs">
                            #ID-{{ $hero->id }}
                        </span>
                    </div>

                    <!-- Bottom Overlay Headline -->
                    <div class="absolute bottom-3.5 left-4 right-4 z-10">
                        <h3 class="text-white font-extrabold text-base sm:text-lg line-clamp-1 drop-shadow-sm">
                            {{ $hero->headline }}
                        </h3>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                    
                    <!-- Sub Headline -->
                    <div>
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-1">Deskripsi Narasi</span>
                        <p class="text-xs text-gray-600 line-clamp-3 leading-relaxed font-medium">
                            {{ $hero->sub_headline }}
                        </p>
                    </div>

                    <!-- CTA Buttons Display -->
                    <div>
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-2">Tombol Call to Action</span>
                        <div class="flex flex-wrap items-center gap-2">
                            @if($hero->cta_text)
                                <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-teal-50 border border-teal-200/80 text-xs text-[#007A87] font-semibold">
                                    <i class="ti ti-click text-sm"></i>
                                    <span>Utama: <strong>{{ $hero->cta_text }}</strong></span>
                                </div>
                            @endif

                            @if($hero->cta_secondary_text)
                                <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-100 border border-slate-200 text-xs text-gray-700 font-semibold">
                                    <i class="ti ti-link text-sm text-gray-400"></i>
                                    <span>Sekunder: <strong>{{ $hero->cta_secondary_text }}</strong></span>
                                </div>
                            @endif

                            @if(!$hero->cta_text && !$hero->cta_secondary_text)
                                <span class="text-[11px] text-gray-400 italic">Belum ada tombol aksi</span>
                            @endif
                        </div>
                    </div>

                    <!-- Card Actions Footer -->
                    <div class="pt-4 border-t border-gray-100 flex items-center justify-between gap-2.5">
                        <a href="{{ route('admin.hero-sections.edit', $hero) }}" 
                           class="flex-1 inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-xl bg-gray-50 hover:bg-gray-100 text-gray-700 border border-gray-200 text-xs font-bold transition-all shadow-2xs">
                            <i class="ti ti-edit text-sm"></i>
                            <span>Edit Konten Hero</span>
                        </a>

                        @if(!$hero->is_active)
                            <form action="{{ route('admin.hero-sections.update', $hero) }}" method="POST" class="flex-1">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="is_active" value="1">
                                <input type="hidden" name="headline" value="{{ $hero->headline }}">
                                <input type="hidden" name="sub_headline" value="{{ $hero->sub_headline }}">
                                <button type="submit" 
                                        class="w-full inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
                                    <i class="ti ti-check text-sm"></i>
                                    <span>Aktifkan Hero</span>
                                </button>
                            </form>
                        @else
                            <a href="{{ route('landing') }}" target="_blank" 
                               class="inline-flex items-center justify-center gap-1 px-3 py-2 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold hover:bg-emerald-100 transition-all">
                                <i class="ti ti-world text-sm"></i>
                                <span>Live Web</span>
                            </a>
                        @endif
                    </div>

                </div>

            </div>
        @empty
            <div class="lg:col-span-2 card-clean p-12 text-center">
                <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto text-gray-400 text-3xl mb-3">
                    <i class="ti ti-layout-board"></i>
                </div>
                <h4 class="text-sm font-bold text-gray-800">Belum ada konten Hero Section</h4>
                <p class="text-xs text-gray-400 mt-1">Silakan tambahkan atau konfigurasikan hero section untuk halaman depan.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection
