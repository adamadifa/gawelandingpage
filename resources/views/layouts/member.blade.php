<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            --sidebar-width: 290px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F0F7F4; /* Soft Emerald Stronger */
            color: #1F2937;
        }

        .font-display { font-family: 'Poppins', sans-serif; }

        .sidebar {
            width: var(--sidebar-width);
            background: #06221C; /* Soft Dark Green */
            border-right: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            box-shadow: 10px 0 30px rgba(0, 0, 0, 0.1);
            min-height: 100vh;
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 200px;
            background: radial-gradient(circle at 0% 0%, rgba(16, 185, 129, 0.12) 0%, transparent 70%);
            pointer-events: none;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            margin: 4px 16px;
            border-radius: 12px;
            color: #94A3B8; /* Slate 400 */
            font-weight: 600;
            font-size: 13px;
            white-space: nowrap;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.03);
            color: white;
            padding-left: 20px;
        }

        .nav-link i {
            font-size: 1.3rem;
            margin-right: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 20px;
            transition: transform 0.3s;
        }

        .nav-link:hover i {
            transform: scale(1.1);
            color: #10B981; /* Brand Green */
        }

        .nav-link.active {
            background: linear-gradient(135deg, #10B981 0%, #059669 100%);
            color: white;
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.25);
        }

        .nav-link.active i {
            color: white !important;
        }

        .main-content {
            flex: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            height: 64px;
            background: white;
            border-bottom: 1px solid #F1F5F9;
            padding: 0 24px;
            position: sticky;
            top: 0;
            z-index: 40;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.2); }

        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); position: fixed; z-index: 50; height: 100vh; }
            .sidebar.open { transform: translateX(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.4s ease-out forwards;
        }

        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="flex">
    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar shrink-0 sticky top-0 overflow-y-auto hidden lg:flex flex-col">
        <div class="px-3 pt-12 pb-8">
            <a href="/" class="flex items-center gap-3 mb-16 px-4 group">
                <div class="w-12 h-12 flex items-center justify-center overflow-hidden transition-all duration-500 group-hover:scale-110 group-hover:rotate-6">
                    @if(isset($settings['brand_logo']) && $settings['brand_logo'])
                        <img src="{{ asset('storage/' . $settings['brand_logo']) }}" alt="Logo" class="w-full h-full object-contain">
                    @else
                        <div class="w-full h-full bg-brand-600 rounded-2xl flex items-center justify-center shadow-lg shadow-brand-600/20 border-2 border-white/20">
                            <span class="text-white font-display font-bold text-xl leading-none uppercase">{{ substr($settings['brand_name'] ?? 'W', 0, 1) }}</span>
                        </div>
                    @endif
                </div>
                <div class="flex flex-col leading-tight">
                    <span class="font-display text-lg font-bold text-white group-hover:text-brand-400 transition-colors tracking-tight uppercase">
                        {{ $settings['brand_name'] ?? 'PresensiGPS V2' }}
                    </span>
                </div>
            </a>

            <div class="space-y-6">
                {{-- Main Menu --}}
                <div class="space-y-1">
                    <div class="px-7 mb-3 text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em]">Pusat Bisnis</div>
                    <a href="{{ route('member.dashboard') }}" class="nav-link {{ request()->routeIs('member.dashboard') ? 'active' : '' }}">
                        <i class="ti ti-layout-dashboard text-xl mr-3"></i>
                        <span>My Dashboard</span>
                    </a>
                    <a href="{{ route('landing') }}#pricing" class="nav-link">
                        <i class="ti ti-shopping-cart text-xl mr-3"></i>
                        <span>Explore Plans</span>
                    </a>
                </div>

                {{-- Support Section --}}
                <div class="space-y-1 pb-10">
                    <div class="px-7 mb-3 text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em]">Bantuan Cepat</div>
                    <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" target="_blank" class="nav-link">
                        <i class="ti ti-headset text-xl mr-3"></i>
                        <span>Technical Support</span>
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <button type="submit" class="nav-link w-[calc(100%-32px)] text-left text-rose-500 hover:bg-rose-500/10 border-none cursor-pointer mt-4 group/logout transition-all duration-300">
                            <i class="ti ti-power text-xl mr-3 group-hover/logout:rotate-90 transition-transform"></i>
                            <span class="group-hover/logout:translate-x-1">Sign Out</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="main-content">
        {{-- Header --}}
        <header class="header flex justify-between items-center bg-white border-b border-gray-100">
            <div class="flex items-center gap-6">
                <button id="toggle-sidebar" class="lg:hidden p-2 text-gray-400 hover:text-brand-600 transition-colors">
                    <i class="ti ti-menu-2 text-2xl"></i>
                </button>
                <div class="hidden md:block">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest pl-1 leading-none">Member Role</span>
                </div>
            </div>

            <div class="flex items-center gap-3 pr-4 group cursor-pointer">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-gray-900 leading-none mb-1 group-hover:text-brand-600 transition-colors">{{ Auth::user()->name }}</p>
                    <p class="text-[11px] font-medium text-gray-400 uppercase tracking-wider">Premium Member</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-brand-50 border-2 border-white p-0.5 shadow-sm group-hover:shadow-md transition-all">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6366f1&color=fff&bold=true" class="w-full h-full rounded-lg object-cover" alt="Profile">
                </div>
            </div>
        </header>

        {{-- Main Page Content --}}
        <div class="p-6 lg:p-8">
            @yield('content')
        </div>

        {{-- Footer --}}
        <footer class="mt-auto px-10 py-6 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4 text-gray-400 text-[13px] font-medium bg-white">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <div class="flex items-center gap-6">
                <a href="#" class="hover:text-brand-600">Privacy Policy</a>
                <a href="#" class="hover:text-brand-600">Terms of Service</a>
                <span class="text-gray-200">|</span>
                <span class="text-gray-500 uppercase">Powered by Biznet GIO</span>
            </div>
        </footer>
    </main>

    @stack('scripts')
    <script>
        const sidebar = document.getElementById('sidebar');
        const toggle = document.getElementById('toggle-sidebar');
        if (toggle) {
            toggle.addEventListener('click', () => {
                sidebar.classList.toggle('hidden');
                sidebar.classList.toggle('open');
            });
        }
    </script>
</body>
</html>
