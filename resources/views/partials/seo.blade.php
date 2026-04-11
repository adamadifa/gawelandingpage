<!-- Primary Meta Tags -->
<title>{{ $settings['brand_name'] ?? config('app.name', 'PresensiGPS') }} - {{ $settings['tagline'] ?? 'Solusi Absensi & Payroll Modern' }}</title>
<meta name="title" content="{{ $settings['brand_name'] ?? config('app.name', 'PresensiGPS') }} - {{ $settings['tagline'] ?? 'Solusi Absensi & Payroll Modern' }}">
<meta name="description" content="{{ $settings['meta_description'] ?? 'Kelola Absensi & Payroll Karyawan Lebih Efisien, Transparan, & Akurat dengan PresensiGPS. Aplikasi Absensi GPS Geofencing terbaik.' }}">
<meta name="keywords" content="{{ $settings['meta_keywords'] ?? 'absensi gps, payroll otomatis, manajemen karyawan, hr software, geofencing, presensi digital' }}">
<meta name="author" content="{{ $settings['brand_name'] ?? 'PresensiGPS Team' }}">
<meta name="robots" content="index, follow">
<link rel="canonical" href="{{ url()->current() }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $settings['brand_name'] ?? config('app.name', 'PresensiGPS') }} - {{ $settings['tagline'] ?? 'Solusi Absensi & Payroll Modern' }}">
<meta property="og:description" content="{{ $settings['meta_description'] ?? 'Kelola Absensi & Payroll Karyawan Lebih Efisien, Transparan, & Akurat dengan PresensiGPS.' }}">
<meta property="og:image" content="{{ isset($settings['brand_logo']) ? asset('storage/' . $settings['brand_logo']) : asset('images/og-image.png') }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ url()->current() }}">
<meta property="twitter:title" content="{{ $settings['brand_name'] ?? config('app.name', 'PresensiGPS') }} - {{ $settings['tagline'] ?? 'Solusi Absensi & Payroll Modern' }}">
<meta property="twitter:description" content="{{ $settings['meta_description'] ?? 'Kelola Absensi & Payroll Karyawan Lebih Efisien, Transparan, & Akurat dengan PresensiGPS.' }}">
<meta property="twitter:image" content="{{ isset($settings['brand_logo']) ? asset('storage/' . $settings['brand_logo']) : asset('images/og-image.png') }}">

<!-- Favicons -->
@if(isset($settings['brand_logo']) && $settings['brand_logo'])
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $settings['brand_logo']) }}">
    <link rel="apple-touch-icon" href="{{ asset('storage/' . $settings['brand_logo']) }}">
@else
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
@endif

<!-- Mobile Headers -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
