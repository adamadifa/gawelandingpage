@extends('layouts.admin')

@section('title', 'Daftar Tanya Jawab (FAQ)')

@section('breadcrumbs')
<nav class="flex items-center gap-1.5 text-xs text-gray-400 font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#007A87] transition-colors flex items-center gap-1">
        <i class="ti ti-home"></i>
        <span>Dashboard</span>
    </a>
    <i class="ti ti-chevron-right text-[10px]"></i>
    <span class="text-gray-700 font-bold">Daftar Pertanyaan FAQ</span>
</nav>
@endsection

@section('actions')
<div class="flex items-center gap-2.5">
    <a href="{{ route('admin.faq-sections.index') }}" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 hover:border-teal-300 text-gray-600 hover:text-[#007A87] text-xs font-bold transition-all shadow-2xs">
        <i class="ti ti-layout-board text-sm"></i>
        <span>Header Mockup FAQ</span>
    </a>

    <a href="{{ route('landing') }}#faq" 
       target="_blank"
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 hover:border-teal-300 text-gray-600 hover:text-[#007A87] text-xs font-bold transition-all shadow-2xs">
        <i class="ti ti-external-link text-sm"></i>
        <span>Lihat Live Web</span>
    </a>

    <a href="{{ route('admin.faqs.create') }}" 
       class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
        <i class="ti ti-plus text-sm"></i>
        <span>Tambah Pertanyaan</span>
    </a>
</div>
@endsection

@section('content')
<div class="space-y-6">

    <!-- Top Statistics Row -->
    @php
        $totalFaqs = $faqs->count();
        $activeFaqs = $faqs->where('is_active', true)->count();
        $draftFaqs = $faqs->where('is_active', false)->count();
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <!-- Stat 1 -->
        <div class="card-clean p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-teal-50 text-[#007A87] flex items-center justify-center text-lg shrink-0">
                <i class="ti ti-help"></i>
            </div>
            <div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Total Pertanyaan</span>
                <div class="flex items-baseline gap-1.5 mt-0.5">
                    <span class="text-lg font-extrabold text-gray-900 leading-none">{{ $totalFaqs }}</span>
                    <span class="text-[11px] font-semibold text-gray-500">Item Terdaftar</span>
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
                    <span class="text-lg font-extrabold text-emerald-600 leading-none">{{ $activeFaqs }}</span>
                    <span class="text-[11px] font-semibold text-gray-500">Tampil di Accordion</span>
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
                    <span class="text-lg font-extrabold text-gray-700 leading-none">{{ $draftFaqs }}</span>
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
                <h4 class="text-xs font-bold text-gray-800">Manajemen Urutan Accordion FAQ</h4>
                <p class="text-[11px] text-gray-400">Daftar pertanyaan akan disusun berurutan berdasarkan nomor urutan (sort order) dari yang terkecil di halaman web.</p>
            </div>
        </div>
        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-[#007A87] bg-teal-50 px-2.5 py-1 rounded-lg border border-teal-200/60 self-start sm:self-auto shrink-0">
            <i class="ti ti-sort-ascending"></i>
            <span>Urutan Otomatis</span>
        </span>
    </div>

    <!-- FAQs Cards List -->
    <div class="space-y-3">
        @forelse($faqs as $faq)
            <div class="card-clean p-5 flex flex-col md:flex-row md:items-center justify-between gap-4 group hover:border-teal-300 transition-all duration-200">
                
                <!-- Left: Question & Answer content -->
                <div class="space-y-2.5 flex-1 min-w-0">
                    <!-- Question Row -->
                    <div class="flex items-start gap-3">
                        <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] border border-teal-100/70 flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">
                            Q
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-sm font-bold text-gray-900 group-hover:text-[#007A87] transition-colors leading-snug">
                                {{ $faq->question }}
                            </h3>
                        </div>
                    </div>

                    <!-- Answer Row -->
                    <div class="flex items-start gap-3 pl-0.5">
                        <div class="w-6 h-6 rounded-md bg-emerald-50 text-emerald-700 border border-emerald-100/70 flex items-center justify-center font-bold text-[10px] shrink-0 mt-0.5">
                            A
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-gray-600 font-medium leading-relaxed line-clamp-2">
                                {{ $faq->answer }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right: Sort Order, Status & Actions -->
                <div class="flex items-center justify-between md:justify-end gap-3 shrink-0 pt-3 md:pt-0 border-t md:border-t-0 border-gray-100">
                    
                    <!-- Sort Order Badge -->
                    <span class="text-[11px] font-mono font-bold text-gray-500 bg-gray-50 px-2.5 py-1 rounded-lg border border-gray-200/70" title="Nomor Urutan">
                        Urutan #{{ $faq->sort_order }}
                    </span>

                    <!-- Status Pill -->
                    <div>
                        @if($faq->is_active)
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span>Aktif</span>
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-gray-100 text-gray-500 border border-gray-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                <span>Draft</span>
                            </span>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-1.5">
                        <a href="{{ route('admin.faqs.edit', $faq->id) }}" 
                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-teal-50 hover:bg-[#007A87] text-[#007A87] hover:text-white border border-teal-200/60 transition-all shadow-2xs" 
                           title="Edit FAQ">
                            <i class="ti ti-edit text-xs"></i>
                        </a>

                        <button type="button" 
                                @click="$dispatch('confirm', {
                                    title: 'Hapus Pertanyaan FAQ',
                                    message: 'Apakah Anda yakin ingin menghapus pertanyaan ini?',
                                    type: 'danger',
                                    icon: 'ti ti-trash',
                                    callback: () => { document.getElementById('delete-form-{{ $faq->id }}').submit(); }
                                })" 
                                class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-50 hover:bg-rose-50 text-gray-400 hover:text-rose-600 border border-gray-200 transition-colors shadow-2xs" 
                                title="Hapus FAQ">
                            <i class="ti ti-trash text-sm"></i>
                        </button>
                    </div>

                    <form id="delete-form-{{ $faq->id }}" action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>

                </div>

            </div>
        @empty
            <div class="card-clean p-12 text-center">
                <div class="w-16 h-16 rounded-2xl bg-teal-50 text-[#007A87] flex items-center justify-center mx-auto mb-4 border border-teal-100 text-2xl shadow-sm">
                    <i class="ti ti-help-off"></i>
                </div>
                <h3 class="text-sm font-bold text-gray-900 mb-1">Belum Ada Pertanyaan FAQ</h3>
                <p class="text-xs text-gray-400 max-w-sm mx-auto mb-5 leading-relaxed">
                    Mulai tambahkan pertanyaan umum dan jawabannya agar calon pelanggan lebih memahami layanan Anda.
                </p>
                <a href="{{ route('admin.faqs.create') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
                    <i class="ti ti-plus text-sm"></i>
                    <span>Tambah Pertanyaan Pertama</span>
                </a>
            </div>
        @endforelse
    </div>

</div>
@endsection
