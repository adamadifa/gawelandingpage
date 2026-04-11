<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    
    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --primary: #4F46E5;
            --primary-light: #EEF2FF;
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

        .card-wow {
            background: white;
            border-radius: 12px;
            border: 1px solid #F1F5F9;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02), 0 1px 2px rgba(0,0,0,0.04);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.2); }

        /* Dropdown Styles */
        .nav-dropdown {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-dropdown.open {
            max-height: 1000px;
            background: rgba(0, 0, 0, 0.2);
            margin: 4px 16px;
            border-radius: 16px;
            padding: 8px 0;
        }

        .nav-link-sub {
            padding: 8px 16px 8px 48px;
            margin: 1px 0;
            font-size: 12px;
            border-radius: 0;
        }
        
        .nav-link-sub:hover {
            background: transparent;
            padding-left: 52px;
        }

        .chevron-icon {
            transition: transform 0.3s;
        }

        .nav-link.active-parent .chevron-icon {
            transform: rotate(90deg);
        }

        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); position: fixed; z-index: 50; height: 100vh; }
            .sidebar.open { transform: translateX(0); }
        }

        /* Animations */
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
<body class="flex" x-data="{}">
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
                    <div class="px-7 mb-3 text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em]">Pusat Kendali</div>
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="ti ti-brand-airtable text-xl mr-3"></i>
                        <span>Dashboard</span>
                    </a>
                </div>

                {{-- Landing Page Control --}}
                {{-- Landing Page Dropdown --}}
                @php
                    $isLandingActive = request()->routeIs('admin.hero-sections.*') || 
                                     request()->routeIs('admin.hero-stats-cards.*') || 
                                     request()->routeIs('admin.about-sections.*') || 
                                     request()->routeIs('admin.feature-sections.*') || 
                                     request()->routeIs('admin.faq-sections.*') || 
                                     request()->routeIs('admin.features.*') || 
                                     request()->routeIs('admin.pricing-plans.*') || 
                                     request()->routeIs('admin.faqs.*') || 
                                     request()->routeIs('admin.trusted-companies.*');
                @endphp
                <div class="space-y-1">
                    <button type="button" id="trigger-landing" class="nav-link w-[calc(100%-32px)] cursor-pointer justify-between transition-all duration-300 {{ $isLandingActive ? 'active-parent bg-white/5 text-white' : '' }}">
                        <div class="flex items-center">
                            <i class="ti ti-components text-xl mr-3 {{ $isLandingActive ? 'text-brand-400' : '' }}"></i>
                            <span>Landing Page</span>
                        </div>
                        <i class="ti ti-chevron-right text-xs chevron-icon {{ $isLandingActive ? 'rotate-90' : '' }}"></i>
                    </button>
                    <div id="dropdown-landing" class="nav-dropdown {{ $isLandingActive ? 'open' : '' }}">
                        <a href="{{ route('admin.hero-sections.index') }}" class="nav-link nav-link-sub {{ request()->routeIs('admin.hero-sections.*') ? 'text-brand-400 font-bold' : '' }}">
                            <span>Hero Layout</span>
                        </a>
                        <a href="{{ route('admin.hero-stats-cards.index') }}" class="nav-link nav-link-sub {{ request()->routeIs('admin.hero-stats-cards.*') ? 'text-brand-400 font-bold' : '' }}">
                            <span>Counter Cards</span>
                        </a>
                        <a href="{{ route('admin.about-sections.index') }}" class="nav-link nav-link-sub {{ request()->routeIs('admin.about-sections.*') ? 'text-brand-400 font-bold' : '' }}">
                            <span>About Content</span>
                        </a>
                        <a href="{{ route('admin.feature-sections.index') }}" class="nav-link nav-link-sub {{ request()->routeIs('admin.feature-sections.*') ? 'text-brand-400 font-bold' : '' }}">
                            <span>Features Setup</span>
                        </a>
                        <a href="{{ route('admin.faq-sections.index') }}" class="nav-link nav-link-sub {{ request()->routeIs('admin.faq-sections.*') ? 'text-brand-400 font-bold' : '' }}">
                            <span>FAQ Settings</span>
                        </a>
                        <a href="{{ route('admin.features.index') }}" class="nav-link nav-link-sub {{ request()->routeIs('admin.features.*') ? 'text-brand-400 font-bold' : '' }}">
                            <span>Core Features</span>
                        </a>
                        <a href="{{ route('admin.pricing-plans.index') }}" class="nav-link nav-link-sub {{ request()->routeIs('admin.pricing-plans.*') ? 'text-brand-400 font-bold' : '' }}">
                            <span>Pricing Tables</span>
                        </a>
                        <a href="{{ route('admin.faqs.index') }}" class="nav-link nav-link-sub {{ request()->routeIs('admin.faqs.*') ? 'text-brand-400 font-bold' : '' }}">
                            <span>Questions List</span>
                        </a>
                        <a href="{{ route('admin.trusted-companies.index') }}" class="nav-link nav-link-sub {{ request()->routeIs('admin.trusted-companies.*') ? 'text-brand-400 font-bold' : '' }}">
                            <span>Partnership Logos</span>
                        </a>
                    </div>
                </div>

                {{-- Membership Management --}}
                <div class="space-y-1">
                    <div class="px-7 mb-3 text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em]">Premium Access</div>
                    <a href="{{ route('admin.memberships.index') }}" class="nav-link {{ request()->routeIs('admin.memberships.*') ? 'active' : '' }}">
                        <i class="ti ti-id-badge-2 text-xl mr-3"></i>
                        <span>Membership</span>
                    </a>
                </div>

                {{-- Website Settings --}}
                <div class="space-y-1 pb-10">
                    <div class="px-7 mb-4 text-[10px] font-black text-slate-600 uppercase tracking-[0.3em]">System Config</div>
                    <a href="{{ route('admin.site-settings.index') }}" class="nav-link {{ request()->routeIs('admin.site-settings.*') ? 'active' : '' }}">
                        <i class="ti ti-tool text-xl mr-3"></i>
                        <span>Site Settings</span>
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
            {{-- Left Side: Toggle & Search --}}
            <div class="flex items-center gap-6 flex-1">
                <button id="toggle-sidebar" class="lg:hidden p-2 text-gray-400 hover:text-brand-600 transition-colors">
                    <i class="ti ti-menu-2 text-2xl"></i>
                </button>
                <div class="relative max-w-md w-full hidden md:block">
                    <span class="absolute inset-y-0 left-4 flex items-center text-gray-400">
                        <i class="ti ti-search text-lg"></i>
                    </span>
                    <input type="text" placeholder="Search anything..." class="w-full bg-gray-50 border-none rounded-2xl py-2.5 pl-12 pr-4 text-sm focus:ring-2 focus:ring-brand-100 transition-all placeholder:text-gray-400">
                </div>
            </div>

            {{-- Right Side: Profile & Icons --}}
            <div class="flex items-center gap-3">
                <div class="hidden sm:flex items-center gap-2 mr-4">
                    <button class="w-10 h-10 rounded-xl hover:bg-gray-50 text-gray-500 flex items-center justify-center transition-all"><i class="ti ti-sun text-xl"></i></button>
                    <button class="w-10 h-10 rounded-xl hover:bg-gray-50 text-gray-500 flex items-center justify-center transition-all relative">
                        <i class="ti ti-bell text-xl"></i>
                        <span class="absolute top-2.5 right-2.5 w-2 h-2 bg-rose-500 rounded-full border-2 border-white"></span>
                    </button>
                </div>
                
                <div class="h-8 w-[1px] bg-gray-100 mx-2 hidden sm:block"></div>

                <div class="flex items-center gap-3 pl-3 group cursor-pointer">
                    <div class="text-right hidden md:block">
                        <p class="text-sm font-bold text-gray-900 leading-none mb-1 group-hover:text-brand-600 transition-colors">{{ Auth::user()->name }}</p>
                        <p class="text-[11px] font-medium text-gray-400 uppercase tracking-wider">Super Administrator</p>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-brand-50 border-2 border-white p-0.5 shadow-sm group-hover:shadow-md transition-all">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6366f1&color=fff&bold=true" class="w-full h-full rounded-lg object-cover" alt="Profile">
                    </div>
                </div>
            </div>
        </header>

        {{-- Main Page Content --}}
        <div class="p-6 lg:px-8 lg:pt-8 lg:pb-0">
            {{-- Breadcrumbs / Page Title --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10 pb-6 border-b border-gray-100/50">
                <div class="flex-1">
                    <h1 class="font-display text-2xl lg:text-3xl font-bold text-gray-900 tracking-tight first-letter:uppercase lowercase min-w-0">
                        @yield('title', 'Dashboard overview')
                    </h1>
                    <p class="text-sm text-gray-400 mt-1.5 font-medium leading-relaxed">
                        @yield('description', 'Selamat datang kembali, ' . Auth::user()->name . '!')
                    </p>
                </div>
                <div class="flex flex-col items-end gap-4 shrink-0">
                    <div class="mb-1">
                        @yield('breadcrumbs')
                    </div>
                    <div class="flex items-center gap-3">
                        @yield('actions')
                        <a href="{{ route('landing') }}" target="_blank" class="flex items-center gap-2 bg-white text-gray-600 border border-gray-100 px-5 py-2.5 rounded-xl text-[13px] font-bold shadow-sm hover:border-brand-600 hover:text-brand-600 hover:shadow-brand-600/5 transition-all">
                            <i class="ti ti-external-link text-lg text-brand-600"></i>
                            <span>Live Site</span>
                        </a>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-brand-50 border border-brand-100 text-brand-700 px-6 py-4 rounded-2xl relative mb-8 flex items-center gap-3 animate-fade-in" role="alert">
                    <i class="ti ti-circle-check text-2xl"></i>
                    <span class="font-bold text-sm">{{ session('success') }}</span>
                </div>
            @endif

            @yield('content')
        </div>

        {{-- Global Confirmation Modal --}}
        <div x-data="{ 
                isOpen: false, 
                title: '', 
                message: '', 
                type: 'info', 
                icon: 'ti ti-help', 
                callback: null,
                closeModal() { this.isOpen = false; },
                confirmAction() {
                    if (this.callback && typeof this.callback === 'function') {
                        this.callback();
                    }
                    this.closeModal();
                }
             }" 
             @confirm.window="
                title = $event.detail.title || 'Konfirmasi';
                message = $event.detail.message || 'Apakah Anda yakin?';
                type = $event.detail.type || 'info';
                icon = $event.detail.icon || 'ti ti-help';
                callback = $event.detail.callback;
                isOpen = true;
             "
             x-show="isOpen" 
             class="fixed inset-0 z-[100] overflow-y-auto" 
             x-cloak>
            <div class="flex items-center justify-center min-h-screen p-4 text-center">
                <div x-show="isOpen" 
                     x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0" 
                     x-transition:enter-end="opacity-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100" 
                     x-transition:leave-end="opacity-0" 
                     @click="closeModal()"
                     class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"></div>

                <div x-show="isOpen" 
                     x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="relative bg-white rounded-xl overflow-hidden shadow-2xl transform transition-all sm:max-w-lg sm:w-full p-8 text-left border border-gray-100">
                    
                    <div class="flex items-start gap-5">
                        <div :class="{
                            'bg-amber-50 text-amber-600': type === 'warning',
                            'bg-brand-50 text-brand-600': type === 'info',
                            'bg-rose-50 text-rose-600': type === 'danger'
                        }" class="w-14 h-14 rounded-2xl shrink-0 flex items-center justify-center">
                            <i class="text-3xl" :class="icon"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900 leading-tight mb-2" x-text="title"></h3>
                            <p class="text-sm text-gray-500 font-medium leading-relaxed" x-text="message"></p>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col sm:flex-row gap-3">
                        <button @click="closeModal()" type="button" class="flex-1 px-6 py-3.5 rounded-xl border border-gray-200 text-sm font-bold text-gray-600 hover:bg-gray-50 transition-all">
                            Batal
                        </button>
                        <button @click="confirmAction()" type="button" 
                                :class="{
                                    'bg-amber-600 hover:bg-amber-700 text-white shadow-amber-200': type === 'warning',
                                    'bg-brand-600 hover:bg-brand-700 text-white shadow-brand-200': type === 'info',
                                    'bg-rose-600 hover:bg-rose-700 text-white shadow-rose-200': type === 'danger'
                                }"
                                class="flex-1 px-8 py-3.5 rounded-xl text-sm font-bold shadow-lg transition-all">
                            Ya, Lanjutkan
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <footer class="mt-auto px-8 py-2 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4 text-gray-400 text-[13px] font-medium bg-white">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <div class="flex items-center gap-6">
                <a href="#" class="hover:text-brand-600">Privacy Policy</a>
                <a href="#" class="hover:text-brand-600">Support</a>
                <span class="text-gray-200">|</span>
                <span class="text-gray-500 uppercase">Powered by Biznet GIO</span>
            </div>
        </footer>
    </main>

    @stack('scripts')
    <script>
        // Sidebar toggle for mobile
        const sidebar = document.getElementById('sidebar');
        const toggle = document.getElementById('toggle-sidebar');
        if (toggle) {
            toggle.addEventListener('click', () => {
                sidebar.classList.toggle('hidden');
            });
        }

        // Dropdown toggle for Landing Page
        const triggerLanding = document.getElementById('trigger-landing');
        const dropdownLanding = document.getElementById('dropdown-landing');
        if (triggerLanding && dropdownLanding) {
            triggerLanding.addEventListener('click', () => {
                triggerLanding.classList.toggle('active-parent');
                dropdownLanding.classList.toggle('open');
            });
        }

        // Global Confirmation Modal helper
        window.confirmDialog = function(options) {
            window.dispatchEvent(new CustomEvent('confirm', {
                detail: options
            }));
        }

        // Auto-hide success alerts
        document.addEventListener('DOMContentLoaded', () => {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'all 0.5s ease';
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-10px)';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            });
        });
    </script>
</body>
</html>
