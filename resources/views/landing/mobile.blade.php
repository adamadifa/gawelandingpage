<!DOCTYPE html>
<html lang="id" class="scroll-smooth h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    @include('partials.seo')
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            -webkit-tap-highlight-color: transparent;
        }
        .font-display { font-family: 'Outfit', sans-serif; }
        
        .safe-top {
            padding-top: env(safe-area-inset-top);
        }
        
        .safe-bottom {
            padding-bottom: env(safe-area-inset-bottom);
        }
        
        /* Mobile Specific Animations */
        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .animate-slide-up { animation: slideUp 0.6s ease-out forwards; }
        
        @keyframes rippleWave {
            0% { width: 60px; height: 60px; opacity: 0.6; border-width: 2px; }
            100% { width: 300px; height: 300px; opacity: 0; border-width: 1px; }
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

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .animate-float { animation: float 3s ease-in-out infinite; }

        .hero-phone-img {
            mix-blend-mode: multiply;
        }

        /* Glassmorphism Navigation */
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        .active-nav {
            color: #16a34a; /* brand-600 */
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 h-full overflow-x-hidden antialiased pb-24">

    <!-- Mobile Top Header -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-100 flex items-center justify-between safe-top">
        <div class="px-5 py-4 flex items-center justify-between w-full">
            <a href="/" class="flex items-center gap-2 flex-shrink-0">
                @if(isset($settings['brand_logo']) && $settings['brand_logo'])
                    <img src="{{ asset('storage/' . $settings['brand_logo']) }}" alt="Logo" class="h-8 w-auto">
                @else
                    <div class="w-8 h-8 bg-brand-600 rounded-lg flex items-center justify-center shadow-lg shadow-brand-600/20">
                        <span class="text-white font-display font-black text-sm">{{ substr($settings['brand_name'] ?? 'P', 0, 1) }}</span>
                    </div>
                @endif
                <span class="font-display text-lg font-bold text-slate-900 tracking-tight">{{ $settings['brand_name'] ?? 'PresensiGPS' }}</span>
            </a>
            
            @auth
                <a href="{{ route('member.dashboard') }}" class="w-10 h-10 rounded-full bg-brand-50 flex items-center justify-center text-brand-600 flex-shrink-0">
                    <i class="ti ti-user-circle text-2xl"></i>
                </a>
            @else
                <a href="{{ route('login') }}" class="text-sm font-bold text-brand-600 px-4 py-2 bg-brand-50 rounded-full flex-shrink-0">Login</a>
            @endauth
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-24 safe-top">

        <!-- Hero Section Mobile -->
        <section class="px-6 pt-6 pb-12 overflow-hidden relative">
            <div class="absolute -top-10 -right-10 w-48 h-48 bg-brand-200/30 rounded-full blur-3xl"></div>
            
            <div class="animate-slide-up">
                <div class="inline-flex items-center gap-2 bg-white px-3 py-1 rounded-full border border-slate-100 shadow-sm mb-4">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-brand-600">Terpercaya</span>
                    <i class="ti ti-heart-filled text-rose-500 text-[10px]"></i>
                </div>
                
                <h1 class="font-display text-4xl font-extrabold leading-[1.1] text-slate-900 mb-4">
                    {{ $hero->headline ?? 'Kelola Absensi & Payroll Lebih Efisien.' }}
                </h1>
                
                <p class="text-slate-500 text-base leading-relaxed mb-8">
                    {{ $hero->sub_headline ?? 'Solusi satu pintu untuk Presensi GPS, Penggajian Otomatis, dan Manajemen Karyawan.' }}
                </p>
                
                <div class="flex flex-col gap-3">
                    <a href="{{ route('register') }}" class="w-full bg-brand-600 text-white font-bold py-4 rounded-2xl flex items-center justify-center gap-2 shadow-xl shadow-brand-600/25 active:scale-95 transition-all">
                        {{ $hero->cta_text ?? 'Coba Sekarang Gratis' }}
                        <i class="ti ti-arrow-right"></i>
                    </a>
                    <a href="#features" class="w-full bg-white text-slate-700 font-bold py-4 rounded-2xl flex items-center justify-center border border-slate-200 active:scale-95 transition-all">
                        Pelajari Fitur
                    </a>
                </div>
            </div>

            <!-- Hero Image Mockup (Desktop parity) -->
            <div class="mt-16 relative flex justify-center animate-slide-up" style="animation-delay: 200ms">
                <!-- Ripples -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-60 h-60">
                    <div class="ripple" style="animation-delay: 0s"></div>
                    <div class="ripple" style="animation-delay: 0.8s"></div>
                    <div class="ripple" style="animation-delay: 1.6s"></div>
                </div>
                
                <!-- Image Container for absolute positioning -->
                <div class="relative">
                    <img src="{{ $hero->image_path ? asset('storage/' . $hero->image_path) : asset('images/hero-phone.png') }}" 
                         alt="PresensiGPS Mobile App" 
                         class="hero-phone-img relative z-10 w-[200px] drop-shadow-2xl animate-float">

                    <!-- Floating Stats Mobile -->
                    @foreach($hero_stats->take(2) as $index => $stat)
                        @php
                            $mobilePosition = $index === 0 
                                ? 'left-[-12px] top-10 scale-[0.85]' // Left side inside
                                : 'right-[-12px] bottom-20 scale-[0.85]'; // Right side inside
                        @endphp
                        <div class="absolute {{ $mobilePosition }} z-20 bg-white/95 backdrop-blur-md rounded-xl p-2.5 shadow-xl border border-white/50 animate-float whitespace-nowrap" style="animation-delay: {{ $index * 1.5 }}s;">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-lg bg-brand-50 flex items-center justify-center flex-shrink-0">
                                    <i class="ti {{ str_starts_with($stat->icon, 'ti-') ? $stat->icon : 'ti-' . $stat->icon }} text-brand-600 text-base"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-[7px] text-slate-400 font-bold uppercase tracking-wider leading-none">{{ $stat->title }}</p>
                                    <p class="text-[11px] font-black text-slate-900 mt-1 leading-none">{{ $stat->value }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Logo Gallery (Marquee simplified) -->
        <section class="py-10 bg-slate-100/50">
            <p class="text-center text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Dipercaya Oleh Perusahaan</p>
            <div class="flex flex-wrap justify-center gap-8 px-6 opacity-40 grayscale">
                @foreach($companies->take(4) as $company)
                    <img src="{{ asset('storage/' . $company->logo_path) }}" alt="{{ $company->name }}" class="h-6 w-auto object-contain">
                @endforeach
            </div>
        </section>

        <!-- About Section Mobile -->
        <section id="about" class="px-6 py-20 bg-white">
            <div class="relative mb-12 animate-slide-up flex justify-center">
                {{-- Main Person Image --}}
                <div class="relative z-10 h-[420px]">
                    <img src="{{ (isset($about->main_image) && str_starts_with($about->main_image, 'images/')) ? asset($about->main_image) : (isset($about->main_image) ? asset('storage/' . $about->main_image) : asset('images/about-person.png')) }}" 
                         alt="HR Manager" class="h-full w-auto object-contain">
                </div>

                {{-- Floating Analytics Card --}}
                <div class="absolute bottom-10 right-0 z-20 w-32 animate-float drop-shadow-2xl overflow-hidden">
                    <img src="{{ (isset($about->floating_image) && str_starts_with($about->floating_image, 'images/')) ? asset($about->floating_image) : (isset($about->floating_image) ? asset('storage/' . $about->floating_image) : asset('images/about-analytics.png')) }}" 
                         alt="Analytics" class="w-full h-auto">
                </div>
            </div>

            <div class="animate-slide-up" style="animation-delay: 200ms">
                <span class="text-brand-600 font-black text-[10px] uppercase tracking-widest">{{ $about->title_badge ?? 'Tentang Aplikasi' }}</span>
                <h2 class="font-display text-3xl font-bold text-slate-900 mt-2 mb-4">
                    {{ $about->headline ?? 'Laporan & Analisis Data Karyawan Lebih Mudah' }}
                </h2>
                <p class="text-slate-500 text-sm leading-relaxed mb-8">
                    {{ $about->description ?? 'PresensiGPS memberikan wawasan mendalam tentang produktivitas tim Anda melalui dashboard analitik yang intuitif.' }}
                </p>

                <ul class="space-y-4 mb-8">
                    @if(isset($about->feature_items) && is_array($about->feature_items))
                        @foreach($about->feature_items as $item)
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 rounded-full bg-brand-500 flex items-center justify-center flex-shrink-0">
                                <i class="ti ti-check text-white text-xs"></i>
                            </div>
                            <span class="text-slate-700 font-bold text-sm">{{ $item }}</span>
                        </li>
                        @endforeach
                    @endif
                </ul>

                <a href="#pricing" class="inline-flex items-center gap-2 bg-brand-600 text-white font-bold px-6 py-3.5 rounded-full shadow-lg shadow-brand-600/20 active:scale-95 transition-all text-sm">
                    {{ $about->cta_text ?? 'Mulai Sekarang' }}
                    <i class="ti ti-arrow-right"></i>
                </a>
            </div>
        </section>

            <div class="text-center mb-10">
                <span class="text-brand-600 font-black text-[10px] uppercase tracking-widest">{{ $feature_section->title_badge ?? 'Fitur Unggulan' }}</span>
                <h2 class="font-display text-3xl font-bold text-slate-900 mt-2">{{ $feature_section->headline ?? 'Solusi Karyawan' }}</h2>
            </div>
            
            <!-- Features Mockup (New Image) -->
            <div class="mb-12 relative flex justify-center animate-slide-up">
                <div class="absolute inset-0 bg-brand-100/30 blur-3xl rounded-full"></div>
                <img src="{{ (isset($feature_section->image_path) && str_starts_with($feature_section->image_path, 'images/')) ? asset($feature_section->image_path) : (isset($feature_section->image_path) ? asset('storage/' . $feature_section->image_path) : asset('images/features-phones.png')) }}" 
                     alt="Features Interface" class="relative z-10 w-full max-w-[320px] animate-float">
            </div>
            
            <div class="space-y-6">
                @foreach($features as $index => $feature)
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm animate-slide-up" style="animation-delay: {{ $index * 100 }}ms">
                    <div class="w-12 h-12 bg-brand-50 rounded-2xl flex items-center justify-center mb-4 transition-transform active:scale-110">
                        <i class="ti {{ str_starts_with($feature->icon, 'ti-') ? $feature->icon : 'ti-' . $feature->icon }} text-2xl text-brand-600"></i>
                    </div>
                    <h3 class="font-display text-xl font-bold text-slate-900 mb-2">{{ $feature->title }}</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">{{ $feature->description }}</p>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Pricing Mobile (Horizontal Scroll) -->
        <section id="pricing" class="py-16 bg-brand-600 rounded-[3rem] mx-2 px-6 overflow-hidden">
            <div class="text-center mb-10 text-white">
                <span class="text-brand-200 font-black text-[10px] uppercase tracking-widest">Pricing Plan</span>
                <h2 class="font-display text-3xl font-bold mt-2">Pilih Paket Anda</h2>
            </div>
            
            <div class="flex flex-nowrap overflow-x-auto gap-5 pb-8 snap-x snap-mandatory hide-scrollbar">
                @foreach($pricing as $plan)
                <div class="min-w-[85%] flex-shrink-0 snap-center bg-white rounded-3xl p-8 flex flex-col items-center text-center shadow-2xl relative overflow-hidden">
                    @if($plan->is_featured)
                    <div class="absolute top-0 right-0 bg-amber-400 text-[10px] font-black text-white px-4 py-1 rounded-bl-xl uppercase tracking-widest">Populer</div>
                    @endif
                    
                    <h3 class="font-display text-xl font-bold text-slate-900 mb-1">{{ $plan->name }}</h3>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-6">{{ $plan->target_audience }}</p>
                    
                    <div class="flex items-baseline mb-8">
                        <span class="text-3xl font-black text-slate-900">Rp {{ number_format($plan->monthly_price / 1000, 0) }}rb</span>
                        <span class="text-slate-400 text-sm">/bln</span>
                    </div>
                    
                    <ul class="space-y-3 mb-8 w-full">
                        @foreach($plan->features->take(4) as $pf)
                        <li class="flex items-center justify-center gap-2 text-xs text-slate-600">
                            <i class="ti ti-circle-check-filled text-brand-500 text-sm"></i>
                            {{ $pf->feature_text }}
                        </li>
                        @endforeach
                    </ul>
                    
                    <a href="{{ route('checkout.index', $plan->id) }}" class="w-full bg-brand-600 text-white font-bold py-3.5 rounded-xl text-sm shadow-lg shadow-brand-600/20 active:scale-95 transition-all">
                        Pilih Paket
                    </a>
                </div>
                @endforeach
            </div>
        </section>

        <!-- FAQ Mobile -->
        <section id="faq" class="px-6 py-20 bg-white">
            <div class="text-center mb-10">
                <h2 class="font-display text-3xl font-bold text-slate-900">FAQ</h2>
            </div>
            
            <div class="space-y-3 mb-16">
                @foreach($faqs->take(5) as $faq)
                <div class="faq-item border-b border-slate-200">
                    <button class="faq-trigger w-full py-4 flex items-center justify-between text-left">
                        <span class="text-sm font-bold text-slate-800 pr-4">{{ $faq->question }}</span>
                        <i class="ti ti-chevron-down text-slate-400 transition-transform"></i>
                    </button>
                    <div class="faq-content hidden pb-4">
                        <p class="text-xs text-slate-500 leading-relaxed">{{ $faq->answer }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Contact Banner Mobile -->
        <section class="px-6 pb-20">
            <div class="bg-slate-900 rounded-[2.5rem] p-10 relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-brand-500/20 rounded-full blur-2xl"></div>
                
                <h2 class="font-display text-2xl font-bold text-white mb-4 relative z-10">Punya pertanyaan lebih lanjut?</h2>
                <p class="text-slate-400 text-sm mb-8 relative z-10 leading-relaxed">Tim bantuan kami siap melayani Anda melalui WhatsApp 24/7.</p>
                
                <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" class="w-full bg-brand-600 text-white font-bold py-4 rounded-2xl flex items-center justify-center gap-2 active:scale-95 transition-all">
                    <i class="ti ti-brand-whatsapp text-2xl"></i>
                    Hubungi WhatsApp
                </a>
            </div>
        </section>

    </main>

    <!-- Bottom Navigation Bar -->
    <nav class="fixed bottom-4 left-4 right-4 z-50 glass-nav h-16 rounded-2xl shadow-2xl safe-bottom flex items-center justify-around px-2">
        <a href="/" class="flex flex-col items-center justify-center flex-1 active-nav">
            <i class="ti ti-smart-home text-2xl"></i>
            <span class="text-[9px] font-bold mt-0.5 tracking-tight">Home</span>
        </a>
        <a href="#features" class="flex flex-col items-center justify-center flex-1 text-slate-400">
            <i class="ti ti-category text-2xl"></i>
            <span class="text-[9px] font-bold mt-0.5 tracking-tight">Fitur</span>
        </a>
        <div class="flex-1 flex justify-center -mt-10">
            <a href="{{ route('register') }}" class="w-14 h-14 bg-brand-600 rounded-full flex items-center justify-center text-white shadow-xl shadow-brand-600/30 active:scale-90 transition-all border-4 border-white">
                <i class="ti ti-plus text-2xl"></i>
            </a>
        </div>
        <a href="#pricing" class="flex flex-col items-center justify-center flex-1 text-slate-400">
            <i class="ti ti-credit-card text-2xl"></i>
            <span class="text-[9px] font-bold mt-0.5 tracking-tight">Harga</span>
        </a>
        <a href="#faq" class="flex flex-col items-center justify-center flex-1 text-slate-400">
            <i class="ti ti-help text-2xl"></i>
            <span class="text-[9px] font-bold mt-0.5 tracking-tight">FAQ</span>
        </a>
    </nav>

    <script>
        // FAQ Toggle
        document.querySelectorAll('.faq-trigger').forEach(trigger => {
            trigger.addEventListener('click', () => {
                const content = trigger.nextElementSibling;
                const icon = trigger.querySelector('.ti-chevron-down');
                
                content.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            });
        });

        // Bottom Nav Active State
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.glass-nav a[href^="#"], .glass-nav a[href="/"]');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                if (pageYOffset >= sectionTop - 150) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active-nav', 'text-brand-600');
                link.classList.add('text-slate-400');
                
                if (link.getAttribute('href') === `#${current}` || (current === '' && link.getAttribute('href') === '/')) {
                    link.classList.add('active-nav', 'text-brand-600');
                    link.classList.remove('text-slate-400');
                }
            });
        });
    </script>
</body>
</html>
