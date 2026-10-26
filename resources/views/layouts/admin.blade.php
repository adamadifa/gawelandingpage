<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GawePro') }} - @yield('title', 'Dashboard Utama & Pusat Analitik')</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    
    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #007A87;
            --primary-hover: #006570;
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 76px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F8FAFC;
            color: #334155;
        }

        /* Custom Scrollbar */
        .custom-scroll::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }
        .custom-scroll::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scroll::-webkit-scrollbar-thumb {
            background: #E2E8F0;
            border-radius: 9999px;
        }
        .custom-scroll::-webkit-scrollbar-thumb:hover {
            background: #CBD5E1;
        }

        /* Sidebar Nav Styles */
        .sidebar {
            width: var(--sidebar-width);
            transition: width 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar.collapsed .sidebar-text,
        .sidebar.collapsed .chevron-icon,
        .sidebar.collapsed .sidebar-section-title,
        .sidebar.collapsed .sidebar-footer {
            display: none !important;
        }

        .sidebar.collapsed .nav-item {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
            margin-left: 6px;
            margin-right: 6px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 5.5px 10px;
            margin: 1px 8px;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 500;
            color: #64748B;
            transition: all 0.15s ease;
            position: relative;
        }

        .nav-item:hover {
            background-color: #F0FDFA;
            color: #007A87;
        }

        .nav-item.active {
            color: #007A87;
            font-weight: 600;
            background-color: #F0FDFA;
            border: 1px solid #CCFBF1;
            box-shadow: 0 1px 2px rgba(0, 122, 135, 0.04);
        }

        .card-clean {
            background: #FFFFFF;
            border: 1px solid #F1F5F9;
            border-radius: 16px;
            box-shadow: 0 1px 3px 0 rgba(15, 23, 42, 0.03);
            transition: box-shadow 0.2s ease, border-color 0.2s ease;
        }

        .card-clean:hover {
            box-shadow: 0 4px 14px -3px rgba(15, 23, 42, 0.06);
        }

        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="min-h-screen bg-[#F8FAFC] text-[#334155] antialiased flex flex-col" x-data="{ sidebarCollapsed: false, mobileOpen: false }">

    <!-- Mobile Sidebar Backdrop -->
    <div x-show="mobileOpen" 
         x-cloak
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="mobileOpen = false" 
         class="fixed inset-0 z-40 bg-slate-900/40 backdrop-blur-xs lg:hidden"></div>

    <div class="flex flex-1 min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" 
               :class="{ 
                   'collapsed': sidebarCollapsed, 
                   'translate-x-0': mobileOpen, 
                   '-translate-x-full lg:translate-x-0': !mobileOpen 
               }"
               class="sidebar fixed lg:sticky top-0 left-0 h-screen z-50 lg:z-30 bg-white border-r border-[#F1F5F9] flex flex-col shrink-0 transition-all duration-300 ease-in-out">
            
            <!-- Brand / Logo Area -->
            <div class="h-14 px-4 flex items-center justify-between border-b border-[#F1F5F9] shrink-0">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 overflow-hidden">
                    <!-- Clean Soft Green / Teal Logo Icon -->
                    <div class="w-7 h-7 rounded-lg bg-gradient-to-tr from-[#005B60] to-[#007A87] flex items-center justify-center shrink-0 shadow-sm shadow-[#007A87]/25 text-white">
                        <i class="ti ti-bolt text-base"></i>
                    </div>
                    <div class="sidebar-text flex items-center whitespace-nowrap">
                        <span class="text-[16px] font-extrabold tracking-tight text-[#0F172A]">{{ $settings['brand_name'] ?? 'PresensiGPS' }}</span>
                    </div>
                </a>

                <!-- Collapse Toggle Button [ | ] -->
                <button @click="sidebarCollapsed = !sidebarCollapsed" 
                        class="hidden lg:flex w-6 h-6 items-center justify-center rounded-md text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors"
                        title="Toggle Sidebar">
                    <i class="ti ti-layout-sidebar-left-collapse text-sm" :class="{ 'rotate-180': sidebarCollapsed }"></i>
                </button>

                <!-- Mobile close button -->
                <button @click="mobileOpen = false" class="lg:hidden p-1.5 text-gray-400 hover:text-gray-600 rounded-md">
                    <i class="ti ti-x text-base"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <div class="flex-1 overflow-y-auto custom-scroll py-2 space-y-2.5">

                <!-- Section: MENU UTAMA -->
                <div>
                    <a href="{{ route('admin.dashboard') }}" 
                       class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="ti ti-layout-grid text-base mr-2 {{ request()->routeIs('admin.dashboard') ? 'text-[#007A87]' : 'text-gray-400' }}"></i>
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                </div>

                <!-- Section: MASTER DATA -->
                <div>
                    <div class="sidebar-section-title px-4 pt-1.5 pb-1 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                        Master Data
                    </div>

                    <a href="{{ route('admin.memberships.index') }}" 
                       class="nav-item {{ request()->routeIs('admin.memberships.*') ? 'active' : '' }}">
                        <i class="ti ti-id-badge-2 text-base mr-2 {{ request()->routeIs('admin.memberships.*') ? 'text-[#007A87]' : 'text-gray-400' }}"></i>
                        <span class="sidebar-text">Pelanggan & Member</span>
                    </a>

                    <a href="{{ route('admin.licenses.index') }}" 
                       class="nav-item {{ request()->routeIs('admin.licenses.*') ? 'active' : '' }}">
                        <i class="ti ti-key text-base mr-2 {{ request()->routeIs('admin.licenses.*') ? 'text-[#007A87]' : 'text-gray-400' }}"></i>
                        <span class="sidebar-text">Data Lisensi</span>
                    </a>
                </div>

                <!-- Section: LANDING PAGE CMS (Flat Grouping without Dropdown) -->
                <div>
                    <div class="sidebar-section-title px-4 pt-1.5 pb-1 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                        Landing Page CMS
                    </div>

                    <a href="{{ route('admin.hero-sections.index') }}" 
                       class="nav-item {{ request()->routeIs('admin.hero-sections.*') ? 'active' : '' }}">
                        <i class="ti ti-layout-board text-base mr-2 {{ request()->routeIs('admin.hero-sections.*') ? 'text-[#007A87]' : 'text-gray-400' }}"></i>
                        <span class="sidebar-text">Hero Layout</span>
                    </a>

                    <a href="{{ route('admin.hero-stats-cards.index') }}" 
                       class="nav-item {{ request()->routeIs('admin.hero-stats-cards.*') ? 'active' : '' }}">
                        <i class="ti ti-numbers text-base mr-2 {{ request()->routeIs('admin.hero-stats-cards.*') ? 'text-[#007A87]' : 'text-gray-400' }}"></i>
                        <span class="sidebar-text">Counter Stats</span>
                    </a>

                    <a href="{{ route('admin.about-sections.index') }}" 
                       class="nav-item {{ request()->routeIs('admin.about-sections.*') ? 'active' : '' }}">
                        <i class="ti ti-info-circle text-base mr-2 {{ request()->routeIs('admin.about-sections.*') ? 'text-[#007A87]' : 'text-gray-400' }}"></i>
                        <span class="sidebar-text">About Section</span>
                    </a>

                    <a href="{{ route('admin.feature-sections.index') }}" 
                       class="nav-item {{ request()->routeIs('admin.feature-sections.*') ? 'active' : '' }}">
                        <i class="ti ti-layout-bottombar text-base mr-2 {{ request()->routeIs('admin.feature-sections.*') ? 'text-[#007A87]' : 'text-gray-400' }}"></i>
                        <span class="sidebar-text">Feature Headers</span>
                    </a>

                    <a href="{{ route('admin.features.index') }}" 
                       class="nav-item {{ request()->routeIs('admin.features.*') ? 'active' : '' }}">
                        <i class="ti ti-list-check text-base mr-2 {{ request()->routeIs('admin.features.*') ? 'text-[#007A87]' : 'text-gray-400' }}"></i>
                        <span class="sidebar-text">Feature List</span>
                    </a>

                    <a href="{{ route('admin.pricing-plans.index') }}" 
                       class="nav-item {{ request()->routeIs('admin.pricing-plans.*') ? 'active' : '' }}">
                        <i class="ti ti-tag text-base mr-2 {{ request()->routeIs('admin.pricing-plans.*') ? 'text-[#007A87]' : 'text-gray-400' }}"></i>
                        <span class="sidebar-text">Pricing Plans</span>
                    </a>

                    <a href="{{ route('admin.faq-sections.index') }}" 
                       class="nav-item {{ request()->routeIs('admin.faq-sections.*') ? 'active' : '' }}">
                        <i class="ti ti-help-hexagon text-base mr-2 {{ request()->routeIs('admin.faq-sections.*') ? 'text-[#007A87]' : 'text-gray-400' }}"></i>
                        <span class="sidebar-text">FAQ Settings</span>
                    </a>

                    <a href="{{ route('admin.faqs.index') }}" 
                       class="nav-item {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
                        <i class="ti ti-help-circle text-base mr-2 {{ request()->routeIs('admin.faqs.*') ? 'text-[#007A87]' : 'text-gray-400' }}"></i>
                        <span class="sidebar-text">FAQ Questions</span>
                    </a>

                    <a href="{{ route('admin.trusted-companies.index') }}" 
                       class="nav-item {{ request()->routeIs('admin.trusted-companies.*') ? 'active' : '' }}">
                        <i class="ti ti-building-store text-base mr-2 {{ request()->routeIs('admin.trusted-companies.*') ? 'text-[#007A87]' : 'text-gray-400' }}"></i>
                        <span class="sidebar-text">Partner Logos</span>
                    </a>

                    <a href="{{ route('admin.testimonials.index') }}" 
                       class="nav-item {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                        <i class="ti ti-message-2-star text-base mr-2 {{ request()->routeIs('admin.testimonials.*') ? 'text-[#007A87]' : 'text-gray-400' }}"></i>
                        <span class="sidebar-text">Testimonials</span>
                    </a>
                </div>

                <!-- Section: PENGATURAN -->
                <div>
                    <div class="sidebar-section-title px-4 pt-1.5 pb-1 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                        Pengaturan
                    </div>

                    <a href="{{ route('admin.site-settings.index') }}" 
                       class="nav-item {{ request()->routeIs('admin.site-settings.*') ? 'active' : '' }}">
                        <i class="ti ti-settings text-base mr-2 {{ request()->routeIs('admin.site-settings.*') ? 'text-[#007A87]' : 'text-gray-400' }}"></i>
                        <span class="sidebar-text">Site Settings</span>
                    </a>

                    <a href="{{ route('profile.edit') }}" 
                       class="nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        <i class="ti ti-user text-base mr-2 {{ request()->routeIs('profile.*') ? 'text-[#007A87]' : 'text-gray-400' }}"></i>
                        <span class="sidebar-text">Profil Admin</span>
                    </a>
                </div>

                <!-- Section: KELUAR -->
                <div class="pt-1 pb-4">
                    <form method="POST" action="{{ route('logout') }}" id="sidebar-logout-form">
                        @csrf
                        <button type="submit" class="w-[calc(100%-16px)] nav-item text-rose-500 hover:bg-rose-50 hover:text-rose-600 cursor-pointer">
                            <i class="ti ti-logout text-base mr-2"></i>
                            <span class="sidebar-text">Sign Out</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 min-h-screen">
            
            <!-- Top Navbar -->
            <header class="h-16 bg-white border-b border-[#F1F5F9] px-4 lg:px-6 sticky top-0 z-30 flex items-center justify-between">
                <!-- Left: Mobile Toggle -->
                <div class="flex items-center gap-3">
                    <button @click="mobileOpen = true" class="lg:hidden p-2 text-gray-500 hover:text-[#007A87] rounded-lg">
                        <i class="ti ti-menu-2 text-xl"></i>
                    </button>
                </div>

                <!-- Center / Right: Clean Search & Quick Actions -->
                <div class="flex items-center gap-2 sm:gap-3 ml-auto">
                    
                    <!-- Clean Search Box -->
                    <div class="relative w-48 sm:w-64 hidden sm:block">
                        <div class="flex items-center bg-[#F8FAFC] border border-[#E2E8F0] rounded-xl px-3 py-1.5 focus-within:border-[#007A87] focus-within:ring-2 focus-within:ring-[#007A87]/15 transition-all">
                            <i class="ti ti-search text-gray-400 text-sm mr-2"></i>
                            <input type="text" 
                                   placeholder="Cari menu & aksi cepat..." 
                                   class="bg-transparent border-none text-[12.5px] text-gray-700 placeholder-gray-400 p-0 focus:outline-none focus:ring-0 w-full font-medium">
                            <span class="text-[10px] bg-white border border-[#CBD5E1] text-gray-400 font-bold px-1.5 py-0.5 rounded shadow-2xs">⌘K</span>
                        </div>
                    </div>

                    <!-- Sun / Dark Toggle -->
                    <button class="w-8 h-8 rounded-xl border border-gray-200/80 flex items-center justify-center text-gray-500 hover:text-gray-800 hover:bg-gray-50 transition-colors">
                        <i class="ti ti-sun text-sm"></i>
                    </button>

                    <!-- Shortcut / Calculator -->
                    <button class="w-8 h-8 rounded-xl border border-gray-200/80 flex items-center justify-center text-gray-500 hover:text-gray-800 hover:bg-gray-50 transition-colors">
                        <i class="ti ti-calculator text-sm"></i>
                    </button>

                    <!-- Notification Bell -->
                    <button class="w-8 h-8 rounded-xl border border-gray-200/80 flex items-center justify-center text-gray-500 hover:text-gray-800 hover:bg-gray-50 transition-colors relative">
                        <i class="ti ti-bell text-sm"></i>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-[#007A87]"></span>
                    </button>

                    <!-- Prominent Soft Teal Pill: Live Site / AI Support -->
                    <a href="{{ route('landing') }}" target="_blank" 
                       class="hidden sm:inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
                        <i class="ti ti-sparkles text-sm"></i>
                        <span>Live Site</span>
                    </a>

                    <!-- User Profile Dropdown -->
                    <div class="relative ml-1" x-data="{ userMenu: false }">
                        <button @click="userMenu = !userMenu" class="flex items-center gap-2 p-1 rounded-xl hover:bg-gray-50 transition-colors">
                            <div class="w-8 h-8 rounded-xl bg-teal-50 border border-teal-200 flex items-center justify-center text-[#007A87] font-bold text-xs uppercase">
                                {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                            </div>
                            <span class="text-xs font-semibold text-gray-700 hidden md:block">{{ Auth::user()->name ?? 'Admin' }}</span>
                            <i class="ti ti-chevron-down text-xs text-gray-400 hidden sm:block"></i>
                        </button>

                        <div x-show="userMenu" 
                             @click.outside="userMenu = false" 
                             x-cloak 
                             class="absolute right-0 mt-2 w-52 bg-white rounded-2xl shadow-xl border border-gray-100 py-1.5 z-50">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-xs font-bold text-gray-900">{{ Auth::user()->name ?? 'Admin' }}</p>
                                <p class="text-[11px] text-gray-400 truncate">{{ Auth::user()->email ?? 'admin@example.com' }}</p>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 text-xs font-medium text-gray-700 hover:bg-gray-50 hover:text-[#007A87]">
                                <i class="ti ti-user text-base"></i>
                                <span>Profil Akun</span>
                            </a>
                            <a href="{{ route('admin.site-settings.index') }}" class="flex items-center gap-2 px-4 py-2 text-xs font-medium text-gray-700 hover:bg-gray-50 hover:text-[#007A87]">
                                <i class="ti ti-settings text-base"></i>
                                <span>Site Settings</span>
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-xs font-semibold text-rose-500 hover:bg-rose-50">
                                    <i class="ti ti-logout text-base"></i>
                                    <span>Sign Out</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content Body -->
            <main class="flex-1 p-4 lg:p-6 custom-scroll">
                
                <!-- Page Top Bar: Title, Subtitle & Breadcrumbs -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
                    <div>
                        <h1 class="text-xl lg:text-2xl font-extrabold text-[#0F172A] tracking-tight">
                            @yield('title', 'Dashboard Utama & Pusat Analitik')
                        </h1>
                        <p class="text-xs text-[#64748B] mt-1 font-medium">
                            @yield('subtitle', 'Ringkasan operasional bisnis, pemantauan inventaris real-time, dan tren analitik penjualan terpadu.')
                        </p>
                    </div>

                    <!-- Breadcrumbs & Actions -->
                    <div class="flex items-center gap-2.5">
                        @hasSection('actions')
                            @yield('actions')
                        @endif

                        <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white border border-[#E2E8F0]/70 text-xs text-[#64748B] shadow-2xs font-medium">
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-[#007A87] flex items-center gap-1">
                                <i class="ti ti-home text-sm"></i>
                                <span>Home</span>
                            </a>
                            <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
                            <span class="text-[#0F172A] font-semibold">@yield('title', 'Dashboard')</span>
                        </div>
                    </div>
                </div>

                <!-- Flash Message Alerts -->
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between" role="alert">
                        <div class="flex items-center gap-2.5">
                            <i class="ti ti-circle-check text-xl text-emerald-600"></i>
                            <span class="text-sm font-semibold">{{ session('success') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">
                            <i class="ti ti-x text-base"></i>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 flex items-center justify-between" role="alert">
                        <div class="flex items-center gap-2.5">
                            <i class="ti ti-alert-triangle text-xl text-rose-600"></i>
                            <span class="text-sm font-semibold">{{ session('error') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700">
                            <i class="ti ti-x text-base"></i>
                        </button>
                    </div>
                @endif

                <!-- Yield Page Content -->
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Global Confirmation Modal -->
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
         class="fixed inset-0 z-50 overflow-y-auto" 
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
                 class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs transition-opacity"></div>

            <div x-show="isOpen" 
                 x-transition:enter="ease-out duration-300" 
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                 x-transition:leave="ease-in duration-200" 
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative bg-white rounded-2xl overflow-hidden shadow-2xl transform transition-all sm:max-w-md sm:w-full p-6 text-left border border-gray-100">
                
                <div class="flex items-start gap-4">
                    <div :class="{
                        'bg-amber-50 text-amber-600': type === 'warning',
                        'bg-teal-50 text-[#007A87]': type === 'info',
                        'bg-rose-50 text-rose-600': type === 'danger'
                    }" class="w-12 h-12 rounded-xl shrink-0 flex items-center justify-center text-2xl">
                        <i :class="icon"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-base font-bold text-gray-900 mb-1" x-text="title"></h3>
                        <p class="text-xs text-gray-500 font-medium leading-relaxed" x-text="message"></p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-2.5">
                    <button @click="closeModal()" type="button" class="px-4 py-2 rounded-xl border border-gray-200 text-xs font-semibold text-gray-600 hover:bg-gray-50 transition-all">
                        Batal
                    </button>
                    <button @click="confirmAction()" type="button" 
                            :class="{
                                'bg-amber-500 hover:bg-amber-600 text-white': type === 'warning',
                                'bg-[#007A87] hover:bg-[#005B60] text-white': type === 'info',
                                'bg-rose-600 hover:bg-rose-700 text-white': type === 'danger'
                            }"
                            class="px-5 py-2 rounded-xl text-xs font-semibold shadow-sm transition-all">
                        Ya, Lanjutkan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Global Confirmation Modal helper -->
    <script>
        window.confirmDialog = function(options) {
            window.dispatchEvent(new CustomEvent('confirm', {
                detail: options
            }));
        };
    </script>

    @stack('scripts')
</body>
</html>
