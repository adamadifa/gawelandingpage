@extends('layouts.admin')

@section('title', 'Testimoni & Ulasan Pengguna')

@section('breadcrumbs')
<nav class="flex items-center gap-1.5 text-xs text-gray-400 font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#007A87] transition-colors flex items-center gap-1">
        <i class="ti ti-home"></i>
        <span>Dashboard</span>
    </a>
    <i class="ti ti-chevron-right text-[10px]"></i>
    <span class="text-gray-700 font-bold">Testimonials</span>
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

    <a href="{{ route('admin.testimonials.create') }}" 
       class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
        <i class="ti ti-plus text-sm"></i>
        <span>Tambah Testimoni</span>
    </a>
</div>
@endsection

@section('content')
<div class="space-y-6">

    <!-- Top Statistics Row -->
    @php
        $totalTestimonials = $testimonials->count();
        $activeTestimonials = $testimonials->where('is_active', true)->count();
        $avgRating = $totalTestimonials > 0 ? round($testimonials->avg('rating'), 1) : 5.0;
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <!-- Stat 1 -->
        <div class="card-clean p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-teal-50 text-[#007A87] flex items-center justify-center text-lg shrink-0">
                <i class="ti ti-message-2-star"></i>
            </div>
            <div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Total Testimoni</span>
                <div class="flex items-baseline gap-1.5 mt-0.5">
                    <span class="text-lg font-extrabold text-gray-900 leading-none">{{ $totalTestimonials }}</span>
                    <span class="text-[11px] font-semibold text-gray-500">Ulasan Pengguna</span>
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
                    <span class="text-lg font-extrabold text-emerald-600 leading-none">{{ $activeTestimonials }}</span>
                    <span class="text-[11px] font-semibold text-gray-500">Tampil di Web</span>
                </div>
            </div>
        </div>

        <!-- Stat 3 -->
        <div class="card-clean p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg shrink-0">
                <i class="ti ti-star-filled"></i>
            </div>
            <div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Rata-rata Rating</span>
                <div class="flex items-baseline gap-1.5 mt-0.5">
                    <span class="text-lg font-extrabold text-amber-600 leading-none">{{ $avgRating }}</span>
                    <span class="text-[11px] font-semibold text-gray-500">/ 5.0 Skor Kepuasan</span>
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
                <h4 class="text-xs font-bold text-gray-800">Manajemen Social Proof & Ulasan Klien</h4>
                <p class="text-[11px] text-gray-400">Testimoni pelanggan disortir berdasarkan nomor urutan (sort order) untuk memperkuat kepercayaan pengunjung terhadap layanan aplikasi.</p>
            </div>
        </div>
        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-[#007A87] bg-teal-50 px-2.5 py-1 rounded-lg border border-teal-200/60 self-start sm:self-auto shrink-0">
            <i class="ti ti-sort-ascending"></i>
            <span>Urutan Otomatis</span>
        </span>
    </div>

    <!-- Testimonials Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($testimonials as $testimonial)
            <div class="card-clean p-5 flex flex-col justify-between group hover:border-teal-300 transition-all duration-200">
                
                <div>
                    <!-- Top Bar: Stars + Sort Order -->
                    <div class="flex items-center justify-between gap-2 mb-3">
                        <div class="flex items-center gap-1 text-amber-400">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $testimonial->rating)
                                    <i class="ti ti-star-filled text-xs"></i>
                                @else
                                    <i class="ti ti-star text-xs text-gray-300"></i>
                                @endif
                            @endfor
                            <span class="text-[11px] font-bold text-gray-700 ml-1">{{ $testimonial->rating }}.0</span>
                        </div>

                        <span class="text-[10px] font-mono font-bold text-gray-400 bg-gray-50 px-2 py-0.5 rounded border border-gray-100" title="Nomor Urutan">
                            #{{ $testimonial->sort_order }}
                        </span>
                    </div>

                    <!-- Quote Content -->
                    <div class="relative mb-5">
                        <i class="ti ti-quote text-2xl text-teal-100 absolute -top-2 -left-1 pointer-events-none"></i>
                        <p class="text-xs text-gray-600 font-medium leading-relaxed italic relative z-10 pl-2">
                            "{{ $testimonial->content }}"
                        </p>
                    </div>
                </div>

                <div>
                    <!-- User Profile & Bottom Bar -->
                    <div class="pt-3 border-t border-gray-100 flex items-center justify-between gap-3">
                        
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-9 h-9 rounded-full bg-slate-100 border border-gray-200 overflow-hidden shrink-0 flex items-center justify-center">
                                @if($testimonial->avatar)
                                    <img src="{{ str_starts_with($testimonial->avatar, 'http') || str_starts_with($testimonial->avatar, 'images/') ? asset($testimonial->avatar) : asset('storage/' . $testimonial->avatar) }}" 
                                         alt="{{ $testimonial->name }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <span class="font-bold text-xs text-[#007A87]">
                                        {{ strtoupper(substr($testimonial->name, 0, 2)) }}
                                    </span>
                                @endif
                            </div>

                            <div class="min-w-0">
                                <h4 class="text-xs font-bold text-gray-900 group-hover:text-[#007A87] transition-colors truncate">
                                    {{ $testimonial->name }}
                                </h4>
                                <p class="text-[10px] text-gray-400 truncate">
                                    {{ $testimonial->position ?: ($testimonial->company ?: 'Klien Terverifikasi') }}
                                </p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center gap-1.5 shrink-0">
                            @if($testimonial->is_active)
                                <span class="w-2 h-2 rounded-full bg-emerald-500 mr-1" title="Aktif"></span>
                            @else
                                <span class="w-2 h-2 rounded-full bg-gray-300 mr-1" title="Draft"></span>
                            @endif

                            <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" 
                               class="w-7 h-7 flex items-center justify-center rounded-lg bg-teal-50 hover:bg-[#007A87] text-[#007A87] hover:text-white border border-teal-200/60 transition-all shadow-2xs" 
                               title="Edit Testimoni">
                                <i class="ti ti-edit text-xs"></i>
                            </a>

                            <button type="button" 
                                    @click="$dispatch('confirm', {
                                        title: 'Hapus Testimoni',
                                        message: 'Apakah Anda yakin ingin menghapus testimoni dari «{{ $testimonial->name }}»?',
                                        type: 'danger',
                                        icon: 'ti ti-trash',
                                        callback: () => { document.getElementById('delete-form-{{ $testimonial->id }}').submit(); }
                                    })" 
                                    class="w-7 h-7 flex items-center justify-center rounded-lg bg-gray-50 hover:bg-rose-50 text-gray-400 hover:text-rose-600 border border-gray-200 transition-colors shadow-2xs" 
                                    title="Hapus Testimoni">
                                <i class="ti ti-trash text-xs"></i>
                            </button>

                            <form id="delete-form-{{ $testimonial->id }}" action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        @empty
            <div class="col-span-full card-clean p-12 text-center">
                <div class="w-16 h-16 rounded-2xl bg-teal-50 text-[#007A87] flex items-center justify-center mx-auto mb-4 border border-teal-100 text-2xl shadow-sm">
                    <i class="ti ti-message-2-off"></i>
                </div>
                <h3 class="text-sm font-bold text-gray-900 mb-1">Belum Ada Testimoni</h3>
                <p class="text-xs text-gray-400 max-w-sm mx-auto mb-5 leading-relaxed">
                    Mulai tambahkan ulasan dan cerita kepuasan dari pelanggan setia Anda.
                </p>
                <a href="{{ route('admin.testimonials.create') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
                    <i class="ti ti-plus text-sm"></i>
                    <span>Tambah Testimoni Pertama</span>
                </a>
            </div>
        @endforelse
    </div>

</div>
@endsection
