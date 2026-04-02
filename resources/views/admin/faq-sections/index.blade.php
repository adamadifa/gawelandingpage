@extends('layouts.admin')

@section('title', 'FAQ — Pengaturan Section')

@section('content')
<div class="w-full space-y-8 pb-20 text-inter font-poppins">
    
    {{-- Page Header --}}
    <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-100">
        <div>
            <nav class="flex items-center gap-2 text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">
                <a href="{{ route('admin.hero-sections.index') }}" class="hover:text-indigo-600 transition-colors">Landing Page</a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <span class="text-indigo-600">FAQ Section Setting</span>
            </nav>
            <h1 class="text-3xl font-display font-black text-gray-900 leading-tight">Pengaturan Section FAQ</h1>
            <p class="text-sm text-gray-500 font-medium">Kelola headline dan visual mockup utama untuk bagian tanya jawab.</p>
        </div>
        <div class="flex items-center gap-3">
             <a href="{{ route('admin.faq-sections.create') }}" class="inline-flex items-center gap-2 px-7 py-3.5 bg-indigo-600 text-white rounded-2xl font-bold text-sm shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 active:scale-95 transition-all">
                <i class="ti ti-plus text-lg"></i>
                Tambah Versi Baru
            </a>
        </div>
    </div>

    {{-- Data Card Table --}}
    <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-black/[0.02] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="py-6 px-8 font-black text-gray-400 text-[10px] uppercase tracking-widest">Visual Mockups</th>
                        <th class="py-6 px-8 font-black text-gray-400 text-[10px] uppercase tracking-widest">Headline & Badge</th>
                        <th class="py-6 px-8 font-black text-gray-400 text-[10px] uppercase tracking-widest text-center">Status</th>
                        <th class="py-6 px-8 font-black text-gray-400 text-[10px] uppercase tracking-widest text-right">Manajemen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($faq_sections as $section)
                    <tr class="group hover:bg-gray-50/30 transition-colors">
                        <td class="py-6 px-8">
                            <div class="flex items-center -space-x-8 group-hover:-space-x-4 transition-all duration-500">
                                <div class="w-20 h-14 rounded-xl bg-gray-50 border-2 border-white overflow-hidden shadow-lg z-20 group-hover:rotate-[-5deg] transition-transform duration-500">
                                    @if($section->primary_image)
                                        <img src="{{ str_starts_with($section->primary_image, 'images/') ? asset($section->primary_image) : asset('storage/' . $section->primary_image) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-200"><i class="ti ti-photo text-xl"></i></div>
                                    @endif
                                </div>
                                <div class="w-12 h-16 rounded-lg bg-gray-100 border-2 border-white overflow-hidden shadow-lg z-10 group-hover:rotate-[10deg] transition-transform duration-500">
                                    @if($section->secondary_image)
                                        <img src="{{ str_starts_with($section->secondary_image, 'images/') ? asset($section->secondary_image) : asset('storage/' . $section->secondary_image) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-200 text-xs font-bold">M</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="py-6 px-8">
                            <div class="max-w-md space-y-2">
                                <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-indigo-50 text-indigo-600 rounded-lg text-[10px] font-black uppercase tracking-widest">
                                    <span>{{ $section->title_badge_icon }}</span>
                                    <span>{{ $section->title_badge }}</span>
                                </div>
                                <h4 class="text-sm font-black text-gray-900 leading-tight group-hover:text-indigo-600 transition-colors">{{ $section->headline }}</h4>
                            </div>
                        </td>
                        <td class="py-6 px-8">
                            <div class="flex justify-center">
                                @if($section->is_active)
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
                                <a href="{{ route('admin.faq-sections.edit', $section->id) }}" class="w-10 h-10 flex items-center justify-center bg-gray-50 text-gray-400 hover:bg-indigo-600 hover:text-white rounded-xl transition-all shadow-sm hover:shadow-lg hover:shadow-indigo-600/20 active:scale-95" title="Edit">
                                    <i class="ti ti-edit text-xl"></i>
                                </a>
                                <form action="{{ route('admin.faq-sections.destroy', $section->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin?')" class="inline">
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
                                <h3 class="text-lg font-display font-bold text-gray-900">Belum Ada Konten</h3>
                                <p class="text-sm text-gray-500 mt-1 max-w-[240px]">Mulai tambahkan visual dan headline untuk section FAQ Anda.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Info Card Summary --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12">
        <div class="p-8 bg-indigo-900 rounded-[2rem] text-white shadow-2xl shadow-indigo-900/10 relative overflow-hidden h-full flex items-center">
             <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-3xl opacity-50"></div>
             <div class="relative z-10 space-y-2">
                 <h4 class="text-xl font-display font-bold leading-tight italic">"Jawaban atas keraguan adalah jembatan menuju kepercayaan."</h4>
                 <p class="text-[10px] text-indigo-200 font-black uppercase tracking-widest">— Branding First</p>
             </div>
        </div>

        <div class="p-8 bg-white rounded-[2rem] border border-gray-100 shadow-sm flex items-center gap-8 group hover:border-indigo-100 transition-colors">
            <div class="w-20 h-20 bg-gray-50 text-indigo-600 rounded-[1.5rem] flex items-center justify-center text-4xl group-hover:bg-indigo-600 group-hover:text-white transition-all shadow-inner">
                <i class="ti ti-help"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Total Versi</p>
                <h5 class="text-3xl font-display font-black text-gray-900 leading-none">{{ $faq_sections->count() }} Section</h5>
                <p class="text-xs text-gray-400 font-bold mt-2 uppercase tracking-wider">Hanya 1 yang bisa diaktifkan</p>
            </div>
        </div>
    </div>
</div>
@endsection
