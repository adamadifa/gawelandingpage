<x-guest-layout :settings="$settings">
    <!-- Left Side: Visual & Branding (Hidden on mobile) -->
    <div class="relative hidden w-0 flex-1 lg:block h-full overflow-hidden">
        <div class="absolute inset-0 h-full w-full bg-brand-950">
            <!-- Background Decoration -->
            <div class="absolute inset-0 bg-gradient-to-br from-brand-600/20 to-transparent"></div>
            <div class="absolute -top-24 -left-24 h-96 w-96 rounded-full bg-brand-500/10 blur-3xl"></div>
            <div class="absolute -bottom-24 -right-24 h-96 w-96 rounded-full bg-brand-400/10 blur-3xl"></div>
            
            <div class="relative flex h-full flex-col justify-center px-12 text-white">
                <div class="mb-6">
                    <a href="/" class="flex items-center gap-3">
                        @if(isset($settings['brand_logo']) && $settings['brand_logo'])
                            <img src="{{ asset('storage/' . $settings['brand_logo']) }}" alt="{{ $settings['brand_name'] ?? 'Logo' }}" class="h-10 w-auto object-contain">
                        @else
                            <x-application-logo class="h-10 w-auto fill-current text-brand-400" />
                        @endif
                        <span class="font-display text-2xl font-bold tracking-tight">{{ $settings['brand_name'] ?? 'PresensiGPS' }}</span>
                    </a>
                </div>
                
                <h1 class="font-display text-4xl font-bold leading-tight mb-4 animate-fade-in-up">
                    {{ $settings['tagline'] ?? 'Solusi Absensi & Payroll Modern' }}
                </h1>
                
                <p class="text-lg text-brand-100/80 max-w-lg mb-8 animate-fade-in-up" style="animation-delay: 200ms">
                    Kelola kehadiran karyawan, penggajian, dan administrasi HR dalam satu platform yang terintegrasi dan mudah digunakan.
                </p>
                
                <div class="grid grid-cols-2 gap-4 animate-fade-in-up" style="animation-delay: 400ms">
                    <div class="bg-white/5 p-4 rounded-xl backdrop-blur-sm border border-white/10">
                        <div class="text-brand-400 font-bold text-xl mb-1">99.9%</div>
                        <div class="text-xs text-brand-200">Uptime Reliability</div>
                    </div>
                    <div class="bg-white/5 p-4 rounded-xl backdrop-blur-sm border border-white/10">
                        <div class="text-brand-400 font-bold text-xl mb-1">10k+</div>
                        <div class="text-xs text-brand-200">Active Users</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side: Login Form -->
    <div class="flex flex-1 flex-col justify-center px-4 py-8 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-slate-50/50 h-full overflow-y-auto">
        <div class="mx-auto w-full max-w-sm lg:w-96">
            <div class="lg:hidden mb-8 flex justify-center">
                <a href="/" class="flex flex-col items-center gap-2">
                    @if(isset($settings['brand_logo']) && $settings['brand_logo'])
                        <img src="{{ asset('storage/' . $settings['brand_logo']) }}" alt="{{ $settings['brand_name'] ?? 'Logo' }}" class="h-12 w-auto object-contain">
                    @else
                        <x-application-logo class="h-10 w-auto fill-current text-brand-600" />
                    @endif
                    <span class="font-display text-2xl font-bold text-slate-900">{{ $settings['brand_name'] ?? 'PresensiGPS' }}</span>
                </a>
            </div>

            <div class="mb-8 text-center lg:text-left">
                <h2 class="font-display text-2xl font-bold tracking-tight text-slate-900">Selamat datang kembali</h2>
                <p class="mt-1 text-sm text-slate-600">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="font-semibold text-brand-600 hover:text-brand-500 transition-colors">Daftar sekarang</a>
                </p>
            </div>

            <div>
                <!-- Social Logins -->
                <div class="grid grid-cols-2 gap-3">
                    <a href="#" class="flex w-full items-center justify-center gap-2.5 rounded-xl bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-200 hover:bg-slate-50 transition-all group">
                        <svg class="h-5 w-5 transition-transform group-hover:scale-110" viewBox="0 0 24 24">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        <span class="text-sm">Google</span>
                    </a>

                    <a href="#" class="flex w-full items-center justify-center gap-2.5 rounded-xl bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-200 hover:bg-slate-50 transition-all group">
                        <svg class="h-5 w-5 fill-slate-900 transition-transform group-hover:scale-110" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm">GitHub</span>
                    </a>
                </div>

                <div class="relative mt-6">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-slate-200"></div>
                    </div>
                    <div class="relative flex justify-center text-xs font-medium leading-6">
                        <span class="bg-slate-50 px-4 text-slate-400 uppercase tracking-widest text-[9px]">Atau dengan email</span>
                    </div>
                </div>

                <div class="mt-6">
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-4">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-sm font-semibold leading-6 text-slate-900">Alamat Email</label>
                            <div class="mt-1.5">
                                <input id="email" 
                                    name="email" 
                                    type="email" 
                                    autocomplete="email" 
                                    required 
                                    autofocus
                                    value="{{ old('email') }}"
                                    class="block w-full rounded-xl border-0 py-2.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-brand-600 sm:text-sm sm:leading-6 transition-all"
                                    placeholder="nama@perusahaan.com">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
                        </div>

                        <!-- Password -->
                        <div>
                            <div class="flex items-center justify-between">
                                <label for="password" class="block text-sm font-semibold leading-6 text-slate-900">Kata Sandi</label>
                                @if (Route::has('password.request'))
                                    <div class="text-xs">
                                        <a href="{{ route('password.request') }}" class="font-semibold text-brand-600 hover:text-brand-500 transition-all">Lupa?</a>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-1.5">
                                <input id="password" 
                                    name="password" 
                                    type="password" 
                                    autocomplete="current-password" 
                                    required 
                                    class="block w-full rounded-xl border-0 py-2.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-brand-600 sm:text-sm sm:leading-6 transition-all"
                                    placeholder="••••••••">
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-brand-600 focus:ring-brand-600 transition-all">
                                <label for="remember_me" class="ml-2.5 block text-sm leading-6 text-slate-700 font-medium">Ingat saya</label>
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="flex w-full justify-center rounded-xl bg-brand-600 px-3 py-3 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-brand-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600 transition-all hover:scale-[1.01] active:scale-[0.98]">
                                Masuk ke Akun
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
