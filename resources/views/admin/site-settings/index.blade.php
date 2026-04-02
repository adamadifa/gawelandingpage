@extends('layouts.admin')

@section('title', 'Site Settings — Konfigurasi')

@section('content')
<div class="w-full space-y-8 pb-20 text-inter font-poppins">
    
    {{-- Page Header --}}
    <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-100">
        <div>
            <nav class="flex items-center gap-2 text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600 transition-colors uppercase tracking-widest">Dashboard</a>
                <i class="ti ti-chevron-right text-[8px]"></i>
                <span class="text-indigo-600 font-bold uppercase tracking-widest">Site Settings</span>
            </nav>
            <h1 class="text-3xl font-display font-black text-gray-900 leading-tight">Pengaturan Situs</h1>
            <p class="text-sm text-gray-500 font-medium">Lakukan penyesuaian cepat untuk setiap entitas konfigurasi website Anda.</p>
        </div>
    </div>

    {{-- Individual Settings List --}}
    <div class="max-w-4xl space-y-6">
        @foreach($settings as $setting)
        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-black/[0.01] p-8 hover:shadow-indigo-600/5 hover:border-indigo-100 transition-all duration-500">
            <form action="{{ route('admin.site-settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="flex flex-col lg:flex-row lg:items-start justify-between gap-8">
                    <div class="flex-1 space-y-4">
                        {{-- Label & Description --}}
                        <div>
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-1">{{ str_replace('_', ' ', $setting->key) }}</label>
                            <h4 class="text-sm font-bold text-gray-900 mt-1 uppercase tracking-widest">Konfigurasi {{ str_replace('_', ' ', $setting->key) }}</h4>
                        </div>

                        {{-- Input Fields --}}
                        @if($setting->type == 'image')
                            <div class="relative group max-w-md">
                                <input type="file" name="image_value" id="input-{{ $setting->key }}" accept="image/*" class="hidden" onchange="previewSettingImage(this, 'preview-{{ $setting->key }}')">
                                <label for="input-{{ $setting->key }}" class="block w-full cursor-pointer group/label">
                                    <div id="preview-{{ $setting->key }}" class="w-full min-h-[160px] bg-gray-50/50 border border-dashed border-gray-200 rounded-[1.5rem] flex flex-col items-center justify-center p-6 group-hover/label:bg-white group-hover/label:border-indigo-400 transition-all duration-500">
                                        @if($setting->value)
                                            <div class="relative w-full max-w-[140px] group/image">
                                                <img src="{{ asset('storage/' . $setting->value) }}" class="max-w-full max-h-[100px] object-contain mx-auto rounded-lg">
                                                <div class="absolute inset-0 bg-indigo-900/40 opacity-0 group-hover/image:opacity-100 flex items-center justify-center rounded-lg backdrop-blur-sm transition-all duration-500">
                                                    <i class="ti ti-camera text-white text-xl"></i>
                                                </div>
                                            </div>
                                        @else
                                            <div class="w-12 h-12 bg-white rounded-xl shadow-lg border border-gray-100 flex items-center justify-center mb-3 group-hover/label:scale-110 transition-transform duration-500">
                                                <i class="ti ti-upload text-2xl text-indigo-500"></i>
                                            </div>
                                            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest leading-none text-center">Ganti Logo Aset</p>
                                        @endif
                                    </div>
                                </label>
                            </div>
                        @elseif($setting->type == 'textarea')
                            <textarea name="value" rows="3" required class="w-full bg-gray-50/50 border-gray-100 rounded-2xl py-4 px-6 text-gray-900 font-medium text-sm focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all">{{ $setting->value }}</textarea>
                        @else
                            <input type="text" name="value" value="{{ $setting->value }}" required 
                                class="w-full bg-gray-50/50 border-gray-100 rounded-2xl py-4 px-6 text-gray-900 font-bold text-sm focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all">
                        @endif
                    </div>

                    {{-- Action Button --}}
                    <div class="shrink-0 lg:pt-6">
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold text-xs uppercase tracking-widest shadow-lg shadow-indigo-600/10 hover:bg-indigo-700 active:scale-95 transition-all">
                            <i class="ti ti-device-floppy text-lg"></i>
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
        @endforeach
    </div>
</div>

@push('scripts')
<script>
    function previewSettingImage(input, containerId) {
        const container = document.getElementById(containerId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                container.innerHTML = `
                    <div class="relative w-full max-w-[140px] group/preview">
                        <img src="${e.target.result}" class="max-w-full max-h-[100px] object-contain mx-auto rounded-lg shadow-xl shadow-indigo-600/10 border border-gray-100">
                        <div class="absolute inset-0 bg-indigo-900/60 opacity-0 group-hover/preview:opacity-100 flex items-center justify-center rounded-lg backdrop-blur-sm transition-all duration-500">
                            <span class="text-white font-bold text-[8px] uppercase tracking-widest">Siap Simpan</span>
                        </div>
                    </div>
                `;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
@endsection
