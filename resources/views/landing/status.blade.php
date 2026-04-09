<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Membership | {{ config('app.name') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #fcfcfd; }
        .font-display { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col items-center justify-center py-12 px-6">
    
    <div class="max-w-xl w-full">
        <div class="text-center mb-10">
            <a href="{{ route('landing') }}" class="inline-flex items-center gap-2 mb-8 group">
                <div class="w-10 h-10 bg-brand-600 rounded-xl flex items-center justify-center shadow-lg shadow-brand-600/20">
                    <span class="text-white font-display font-bold text-xl">P</span>
                </div>
                <span class="font-display text-2xl font-bold text-gray-900 group-hover:text-brand-600 transition-colors">PresensiGPS V2</span>
            </a>
            <h1 class="font-display text-4xl font-bold text-gray-900">Status Membership</h1>
        </div>

        <div class="bg-white rounded-3xl border border-gray-100 shadow-xl overflow-hidden p-8 lg:p-12">
            
            @if($subscription && $subscription->status === 'active')
                {{-- Active Subscription --}}
                <div class="text-center space-y-6">
                    <div class="w-24 h-24 bg-emerald-50 rounded-full flex items-center justify-center text-emerald-600 mx-auto animate-bounce duration-1000">
                        <i class="ti ti-circle-check text-5xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Langganan Anda Aktif!</h2>
                        <p class="text-gray-500 mt-2">Terima kasih telah bergabung. Paket <b>{{ $subscription->pricingPlan->name }}</b> Anda sekarang sudah aktif.</p>
                    </div>

                    <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100 relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-4 opacity-5">
                            <i class="ti ti-key text-8xl"></i>
                        </div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest leading-none mb-3">Kode Lisensi Anda</p>
                        <div class="font-display text-3xl font-black text-brand-600 tracking-wider mb-2">{{ $subscription->license_code }}</div>
                        <p class="text-xs font-medium text-gray-400">Gunakan kode ini untuk aktivasi aplikasi Anda.</p>
                    </div>

                    <div class="pt-6 border-t border-gray-100 grid grid-cols-2 gap-6 text-center">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest leading-none mb-2">Tanggal Berakhir</p>
                            <p class="font-bold text-gray-900">{{ $subscription->ends_at->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest leading-none mb-2">Sisa Hari</p>
                            <p class="font-bold text-brand-600">{{ number_format(now()->diffInDays($subscription->ends_at), 0, ',', '.') }} Hari Lagi</p>
                        </div>
                    </div>
                </div>
            @elseif($transaction && $transaction->status === 'pending')
                {{-- Pending Verification --}}
                <div class="text-center space-y-6">
                    <div class="w-24 h-24 bg-amber-50 rounded-full flex items-center justify-center text-amber-600 mx-auto animate-pulse">
                        <i class="ti ti-progress-check text-5xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Menunggu Verifikasi</h2>
                        <p class="text-gray-500 mt-2 leading-relaxed">Pembayaran Anda sebesar <b>Rp {{ number_format($transaction->amount) }}</b> sedang diverifikasi oleh tim admin kami.</p>
                    </div>
                    <div class="bg-amber-50 border border-amber-100 rounded-2xl p-6 text-amber-700 text-sm font-medium flex gap-4">
                        <div class="flex-shrink-0 mt-1"><i class="ti ti-info-circle text-xl"></i></div>
                        <p class="text-left">Biasanya proses verifikasi memakan waktu 1-24 jam. Kami akan Segera mengaktifkan lisensi Anda setelah disetujui.</p>
                    </div>
                </div>
            @elseif($transaction && $transaction->status === 'rejected')
                {{-- Rejected --}}
                <div class="text-center space-y-6">
                    <div class="w-24 h-24 bg-rose-50 rounded-full flex items-center justify-center text-rose-600 mx-auto">
                        <i class="ti ti-circle-x text-5xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Pembayaran Ditolak</h2>
                        <p class="text-gray-500 mt-2">Maaf, terjadi masalah saat verifikasi pembayaran Anda.</p>
                    </div>
                    <div class="bg-rose-50 border border-rose-100 rounded-2xl p-6 text-rose-700 text-sm font-medium text-left">
                        <p class="font-bold mb-1 italic">Catatan Admin:</p>
                        <p>{{ $transaction->admin_note ?? 'Bukti transfer tidak terbaca atau tidak valid.' }}</p>
                    </div>
                    <a href="{{ route('landing') }}#pricing" class="block w-full bg-gray-900 text-white font-bold py-4 rounded-xl transition-all hover:bg-gray-800">Coba Checkout Lagi</a>
                </div>
            @else
                {{-- No Transaction Found --}}
                <div class="text-center space-y-6">
                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 mx-auto">
                        <i class="ti ti-help-circle text-5xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Belum Ada Membership</h2>
                        <p class="text-gray-500 mt-2">Silakan pilih paket langganan untuk mulai menggunakan layanan kami.</p>
                    </div>
                    <a href="{{ route('landing') }}#pricing" class="block w-full bg-brand-600 text-white font-bold py-4 rounded-xl transition-all hover:bg-brand-700 shadow-lg shadow-brand-600/20">Lihat Paket Harga</a>
                </div>
            @endif

        </div>

        <div class="text-center mt-10">
            <a href="{{ route('landing') }}" class="text-sm font-bold text-gray-400 hover:text-brand-600 transition-colors flex items-center justify-center gap-2">
                <i class="ti ti-arrow-left"></i>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>
