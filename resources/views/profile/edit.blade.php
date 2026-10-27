@extends(auth()->user()->isAdmin() ? 'layouts.admin' : 'layouts.member')

@section('title', 'Profil Pengguna')
@section('subtitle', 'Kelola data pribadi, alamat email, dan kata sandi akun Anda.')

@section('actions')
<a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('member.dashboard') }}" 
   class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 text-xs font-semibold shadow-2xs transition-all">
    <i class="ti ti-arrow-left text-sm"></i>
    <span>Kembali ke Dashboard</span>
</a>
@endsection

@section('content')
<div class="space-y-6 max-w-4xl">
    
    <!-- Profile Hero Card -->
    <div class="bg-white border border-[#E2E8F0] rounded-2xl p-5 sm:p-6 shadow-2xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-5">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-teal-50 border border-teal-200 text-[#007A87] font-bold text-xl flex items-center justify-center shrink-0 uppercase shadow-2xs">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
            <div>
                <h3 class="text-base font-bold text-gray-900 leading-tight">{{ auth()->user()->name }}</h3>
                <p class="text-xs text-gray-500 mt-1">{{ auth()->user()->email }}</p>
                <div class="flex flex-wrap items-center gap-2 mt-2.5">
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-teal-50 border border-teal-200 text-[#007A87] text-[11px] font-semibold">
                        <i class="ti ti-shield-check text-xs"></i>
                        <span>{{ auth()->user()->isAdmin() ? 'Super Admin' : 'Member Terverifikasi' }}</span>
                    </span>
                    <span class="text-xs text-gray-400">
                        Bergabung sejak {{ auth()->user()->created_at->format('d M Y') }}
                    </span>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-2 text-xs text-gray-500 shrink-0">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 font-medium">
                <i class="ti ti-circle-check text-emerald-600 text-sm"></i>
                <span>Status Akun Aktif</span>
            </span>
        </div>
    </div>

    <!-- Forms Stack -->
    <div class="space-y-6">
        <div class="bg-white border border-[#E2E8F0] rounded-2xl p-5 sm:p-6 shadow-2xs">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="bg-white border border-[#E2E8F0] rounded-2xl p-5 sm:p-6 shadow-2xs">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="bg-white border border-[#E2E8F0] rounded-2xl p-5 sm:p-6 shadow-2xs">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>

</div>
@endsection
