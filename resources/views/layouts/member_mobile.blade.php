<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Member Area</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    
    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --primary: #10B981;
            --primary-700: #047857;
            --primary-50: #ECFDF5;
            --background: #F8FAFC; /* Cleaner, professional slate-50 */
            --safe-top: env(safe-area-inset-top);
            --safe-bottom: env(safe-area-inset-bottom);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background);
            color: #1E293B;
            -webkit-tap-highlight-color: transparent;
            padding-bottom: calc(85px + var(--safe-bottom));
        }

        .font-display { font-family: 'Poppins', sans-serif; }

        .glass-nav {
            background: #FFFFFF;
            border-top: 1px solid #E2E8F0;
            box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.03);
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex: 1;
            color: #64748B;
            transition: all 0.2s ease;
            position: relative;
            padding-top: 4px;
        }

        .nav-item.active {
            color: var(--primary);
        }

        .nav-item.active::after {
            content: '';
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            width: 24px;
            height: 3px;
            background: var(--primary);
            border-radius: 0 0 3px 3px;
        }

        .nav-item i {
            font-size: 1.4rem;
            margin-bottom: 3px;
        }

        .nav-text {
            font-size: 9px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .header-mobile {
            padding: calc(14px + var(--safe-top)) 20px 14px;
            background: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 50;
            border-bottom: 1px solid #E2E8F0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
        }

        .card-formal {
            background: white;
            border: 1px solid #E2E8F0;
            border-radius: 16px; /* Professional 2xl-ish */
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }

        .status-pill {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        [x-cloak] { display: none !important; }

        /* Smooth Animations */
        @keyframes slideInUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .animate-slide-up {
            animation: slideInUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="antialiased">
    
    {{-- Header --}}
    <header class="header-mobile">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 flex items-center justify-center overflow-hidden">
                @if(isset($settings['brand_logo']) && $settings['brand_logo'])
                    <img src="{{ asset('storage/' . $settings['brand_logo']) }}" alt="Logo" class="w-full h-full object-contain">
                @else
                    <div class="w-full h-full bg-brand-600 rounded-xl flex items-center justify-center shadow-lg shadow-brand-600/20 border-2 border-white/20">
                        <span class="text-white font-display font-bold text-lg leading-none uppercase">{{ substr($settings['brand_name'] ?? 'W', 0, 1) }}</span>
                    </div>
                @endif
            </div>
            <div>
                <h1 class="text-xs font-black text-gray-900 uppercase tracking-tighter leading-none mb-0.5">{{ $settings['brand_name'] ?? 'PresensiGPS' }}</h1>
                <p class="text-[9px] font-bold text-emerald-600 uppercase tracking-[0.15em] leading-none">Member Area</p>
            </div>
        </div>

        <div class="flex items-center gap-2">
            <div class="text-right">
                <p class="text-[10px] font-bold text-gray-900 leading-none truncate max-w-[80px]">{{ Auth::user()->name }}</p>
            </div>
            <div class="w-9 h-9 rounded-xl bg-brand-50 border-2 border-white p-0.5 shadow-sm overflow-hidden">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=10B981&color=fff&bold=true" class="w-full h-full rounded-lg object-cover" alt="Profile">
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Bottom Navigation --}}
    <nav class="fixed bottom-0 left-0 right-0 glass-nav z-50 px-4 pb-[calc(10px+var(--safe-bottom))] pt-3">
        <div class="flex justify-around items-center max-w-lg mx-auto">
            <a href="{{ route('member.dashboard') }}" class="nav-item {{ request()->routeIs('member.dashboard') ? 'active' : '' }}">
                <i class="ti ti-layout-grid"></i>
                <span class="nav-text">Home</span>
            </a>
            <a href="{{ route('landing') }}#pricing" class="nav-item">
                <i class="ti ti-shopping-cart"></i>
                <span class="nav-text">Explore</span>
            </a>
            <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" target="_blank" class="nav-item">
                <i class="ti ti-headset"></i>
                <span class="nav-text">Support</span>
            </a>
            <form method="POST" action="{{ route('logout') }}" id="logout-form-mobile" class="nav-item m-0">
                @csrf
                <button type="submit" class="flex flex-col items-center bg-transparent border-none p-0 text-inherit cursor-pointer">
                    <i class="ti ti-power text-rose-500"></i>
                    <span class="nav-text text-rose-500">Sign Out</span>
                </button>
            </form>
        </div>
    </nav>

    @stack('scripts')
</body>
</html>
