<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Dashboard | {{ $settings['brand_name'] ?? 'PresensiGPS' }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@400;500;600;700;800&family=Outfit:wght@600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Poppins', 'Inter', sans-serif; background-color: #f8fafc; }
        .font-display { font-family: 'Outfit', sans-serif; }
        
        .main-container {
            width: 100%;
            max-width: 100%;
            padding-left: 24px;
            padding-right: 24px;
        }

        @media (min-width: 1024px) {
            .main-container {
                padding-left: 40px;
                padding-right: 40px;
            }
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="antialiased" x-data="{ openDetail: false, selectedTrx: null }">
    
    <!-- Navigation -->
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="px-6 lg:px-10 h-20 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-10 h-10 flex items-center justify-center overflow-hidden transition-all duration-300 group-hover:scale-105">
                    @if(isset($settings['brand_logo']) && $settings['brand_logo'])
                        <img src="{{ asset('storage/' . $settings['brand_logo']) }}" alt="Logo" class="w-full h-full object-contain filter brightness-100 invert-0">
                    @else
                        <div class="w-full h-full bg-brand-600 rounded-lg flex items-center justify-center shadow-inner">
                            <span class="text-white font-display font-bold text-lg leading-none">{{ substr($settings['brand_name'] ?? 'P', 0, 1) }}</span>
                        </div>
                    @endif
                </div>
                <span class="font-display text-xl font-bold">
                    <span class="text-brand-700">{{ $settings['brand_name'] ?? 'PresensiGPS' }}</span>
                </span>
            </a>
            <div class="flex items-center gap-4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-rose-50 hover:text-rose-600 transition-all border border-transparent hover:border-rose-100 shadow-sm active:scale-95">
                        <i class="ti ti-logout text-xl"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="py-12 lg:py-16">
        <div class="main-container">
            
            {{-- Welcome Section --}}
            <div class="mb-12 flex flex-col lg:flex-row lg:items-end justify-between gap-6">
                <div>
                    <h1 class="text-4xl lg:text-5xl font-display font-bold text-gray-900 leading-tight">Halo, <span class="text-brand-600">{{ auth()->user()->name }}</span>!</h1>
                    <p class="text-gray-500 mt-2 text-lg">Kelola semua lisensi dan pantau histori paket bisnis anda.</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('landing') }}#pricing" class="px-8 py-4 bg-brand-600 hover:bg-brand-700 text-white rounded-2xl font-display font-bold transition-all shadow-xl shadow-brand-600/20 active:scale-95 flex items-center gap-3 text-xs uppercase tracking-widest">
                        <i class="ti ti-plus text-lg"></i>
                        Beli Lisensi Baru
                    </a>
                </div>
            </div>

            <div class="grid lg:grid-cols-4 gap-10">
                {{-- Left Side: Profile & Licenses --}}
                <div class="lg:col-span-1 space-y-10">
                    
                    {{-- User Profile Card --}}
                    <div class="bg-white rounded-3xl p-10 border border-gray-100 shadow-xl space-y-8 relative overflow-hidden">
                        {{-- Decoration --}}
                        <div class="absolute -top-12 -right-12 w-32 h-32 bg-brand-50 rounded-full blur-3xl opacity-50"></div>
                        
                        <div class="relative z-10 flex flex-col items-center text-center">
                            <div class="w-24 h-24 bg-brand-50 rounded-3xl flex items-center justify-center text-brand-600 border border-brand-100/50 mb-6 shadow-inner overflow-hidden">
                                <span class="text-4xl font-display font-black uppercase">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 uppercase tracking-tight">{{ auth()->user()->name }}</h3>
                            <p class="text-sm text-gray-400 font-medium mt-1">{{ auth()->user()->email }}</p>
                            
                            <div class="mt-6 flex items-center gap-2">
                                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest bg-brand-50 text-brand-600 border border-brand-100/50">
                                    Member Account
                                </span>
                            </div>
                        </div>

                        <div class="pt-8 border-t border-gray-50 space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Bergabung</span>
                                <span class="text-xs font-bold text-gray-700">{{ auth()->user()->created_at->format('M Y') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Status</span>
                                <span class="text-xs font-bold text-emerald-600 uppercase tracking-tight">Terverifikasi</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl p-10 border border-gray-100 shadow-xl space-y-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center text-brand-600 shadow-sm border border-gray-100/50">
                                <i class="ti ti-headset text-2xl"></i>
                            </div>
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Bantuan</h4>
                        </div>
                        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" target="_blank" class="flex items-center justify-between group p-6 bg-gray-50 rounded-2xl hover:bg-brand-50 transition-all border border-transparent hover:border-brand-100 active:scale-95">
                            <div class="flex items-center gap-4">
                                <div class="w-9 h-9 bg-white rounded-xl shadow-sm flex items-center justify-center text-brand-600 group-hover:scale-110 group-hover:rotate-6 transition-all border border-gray-100">
                                    <i class="ti ti-brand-whatsapp text-lg"></i>
                                </div>
                                <span class="text-[10px] font-bold text-gray-700 uppercase tracking-widest">WhatsApp</span>
                            </div>
                            <i class="ti ti-arrow-right text-gray-300 group-hover:text-brand-500 group-hover:translate-x-1 transition-all"></i>
                        </a>
                    </div>
                </div>

                {{-- Right Column: Active Services & History --}}
                <div class="lg:col-span-3 space-y-12">
                    
                    {{-- Active Licenses Section --}}
                    <div class="space-y-6">
                        <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest pl-1">Layanan Aktif ({{ $subscriptions->count() }})</h3>
                        
                        <div class="grid sm:grid-cols-2 gap-6">
                            @forelse($subscriptions as $sub)
                                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-xl relative overflow-hidden group transition-all duration-500 hover:scale-[1.02]">
                                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-brand-50 rounded-full blur-3xl group-hover:bg-brand-100 transition-all duration-700"></div>
                                    
                                    <div class="relative z-10 space-y-8">
                                        <div class="flex justify-between items-start">
                                            <div class="w-14 h-14 bg-brand-600 rounded-2xl flex items-center justify-center shadow-lg shadow-brand-600/20">
                                                @if($sub->pricingPlan->icon_type == 'image' && $sub->pricingPlan->icon)
                                                    <img src="{{ asset('storage/' . $sub->pricingPlan->icon) }}" class="w-full h-full object-contain p-2.5 filter brightness-0 invert">
                                                @else
                                                    <i class="ti ti-crown text-2xl text-white"></i>
                                                @endif
                                            </div>
                                            <span class="bg-brand-50 text-brand-600 px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest border border-brand-100/50">Active</span>
                                        </div>

                                        <div>
                                            <h4 class="text-lg font-display font-black text-gray-900 uppercase tracking-tight leading-none mb-1">{{ $sub->pricingPlan->name }}</h4>
                                            <p class="text-[10px] font-bold text-brand-600 uppercase tracking-widest flex items-center gap-1.5 pl-0.5">
                                                Expiry: {{ \Carbon\Carbon::parse($sub->ends_at)->format('d M Y') }}
                                            </p>
                                        </div>

                                        <div class="bg-gray-50 rounded-2xl p-4 flex items-center justify-between border border-gray-100/50 group/code cursor-pointer active:scale-95 transition-all" onclick="copyToClipboard('{{ $sub->license_code }}')">
                                            <span class="text-xs font-display font-black tracking-widest text-gray-800">{{ $sub->license_code }}</span>
                                            <i class="ti ti-copy text-sm text-gray-300 group-hover/code:text-brand-600 transition-all"></i>
                                        </div>

                                        <div class="pt-2">
                                            <a href="{{ route('checkout.index', $sub->pricing_plan_id) }}?subscription_id={{ $sub->id }}" class="flex items-center justify-center w-full bg-gray-900 text-white font-black py-4 rounded-2xl transition-all shadow-xl shadow-gray-900/10 active:scale-95 uppercase tracking-widest text-[9px] border border-transparent hover:bg-gray-800">
                                                Perpanjang Lisensi
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="sm:col-span-2 bg-white rounded-3xl p-12 border border-gray-100 shadow-xl text-center space-y-6">
                                    <div class="w-20 h-20 bg-gray-50 rounded-2xl flex items-center justify-center mx-auto text-gray-200">
                                        <i class="ti ti-id-badge-off text-4xl"></i>
                                    </div>
                                    <p class="text-xs text-gray-400 font-medium leading-relaxed px-4">Anda belum memiliki lisensi aktif. Mulai bisnis anda dengan memilih paket premium.</p>
                                    <a href="{{ route('landing') }}#pricing" class="inline-flex items-center justify-center bg-brand-600 text-white font-black px-12 py-4 rounded-2xl transition-all shadow-xl shadow-brand-600/20 active:scale-95 uppercase tracking-widest text-[10px]">
                                        Pilih Paket
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- Transaction History Section --}}
                    <div class="space-y-6">
                        <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest pl-1">Histori Pembayaran</h3>
                    
                    <div class="bg-white rounded-3xl border border-gray-100 shadow-xl overflow-hidden">
                        @if($transactions->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <thead>
                                        <tr class="bg-gray-50/50">
                                            <th class="px-10 py-8 text-[11px] font-bold text-gray-400 uppercase tracking-widest">Paket / Layanan</th>
                                            <th class="px-10 py-8 text-[11px] font-bold text-gray-400 uppercase tracking-widest">Total</th>
                                            <th class="px-10 py-8 text-[11px] font-bold text-gray-400 uppercase tracking-widest">Status</th>
                                            <th class="px-10 py-8 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-50">
                                        @foreach($transactions as $trx)
                                            <tr class="group hover:bg-gray-50/30 transition-all duration-300">
                                                <td class="px-10 py-8">
                                                    <div class="flex items-center gap-6">
                                                        <div class="w-14 h-14 bg-white border border-gray-100 rounded-2xl flex items-center justify-center text-brand-600 transition-all group-hover:scale-110 group-hover:bg-brand-600 group-hover:text-white shadow-md overflow-hidden">
                                                            @if($trx->pricingPlan->icon_type == 'image' && $trx->pricingPlan->icon)
                                                                <img src="{{ asset('storage/' . $trx->pricingPlan->icon) }}" class="w-full h-full object-cover p-2.5 group-hover:brightness-0 group-hover:invert transition-all">
                                                            @else
                                                                <i class="ti ti-crown text-2xl"></i>
                                                            @endif
                                                        </div>
                                                        <div class="space-y-1">
                                                            <p class="text-[15px] font-bold text-gray-900 leading-none uppercase">{{ $trx->pricingPlan->name }}</p>
                                                            <p class="text-[10px] font-bold text-brand-400 uppercase tracking-widest flex items-center gap-1.5">
                                                                <span class="w-1.5 h-1.5 bg-brand-200 rounded-full"></span>
                                                                {{ $trx->plan_type }} / {{ $trx->pricingPlan->duration_months ?? 1 }} Mo
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-10 py-8">
                                                    <p class="text-[15px] font-bold text-gray-900 leading-none uppercase">Rp {{ number_format($trx->amount) }}</p>
                                                </td>
                                                <td class="px-10 py-8">
                                                    @if($trx->status == 'pending')
                                                        <span class="inline-flex items-center gap-2.5 bg-amber-50 text-amber-600 border border-amber-100/50 px-5 py-2 rounded-full text-[9px] font-black uppercase tracking-widest">
                                                            Verification
                                                        </span>
                                                    @elseif($trx->status == 'approved')
                                                        <span class="inline-flex items-center gap-2.5 bg-brand-50 text-brand-600 border border-brand-100/50 px-5 py-2 rounded-full text-[9px] font-black uppercase tracking-widest">
                                                            Successful
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center gap-2.5 bg-rose-50 text-rose-600 border border-rose-100/50 px-5 py-2 rounded-full text-[9px] font-black uppercase tracking-widest">
                                                            Rejected
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="px-10 py-8 text-right">
                                                    <button 
                                                        @click="selectedTrx = {{ json_encode([
                                                            'id' => $trx->id,
                                                            'plan_name' => $trx->pricingPlan->name,
                                                            'amount' => number_format($trx->amount),
                                                            'status' => $trx->status,
                                                            'payment_proof' => $trx->payment_proof ? asset('storage/' . $trx->payment_proof) : null,
                                                            'admin_note' => $trx->admin_note,
                                                            'date' => $trx->created_at->format('d M Y H:i'),
                                                            'plan_type' => $trx->plan_type,
                                                        ]) }}; openDetail = true"
                                                        class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-brand-600 hover:text-white transition-all shadow-sm active:scale-95">
                                                        <i class="ti ti-chevron-right text-lg"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if($transactions->hasPages())
                                <div class="px-8 py-6 bg-gray-50/50 border-t border-gray-100">
                                    {{ $transactions->links() }}
                                </div>
                            @endif
                        @else
                            <div class="px-12 py-32 text-center space-y-8">
                                <div class="w-24 h-24 bg-gray-50 rounded-[2.5rem] flex items-center justify-center mx-auto text-gray-200 shadow-inner border border-gray-100/50">
                                    <i class="ti ti-receipt-off text-5xl"></i>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xl font-bold text-gray-900 uppercase tracking-widest">Belum Ada Transaksi</p>
                                    <p class="text-xs text-gray-400 font-medium tracking-wide">Semua rincian pembelian anda akan terekam otomatis di sini.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- Detail Modal --}}
    <div x-cloak x-show="openDetail" class="fixed inset-0 z-[100] flex items-center justify-center px-6 py-12">
        <div x-show="openDetail" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 bg-gray-900/40 backdrop-blur-sm" @click="openDetail = false"></div>
        
        <div x-show="openDetail" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative bg-white w-full max-w-2xl rounded-[2.5rem] shadow-2xl overflow-hidden glass-card">
            <div class="p-10 lg:p-12 text-poppins">
                <div class="flex items-center justify-between mb-10">
                    <h3 class="text-2xl font-display font-black text-gray-900 uppercase tracking-tight">Detail Transaksi</h3>
                    <button @click="openDetail = false" class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 hover:text-rose-500 transition-colors">
                        <i class="ti ti-x text-xl"></i>
                    </button>
                </div>

                <div class="grid lg:grid-cols-2 gap-10">
                    <div class="space-y-8">
                        <div>
                            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-3" style="letter-spacing: 0.2em;">Rincian Paket</p>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-brand-50 rounded-2xl flex items-center justify-center text-brand-600 shadow-inner">
                                    <i class="ti ti-crown text-2xl"></i>
                                </div>
                                <div>
                                    <h4 class="text-lg font-bold text-gray-900 leading-none uppercase" x-text="selectedTrx?.plan_name"></h4>
                                    <p class="text-[10px] font-bold text-brand-400 uppercase tracking-widest mt-1.5" x-text="selectedTrx?.plan_type" style="letter-spacing: 0.2em;"></p>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5" style="letter-spacing: 0.2em;">Status</p>
                                <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest inline-block" 
                                    :class="{
                                        'bg-amber-50 text-amber-600 border border-amber-100/50': selectedTrx?.status === 'pending',
                                        'bg-brand-50 text-brand-600 border border-brand-100/50': selectedTrx?.status === 'approved',
                                        'bg-rose-50 text-rose-600 border border-rose-100/50': selectedTrx?.status === 'rejected'
                                    }" x-text="selectedTrx?.status" style="letter-spacing: 0.2em;"></span>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5" style="letter-spacing: 0.2em;">Total Bayar</p>
                                <p class="text-sm font-black text-gray-900 leading-none uppercase" x-text="'Rp ' + selectedTrx?.amount"></p>
                            </div>
                        </div>

                        <div>
                            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-3" style="letter-spacing: 0.2em;">Catatan Admin</p>
                            <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 min-h-[80px]">
                                <p class="text-sm text-gray-600 font-medium leading-relaxed italic" x-text="selectedTrx?.admin_note || 'Tidak ada catatan.'"></p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest" style="letter-spacing: 0.2em;">Bukti Pembayaran</p>
                        <div class="relative group aspect-[3/4] rounded-3xl overflow-hidden bg-gray-100 border border-gray-200">
                            <template x-if="selectedTrx?.payment_proof">
                                <img :src="selectedTrx.payment_proof" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!selectedTrx?.payment_proof">
                                <div class="w-full h-full flex flex-col items-center justify-center text-gray-300 space-y-3">
                                    <i class="ti ti-photo-off text-5xl"></i>
                                    <span class="text-[10px] font-bold uppercase tracking-widest">No Image Found</span>
                                </div>
                            </template>
                        </div>
                        <div class="pt-4 flex items-center justify-between border-t border-gray-50">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Transaction Date</span>
                            <span class="text-xs font-bold text-gray-700" x-text="selectedTrx?.date"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'License Code telah disalin!',
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: '#ffffff',
                    color: '#111827',
                    iconColor: '#16a34a',
                });
            });
        }
    </script>
</body>
</html>
