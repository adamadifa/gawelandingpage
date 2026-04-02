@extends('layouts.admin')

@section('title', 'FAQ — Daftar Pertanyaan')

@section('content')
<div class="w-full space-y-8 pb-20 text-inter font-poppins">
    
    {{-- Page Header --}}
    <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-100">
        <div>
            <nav class="flex items-center gap-2 text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">
                <a href="{{ route('admin.hero-sections.index') }}" class="hover:text-indigo-600 transition-colors">Landing Page</a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <a href="{{ route('admin.faq-sections.index') }}" class="hover:text-indigo-600 transition-colors uppercase tracking-widest">FAQ Section</a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <span class="text-indigo-600">Daftar Pertanyaan</span>
            </nav>
            <h1 class="text-3xl font-display font-black text-gray-900 leading-tight">Kelola FAQ</h1>
            <p class="text-sm text-gray-500 font-medium">Susun daftar pertanyaan dan jawaban yang akan membantu pengguna memahami aplikasi Anda.</p>
        </div>
        <div class="flex items-center gap-3">
             <a href="{{ route('admin.faqs.create') }}" class="inline-flex items-center gap-2 px-7 py-3.5 bg-indigo-600 text-white rounded-2xl font-bold text-sm shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 active:scale-95 transition-all">
                <i class="ti ti-plus text-lg"></i>
                Tambah Pertanyaan
            </a>
        </div>
    </div>

    {{-- Data Card Table --}}
    <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-black/[0.02] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="py-6 px-8 font-black text-gray-400 text-[10px] uppercase tracking-widest">Pertanyaan & Jawaban</th>
                        <th class="py-6 px-8 font-black text-gray-400 text-[10px] uppercase tracking-widest text-center w-32">Urutan</th>
                        <th class="py-6 px-8 font-black text-gray-400 text-[10px] uppercase tracking-widest text-center">Status</th>
                        <th class="py-6 px-8 font-black text-gray-400 text-[10px] uppercase tracking-widest text-right">Manajemen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($faqs as $faq)
                    <tr class="group hover:bg-gray-50/30 transition-colors">
                        <td class="py-6 px-8">
                            <div class="space-y-3">
                                <div class="flex items-start gap-4">
                                    <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">Q</div>
                                    <h4 class="text-sm font-black text-gray-900 leading-tight group-hover:text-indigo-600 transition-colors">
                                        {{ $faq->question }}
                                    </h4>
                                </div>
                                <div class="flex items-start gap-4">
                                    <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">A</div>
                                    <p class="text-sm text-gray-500 font-medium leading-relaxed max-w-2xl line-clamp-2">
                                        {{ $faq->answer }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="py-6 px-8 text-center">
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gray-50 text-gray-900 font-black text-sm border border-gray-100 shadow-inner group-hover:bg-white group-hover:border-indigo-100 transition-all">
                                {{ $faq->sort_order }}
                            </span>
                        </td>
                        <td class="py-6 px-8 text-center">
                            <div class="flex justify-center">
                                @if($faq->is_active)
                                    <span class="inline-flex items-center gap-2 py-2 px-4 rounded-xl text-[10px] font-black tracking-widest bg-emerald-50 text-emerald-600 border border-emerald-100 shadow-sm shadow-emerald-600/5">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                        AKTIF
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-2 py-2 px-4 rounded-xl text-[10px] font-black tracking-widest bg-gray-50 text-gray-400 border border-gray-100">
                                        <span class="w-2 h-2 rounded-full bg-gray-300"></span>
                                        DRAFT
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td class="py-6 px-8 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="w-10 h-10 flex items-center justify-center bg-gray-50 text-gray-400 hover:bg-indigo-600 hover:text-white rounded-xl transition-all shadow-sm hover:shadow-lg hover:shadow-indigo-600/20 active:scale-95" title="Edit">
                                    <i class="ti ti-edit text-xl"></i>
                                </a>
                                <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-10 h-10 flex items-center justify-center bg-gray-50 text-gray-400 hover:bg-rose-600 hover:text-white rounded-xl transition-all shadow-sm hover:shadow-lg hover:shadow-rose-600/20 active:scale-95" title="Hapus">
                                        <i class="ti ti-trash text-xl"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-20 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4 border border-gray-100">
                                    <i class="ti ti-help-off text-3xl text-gray-200"></i>
                                </div>
                                <h3 class="text-lg font-display font-bold text-gray-900">Belum Ada Pertanyaan</h3>
                                <p class="text-sm text-gray-500 mt-1 max-w-[240px]">Mulai tambahkan daftar pertanyaan yang sering ditanyakan pengguna.</p>
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
