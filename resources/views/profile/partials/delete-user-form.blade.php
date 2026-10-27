<section>
    <div class="flex items-center gap-2.5 pb-4 border-b border-gray-100">
        <div class="w-8 h-8 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-base shrink-0">
            <i class="ti ti-trash"></i>
        </div>
        <div>
            <h4 class="text-sm font-bold text-gray-900 leading-tight">Hapus Akun Pengguna</h4>
            <p class="text-xs text-gray-500 mt-0.5">Tindakan permanen. Data akun dan histori lisensi akan dihapus selamanya.</p>
        </div>
    </div>

    <div class="mt-5 space-y-4" x-data="{ confirmModal: false }">
        <p class="text-xs text-gray-600 leading-relaxed font-normal">
            Setelah akun Anda dihapus, semua sumber daya dan data di dalamnya akan dihapus secara permanen. Pastikan Anda telah mengunduh data penting sebelum melanjutkan.
        </p>

        <button type="button" 
                @click="confirmModal = true" 
                class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 text-xs font-semibold transition-colors cursor-pointer">
            <i class="ti ti-alert-triangle text-sm"></i>
            <span>Hapus Akun Saya</span>
        </button>

        <!-- Confirmation Modal -->
        <div x-show="confirmModal" 
             x-cloak 
             class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4">
            <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs transition-opacity" @click="confirmModal = false"></div>

            <div class="relative bg-white rounded-2xl max-w-md w-full p-6 shadow-xl border border-gray-100 space-y-4 z-10">
                <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-2xl mx-auto">
                    <i class="ti ti-alert-triangle"></i>
                </div>

                <div class="text-center space-y-1.5">
                    <h3 class="text-base font-bold text-gray-900">Apakah Anda Yakin Ingin Menghapus Akun?</h3>
                    <p class="text-xs text-gray-500 leading-relaxed font-normal">
                        Masukkan kata sandi akun Anda untuk mengonfirmasi bahwa Anda benar-benar ingin menghapus akun ini secara permanen.
                    </p>
                </div>

                <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4">
                    @csrf
                    @method('delete')

                    <div>
                        <input id="password" name="password" type="password" 
                               class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 text-xs sm:text-sm text-gray-900 transition-all" 
                               placeholder="Masukkan kata sandi Anda..." required />
                        @if($errors->userDeletion->has('password'))
                            <p class="mt-1 text-xs text-rose-600 font-medium">{{ $errors->userDeletion->first('password') }}</p>
                        @endif
                    </div>

                    <div class="grid grid-cols-2 gap-3 pt-2">
                        <button type="button" 
                                @click="confirmModal = false" 
                                class="py-2.5 px-4 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold text-center transition-colors cursor-pointer">
                            Batal
                        </button>
                        <button type="submit" 
                                class="py-2.5 px-4 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold text-center shadow-xs transition-colors cursor-pointer">
                            Ya, Hapus Akun
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
