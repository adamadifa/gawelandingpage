<section>
    <div class="flex items-center gap-2.5 pb-4 border-b border-gray-100">
        <div class="w-8 h-8 rounded-xl bg-gray-100 text-gray-600 flex items-center justify-center text-base shrink-0">
            <i class="ti ti-key"></i>
        </div>
        <div>
            <h4 class="text-sm font-bold text-gray-900 leading-tight">Keamanan Kata Sandi</h4>
            <p class="text-xs text-gray-500 mt-0.5">Pastikan akun Anda menggunakan kata sandi yang kuat dan aman.</p>
        </div>
    </div>

    <form method="post" action="{{ route('password.update') }}" class="mt-5 space-y-4">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-xs font-semibold text-gray-700 mb-1.5">Kata Sandi Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" 
                   class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] text-xs sm:text-sm text-gray-900 transition-all" 
                   autocomplete="current-password" />
            @if($errors->updatePassword->has('current_password'))
                <p class="mt-1 text-xs text-rose-600 font-medium">{{ $errors->updatePassword->first('current_password') }}</p>
            @endif
        </div>

        <div>
            <label for="update_password_password" class="block text-xs font-semibold text-gray-700 mb-1.5">Kata Sandi Baru</label>
            <input id="update_password_password" name="password" type="password" 
                   class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] text-xs sm:text-sm text-gray-900 transition-all" 
                   autocomplete="new-password" />
            @if($errors->updatePassword->has('password'))
                <p class="mt-1 text-xs text-rose-600 font-medium">{{ $errors->updatePassword->first('password') }}</p>
            @endif
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-xs font-semibold text-gray-700 mb-1.5">Konfirmasi Kata Sandi Baru</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                   class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] text-xs sm:text-sm text-gray-900 transition-all" 
                   autocomplete="new-password" />
            @if($errors->updatePassword->has('password_confirmation'))
                <p class="mt-1 text-xs text-rose-600 font-medium">{{ $errors->updatePassword->first('password_confirmation') }}</p>
            @endif
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" 
                    class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-semibold shadow-2xs transition-all cursor-pointer">
                <i class="ti ti-lock-check text-sm"></i>
                <span>Perbarui Kata Sandi</span>
            </button>

            @if (session('status') === 'password-updated')
                <span x-data="{ show: true }"
                      x-show="show"
                      x-transition
                      x-init="setTimeout(() => show = false, 3000)"
                      class="text-xs font-medium text-emerald-600 flex items-center gap-1">
                    <i class="ti ti-circle-check"></i>
                    <span>Kata sandi berhasil diperbarui</span>
                </span>
            @endif
        </div>
    </form>
</section>
