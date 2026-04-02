@extends('layouts.admin')

@section('title', 'FAQ — Edit Pertanyaan')

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
                <a href="{{ route('admin.faqs.index') }}" class="hover:text-indigo-600 transition-colors uppercase tracking-widest">Daftar Pertanyaan</a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <span class="text-indigo-600 font-bold uppercase tracking-widest">Edit Item</span>
            </nav>
            <h1 class="text-3xl font-display font-black text-gray-900 leading-tight">Perbarui Item FAQ</h1>
            <p class="text-sm text-gray-500 font-medium">Sesuaikan detail pertanyaan dan jawaban untuk memberikan informasi terbaik bagi pengguna.</p>
        </div>
        <div class="flex items-center gap-3">
             <a href="{{ route('admin.faqs.index') }}" class="px-5 py-2.5 text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">Batal</a>
             <button type="submit" form="faq-item-edit-form" class="inline-flex items-center gap-2 px-7 py-3.5 bg-indigo-600 text-white rounded-2xl font-bold text-sm shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 active:scale-95 transition-all">
                <i class="ti ti-device-floppy text-lg"></i>
                Simpan Perubahan
            </button>
        </div>
    </div>

    <form id="faq-item-edit-form" action="{{ route('admin.faqs.update', $faq->id) }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        @csrf
        @method('PUT')

        {{-- Left: Question & Answer Content --}}
        <div class="lg:col-span-8 space-y-8">
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-8">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-indigo-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-indigo-50">
                        <i class="ti ti-help"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none">Konten Q&A</h3>
                        <p class="text-[12px] text-gray-400 font-bold mt-1.5 uppercase tracking-wider">Pertanyaan & Jawaban</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 px-1">Pertanyaan</label>
                        <input type="text" name="question" value="{{ old('question', $faq->question) }}" required placeholder="Contoh: Apakah aplikasi ini gratis?"
                            class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-4 px-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all placeholder:text-gray-300">
                    </div>

                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 px-1">Jawaban Lengkap</label>
                        <textarea name="answer" rows="8" required placeholder="Berikan penjelasan yang detail dan mudah dipahami..."
                            class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-4 px-6 text-gray-900 font-medium focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all placeholder:text-gray-300 leading-relaxed">{{ old('answer', $faq->answer) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Settings & Visibility --}}
        <div class="lg:col-span-4 space-y-8">
            {{-- Organization Card --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-black/[0.02] p-8 lg:p-10 space-y-8">
                <div class="flex items-center gap-4 border-b border-gray-50 pb-6 mb-8">
                    <div class="w-12 h-12 bg-gray-50 text-indigo-600 rounded-xl flex items-center justify-center text-2xl shadow-inner border border-indigo-50">
                        <i class="ti ti-sort-ascending-numbers"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none">Pengaturan</h3>
                        <p class="text-[12px] text-gray-400 font-bold mt-1.5 uppercase tracking-wider">Urutan & Prioritas</p>
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="block text-sm font-bold text-gray-700 px-1">Urutan Tampilan</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $faq->sort_order) }}" required
                        class="w-full bg-gray-50/50 border-gray-200 rounded-[1.25rem] py-4 px-6 text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all">
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mt-2 px-1">Gunakan angka lebih kecil untuk posisi atas.</p>
                </div>
            </div>

            {{-- Visibility Status --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-black/[0.02] p-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl shadow-inner">
                            <i class="ti ti-eye"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-black text-gray-900 leading-none">Visibility</h4>
                            <p class="text-[10px] text-gray-400 font-bold mt-1 uppercase tracking-wider">Status Publikasi</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ $faq->is_active ? 'checked' : '' }}>
                        <div class="w-12 h-6.5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[3px] after:left-[3px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600 transition-all"></div>
                    </label>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
