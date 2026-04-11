@extends('layouts.admin')

@section('title', 'FAQ — Pengaturan Section')
@section('description', 'Kelola headline dan visual mockup utama untuk bagian tanya jawab.')

@section('breadcrumbs')
<nav class="flex items-center gap-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest font-poppins">
    <a href="{{ route('admin.hero-sections.index') }}" class="hover:text-brand-600 transition-colors">Landing page</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <span class="text-brand-600 font-semibold">FAQ Section</span>
</nav>
@endsection

@section('actions')
<a href="{{ route('admin.faq-sections.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-brand-600 text-white rounded-xl font-bold text-[13px] shadow-lg shadow-brand-600/20 hover:bg-brand-700 active:scale-95 transition-all font-poppins">
    <i class="ti ti-plus text-lg"></i>
    <span>Tambah Baru</span>
</a>
@endsection

@section('content')
<div class="w-full -mt-6 space-y-6 pb-0 font-poppins">
    
    {{-- Data Card Table --}}
    <div class="bg-gray-50/50 rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="py-6 px-8 font-semibold text-gray-400 text-[10px] uppercase tracking-widest">Visual Mockups</th>
                        <th class="py-6 px-8 font-semibold text-gray-400 text-[10px] uppercase tracking-widest">Headline & Badge</th>
                        <th class="py-6 px-8 font-semibold text-gray-400 text-[10px] uppercase tracking-widest text-center">Status</th>
                        <th class="py-6 px-8 font-semibold text-gray-400 text-[10px] uppercase tracking-widest text-right">Manajemen</th>
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
                                <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-brand-50 text-brand-600 rounded-lg text-[10px] font-bold uppercase tracking-widest">
                                    <span>{{ $section->title_badge_icon }}</span>
                                    <span>{{ $section->title_badge }}</span>
                                </div>
                                <h4 class="text-[14px] font-bold text-gray-900 leading-tight group-hover:text-brand-600 transition-colors">{{ $section->headline }}</h4>
                            </div>
                        </td>
                        <td class="py-6 px-8">
                            <div class="flex justify-center">
                                @if($section->is_active)
                                    <span class="inline-flex items-center gap-2 py-2 px-4 rounded-xl text-[10px] font-semibold tracking-widest bg-emerald-50 text-emerald-600 border border-emerald-100 shadow-sm shadow-emerald-600/5">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                        AKTIF
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-2 py-2 px-4 rounded-xl text-[10px] font-semibold tracking-widest bg-gray-50 text-gray-400 border border-gray-100">
                                        <span class="w-2 h-2 rounded-full bg-gray-300"></span>
                                        NONAKTIF
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td class="py-6 px-8 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.faq-sections.edit', $section->id) }}" class="w-9 h-9 flex items-center justify-center bg-gray-50 text-gray-400 hover:bg-brand-600 hover:text-white rounded-xl transition-all shadow-sm hover:shadow-lg hover:shadow-brand-600/20 active:scale-95" title="Edit">
                                    <i class="ti ti-edit text-lg"></i>
                                </a>
                                <button @click="$dispatch('confirm', {
                                    title: 'Hapus FAQ Section',
                                    message: 'Apakah Anda yakin ingin menghapus content ini?',
                                    type: 'danger',
                                    icon: 'ti ti-trash',
                                    callback: () => { document.getElementById('delete-form-{{ $section->id }}').submit(); }
                                })" class="w-9 h-9 flex items-center justify-center bg-gray-50 text-gray-400 hover:bg-rose-600 hover:text-white rounded-xl transition-all shadow-sm hover:shadow-lg hover:shadow-rose-600/20 active:scale-95" title="Hapus">
                                    <i class="ti ti-trash text-lg"></i>
                                </button>
                                <form id="delete-form-{{ $section->id }}" action="{{ route('admin.faq-sections.destroy', $section->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
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
                                <a href="{{ route('admin.faq-sections.create') }}" class="mt-6 text-sm font-bold text-indigo-600 hover:text-indigo-700 border-b-2 border-indigo-100 hover:border-indigo-600 transition-all uppercase tracking-widest pb-1">
                                    Klik di Sini untuk Memulai
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Info Card Summary --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-12 pl-0.5">
        <div class="p-8 bg-brand-900 rounded-xl text-white shadow-2xl shadow-brand-900/20 relative overflow-hidden h-full flex flex-col justify-center group">
             <div class="absolute -top-10 -right-10 w-64 h-64 bg-white/10 rounded-full blur-3xl opacity-50 group-hover:scale-150 transition-transform duration-700"></div>
             <div class="relative z-10 space-y-3">
                 <h4 class="text-xl font-display font-bold leading-tight italic opacity-90 tracking-tight">"Jawaban atas keraguan adalah jembatan menuju kepercayaan."</h4>
                 <p class="text-sm text-brand-100/80 font-medium leading-relaxed">Section ini membungkus daftar pertanyaan Anda dengan visual yang menarik dan headline yang kuat.</p>
             </div>
        </div>

        <div class="p-8 bg-white rounded-xl border border-gray-100 shadow-sm flex items-center gap-8 group hover:shadow-lg hover:shadow-black/[0.02] transition-all duration-500">
            <div class="w-20 h-20 bg-brand-50 text-brand-600 rounded-xl flex items-center justify-center text-4xl shadow-inner border border-brand-100 group-hover:scale-110 group-hover:rotate-6 transition-all">
                <i class="ti ti-help"></i>
            </div>
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 pl-0.5">Total Versi</p>
                <h5 class="text-3xl font-display font-bold text-gray-900 leading-none tracking-tighter">{{ $faq_sections->count() }} Section</h5>
                <p class="text-[11px] text-brand-600 font-bold mt-2 uppercase tracking-widest">Hanya 1 yang aktif di landing page</p>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 0.4s ease-out forwards;
    }
</style>
@endsection
