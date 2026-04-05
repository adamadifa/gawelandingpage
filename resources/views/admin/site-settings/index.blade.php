@extends('layouts.admin')

@section('title', 'Site Settings — Konfigurasi')

@section('breadcrumbs')
<nav class="flex items-center gap-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest mb-1 font-poppins">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-brand-600 transition-colors">Dashboard</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <span class="text-brand-600 font-semibold tracking-widest">Site Settings</span>
</nav>
@endsection

@section('actions')
@endsection

@section('content')
<div class="w-full -mt-6 space-y-6 pb-20 font-poppins text-inter">

    {{-- Individual Settings List --}}
    <div class="max-w-4xl space-y-4">
        @foreach($site_configs as $setting)
        <div class="bg-white rounded-xl border border-emerald-100/50 shadow-sm shadow-emerald-600/5 p-6 hover:shadow-xl hover:shadow-brand-600/5 hover:border-brand-200 transition-all duration-500">
            <form action="{{ route('admin.site-settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="flex flex-col lg:flex-row lg:items-start justify-between gap-8">
                    <div class="flex-1 space-y-3">
                        {{-- Label & Description --}}
                        <div>
                            <label class="text-[9px] font-bold text-emerald-600/60 uppercase tracking-[0.2em] px-0.5 leading-none">{{ str_replace('_', ' ', $setting->key) }}</label>
                            <h4 class="text-[13px] font-bold text-gray-900 mt-1 uppercase tracking-tight">Konfigurasi {{ ucwords(str_replace('_', ' ', $setting->key)) }}</h4>
                        </div>

                        {{-- Input Fields --}}
                        @if($setting->type == 'image')
                            <div class="relative group max-w-sm">
                                <input type="file" name="image_value" id="input-{{ $setting->key }}" accept="image/*" class="hidden" onchange="previewSettingImage(this, 'preview-{{ $setting->key }}')">
                                <label for="input-{{ $setting->key }}" class="block w-full cursor-pointer group/label">
                                    <div id="preview-{{ $setting->key }}" class="w-full min-h-[100px] bg-gray-50/50 border-2 border-dashed border-gray-100 rounded-xl flex flex-col items-center justify-center p-4 group-hover/label:bg-white group-hover/label:border-brand-400 transition-all duration-500">
                                        @if($setting->value)
                                            <div class="relative w-full max-w-[100px] group/image">
                                                <img src="{{ asset('storage/' . $setting->value) }}" class="max-w-full max-h-[60px] object-contain mx-auto rounded-lg">
                                                <div class="absolute inset-0 bg-brand-900/40 opacity-0 group-hover/image:opacity-100 flex items-center justify-center rounded-lg backdrop-blur-sm transition-all duration-500">
                                                    <i class="ti ti-camera text-white text-base"></i>
                                                </div>
                                            </div>
                                        @else
                                            <div class="w-9 h-9 bg-white rounded-xl shadow-md border border-gray-100 flex items-center justify-center mb-2 group-hover/label:scale-110 transition-transform duration-500">
                                                <i class="ti ti-upload text-lg text-brand-500"></i>
                                            </div>
                                            <p class="text-[8px] text-gray-400 font-bold uppercase tracking-widest leading-none text-center">Update Base Image</p>
                                        @endif
                                    </div>
                                </label>
                            </div>
                        @elseif($setting->type == 'textarea')
                            <textarea name="value" rows="2" required class="w-full bg-gray-50/30 border-gray-100 rounded-xl py-3 px-5 text-gray-900 font-bold text-[13px] focus:bg-white focus:ring-4 focus:ring-brand-500/10 focus:border-brand-600 transition-all shadow-sm placeholder:text-gray-300">{{ $setting->value }}</textarea>
                        @else
                            <input type="text" name="value" value="{{ $setting->value }}" required 
                                class="w-full bg-gray-50/30 border-gray-100 rounded-xl py-3 px-5 text-gray-900 font-bold text-[13px] focus:bg-white focus:ring-4 focus:ring-brand-500/10 focus:border-brand-600 transition-all shadow-sm">
                        @endif
                    </div>

                    {{-- Action Button --}}
                    <div class="shrink-0 lg:pt-5">
                        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-brand-600 text-white rounded-xl font-bold text-[10px] uppercase tracking-widest shadow-lg shadow-brand-600/20 hover:bg-brand-700 active:scale-95 transition-all">
                            <i class="ti ti-device-floppy text-base"></i>
                            <span>Update</span>
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
                        <img src="${e.target.result}" class="max-w-full max-h-[100px] object-contain mx-auto rounded-lg shadow-xl shadow-brand-600/10 border border-gray-100 bg-white p-1">
                        <div class="absolute inset-0 bg-brand-900/60 opacity-0 group-hover/preview:opacity-100 flex items-center justify-center rounded-lg backdrop-blur-sm transition-all duration-500">
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
