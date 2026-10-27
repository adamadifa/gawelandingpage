<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Gawe') }} - @yield('title', 'Member Dashboard')</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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

        .font-display { font-family: 'Outfit', sans-serif; }

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
            gap: 9px;
            padding: 5px 9px;
            margin: 1px 6px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            color: #475569;
            transition: all 0.15s ease;
            position: relative;
        }

        .nav-item i {
            color: #64748B;
            transition: color 0.15s ease;
        }

        .nav-item:hover {
            background-color: #F8FAFC;
            color: #0F172A;
        }

        .nav-item:hover i {
            color: #0F172A;
        }

        .nav-item.active {
            color: #007A87;
            font-weight: 600;
            background-color: #F0FDFA;
            border: 1px solid #CCFBF1;
            box-shadow: 0 1px 2px rgba(0, 122, 135, 0.05);
        }

        .nav-item.active i {
            color: #007A87 !important;
        }

        .sidebar-section-title {
            font-size: 10.5px;
            font-weight: 600;
            color: #94A3B8;
            padding: 5px 12px 1px 12px;
        }

        .sidebar .custom-scroll::-webkit-scrollbar-thumb {
            background: #E2E8F0;
        }
        .sidebar .custom-scroll::-webkit-scrollbar-thumb:hover {
            background: #CBD5E1;
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
        
        <!-- Sidebar Clean Reference Style -->
        <aside id="sidebar" 
               :class="{ 
                   'collapsed': sidebarCollapsed, 
                   'translate-x-0': mobileOpen, 
                   '-translate-x-full lg:translate-x-0': !mobileOpen 
               }"
               class="sidebar fixed lg:sticky top-0 left-0 h-screen z-50 lg:z-30 bg-white border-r border-[#E2E8F0] flex flex-col shrink-0 transition-all duration-300 ease-in-out">
            
            <!-- Brand / Logo Area -->
            <div class="h-16 px-4 flex items-center justify-between border-b border-[#F1F5F9] shrink-0">
                <a href="{{ route('member.dashboard') }}" class="flex items-center gap-2.5 overflow-hidden">
                    <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-[#005B60] to-[#007A87] flex items-center justify-center shrink-0 shadow-sm shadow-[#007A87]/20 text-white">
                        <i class="ti ti-bolt text-lg"></i>
                    </div>
                    <div class="sidebar-text flex items-center whitespace-nowrap">
                        <span class="text-[15px] font-bold tracking-tight text-[#0F172A]">{{ $settings['brand_name'] ?? 'PresensiGPS' }}</span>
                    </div>
                </a>

                <!-- Collapse Toggle Button [ | ] for Desktop -->
                <button @click="sidebarCollapsed = !sidebarCollapsed" 
                        class="hidden lg:flex w-7 h-7 items-center justify-center rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-colors cursor-pointer"
                        title="Toggle Sidebar">
                    <i class="ti ti-layout-sidebar-left-collapse text-base" :class="{ 'rotate-180': sidebarCollapsed }"></i>
                </button>

                <!-- Close Button for Mobile Drawer -->
                <button @click="mobileOpen = false" 
                        class="lg:hidden w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-colors cursor-pointer"
                        title="Tutup Menu">
                    <i class="ti ti-x text-lg"></i>
                </button>
            </div>

            <!-- Sidebar Navigation Links -->
            <div class="flex-1 overflow-y-auto custom-scroll py-1.5 space-y-1.5">

                <!-- Section: Menu Utama -->
                <div>
                    <div class="sidebar-section-title">
                        Menu Utama
                    </div>

                    <a href="{{ route('member.dashboard') }}" 
                       class="nav-item {{ request()->routeIs('member.dashboard') ? 'active' : '' }}">
                        <i class="ti ti-layout-grid text-lg shrink-0"></i>
                        <span class="sidebar-text">Dashboard</span>
                    </a>

                    <a href="{{ route('member.source-code') }}" 
                       class="nav-item {{ request()->routeIs('member.source-code') ? 'active' : '' }}">
                        <i class="ti ti-code text-lg shrink-0"></i>
                        <span class="sidebar-text">Akses Source Code</span>
                    </a>

                    <a href="{{ route('landing') }}#pricing" 
                       class="nav-item">
                        <i class="ti ti-shopping-cart text-lg shrink-0"></i>
                        <span class="sidebar-text">Beli Lisensi Baru</span>
                    </a>
                </div>

                <!-- Section: Bantuan & Layanan -->
                <div>
                    <div class="sidebar-section-title">
                        Bantuan & Layanan
                    </div>

                    <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}?text=Halo%20Admin,%20saya%20member%20membutuhkan%20bantuan" 
                       target="_blank" 
                       class="nav-item">
                        <i class="ti ti-brand-whatsapp text-lg shrink-0"></i>
                        <span class="sidebar-text">Technical Support</span>
                    </a>

                    <a href="{{ route('landing') }}" 
                       target="_blank" 
                       class="nav-item">
                        <i class="ti ti-world text-lg shrink-0"></i>
                        <span class="sidebar-text">Lihat Live Website</span>
                    </a>
                </div>

                <!-- Section: Akun Pengguna -->
                <div>
                    <div class="sidebar-section-title">
                        Akun Pengguna
                    </div>

                    <a href="{{ route('profile.edit') }}" 
                       class="nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        <i class="ti ti-user text-lg shrink-0"></i>
                        <span class="sidebar-text">Profil Pengguna</span>
                    </a>
                </div>

                <!-- Section: SIGN OUT -->
                <div class="pt-0.5 pb-2">
                    <form method="POST" action="{{ route('logout') }}" id="sidebar-logout-form">
                        @csrf
                        <button type="submit" class="w-[calc(100%-12px)] nav-item text-slate-600 hover:bg-rose-50 hover:text-rose-600 cursor-pointer group">
                            <i class="ti ti-logout text-lg shrink-0 text-slate-400 group-hover:text-rose-500"></i>
                            <span class="sidebar-text">Keluar (Sign Out)</span>
                        </button>
                    </form>
                </div>

            </div>

            <!-- Sidebar Footer (Profile Summary) -->
            <div class="sidebar-footer p-3 border-t border-[#F1F5F9] bg-[#F8FAFC] shrink-0">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-teal-50 border border-teal-200 flex items-center justify-center text-[#007A87] font-bold text-xs uppercase shrink-0">
                        {{ substr(Auth::user()->name ?? 'M', 0, 1) }}
                    </div>
                    <div class="overflow-hidden leading-tight flex-1">
                        <p class="text-xs font-bold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-[11px] text-gray-400 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>

        </aside>

        <!-- Main Content Area Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 min-h-screen">
            
            <!-- Top Navbar -->
            <header class="h-14 sm:h-16 bg-white border-b border-[#F1F5F9] px-3 sm:px-6 sticky top-0 z-30 flex items-center justify-between">
                
                <!-- Left: Mobile Toggle -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <button @click="mobileOpen = true" class="lg:hidden p-1.5 sm:p-2 text-gray-500 hover:text-[#007A87] rounded-lg cursor-pointer">
                        <i class="ti ti-menu-2 text-xl"></i>
                    </button>
                    
                    <span class="text-xs font-medium text-slate-500 hidden sm:inline-block">
                        Area Member
                    </span>
                </div>

                <!-- Right: Quick Actions & Profile -->
                <div class="flex items-center gap-2 sm:gap-3 ml-auto">
                    
                    <!-- WhatsApp Assistance -->
                    <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" target="_blank" 
                       class="hidden md:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-gray-200 text-gray-600 hover:text-emerald-700 hover:bg-emerald-50 text-xs font-bold transition-all">
                        <i class="ti ti-brand-whatsapp text-emerald-600 text-sm"></i>
                        <span>Bantuan CS</span>
                    </a>

                    <!-- Prominent Soft Teal Pill: Live Site -->
                    <a href="{{ route('landing') }}" target="_blank" 
                       class="inline-flex items-center gap-1 sm:gap-1.5 px-2.5 sm:px-3.5 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
                        <i class="ti ti-sparkles text-sm"></i>
                        <span class="hidden xs:inline">Live Site</span>
                        <span class="xs:hidden">Live</span>
                    </a>

                    <!-- User Profile Dropdown -->
                    <div class="relative ml-0.5 sm:ml-1" x-data="{ userMenu: false }">
                        <button @click="userMenu = !userMenu" class="flex items-center gap-1.5 sm:gap-2 p-1 rounded-xl hover:bg-gray-50 transition-colors cursor-pointer">
                            <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg sm:rounded-xl bg-teal-50 border border-teal-200 flex items-center justify-center text-[#007A87] font-bold text-xs uppercase">
                                {{ substr(Auth::user()->name ?? 'M', 0, 1) }}
                            </div>
                            <span class="text-xs font-semibold text-gray-700 hidden md:block">{{ Auth::user()->name }}</span>
                            <i class="ti ti-chevron-down text-xs text-gray-400 hidden sm:block"></i>
                        </button>

                        <div x-show="userMenu" 
                             @click.outside="userMenu = false" 
                             x-cloak 
                             class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 py-1.5 z-50">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-xs font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                <p class="text-[11px] text-gray-400 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="{{ route('member.dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-xs font-medium text-gray-700 hover:bg-gray-50 hover:text-[#007A87]">
                                <i class="ti ti-layout-grid text-base"></i>
                                <span>Dashboard Saya</span>
                            </a>
                            <a href="{{ route('member.source-code') }}" class="flex items-center gap-2 px-4 py-2 text-xs font-medium text-gray-700 hover:bg-gray-50 hover:text-[#007A87]">
                                <i class="ti ti-code text-base"></i>
                                <span>Akses Source Code</span>
                            </a>
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 text-xs font-medium text-gray-700 hover:bg-gray-50 hover:text-[#007A87]">
                                <i class="ti ti-user text-base"></i>
                                <span>Profil Akun</span>
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-xs font-semibold text-rose-500 hover:bg-rose-50 cursor-pointer">
                                    <i class="ti ti-logout text-base"></i>
                                    <span>Sign Out</span>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </header>

            <!-- Page Content Body -->
            <main class="flex-1 p-3 sm:p-5 lg:p-6 custom-scroll">
                
                <!-- Page Top Bar: Title, Subtitle & Breadcrumbs -->
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 sm:gap-4 mb-4 sm:mb-6">
                    <div>
                        <h1 class="text-lg sm:text-xl lg:text-2xl font-extrabold text-[#0F172A] tracking-tight">
                            @yield('title', 'Member Dashboard')
                        </h1>
                        <p class="text-xs text-[#64748B] mt-0.5 sm:mt-1 font-medium">
                            @yield('subtitle', 'Pantau lisensi aktif aplikasi, status sistem operasional, dan histori transaksi pembayaran Anda.')
                        </p>
                    </div>

                    <!-- Breadcrumbs & Actions -->
                    <div class="flex flex-wrap items-center gap-2 sm:gap-2.5">
                        @hasSection('actions')
                            @yield('actions')
                        @endif

                        <div class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white border border-[#E2E8F0]/70 text-xs text-[#64748B] shadow-2xs font-medium">
                            <a href="{{ route('member.dashboard') }}" class="hover:text-[#007A87] flex items-center gap-1">
                                <i class="ti ti-home text-sm"></i>
                                <span>Member</span>
                            </a>
                            <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
                            <span class="text-[#0F172A] font-semibold">@yield('title', 'Dashboard')</span>
                        </div>
                    </div>
                </div>

                <!-- Flash Message Alerts -->
                @if(session('success'))
                    <div class="mb-4 sm:mb-6 p-3.5 sm:p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between" role="alert">
                        <div class="flex items-center gap-2.5">
                            <i class="ti ti-circle-check text-xl text-emerald-600 shrink-0"></i>
                            <span class="text-xs sm:text-sm font-semibold">{{ session('success') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 cursor-pointer p-1">
                            <i class="ti ti-x text-base"></i>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 sm:mb-6 p-3.5 sm:p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 flex items-center justify-between" role="alert">
                        <div class="flex items-center gap-2.5">
                            <i class="ti ti-alert-triangle text-xl text-rose-600 shrink-0"></i>
                            <span class="text-xs sm:text-sm font-semibold">{{ session('error') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700 cursor-pointer p-1">
                            <i class="ti ti-x text-base"></i>
                        </button>
                    </div>
                @endif

                @if(session('info'))
                    <div class="mb-4 sm:mb-6 p-3.5 sm:p-4 rounded-xl bg-blue-50 border border-blue-200 text-blue-800 flex items-center justify-between" role="alert">
                        <div class="flex items-center gap-2.5">
                            <i class="ti ti-info-circle text-xl text-blue-600 shrink-0"></i>
                            <span class="text-xs sm:text-sm font-semibold">{{ session('info') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove()" class="text-blue-500 hover:text-blue-700 cursor-pointer p-1">
                            <i class="ti ti-x text-base"></i>
                        </button>
                    </div>
                @endif

                <!-- Yield Content -->
                @yield('content')

            </main>

            <!-- Footer Minimal -->
            <footer class="py-3 sm:h-12 border-t border-[#F1F5F9] px-4 sm:px-6 flex flex-col sm:flex-row items-center justify-between gap-2 text-[11px] text-[#64748B] bg-white shrink-0 text-center sm:text-left">
                <div>
                    <span>© {{ date('Y') }} <strong>{{ $settings['brand_name'] ?? 'PresensiGPS' }}</strong>. Member Portal.</span>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('landing') }}" class="hover:text-[#007A87]">Beranda</a>
                    <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" target="_blank" class="hover:text-[#007A87]">Bantuan WhatsApp</a>
                </div>
            </footer>

        </div>

    </div>

    @stack('scripts')
</body>
</html>
