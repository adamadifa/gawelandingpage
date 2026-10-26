@extends('layouts.admin')

@section('title', 'Tambah Pertanyaan FAQ')

@section('breadcrumbs')
<nav class="flex items-center gap-1.5 text-xs text-gray-400 font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#007A87] transition-colors flex items-center gap-1">
        <i class="ti ti-home"></i>
        <span>Dashboard</span>
    </a>
    <i class="ti ti-chevron-right text-[10px]"></i>
    <a href="{{ route('admin.faqs.index') }}" class="hover:text-[#007A87] transition-colors">FAQ</a>
    <i class="ti ti-chevron-right text-[10px]"></i>
    <span class="text-gray-700 font-bold">Tambah Pertanyaan</span>
</nav>
@endsection

@section('actions')
<div class="flex items-center gap-2.5">
    <a href="{{ route('admin.faqs.index') }}" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 hover:border-gray-300 text-gray-600 text-xs font-bold transition-all shadow-2xs">
        <i class="ti ti-arrow-left text-sm"></i>
        <span>Kembali</span>
    </a>

    <button type="submit" 
            form="faq-item-create-form" 
            class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
        <i class="ti ti-device-floppy text-sm"></i>
        <span>Simpan FAQ</span>
    </button>
</div>
@endsection

@section('content')
<div class="space-y-6" x-data="{
    question: '{{ old('question', '') }}',
    answer: '{{ old('answer', '') }}',
    sort_order: '{{ old('sort_order', 0) }}',
    isOpen: true
}">

    @if ($errors->any())
        <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs">
            <div class="flex items-center gap-2 font-bold mb-1">
                <i class="ti ti-alert-triangle text-base"></i>
                <span>Terdapat kesalahan pada formulir:</span>
            </div>
            <ul class="list-disc pl-5 space-y-0.5 text-rose-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="faq-item-create-form" 
          action="{{ route('admin.faqs.store') }}" 
          method="POST" 
          class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        @csrf

        <!-- Left Column: Q&A Content (7 Cols) -->
        <div class="lg:col-span-7 space-y-5">
            
            <div class="card-clean p-5 lg:p-6 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-help text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Konten Pertanyaan & Jawaban</h3>
                        <p class="text-[11px] text-gray-400">Tuliskan pertanyaan umum dan jawaban penjelasan yang jelas</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label for="question" class="block text-xs font-bold text-gray-700 mb-1">
                            Pertanyaan <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" 
                               name="question" 
                               id="question" 
                               x-model="question"
                               required 
                               placeholder="Contoh: Apakah aplikasi mendukung presensi multi-cabang?"
                               class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-900 font-bold focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                    </div>

                    <div>
                        <label for="answer" class="block text-xs font-bold text-gray-700 mb-1">
                            Jawaban Lengkap <span class="text-rose-500">*</span>
                        </label>
                        <textarea name="answer" 
                                  id="answer" 
                                  rows="8" 
                                  x-model="answer"
                                  required 
                                  placeholder="Jelaskan solusi secara rinci, terstruktur, dan mudah dipahami oleh calon pelanggan..."
                                  class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 px-3 text-xs text-gray-800 font-medium leading-relaxed focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">{{ old('answer') }}</textarea>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column: Settings & Live Preview (5 Cols) -->
        <div class="lg:col-span-5 space-y-5 lg:sticky lg:top-24">
            
            <!-- Card 2: Pengaturan & Urutan -->
            <div class="card-clean p-5 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-adjustments text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-xs font-bold text-[#0F172A]">Pengaturan Tampilan</h3>
                        <p class="text-[11px] text-gray-400">Urutan dan status visibilitas pertanyaan</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label for="sort_order" class="block text-xs font-bold text-gray-700 mb-1">
                            Nomor Urutan Tampilan
                        </label>
                        <input type="number" 
                               name="sort_order" 
                               id="sort_order" 
                               x-model="sort_order"
                               required
                               class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs text-gray-800 font-semibold focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                        <p class="text-[10px] text-gray-400 mt-1">Angka lebih kecil tampil di urutan atas accordion FAQ.</p>
                    </div>

                    <div class="pt-3 border-t border-gray-100 flex items-center justify-between">
                        <div>
                            <span class="block text-xs font-bold text-gray-800">Publikasikan Pertanyaan</span>
                            <span class="text-[10px] text-gray-400">Tampilkan pada landing page</span>
                        </div>
                        <input type="hidden" name="is_active" value="0">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                            <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#007A87]"></div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Card 3: Simulasi Pratinjau Accordion -->
            <div class="card-clean p-5 space-y-3">
                <div class="flex items-center gap-2 pb-2 border-b border-gray-100">
                    <div class="w-6 h-6 rounded-md bg-teal-50 text-[#007A87] flex items-center justify-center">
                        <i class="ti ti-eye text-xs"></i>
                    </div>
                    <h3 class="text-xs font-bold text-[#0F172A]">Simulasi Accordion FAQ</h3>
                </div>

                <div class="border border-gray-200 rounded-xl overflow-hidden bg-white shadow-2xs">
                    <button type="button" 
                            @click="isOpen = !isOpen"
                            class="w-full p-3.5 flex items-center justify-between text-left bg-slate-50/70 hover:bg-slate-100/70 transition-colors">
                        <span class="text-xs font-bold text-gray-900 leading-snug" x-text="question || 'Judul Pertanyaan Pengguna?'"></span>
                        <div class="w-5 h-5 rounded-md bg-white border border-gray-200 flex items-center justify-center text-gray-400 shrink-0 ml-2">
                            <i class="ti transition-transform duration-200 text-xs" :class="isOpen ? 'ti-minus' : 'ti-plus'"></i>
                        </div>
                    </button>
                    
                    <div x-show="isOpen" 
                         x-collapse
                         class="p-3.5 text-xs text-gray-600 bg-white border-t border-gray-100 leading-relaxed font-normal" 
                         x-text="answer || 'Penjelasan lengkap dan solusi jawaban akan muncul di area accordion ini saat pengguna mengklik pertanyaan...'">
                    </div>
                </div>
            </div>

        </div>

    </form>

</div>
@endsection
