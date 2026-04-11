<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('partials.seo')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .nav-blur {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        /* Water Ripple Animation */
        .ripple-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 600px;
            height: 600px;
            pointer-events: none;
        }

        .ripple {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            border: 2px solid rgba(22, 163, 74, 0.15);
            animation: rippleWave 4s ease-out infinite;
        }

        .ripple:nth-child(1) {
            animation-delay: 0s;
        }

        .ripple:nth-child(2) {
            animation-delay: 0.8s;
        }

        .ripple:nth-child(3) {
            animation-delay: 1.6s;
        }

        .ripple:nth-child(4) {
            animation-delay: 2.4s;
        }

        .ripple:nth-child(5) {
            animation-delay: 3.2s;
        }

        @keyframes rippleWave {
            0% {
                width: 100px;
                height: 100px;
                opacity: 0.6;
                border-width: 3px;
                border-color: rgba(22, 163, 74, 0.25);
            }

            50% {
                opacity: 0.3;
                border-color: rgba(22, 163, 74, 0.15);
            }

            100% {
                width: 600px;
                height: 600px;
                opacity: 0;
                border-width: 1px;
                border-color: rgba(22, 163, 74, 0.05);
            }
        }

        /* Phone image transparent blend */
        .hero-phone-img {
            mix-blend-mode: multiply;
        }

        /* Custom Scrollbar for Pricing Features */
        .features-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .features-scroll::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
            border-radius: 10px;
        }

        .features-scroll::-webkit-scrollbar-thumb {
            background: rgba(22, 163, 74, 0.2);
            border-radius: 10px;
        }

        .features-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(22, 163, 74, 0.4);
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased overflow-x-hidden bg-white">

    {{-- ========================================= --}}
    {{-- NAVBAR --}}
    {{-- ========================================= --}}
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 py-5">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between">
                {{-- Logo --}}
                <a href="/" class="flex items-center gap-3 group text-decoration-none">
                    <div
                        class="w-12 h-12 flex items-center justify-center transition-all duration-500 overflow-hidden group-hover:scale-105">
                        @if(isset($settings['brand_logo']) && $settings['brand_logo'])
                            <img src="{{ asset('storage/' . $settings['brand_logo']) }}"
                                alt="{{ $settings['brand_name'] ?? 'Logo' }}"
                                class="w-full h-full object-contain filter group-hover:brightness-110 transition-all duration-500">
                        @else
                            <div
                                class="w-full h-full bg-brand-600 rounded-[0.9rem] flex items-center justify-center shadow-inner">
                                <span
                                    class="text-white font-display font-black text-xl leading-none">{{ substr($settings['brand_name'] ?? 'P', 0, 1) }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="flex flex-col">
                        <span
                            class="font-display text-xl font-black tracking-tight leading-none group-hover:text-brand-700 transition-colors">
                            @if(isset($settings['brand_name']))
                                @php
                                    $words = explode(' ', $settings['brand_name']);
                                    $firstWord = $words[0] ?? '';
                                    $rest = implode(' ', array_slice($words, 1));
                                @endphp
                                <span class="text-brand-700">{{ $firstWord }}</span><span
                                    class="text-gray-900">{{ $rest }}</span>
                            @else
                                <span class="text-brand-700">Presensi</span><span class="text-gray-900">GPS</span>
                            @endif
                        </span>
                        @if(isset($settings['tagline']))
                            <span
                                class="text-[9px] font-black text-gray-400 uppercase tracking-[0.15em] mt-1">{{ $settings['tagline'] }}</span>
                        @endif
                    </div>
                </a>

                {{-- Nav Links --}}
                <div class="hidden md:flex items-center gap-8">
                    <a href="#features"
                        class="text-[15px] font-medium text-gray-600 hover:text-brand-700 transition-colors duration-300">Fitur</a>
                    <a href="#pricing"
                        class="text-[15px] font-medium text-gray-600 hover:text-brand-700 transition-colors duration-300">Harga</a>
                    <a href="#faq"
                        class="text-[15px] font-medium text-gray-600 hover:text-brand-700 transition-colors duration-300">FAQ</a>
                    <a href="#contact"
                        class="text-[15px] font-medium text-gray-600 hover:text-brand-700 transition-colors duration-300">Kontak</a>
                </div>

                @auth
                    <div class="hidden md:flex items-center gap-4">
                        <a href="{{ route('member.dashboard') }}"
                            class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-700 text-white font-semibold text-sm px-6 py-3 rounded-full shadow-lg shadow-brand-600/25 hover:shadow-brand-600/40 transition-all duration-300 hover:-translate-y-0.5">
                            <i class="ti ti-layout-dashboard text-lg"></i>
                            Member Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="text-xs font-bold text-gray-400 hover:text-rose-500 transition-colors uppercase tracking-widest">Logout</button>
                        </form>
                    </div>
                @else
                    <div class="hidden md:flex items-center gap-6">
                        <a href="{{ route('login') }}"
                            class="text-[15px] font-bold text-gray-900 hover:text-brand-700 transition-colors">Login</a>
                        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}"
                            class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-700 text-white font-semibold text-sm px-6 py-3 rounded-full shadow-lg shadow-brand-600/25 hover:shadow-brand-600/40 transition-all duration-300 hover:-translate-y-0.5">
                            Hubungi Kami
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                @endauth

                {{-- Mobile Menu Button --}}
                <button id="mobile-menu-btn" class="md:hidden p-2 text-gray-600 hover:text-brand-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    {{-- ========================================= --}}
    {{-- HERO SECTION --}}
    {{-- ========================================= --}}
    <section
        class="relative min-h-screen flex items-center pt-28 pb-16 lg:pt-0 lg:pb-0 bg-gradient-to-br from-white via-brand-50/40 to-brand-100/30">

        {{-- Decorative Elements --}}

        {{-- Sparkle decorations --}}
        <div class="absolute top-32 left-12 text-brand-300/40 animate-pulse-soft">
            <svg class="w-10 h-10" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 0L14.59 8.41L23 11L14.59 13.59L12 22L9.41 13.59L1 11L9.41 8.41L12 0Z" />
            </svg>
        </div>
        <div class="absolute bottom-40 left-1/2 text-brand-200/30 animate-pulse-soft" style="animation-delay: 1.5s;">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 0L14.59 8.41L23 11L14.59 13.59L12 22L9.41 13.59L1 11L9.41 8.41L12 0Z" />
            </svg>
        </div>
        <div class="absolute top-60 right-20 text-gray-300/50 animate-pulse-soft" style="animation-delay: 0.8s;">
            <svg class="w-8 h-8" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 0L14.59 8.41L23 11L14.59 13.59L12 22L9.41 13.59L1 11L9.41 8.41L12 0Z" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 w-full">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-8 items-center">

                {{-- Left: Text Content --}}
                <div class="relative z-10 animate-fade-in-up">
                    {{-- News Badge --}}
                    <div
                        class="inline-flex items-center gap-2 bg-white/80 border border-brand-200/60 rounded-full pl-1 pr-4 py-1 mb-8 shadow-sm backdrop-blur-sm">
                        <span class="bg-brand-100 text-brand-700 text-xs font-bold px-3 py-1 rounded-full">Baru!</span>
                        <span class="text-brand-600 text-sm font-medium">Demo Gratis 7 Hari</span>
                        <span class="text-lg">👋</span>
                    </div>

                    {{-- Headline --}}
                    <h1
                        class="font-display text-[42px] lg:text-[56px] leading-[1.08] font-extrabold text-gray-900 mb-6 tracking-tight">
                        {{ $hero->headline ?? 'Kelola Absensi & Payroll Lebih Efisien.' }}
                    </h1>

                    {{-- Sub-headline --}}
                    <p class="text-lg lg:text-xl text-gray-500 leading-relaxed mb-10 max-w-lg">
                        {{ $hero->sub_headline ?? 'Solusi satu pintu untuk Presensi GPS Geofencing, Penggajian Otomatis, dan Manajemen Pinjaman Karyawan tanpa ribet.' }}
                    </p>

                    {{-- CTA Buttons --}}
                    <div class="flex flex-wrap items-center gap-4 mb-12">
                        <a href="{{ $hero->cta_url ?? '#' }}"
                            class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-700 text-white font-semibold px-8 py-4 rounded-full shadow-xl shadow-brand-600/25 hover:shadow-brand-600/40 transition-all duration-300 hover:-translate-y-0.5 text-[15px]">
                            {{ $hero->cta_text ?? 'Coba Sekarang Gratis' }}
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="{{ $hero->cta_secondary_url ?? '#' }}"
                            class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 text-gray-700 font-semibold px-8 py-4 rounded-full border border-gray-200 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 text-[15px]">
                            {{ $hero->cta_secondary_text ?? 'Pelajari Lebih Lanjut' }}
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>

                    {{-- Social Proof Stats --}}
                    <div class="flex items-center gap-6">
                        {{-- Avatars Stack --}}
                        <div class="flex -space-x-3">
                            <div
                                class="w-10 h-10 rounded-full bg-brand-200 border-2 border-white flex items-center justify-center text-xs font-bold text-brand-800">
                                A</div>
                            <div
                                class="w-10 h-10 rounded-full bg-brand-200 border-2 border-white flex items-center justify-center text-xs font-bold text-brand-800">
                                B</div>
                            <div
                                class="w-10 h-10 rounded-full bg-teal-200 border-2 border-white flex items-center justify-center text-xs font-bold text-teal-800">
                                C</div>
                        </div>
                        <div>
                            <p class="text-lg font-bold text-gray-800">2,500+</p>
                            <p class="text-sm text-gray-500">Karyawan Terdaftar</p>
                        </div>
                        <div class="w-px h-10 bg-gray-200"></div>
                        <div>
                            <p class="text-lg font-bold text-gray-800">4.9/5</p>
                            <div class="flex items-center gap-0.5">
                                @for($i = 0; $i < 5; $i++)
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                                <span class="text-sm text-gray-500 ml-1">Rating</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Phone Mockup with Ripple Effect --}}
                <div class="relative flex justify-center lg:justify-end animate-fade-in-right">

                    {{-- Water Ripple Animation Circles --}}
                    <div class="ripple-container">
                        <div class="ripple"></div>
                        <div class="ripple"></div>
                        <div class="ripple"></div>
                        <div class="ripple"></div>
                        <div class="ripple"></div>
                    </div>

                    {{-- Soft gradient glow behind phone --}}
                    <div
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[350px] h-[350px] lg:w-[420px] lg:h-[420px] rounded-full bg-brand-100/30 blur-3xl pointer-events-none">
                    </div>

                    {{-- Phone Image (transparent blend) --}}
                    <img src="{{ $hero->image_path ? asset('storage/' . $hero->image_path) : asset('images/hero-phone.png') }}"
                        alt="PresensiGPS Mobile App"
                        class="hero-phone-img relative z-10 w-[320px] lg:w-[420px] drop-shadow-2xl animate-float">

                    {{-- Dynamic Floating Stats Cards --}}
                    @foreach($hero_stats as $index => $stat)
                        @php
                            $positionClasses = match ($stat->position_slot) {
                                'TR' => 'top-16 right-0 lg:right-[-10px] animate-float-delayed',
                                'BL' => 'bottom-24 left-0 lg:left-[-20px] animate-float',
                                'TL' => 'top-24 left-[-20px] animate-float',
                                'BR' => 'bottom-16 right-0 lg:right-[10px] animate-float-delayed',
                                'MR' => 'top-1/2 right-[-40px] -translate-y-1/2 animate-float-delayed',
                                'ML' => 'top-1/2 left-[-40px] -translate-y-1/2 animate-float',
                                'TM' => 'top-4 right-1/4 translate-x-1/2 animate-float',
                                'BM' => 'bottom-4 left-1/4 -translate-x-1/2 animate-float-delayed',
                                default => 'top-16 right-0 lg:right-[-10px] animate-float-delayed',
                            };
                            $colorClasses = match ($stat->color_theme) {
                                'brand' => ['bg' => 'bg-brand-100', 'text' => 'text-brand-600'],
                                'amber' => ['bg' => 'bg-amber-100', 'text' => 'text-amber-600'],
                                'rose' => ['bg' => 'bg-rose-100', 'text' => 'text-rose-600'],
                                'sky' => ['bg' => 'bg-sky-100', 'text' => 'text-sky-600'],
                                default => ['bg' => 'bg-brand-100', 'text' => 'text-brand-600'],
                            };
                        @endphp
                        <div class="absolute {{ $positionClasses }} z-20 bg-white/90 backdrop-blur-md rounded-2xl px-5 py-4 shadow-xl shadow-black/5 border border-white/50"
                            style="animation-delay: {{ $index * 0.5 }}s;">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-xl {{ $colorClasses['bg'] }} flex items-center justify-center">
                                    <i
                                        class="ti {{ str_starts_with($stat->icon, 'ti-') ? $stat->icon : 'ti-' . $stat->icon }} {{ $colorClasses['text'] }} text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium">{{ $stat->title }}</p>
                                    <p class="text-lg font-bold text-gray-800">{{ $stat->value }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ========================================= --}}
    {{-- ABOUT SECTION --}}
    {{-- ========================================= --}}
    <section id="about" class="py-24 lg:py-32 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">

                {{-- Left: Image & Mockups --}}
                <div class="relative animate-fade-in-up">
                    {{-- Decorative Sparkle --}}
                    <div class="absolute -top-10 -left-10 text-brand-300/40 animate-pulse-soft">
                        <svg class="w-12 h-12" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 0L14.59 8.41L23 11L14.59 13.59L12 22L9.41 13.59L1 11L9.41 8.41L12 0Z" />
                        </svg>
                    </div>

                    {{-- Main Person Image with Styled Background --}}
                    <div class="relative z-10 rounded-[40px] overflow-hidden h-[480px] lg:h-[620px]">
                        <img src="{{ (isset($about->main_image) && str_starts_with($about->main_image, 'images/')) ? asset($about->main_image) : (isset($about->main_image) ? asset('storage/' . $about->main_image) : asset('images/about-person.png')) }}"
                            alt="HR Manager using PresensiGPS" class="w-full h-full object-cover object-top">
                    </div>

                    {{-- Floating Analytics Card --}}
                    <div
                        class="absolute -bottom-6 -left-6 lg:-left-10 z-20 w-48 lg:w-64 animate-float shadow-2xl shadow-black/10 rounded-2xl lg:rounded-3xl overflow-hidden">
                        <img src="{{ (isset($about->floating_image) && str_starts_with($about->floating_image, 'images/')) ? asset($about->floating_image) : (isset($about->floating_image) ? asset('storage/' . $about->floating_image) : asset('images/about-analytics.png')) }}"
                            alt="Analytics Dashboard" class="w-full h-auto">
                    </div>

                    {{-- Decorative Icon (Top Left) --}}
                    <div
                        class="absolute top-10 -left-6 z-20 w-16 h-16 bg-brand-600 rounded-3xl flex items-center justify-center shadow-xl shadow-brand-600/30 animate-float-delayed">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>

                {{-- Right: Content --}}
                <div class="animate-fade-in-right">
                    {{-- Badge --}}
                    <div class="inline-flex items-center gap-2 bg-brand-50 text-brand-700 px-4 py-2 rounded-full mb-6">
                        <span class="text-sm font-bold">{{ $about->title_badge ?? 'Tentang Aplikasi' }}</span>
                        <span class="text-lg">{{ $about->title_badge_icon ?? '🔥' }}</span>
                    </div>

                    {{-- Headline --}}
                    <h2 class="font-display text-4xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                        {{ $about->headline ?? 'Laporan & Analisis Data Karyawan Lebih Mudah' }}
                    </h2>

                    {{-- Description --}}
                    <p class="text-gray-500 text-lg leading-relaxed mb-10">
                        {{ $about->description ?? 'PresensiGPS tidak hanya mencatat kehadiran, tapi juga memberikan wawasan mendalam tentang produktivitas tim Anda melalui dashboard analitik yang intuitif dan real-time.' }}
                    </p>

                    {{-- Checklist --}}
                    <ul class="space-y-5 mb-10">
                        @if(isset($about->feature_items) && is_array($about->feature_items))
                            @foreach($about->feature_items as $item)
                                <li class="flex items-center gap-4 group">
                                    <div
                                        class="w-6 h-6 rounded-full bg-brand-500 flex items-center justify-center transition-transform group-hover:scale-110">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <span class="text-gray-700 font-semibold text-lg">{{ $item }}</span>
                                </li>
                            @endforeach
                        @else
                            <li class="flex items-center gap-4 group">
                                <div
                                    class="w-6 h-6 rounded-full bg-brand-500 flex items-center justify-center transition-transform group-hover:scale-110">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <span class="text-gray-700 font-semibold text-lg">Dashboard Analitik Terpusat &
                                    Real-time</span>
                            </li>
                        @endif
                    </ul>

                    {{-- CTA Button --}}
                    <a href="{{ $about->cta_url ?? '#pricing' }}"
                        class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-700 text-white font-bold px-8 py-4 rounded-full shadow-lg shadow-brand-600/25 hover:shadow-brand-600/40 transition-all duration-300 hover:translate-x-2">
                        {{ $about->cta_text ?? 'Pelajari Selengkapnya' }}
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

            </div>
        </div>
    </section>

    {{-- ========================================= --}}
    {{-- FEATURES SECTION --}}
    {{-- ========================================= --}}
    <section id="features" class="py-24 lg:py-32 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            {{-- Header --}}
            <div class="text-center max-w-3xl mx-auto mb-20 animate-fade-in-up">
                <div class="inline-flex items-center gap-2 bg-brand-50 text-brand-700 px-4 py-2 rounded-full mb-6">
                    <span
                        class="text-sm font-bold uppercase tracking-wider">{{ $feature_section->title_badge ?? 'Keunggulan Kami' }}</span>
                    <span class="text-lg">{{ $feature_section->title_badge_icon ?? '🔥' }}</span>
                </div>
                <h2 class="font-display text-3xl lg:text-[52px] font-bold text-gray-900 leading-[1.1] mb-6">
                    {{ $feature_section->headline ?? 'Solusi Terpadu untuk Karyawan, Startup, dan Perusahaan Besar' }}
                </h2>
            </div>

            {{-- 3-Column Layout --}}
            <div class="grid lg:grid-cols-3 gap-12 lg:gap-8 items-center">

                {{-- Left Side: Features 1-3 --}}
                <div class="space-y-10 lg:space-y-16 order-2 lg:order-1">
                    @foreach($features->take(3) as $feature)
                        <div class="group flex items-start gap-6 animate-fade-in-up"
                            style="animation-delay: {{ $loop->index * 0.1 }}s">
                            <div
                                class="w-16 h-16 shrink-0 bg-white border border-gray-100 rounded-2xl flex items-center justify-center shadow-sm group-hover:border-brand-200 group-hover:shadow-lg group-hover:shadow-brand-500/5 transition-all duration-300">
                                <i
                                    class="ti {{ str_starts_with($feature->icon, 'ti-') ? $feature->icon : 'ti-' . $feature->icon }} text-3xl text-brand-600"></i>
                            </div>
                            <div>
                                <h3 class="font-display text-xl font-bold text-gray-900 mb-2">{{ $feature->title }}</h3>
                                <p class="text-gray-500 leading-relaxed text-[15px]">{{ $feature->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Center: Dual Phone Mockup --}}
                <div class="relative flex justify-center order-1 lg:order-2 mb-16 lg:mb-0 animate-fade-in-up">
                    {{-- Central Glow background --}}
                    <div
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[350px] h-[350px] lg:w-[500px] lg:h-[500px] rounded-full bg-brand-100/40 blur-[100px] pointer-events-none">
                    </div>
                    <div
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[300px] h-[300px] lg:w-[450px] lg:h-[450px] rounded-full border border-brand-200/30 opacity-50 pointer-events-none">
                    </div>

                    <img src="{{ (isset($feature_section->image_path) && str_starts_with($feature_section->image_path, 'images/')) ? asset($feature_section->image_path) : (isset($feature_section->image_path) ? asset('storage/' . $feature_section->image_path) : asset('images/features-phones.png')) }}"
                        alt="PresensiGPS App Interface"
                        class="relative z-10 w-full max-w-[480px] drop-shadow-3xl animate-float">
                </div>

                {{-- Right Side: Features 4-6 --}}
                <div class="space-y-10 lg:space-y-16 order-3">
                    @foreach($features->skip(3)->take(3) as $feature)
                        <div class="group flex items-start gap-6 animate-fade-in-up"
                            style="animation-delay: {{ ($loop->index + 3) * 0.1 }}s">
                            <div
                                class="w-16 h-16 shrink-0 bg-white border border-gray-100 rounded-2xl flex items-center justify-center shadow-sm group-hover:border-brand-200 group-hover:shadow-lg group-hover:shadow-brand-500/5 transition-all duration-300">
                                <i
                                    class="ti {{ str_starts_with($feature->icon, 'ti-') ? $feature->icon : 'ti-' . $feature->icon }} text-3xl text-brand-600"></i>
                            </div>
                            <div>
                                <h3 class="font-display text-xl font-bold text-gray-900 mb-2">{{ $feature->title }}</h3>
                                <p class="text-gray-500 leading-relaxed text-[15px]">{{ $feature->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>

    {{-- ========================================= --}}
    {{-- PRICING SECTION --}}
    {{-- ========================================= --}}
    <section id="pricing" class="py-24 lg:py-32 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="inline-block text-brand-600 font-semibold text-sm tracking-wider uppercase mb-3">Harga
                    Transparan</span>
                <h2 class="font-display text-3xl lg:text-[42px] font-bold text-gray-900 mb-4 leading-tight">Pilih Paket
                    Langganan</h2>
                <p class="text-gray-500 text-lg">Harga bersahabat yang disesuaikan dengan skala bisnis Anda.</p>
                <div
                    class="mt-8 inline-flex items-center gap-3 bg-brand-50 border border-brand-100 px-6 py-3 rounded-2xl animate-bounce-soft">
                    <span class="text-lg">💡</span>
                    <p class="text-brand-700 text-sm font-bold">Rekomendasi: Hemat 15% (2 Bulan Gratis) untuk pembayaran
                        tahunan!</p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 items-start">
                @foreach($pricing as $plan)
                            <div
                                class="relative bg-white rounded-3xl p-8 lg:p-10 border-2 transition-all duration-500 hover:-translate-y-2
                                {{ $plan->is_featured ? 'border-brand-500 shadow-2xl shadow-brand-500/10 lg:scale-105' : 'border-gray-100 shadow-lg shadow-black/5 hover:border-brand-200 hover:shadow-xl' }}">

                                @if($plan->is_featured)
                                    <div class="absolute -top-4 left-1/2 -translate-x-1/2">
                                        <span
                                            class="inline-block bg-brand-600 text-white text-xs font-bold px-5 py-1.5 rounded-full shadow-lg shadow-brand-600/30">Paling
                                            Populer</span>
                                    </div>
                                @endif

                                <div class="mb-6">
                                    <h3 class="font-display text-xl font-bold text-gray-900">{{ $plan->name }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">{{ $plan->target_audience }}</p>
                                </div>

                                <div class="mb-8 h-[72px]">
                                    @if($plan->monthly_price > 0)
                                        <div class="flex items-baseline gap-1">
                                            <span class="font-display text-4xl lg:text-5xl font-extrabold text-gray-900">Rp
                                                {{ number_format($plan->monthly_price / 1000, 0) }}rb</span>
                                            <span class="text-gray-400 font-medium">/bln</span>
                                        </div>
                                    @else
                                        <div class="flex items-baseline gap-1">
                                            <span class="font-display text-3xl lg:text-4xl font-extrabold text-gray-900">Custom
                                                Pricing</span>
                                        </div>
                                    @endif

                                    @if($plan->yearly_savings && $plan->monthly_price > 0)
                                        <p class="text-brand-600 text-sm font-semibold mt-2">🎉 Tahunan: Rp
                                            {{ number_format($plan->yearly_price, 0, ',', '.') }} ({{ $plan->yearly_savings }})</p>
                                    @elseif($plan->monthly_price == 0)
                                        <p class="text-brand-600 text-sm font-semibold mt-2">SLA Guarantee 99.9% Reliable</p>
                                    @endif
                                </div>

                                <div class="features-scroll overflow-y-auto pr-2 mb-10 h-[380px]">
                                    <ul class="space-y-4">
                                        @foreach($plan->features as $pf)
                                            <li class="flex items-start gap-3">
                                                <div
                                                    class="w-5 h-5 rounded-full bg-brand-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                                    <svg class="w-3 h-3 text-brand-600" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                            d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </div>
                                                <span class="text-gray-600 text-[15px]">{{ $pf->feature_text }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <a href="{{ $plan->monthly_price > 0 ? route('checkout.index', $plan->id) : 'https://wa.me/' . ($settings['whatsapp_number'] ?? '') }}"
                                    class="block text-center w-full py-4 rounded-2xl font-semibold text-[15px] transition-all duration-300
                                   {{ $plan->is_featured
                    ? 'bg-brand-600 hover:bg-brand-700 text-white shadow-lg shadow-brand-600/25 hover:shadow-brand-600/40 hover:-translate-y-0.5'
                    : 'bg-brand-50 hover:bg-brand-100 text-brand-700 hover:-translate-y-0.5' }}">
                                    {{ $plan->monthly_price > 0 ? 'Pilih ' . $plan->name : 'Hubungi Kami' }}
                                </a>
                            </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========================================= --}}
    {{-- FAQ SECTION --}}
    {{-- ========================================= --}}
    <section id="faq" class="py-24 lg:py-32 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">

                {{-- Left Side: Content & Accordion --}}
                <div class="animate-fade-in-up">
                    {{-- Badge --}}
                    <div class="inline-flex items-center gap-2 bg-brand-50 text-brand-700 px-4 py-2 rounded-full mb-6">
                        <span
                            class="text-sm font-bold uppercase tracking-wider">{{ $faq_section->title_badge ?? 'FAQs' }}</span>
                        <span class="text-lg">{{ $faq_section->title_badge_icon ?? '🔥' }}</span>
                    </div>

                    {{-- Headline --}}
                    <h2 class="font-display text-4xl lg:text-[52px] font-bold text-gray-900 leading-[1.1] mb-6">
                        {{ $faq_section->headline ?? 'Frequently Ask Questions' }}
                    </h2>

                    {{-- Description --}}
                    <p class="text-gray-500 text-lg leading-relaxed mb-10 max-w-xl">
                        {{ $faq_section->description ?? 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.' }}
                    </p>

                    {{-- Accordion --}}
                    <div class="space-y-4">
                        @foreach($faqs as $faq)
                            <div
                                class="faq-item group bg-gray-50/50 border border-gray-100 rounded-2xl overflow-hidden transition-all duration-300 hover:border-brand-200 hover:shadow-xl hover:shadow-brand-500/5">
                                <button class="faq-trigger w-full px-6 py-5 flex items-center justify-between text-left">
                                    <span
                                        class="font-bold text-gray-900 group-hover:text-brand-600 transition-colors">{{ $faq->question }}</span>
                                    <div
                                        class="w-8 h-8 rounded-lg bg-white border border-gray-100 flex items-center justify-center transition-transform duration-300 faq-icon-box">
                                        <svg class="w-4 h-4 text-brand-600 transition-transform duration-300 faq-icon"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </button>
                                <div
                                    class="faq-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out px-6">
                                    <p class="pb-6 text-gray-500 leading-relaxed">{{ $faq->answer }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Right Side: Dual Overlapping Mockups --}}
                <div class="relative animate-fade-in-right h-[400px] sm:h-[500px] lg:h-[650px] lg:-mt-48">
                    {{-- Soft background glow --}}
                    <div
                        class="absolute top-1/2 right-[-100px] -translate-y-1/2 w-[400px] h-[400px] lg:w-[800px] lg:h-[800px] rounded-full bg-brand-50 lg:bg-brand-100/30 blur-[120px] pointer-events-none">
                    </div>

                    {{-- Background Image (Landscape Dashboard) --}}
                    <div
                        class="absolute top-1/2 right-[-50px] lg:right-[-350px] -translate-y-1/2 w-[350px] sm:w-[500px] lg:w-[1000px] shadow-2xl rounded-3xl overflow-hidden animate-float-delayed border border-white/40 z-10 transition-all duration-500">
                        <img src="{{ (isset($faq_section->primary_image) && str_starts_with($faq_section->primary_image, 'images/')) ? asset($faq_section->primary_image) : (isset($faq_section->primary_image) ? asset('storage/' . $faq_section->primary_image) : asset('images/faq-mockup.png')) }}"
                            alt="Dashboard Context" class="w-full h-auto">
                    </div>

                    {{-- Foreground Image (Portrait Mobile) --}}
                    <div
                        class="absolute top-1/2 left-4 sm:left-10 lg:left-[20px] -translate-y-1/2 w-[110px] sm:w-[145px] lg:w-[185px] animate-float z-30 group">
                        <div
                            class="relative drop-shadow-[0_20px_60px_rgba(0,0,0,0.2)] group-hover:scale-105 transition-transform duration-700">
                            <img src="{{ (isset($faq_section->secondary_image) && str_starts_with($faq_section->secondary_image, 'images/')) ? asset($faq_section->secondary_image) : (isset($faq_section->secondary_image) ? asset('storage/' . $faq_section->secondary_image) : asset('images/hero-phone.png')) }}"
                                alt="Mobile View" class="w-full h-auto">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ========================================= --}}
    {{-- CTA BANNER --}}
    {{-- ========================================= --}}
    <section class="py-20 bg-gradient-to-r from-brand-700 via-brand-600 to-brand-500 relative overflow-hidden">
        {{-- Decorative Patterns --}}
        <div class="absolute top-0 left-0 w-full h-full opacity-10">
            <div class="absolute top-10 left-20 w-40 h-40 border border-white/30 rounded-full"></div>
            <div class="absolute bottom-10 right-20 w-60 h-60 border border-white/20 rounded-full"></div>
            <div class="absolute top-20 right-40 w-20 h-20 border border-white/20 rounded-full"></div>
        </div>

        <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center relative z-10">
            <h2 class="font-display text-3xl lg:text-5xl font-bold text-white mb-6">Mulai Kelola Karyawan Anda Sekarang
            </h2>
            <p class="text-brand-100 text-lg mb-10 max-w-2xl mx-auto">Dapatkan demo gratis 7 hari tanpa komitmen.
                Rasakan kemudahan mengelola absensi dan payroll dalam satu platform.</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ $hero->cta_url ?? '#' }}"
                    class="inline-flex items-center gap-2 bg-white text-brand-700 font-bold px-8 py-4 rounded-full shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    Coba Gratis Sekarang
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
                <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}"
                    class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white font-bold px-8 py-4 rounded-full border border-white/30 transition-all duration-300 hover:-translate-y-1">
                    💬 Chat via WhatsApp
                </a>
            </div>
        </div>
    </section>

    {{-- ========================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================= --}}
    {{-- ========================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================= --}}
    <footer id="contact" class="bg-[#F8F9FA] pt-24 pb-12 relative overflow-hidden">
        {{-- Decorative Background Blobs --}}
        <div class="absolute top-0 left-0 w-full h-full pointer-events-none overflow-hidden">
            <div
                class="absolute top-[-10%] translate-x-[-30%] left-0 w-[400px] h-[400px] rounded-full bg-brand-100/30 blur-[100px] opacity-60">
            </div>
            <div
                class="absolute bottom-0 translate-x-[30%] right-0 w-[500px] h-[500px] rounded-full bg-brand-100/20 blur-[120px] opacity-40">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-12 gap-12 lg:gap-16 items-start pb-20 border-b border-gray-100">

                {{-- Column 1: Brand & Description --}}
                <div class="lg:col-span-4 max-w-sm">
                    <a href="/" class="flex items-center gap-3 mb-8 group text-decoration-none">
                        <div
                            class="w-12 h-12 flex items-center justify-center transition-all duration-500 overflow-hidden group-hover:scale-105">
                            @if(isset($settings['brand_logo']) && $settings['brand_logo'])
                                <img src="{{ asset('storage/' . $settings['brand_logo']) }}" alt="Logo"
                                    class="w-full h-full object-contain">
                            @else
                                <div
                                    class="w-full h-full bg-brand-600 rounded-[1rem] flex items-center justify-center shadow-inner">
                                    <span
                                        class="text-white font-display font-black text-xl leading-none">{{ substr($settings['brand_name'] ?? 'P', 0, 1) }}</span>
                                </div>
                            @endif
                        </div>
                        <span
                            class="font-display text-2xl font-black text-gray-900 tracking-tight leading-none group-hover:text-brand-700 transition-colors text-decoration-none">
                            @if(isset($settings['brand_name']))
                                @php
                                    $words = explode(' ', $settings['brand_name']);
                                    $firstWord = $words[0] ?? '';
                                    $rest = implode(' ', array_slice($words, 1));
                                @endphp
                                <span class="text-brand-700">{{ $firstWord }}</span><span
                                    class="text-gray-900">{{ $rest }}</span>
                            @else
                                <span class="text-brand-700">Presensi</span><span class="text-gray-900">GPS</span>
                            @endif
                        </span>
                    </a>
                    <p class="text-gray-500 text-lg leading-relaxed mb-6 font-medium">
                        {{ $settings['tagline'] ?? 'Mengarahkan masa depan operasional bisnis Anda dengan absensi & payroll yang lebih efisien.' }}
                    </p>
                    <p class="text-sm text-gray-400 leading-relaxed max-w-[280px] font-bold uppercase tracking-wider">
                        Solusi terintegrasi untuk manajemen aset terpenting perusahaan: Karyawan.
                    </p>
                </div>

                {{-- Column 2: Navigation --}}
                <div class="lg:col-span-2">
                    <h4 class="text-gray-900 font-black mb-8 relative inline-block text-sm uppercase tracking-widest">
                        Navigasi
                        <div class="absolute -bottom-2 left-0 w-8 h-1 bg-brand-500 rounded-full"></div>
                    </h4>
                    <ul class="space-y-4">
                        <li><a href="#"
                                class="text-gray-500 hover:text-brand-600 font-bold text-sm transition-colors uppercase tracking-tight text-decoration-none">Beranda</a>
                        </li>
                        <li><a href="#about"
                                class="text-gray-500 hover:text-brand-600 font-bold text-sm transition-colors uppercase tracking-tight text-decoration-none">Tentang
                                Kami</a></li>
                        <li><a href="#features"
                                class="text-gray-500 hover:text-brand-600 font-bold text-sm transition-colors uppercase tracking-tight text-decoration-none">Fitur
                                Unggulan</a></li>
                        <li><a href="#pricing"
                                class="text-gray-500 hover:text-brand-600 font-bold text-sm transition-colors uppercase tracking-tight text-decoration-none">Paket
                                Harga</a></li>
                    </ul>
                </div>

                {{-- Column 3: Bantuan --}}
                <div class="lg:col-span-2">
                    <h4 class="text-gray-900 font-black mb-8 relative inline-block text-sm uppercase tracking-widest">
                        Bantuan
                        <div class="absolute -bottom-2 left-0 w-8 h-1 bg-brand-500 rounded-full"></div>
                    </h4>
                    <ul class="space-y-4">
                        <li><a href="#faq"
                                class="text-gray-500 hover:text-brand-600 font-bold text-sm transition-colors uppercase tracking-tight text-decoration-none">Pusat
                                FAQ</a></li>
                        <li><a href="#"
                                class="text-gray-500 hover:text-brand-600 font-bold text-sm transition-colors uppercase tracking-tight text-decoration-none">Panduan</a>
                        </li>
                        <li><a href="/login"
                                class="text-gray-500 hover:text-brand-600 font-bold text-sm transition-colors uppercase tracking-tight text-decoration-none text-decoration-none">Admin
                                Portal</a></li>
                    </ul>
                </div>

                {{-- Column 4: Contact Card --}}
                <div class="lg:col-span-4">
                    <div
                        class="bg-white p-8 lg:p-10 rounded-3xl shadow-2xl shadow-gray-200 border border-gray-50 relative overflow-hidden group">
                        {{-- Subtle background decoration in card --}}
                        <div
                            class="absolute -top-10 -right-10 w-32 h-32 bg-brand-50 rounded-full blur-2xl opacity-50 transition-transform group-hover:scale-150 duration-700">
                        </div>

                        <div class="relative z-10">
                            <span
                                class="text-brand-600 font-bold text-sm uppercase tracking-widest mb-4 inline-block">Hubungi
                                Kami</span>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Ready To Get Started?</h3>
                            <p class="text-gray-500 text-sm leading-relaxed mb-10 font-medium">
                                Berikan tim HR Anda alat yang tepat untuk mengelola aset terpenting perusahaan:
                                Karyawan.
                            </p>

                            <div class="space-y-6">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 shrink-0 bg-brand-50 rounded-xl flex items-center justify-center text-brand-600 shadow-sm">
                                        <i class="ti ti-mail text-xl"></i>
                                    </div>
                                    <div class="leading-tight pt-1">
                                        <p class="text-[11px] text-gray-400 font-bold mb-0.5 uppercase tracking-wider">
                                            Email Kami</p>
                                        <p class="text-gray-800 font-bold text-sm">
                                            {{ $settings['email_contact'] ?? 'hello@' . strtolower(str_replace(' ', '', $settings['brand_name'] ?? 'presensigps')) . '.com' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 shrink-0 bg-brand-50 rounded-xl flex items-center justify-center text-brand-600 shadow-sm">
                                        <i class="ti ti-phone text-xl"></i>
                                    </div>
                                    <div class="leading-tight pt-1">
                                        <p class="text-[11px] text-gray-400 font-bold mb-0.5 uppercase tracking-wider">
                                            Hubungi Kami</p>
                                        <p class="text-gray-800 font-bold text-sm">
                                            {{ $settings['whatsapp_number'] ?? '+62 812 3456 7890' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Bottom Bar --}}
            <div
                class="pt-12 mt-20 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-6 text-gray-400 text-xs font-bold uppercase tracking-widest">
                <div class="flex items-center gap-2">
                    <p class="font-medium">&copy; {{ date('Y') }} {{ $settings['brand_name'] ?? 'PresensiGPS' }}. All
                        rights reserved.</p>
                </div>
                <div class="flex items-center gap-8">
                    <a href="#" class="hover:text-brand-600 font-medium transition-colors">Sitemap</a>
                    <a href="#" class="hover:text-brand-600 font-medium transition-colors">Privacy Policy</a>

                </div>
            </div>
        </div>
    </footer>

    {{-- ========================================= --}}
    {{-- JAVASCRIPT --}}
    {{-- ========================================= --}}
    <script>
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('bg-white/95', 'nav-blur', 'shadow-sm', 'py-3');
                navbar.classList.remove('py-5');
            } else {
                navbar.classList.remove('bg-white/95', 'nav-blur', 'shadow-sm', 'py-3');
                navbar.classList.add('py-5');
            }
        });

        // FAQ Accordion
        document.querySelectorAll('.faq-trigger').forEach(button => {
            button.addEventListener('click', () => {
                const item = button.closest('.faq-item');
                const content = item.querySelector('.faq-content');
                const icon = item.querySelector('.faq-icon');

                // Close all others
                document.querySelectorAll('.faq-item').forEach(other => {
                    if (other !== item) {
                        const otherContent = other.querySelector('.faq-content');
                        const otherIcon = other.querySelector('.faq-icon');
                        if (otherContent) otherContent.style.maxHeight = '0';
                        if (otherIcon) otherIcon.style.transform = 'rotate(0deg)';
                        other.classList.remove('active', 'border-brand-500', 'bg-white', 'shadow-xl', 'shadow-brand-500/5');
                        other.classList.add('border-gray-100', 'bg-gray-50/50');
                    }
                });

                // Toggle current
                if (item.classList.contains('active')) {
                    content.style.maxHeight = '0';
                    if (icon) icon.style.transform = 'rotate(0deg)';
                    item.classList.remove('active', 'border-brand-500', 'bg-white', 'shadow-xl', 'shadow-brand-500/5');
                    item.classList.add('border-gray-100', 'bg-gray-50/50');
                } else {
                    content.style.maxHeight = content.scrollHeight + 'px';
                    if (icon) icon.style.transform = 'rotate(180deg)';
                    item.classList.add('active', 'border-brand-500', 'bg-white', 'shadow-xl', 'shadow-brand-500/5');
                    item.classList.remove('border-gray-100', 'bg-gray-50/50');
                }
            });
        });

        // Mobile menu toggle
        const menuBtn = document.getElementById('mobile-menu-btn');
        if (menuBtn) {
            menuBtn.addEventListener('click', () => {
                // Simple mobile menu - you could enhance this
                const navLinks = document.querySelector('.nav-links-mobile');
                if (navLinks) navLinks.classList.toggle('hidden');
            });
        }
    </script>
</body>

</html>