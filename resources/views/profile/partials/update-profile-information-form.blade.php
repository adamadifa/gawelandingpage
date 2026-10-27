<section>
    <div class="flex items-center gap-2.5 pb-4 border-b border-gray-100">
        <div class="w-8 h-8 rounded-xl bg-gray-100 text-gray-600 flex items-center justify-center text-base shrink-0">
            <i class="ti ti-user"></i>
        </div>
        <div>
            <h4 class="text-sm font-bold text-gray-900 leading-tight">Informasi Akun</h4>
            <p class="text-xs text-gray-500 mt-0.5">Perbarui nama tampilan dan alamat email akun Anda.</p>
        </div>
    </div>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-5 space-y-4">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-xs font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
            <input id="name" name="name" type="text" 
                   class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] text-xs sm:text-sm text-gray-900 transition-all" 
                   value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @if($errors->has('name'))
                <p class="mt-1 text-xs text-rose-600 font-medium">{{ $errors->first('name') }}</p>
            @endif
        </div>

        <div>
            <label for="email" class="block text-xs font-semibold text-gray-700 mb-1.5">Alamat Email</label>
            <input id="email" name="email" type="email" 
                   class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] text-xs sm:text-sm text-gray-900 transition-all" 
                   value="{{ old('email', $user->email) }}" required autocomplete="username" />
            @if($errors->has('email'))
                <p class="mt-1 text-xs text-rose-600 font-medium">{{ $errors->first('email') }}</p>
            @endif

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 p-3 rounded-xl bg-amber-50 border border-amber-200 text-xs text-amber-900 flex items-center justify-between gap-3">
                    <span>Email Anda belum diverifikasi.</span>
                    <button form="send-verification" class="text-xs font-semibold text-[#007A87] hover:underline cursor-pointer">
                        Kirim Ulang Verifikasi
                    </button>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-xs font-medium text-emerald-600">
                        Tautan verifikasi baru telah dikirim ke alamat email Anda.
                    </p>
                @endif
            @endif
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" 
                    class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-semibold shadow-2xs transition-all cursor-pointer">
                <i class="ti ti-check text-sm"></i>
                <span>Simpan Perubahan</span>
            </button>

            @if (session('status') === 'profile-updated')
                <span x-data="{ show: true }"
                      x-show="show"
                      x-transition
                      x-init="setTimeout(() => show = false, 3000)"
                      class="text-xs font-medium text-emerald-600 flex items-center gap-1">
                    <i class="ti ti-circle-check"></i>
                    <span>Berhasil disimpan</span>
                </span>
            @endif
        </div>
    </form>
</section>
