@extends('layouts.admin')

@section('title', 'FAQ — Tambah Pertanyaan')

@section('breadcrumbs')
<nav class="flex items-center gap-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest mb-2 font-poppins">
    <a href="{{ route('admin.hero-sections.index') }}" class="hover:text-brand-600 transition-colors">Landing Page</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <a href="{{ route('admin.faq-sections.index') }}" class="hover:text-brand-600 transition-colors">FAQ Section</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <a href="{{ route('admin.faqs.index') }}" class="hover:text-brand-600 transition-colors">Daftar Pertanyaan</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <span class="text-brand-600 font-semibold">Item Baru</span>
</nav>
@endsection

@section('actions')
<div class="flex items-center gap-3 font-poppins">
     <a href="{{ route('admin.faqs.index') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-400 hover:text-gray-600 transition-colors">Batal</a>
     <button type="submit" form="faq-item-create-form" class="inline-flex items-center gap-2 px-7 py-3.5 bg-brand-600 text-white rounded-xl font-bold text-sm shadow-xl shadow-brand-600/20 hover:bg-brand-700 active:scale-95 transition-all">
        <i class="ti ti-device-floppy text-lg"></i>
        <span>Simpan FAQ</span>
    </button>
</div>
@endsection

@section('content')
<div class="w-full -mt-6 space-y-6 pb-0 font-poppins text-inter">

    <form id="faq-item-create-form" action="{{ route('admin.faqs.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        @csrf

        {{-- Left: Question & Answer Content --}}
        <div class="lg:col-span-8 space-y-6">
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-8">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-brand-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-brand-50">
                        <i class="ti ti-help"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none tracking-tight">Konten Q&A</h3>
                        <p class="text-[12px] text-gray-400 font-semibold mt-1.5 uppercase tracking-wider">Pertanyaan & Jawaban</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700 px-1">Pertanyaan</label>
                        <input type="text" name="question" value="{{ old('question') }}" required placeholder="Contoh: Apakah aplikasi ini gratis?"
                            class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 px-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all placeholder:text-gray-300 shadow-sm">
                    </div>

                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700 px-1">Jawaban Lengkap</label>
                        <textarea name="answer" rows="8" required placeholder="Berikan penjelasan yang detail dan mudah dipahami..."
                            class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 px-6 text-gray-900 font-medium focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all placeholder:text-gray-300 leading-relaxed shadow-sm">{{ old('answer') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Settings & Visibility --}}
        <div class="lg:col-span-4 space-y-6">
            {{-- Organization Card --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-8">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-brand-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-brand-50">
                        <i class="ti ti-sort-ascending-numbers"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none tracking-tight">Pengaturan</h3>
                        <p class="text-[12px] text-gray-400 font-semibold mt-1.5 uppercase tracking-wider">Urutan & Prioritas</p>
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-gray-700 px-1">Urutan Tampilan</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" required
                        class="w-full bg-gray-50/50 border-gray-200 rounded-xl py-4 px-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all shadow-sm">
                    <p class="text-[10px] text-gray-400 font-semibold uppercase tracking-wider mt-2 px-1">Gunakan angka lebih kecil untuk posisi atas.</p>
                </div>
            </div>

            {{-- Visibility Status --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] p-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl shadow-inner border border-emerald-50">
                            <i class="ti ti-eye"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-900 leading-none tracking-tight">Visibility</h4>
                            <p class="text-[10px] text-gray-400 font-semibold mt-1 uppercase tracking-wider">Status Publikasi</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                        <div class="w-12 h-6.5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[3px] after:left-[3px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-600 transition-all shadow-sm"></div>
                    </label>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
