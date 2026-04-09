<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Checkout - {{ $pricingPlan->name }} | {{ config('app.name') }}</title>
    
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
        input, select, textarea { font-size: 16px !important; } /* Stop iOS auto-zoom */
    </style>
</head>
<body class="antialiased" x-data="{ showTerms: false, showDetails: false }">
    
    <!-- Mobile Header -->
    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-xl border-b border-gray-100 px-4 h-16 flex items-center justify-between">
        <a href="{{ route('landing') }}" class="w-10 h-10 bg-brand-50 rounded-xl flex items-center justify-center text-brand-600">
            <i class="ti ti-chevron-left text-xl"></i>
        </a>
        <div class="text-center">
            <h1 class="font-display font-bold text-gray-900 leading-none">Checkout</h1>
            <p class="text-[10px] text-brand-600 font-bold uppercase tracking-widest mt-1">{{ $pricingPlan->name }} Plan</p>
        </div>
        <div class="w-10"></div> {{-- Spacer for center alignment --}}
    </nav>

    <main class="pb-10">
        {{-- Plan Quick Summary --}}
        <div class="bg-white border-b border-gray-100 p-6 space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] block mb-1">Paket Pilihan</span>
                    <h2 class="text-xl font-black text-gray-900 font-display">{{ $pricingPlan->name }}</h2>
                </div>
                <div class="text-right">
                    <span class="text-[10px] font-bold text-brand-600 uppercase tracking-[0.2em] block mb-1">Total Bayar</span>
                    <div class="text-xl font-black text-brand-600 font-display transition-all duration-300" id="mobile-price-display">
                        Rp {{ number_format($pricingPlan->monthly_price) }}
                    </div>
                </div>
            </div>

            <button @click="showDetails = !showDetails" class="w-full py-3 px-4 bg-gray-50 rounded-xl flex items-center justify-between text-gray-600 text-xs font-bold transition-all active:scale-[0.98]">
                <div class="flex items-center gap-2">
                    <i class="ti ti-list-details text-lg text-brand-600"></i>
                    <span>Lihat Detail Fitur & Spesifikasi</span>
                </div>
                <i class="ti transition-transform duration-300" :class="showDetails ? 'ti-chevron-up rotate-180' : 'ti-chevron-down'"></i>
            </button>

            {{-- Collapsible Details --}}
            <div x-show="showDetails" x-collapse x-cloak class="space-y-6 pt-4">
                <ul class="grid grid-cols-1 gap-3">
                    @foreach($pricingPlan->features as $feature)
                    <li class="flex items-start gap-3 bg-brand-50/30 p-3 rounded-lg">
                        <i class="ti ti-circle-check text-brand-600 text-lg"></i>
                        <span class="text-[13px] font-medium text-gray-700 leading-snug">{{ $feature->feature_text }}</span>
                    </li>
                    @endforeach
                </ul>
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1">Max Users</p>
                        <p class="text-sm font-black text-gray-900">{{ $pricingPlan->max_employees ?? 'Unlimited' }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1">Server</p>
                        <p class="text-sm font-black text-brand-600 truncate">{{ $pricingPlan->server_spec }}</p>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('checkout.store', $pricingPlan->id) }}" method="POST" enctype="multipart/form-data" class="mt-6 px-4 space-y-8">
            @csrf
            <input type="hidden" name="subscription_id" value="{{ $subscriptionId ?? '' }}">

            {{-- Account Section --}}
            @guest
            <div class="space-y-5">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-brand-600 text-white rounded-lg flex items-center justify-center font-bold text-sm shadow-lg shadow-brand-600/20">1</div>
                    <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest">Informasi Akun</h3>
                </div>
                <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm space-y-4">
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full bg-gray-50 border-gray-100 rounded-xl py-3 px-4 focus:ring-2 focus:ring-brand-100" placeholder="Contoh: Adam Adifa" required>
                        @error('name') <p class="text-[10px] text-rose-500 font-bold pl-1 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full bg-gray-50 border-gray-100 rounded-xl py-3 px-4 focus:ring-2 focus:ring-brand-100" placeholder="nama@perusahaan.com" required>
                        @error('email') <p class="text-[10px] text-rose-500 font-bold pl-1 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="space-y-1.5">
                            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Password</label>
                            <input type="password" name="password" class="w-full bg-gray-50 border-gray-100 rounded-xl py-3 px-4 focus:ring-2 focus:ring-brand-100" required>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Konfirmasi</label>
                            <input type="password" name="password_confirmation" class="w-full bg-gray-50 border-gray-100 rounded-xl py-3 px-4 focus:ring-2 focus:ring-brand-100" required>
                        </div>
                    </div>
                    @error('password') <p class="text-[10px] text-rose-500 font-bold pl-1 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            @endguest

            {{-- Duration Selection --}}
            <div class="space-y-5">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-brand-600 text-white rounded-lg flex items-center justify-center font-bold text-sm shadow-lg shadow-brand-600/20">{{ auth()->guest() ? '2' : '1' }}</div>
                    <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest">Pilih Durasi</h3>
                </div>
                <div class="grid grid-cols-1 gap-3">
                    <label class="relative block cursor-pointer group">
                        <input type="radio" name="plan_type" value="monthly" checked class="peer sr-only" @change="document.getElementById('mobile-price-display').innerText = 'Rp {{ number_format($pricingPlan->monthly_price) }}'">
                        <div class="p-4 rounded-xl border-2 border-gray-100 bg-white peer-checked:border-brand-600 peer-checked:bg-brand-50/50 transition-all flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-5 h-5 rounded-full border-2 border-brand-200 flex items-center justify-center peer-checked:border-brand-600">
                                    <div class="w-2.5 h-2.5 rounded-full bg-brand-600 scale-0 peer-checked:scale-100 transition-transform"></div>
                                </div>
                                <span class="text-sm font-bold text-gray-700">Bayar Bulanan</span>
                            </div>
                            <span class="text-sm font-black text-gray-900">Rp {{ number_format($pricingPlan->monthly_price) }}</span>
                        </div>
                    </label>

                    <label class="relative block cursor-pointer group">
                        <input type="radio" name="plan_type" value="yearly" class="peer sr-only" @change="document.getElementById('mobile-price-display').innerText = 'Rp {{ number_format($pricingPlan->yearly_price) }}'">
                        <div class="p-4 rounded-xl border-2 border-gray-100 bg-white peer-checked:border-brand-600 peer-checked:bg-brand-50/50 transition-all flex items-center justify-between relative overflow-hidden">
                            <div class="absolute top-0 right-0 bg-emerald-500 text-white text-[7px] font-bold px-3 py-1 rounded-bl-lg uppercase tracking-widest">Hemat {{ round(100 - ($pricingPlan->yearly_price / ($pricingPlan->monthly_price * 12)) * 100) }}%</div>
                            <div class="flex items-center gap-3 pt-2">
                                <div class="w-5 h-5 rounded-full border-2 border-brand-200 flex items-center justify-center peer-checked:border-brand-600">
                                    <div class="w-2.5 h-2.5 rounded-full bg-brand-600 scale-0 peer-checked:scale-100 transition-transform"></div>
                                </div>
                                <span class="text-sm font-bold text-gray-700">Bayar Tahunan</span>
                            </div>
                            <span class="text-sm font-black text-gray-900 pt-2">Rp {{ number_format($pricingPlan->yearly_price) }}</span>
                        </div>
                    </label>
                </div>
            </div>

            {{-- Payment Details --}}
            <div class="space-y-5">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-brand-600 text-white rounded-lg flex items-center justify-center font-bold text-sm shadow-lg shadow-brand-600/20">{{ auth()->guest() ? '3' : '2' }}</div>
                    <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest">Informasi Transfer</h3>
                </div>
                <div class="bg-indigo-600 rounded-2xl p-6 text-white shadow-xl shadow-indigo-600/20 space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-white/10 backdrop-blur-md rounded-xl flex items-center justify-center p-2 shrink-0 border border-white/20">
                            @if(isset($settings['payment_bank_logo']) && $settings['payment_bank_logo'])
                                <img src="{{ asset('storage/' . $settings['payment_bank_logo']) }}" alt="Bank" class="w-full h-full object-contain">
                            @else
                                <i class="ti ti-building-bank text-2xl text-white"></i>
                            @endif
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-indigo-200 uppercase tracking-widest mb-1">{{ $settings['payment_bank_name'] ?? 'Transfer Bank' }}</p>
                            <p class="text-xl font-black font-display tracking-tight">{{ $settings['payment_bank_number'] ?? '829 012 3456' }}</p>
                            <p class="text-xs font-medium text-indigo-100 opacity-80 uppercase tracking-wide">A.n {{ $settings['payment_bank_holder'] ?? 'Adam Adifa' }}</p>
                        </div>
                    </div>
                    <button type="button" onclick="copyAccountNumber('{{ str_replace(' ', '', $settings['payment_bank_number'] ?? '8290123456') }}')" class="w-full bg-white text-indigo-600 font-bold py-3.5 rounded-xl flex items-center justify-center gap-2 active:scale-95 transition-all text-sm">
                        <i class="ti ti-copy"></i>
                        Salin Nomor Rekening
                    </button>
                </div>
            </div>

            {{-- Proof Upload --}}
            <div class="space-y-5">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-brand-600 text-white rounded-lg flex items-center justify-center font-bold text-sm shadow-lg shadow-brand-600/20">{{ auth()->guest() ? '4' : '3' }}</div>
                    <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest">Unggah Bukti</h3>
                </div>
                <div class="relative">
                    <input type="file" name="payment_proof" id="payment_proof" class="hidden" accept="image/*" required onchange="previewImage(this)">
                    <label for="payment_proof" class="cursor-pointer block w-full bg-white border-2 border-dashed border-gray-200 rounded-2xl p-8 hover:border-brand-600 transition-all text-center group">
                        <div id="upload-placeholder" class="space-y-2">
                            <div class="w-12 h-12 bg-brand-50 rounded-full flex items-center justify-center text-brand-600 mx-auto group-hover:scale-110 transition-transform">
                                <i class="ti ti-camera-plus text-xl"></i>
                            </div>
                            <p class="text-sm font-bold text-gray-900">Pilih Foto Bukti Transfer</p>
                            <p class="text-[10px] text-gray-400">Pastikan nominal & tanggal terlihat jelas</p>
                        </div>
                        <div id="preview-container" class="hidden">
                            <img id="image-preview" src="#" alt="Preview" class="max-h-60 mx-auto rounded-xl shadow-md">
                            <p class="text-xs font-bold text-brand-600 mt-4 underline">Ganti Foto</p>
                        </div>
                    </label>
                </div>
                @error('payment_proof') <p class="text-xs text-rose-500 font-bold mt-1 text-center">{{ $message }}</p> @enderror
            </div>

            {{-- Terms --}}
            <div class="pt-4 px-2">
                <label class="flex items-start gap-3 cursor-pointer group">
                    <div class="relative flex items-center mt-1">
                        <input type="checkbox" name="terms" id="terms" required class="peer h-5 w-5 appearance-none rounded border border-gray-300 bg-white checked:border-brand-600 checked:bg-brand-600 transition-all">
                        <i class="ti ti-check absolute text-[10px] text-white opacity-0 peer-checked:opacity-100 left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 font-black pointer-events-none"></i>
                    </div>
                    <span class="text-[13px] font-medium text-gray-500 leading-relaxed">
                        Saya setuju dengan <button type="button" @click="showTerms = true" class="text-brand-600 font-bold">Syarat & Ketentuan</button> yang berlaku.
                    </span>
                </label>
                @error('terms') <p class="text-[10px] text-rose-500 font-bold mt-2 pl-8">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full bg-brand-600 text-white font-bold py-5 rounded-2xl shadow-xl shadow-brand-600/20 active:scale-95 transition-all text-lg flex items-center justify-center gap-3 mt-4">
                <i class="ti ti-circle-check text-2xl"></i>
                Konfirmasi Pembayaran
            </button>
            <p class="text-center text-[10px] text-gray-400 font-medium">Pembayaran akan diverifikasi admin secara manual dalam 1x24 jam.</p>
        </form>
    </main>

    {{-- Mobile T&C Modal --}}
    <div x-show="showTerms" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         class="fixed inset-0 z-[100] flex items-end sm:items-center justify-center px-4" x-cloak>
        <div class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm" @click="showTerms = false"></div>
        <div class="relative bg-white w-full rounded-t-[2.5rem] sm:rounded-[2rem] max-h-[90vh] flex flex-col shadow-2xl overflow-hidden animate-slide-up">
            <div class="h-1.5 w-12 bg-gray-200 rounded-full mx-auto mt-4 mb-2 sm:hidden"></div>
            <div class="px-8 py-6 border-b border-gray-50 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-black font-display text-gray-900">Syarat & Ketentuan</h3>
                    <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-1">Versi 09 April 2026</p>
                </div>
                <button @click="showTerms = false" class="text-gray-400 p-2"><i class="ti ti-x text-2xl"></i></button>
            </div>
            <div class="px-8 py-8 overflow-y-auto space-y-6">
                @php
                    $tc = [
                        ['Layanan', 'PresensiGPS V2 menyediakan platform manajemen SDM as-is. Ketersediaan fitur sesuai paket pilihan.'],
                        ['Refund', 'Seluruh pembayaran bersifat FINAL & NON-REFUNDABLE. Pilih paket dengan teliti.'],
                        ['Uptime', 'Komitmen uptime 99.9%. Kami tidak bertanggung jawab atas kendala ISP pihak ketiga.'],
                        ['Privasi', 'Data dienkripsi standar industri. Keamanan akun (Password) tanggung jawab pengguna.'],
                        ['Larangan', 'Dilarang menggunakan Fake GPS atau manipulasi data. Pelanggaran berujung BANNED.']
                    ];
                @endphp
                @foreach($tc as $index => $item)
                <div class="space-y-2">
                    <h4 class="text-xs font-black text-gray-900 uppercase tracking-widest flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-600"></span>
                        {{ $loop->iteration }}. {{ $item[0] }}
                    </h4>
                    <p class="text-xs text-gray-500 leading-relaxed font-medium pl-3.5">{{ $item[1] }}</p>
                </div>
                @endforeach
            </div>
            <div class="p-8 bg-gray-50/50 border-t border-gray-100">
                <button @click="showTerms = false" class="w-full bg-brand-600 text-white font-bold py-4 rounded-xl shadow-lg transition-all active:scale-95">Saya Mengerti</button>
            </div>
        </div>
    </div>

    <script>
        function copyAccountNumber(number) {
            navigator.clipboard.writeText(number).then(() => {
                const btn = event.currentTarget;
                const originalContent = btn.innerHTML;
                btn.innerHTML = '<i class="ti ti-check text-emerald-500"></i> Berhasil Disalin';
                btn.classList.add('bg-emerald-50', 'text-emerald-600');
                setTimeout(() => {
                    btn.innerHTML = originalContent;
                    btn.classList.remove('bg-emerald-50', 'text-emerald-600');
                }, 2000);
            });
        }

        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            const placeholder = document.getElementById('upload-placeholder');
            const container = document.getElementById('preview-container');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    placeholder.classList.add('hidden');
                    container.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
