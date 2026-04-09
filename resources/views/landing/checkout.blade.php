<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    </style>
</head>
<body class="antialiased" x-data="{ showTerms: false }">
    
    <!-- Navigation -->
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="{{ route('landing') }}" class="flex items-center gap-2 group">
                <i class="ti ti-arrow-left text-xl text-gray-400 group-hover:text-brand-600 transition-colors"></i>
                <span class="font-bold text-gray-900">Kembali ke Beranda</span>
            </a>
            <div class="flex items-center gap-4">
                @auth
                    <span class="text-sm text-gray-400 font-medium">Logged in as</span>
                    <a href="{{ route('member.dashboard') }}" class="text-sm font-bold text-gray-900 hover:text-brand-600 transition-colors flex items-center gap-2">
                        <i class="ti ti-layout-dashboard text-lg"></i>
                        {{ auth()->user()->name }}
                    </a>
                @else
                    <span class="text-sm text-gray-400 font-medium">Sudah punya akun?</span>
                    <a href="{{ route('login') }}" class="text-sm font-bold text-brand-600 hover:text-brand-700 transition-colors">Login Sekarang</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="py-16">
        <div class="max-w-5xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-12">
                
                {{-- Left Side: Order Summary --}}
                <div class="lg:w-4/12 space-y-8">
                    <div>
                        <h1 class="font-display text-3xl font-bold text-gray-900 mb-2 leading-tight">Order Summary</h1>
                        <p class="text-sm text-gray-500">Konfirmasi paket pilihan Anda sebelum melanjutkan pembayaran.</p>
                    </div>

                    <div class="bg-white rounded-3xl border border-gray-100 p-6 lg:p-8 shadow-sm">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 bg-brand-50 rounded-2xl flex items-center justify-center text-brand-600 shrink-0">
                                <i class="ti ti-box text-2xl"></i>
                            </div>
                            <div>
                                <span class="text-[10px] font-bold text-brand-600 uppercase tracking-widest">Selected Plan</span>
                                <h3 class="text-lg font-bold text-gray-900">{{ $pricingPlan->name }}</h3>
                            </div>
                        </div>

                        <ul class="space-y-4 mb-8">
                            @foreach($pricingPlan->features as $feature)
                            <li class="flex items-start gap-3">
                                <div class="mt-1 flex-shrink-0 w-5 h-5 bg-emerald-50 rounded-full flex items-center justify-center text-emerald-600 whitespace-nowrap">
                                    <i class="ti ti-check text-[10px]"></i>
                                </div>
                                <span class="text-[13px] font-medium text-gray-600 leading-snug">{{ $feature->feature_text }}</span>
                            </li>
                            @endforeach
                        </ul>

                        <div class="pt-6 border-t border-dashed border-gray-100 space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-medium text-gray-400 uppercase tracking-widest">Max Employees</span>
                                <span class="text-sm font-bold text-gray-900">{{ $pricingPlan->max_employees ?? 'Unlimited' }} Users</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-medium text-gray-400 uppercase tracking-widest">Server Performance</span>
                                <span class="text-[13px] font-bold text-brand-600">{{ $pricingPlan->server_spec }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-indigo-600 rounded-3xl p-8 text-white shadow-xl shadow-indigo-600/20">
                        <div class="flex items-center gap-3 mb-4">
                            <i class="ti ti-shield-check text-2xl text-indigo-200"></i>
                            <span class="font-bold opacity-80 uppercase text-[10px] tracking-widest">Secure Payment</span>
                        </div>
                        <h4 class="text-lg font-bold mb-2 leading-tight">Manual Approval</h4>
                        <p class="text-indigo-100 text-xs leading-relaxed">Admin akan memverifikasi bukti transfer Anda dalam waktu maksimal 24 jam.</p>
                    </div>
                </div>

                {{-- Right Side: Checkout Form --}}
                <div class="lg:w-8/12">
                    <form action="{{ route('checkout.store', $pricingPlan->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl border border-gray-100 shadow-xl overflow-hidden">
                        @csrf
                        <input type="hidden" name="subscription_id" value="{{ $subscriptionId ?? '' }}">
                        <div class="p-8 lg:p-12 space-y-10">
                            
                            {{-- Account Registration (Guest Only) --}}
                            @guest
                            <div class="space-y-6 pb-10 border-b border-gray-100">
                                <label class="block text-sm font-bold text-gray-900 tracking-wide uppercase">1. Informasi Akun Anda</label>
                                <div class="grid grid-cols-1 gap-6">
                                    <div class="space-y-2">
                                        <label for="name" class="text-xs font-bold text-gray-400 uppercase tracking-widest pl-1">Nama Lengkap</label>
                                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full bg-gray-50 border-gray-100 rounded-2xl py-4 px-6 focus:ring-2 focus:ring-brand-100 focus:border-brand-600 transition-all placeholder:text-gray-300" placeholder="Masukkan nama lengkap" required>
                                        @error('name') <p class="text-xs text-rose-500 font-bold mt-1 pl-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="space-y-2">
                                        <label for="email" class="text-xs font-bold text-gray-400 uppercase tracking-widest pl-1">Alamat Email</label>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full bg-gray-50 border-gray-100 rounded-2xl py-4 px-6 focus:ring-2 focus:ring-brand-100 focus:border-brand-600 transition-all placeholder:text-gray-300" placeholder="nama@email.com" required>
                                        @error('email') <p class="text-xs text-rose-500 font-bold mt-1 pl-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                        <div class="space-y-2">
                                            <label for="password" class="text-xs font-bold text-gray-400 uppercase tracking-widest pl-1">Password</label>
                                            <input type="password" name="password" id="password" class="w-full bg-gray-50 border-gray-100 rounded-2xl py-4 px-6 focus:ring-2 focus:ring-brand-100 focus:border-brand-600 transition-all placeholder:text-gray-300" placeholder="Min. 8 karakter" required>
                                            @error('password') <p class="text-xs text-rose-500 font-bold mt-1 pl-1">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="space-y-2">
                                            <label for="password_confirmation" class="text-xs font-bold text-gray-400 uppercase tracking-widest pl-1">Konfirmasi</label>
                                            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full bg-gray-50 border-gray-100 rounded-2xl py-4 px-6 focus:ring-2 focus:ring-brand-100 focus:border-brand-600 transition-all placeholder:text-gray-300" placeholder="Ulangi" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endguest

                            {{-- Plan Type Selection --}}
                            <div class="space-y-6">
                                <label class="block text-sm font-bold text-gray-900 tracking-wide uppercase">{{ auth()->guest() ? '2' : '1' }}. Pilih Durasi Langganan</label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    {{-- Monthly Option --}}
                                    <label class="relative cursor-pointer group">
                                        <input type="radio" name="plan_type" value="monthly" checked class="peer sr-only">
                                        <div class="p-6 rounded-2xl border-2 border-gray-100 bg-white peer-checked:border-brand-600 peer-checked:bg-white peer-checked:shadow-xl peer-checked:shadow-brand-600/5 transition-all group-hover:border-brand-200 h-full relative overflow-hidden">
                                            <div class="relative z-10">
                                                <div class="flex justify-between items-center mb-4">
                                                    <span class="text-[10px] font-bold text-gray-400 peer-checked:text-brand-600 transition-colors uppercase tracking-widest pl-1 leading-none">Bayar Per Bulan</span>
                                                    <div class="w-6 h-6 rounded-full border-2 border-gray-100 flex items-center justify-center peer-checked:border-brand-600 peer-checked:bg-brand-600 transition-all">
                                                        <i class="ti ti-check text-white text-[10px] opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                                                    </div>
                                                </div>
                                                <h4 class="text-xs font-bold text-gray-800 uppercase tracking-tight mb-1">Bulanan</h4>
                                                <div class="font-display text-2xl font-bold text-gray-900 leading-none">
                                                    Rp {{ number_format($pricingPlan->monthly_price) }}
                                                    <span class="text-[10px] font-medium text-gray-400 block mt-1 lowercase">Harga standar / bulan</span>
                                                </div>
                                            </div>
                                        </div>
                                    </label>

                                    {{-- Yearly Option --}}
                                    <label class="relative cursor-pointer group">
                                        <input type="radio" name="plan_type" value="yearly" class="peer sr-only">
                                        <div class="p-6 rounded-2xl border-2 border-gray-100 bg-white peer-checked:border-brand-600 peer-checked:bg-white peer-checked:shadow-xl peer-checked:shadow-brand-600/5 transition-all group-hover:border-brand-200 h-full relative overflow-hidden">
                                            {{-- Recommendation Badge --}}
                                            <div class="absolute -right-12 top-4 rotate-45 bg-emerald-500 text-white text-[8px] font-bold px-12 py-1 shadow-sm z-20 uppercase tracking-widest">HEMAT</div>
                                            
                                            <div class="relative z-10">
                                                <div class="flex justify-between items-center mb-4">
                                                    <div class="flex flex-col">
                                                        <span class="text-[10px] font-bold text-emerald-600 transition-colors uppercase tracking-widest pl-1 leading-none">Bayar Per Tahun</span>
                                                        @if($pricingPlan->monthly_price > 0)
                                                            <span class="text-[9px] font-bold text-emerald-500 mt-1 pl-1">SAVE {{ round(100 - ($pricingPlan->yearly_price / ($pricingPlan->monthly_price * 12)) * 100) }}%</span>
                                                        @endif
                                                    </div>
                                                    <div class="w-6 h-6 rounded-full border-2 border-gray-100 flex items-center justify-center peer-checked:border-brand-600 peer-checked:bg-brand-600 transition-all">
                                                        <i class="ti ti-check text-white text-[10px] opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                                                    </div>
                                                </div>
                                                <h4 class="text-xs font-bold text-gray-800 uppercase tracking-tight mb-1">Tahunan (Best Value)</h4>
                                                <div class="font-display text-2xl font-bold text-gray-900 leading-none">
                                                    Rp {{ number_format($pricingPlan->yearly_price) }}
                                                    <span class="text-[10px] font-medium text-gray-400 block mt-1 lowercase">Masa aktif 12 bulan</span>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            {{-- Bank Details --}}
                            <div class="space-y-6">
                                <label class="block text-sm font-bold text-gray-900 tracking-wide uppercase">{{ auth()->guest() ? '3' : '2' }}. Informasi Transfer</label>
                                <div class="bg-gray-50/50 rounded-2xl p-6 border border-gray-100">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-14 h-14 bg-white rounded-xl shadow-sm border border-gray-100 flex items-center justify-center px-2 shrink-0 overflow-hidden">
                                                @if(isset($settings['payment_bank_logo']) && $settings['payment_bank_logo'])
                                                    <img src="{{ asset('storage/' . $settings['payment_bank_logo']) }}" alt="{{ $settings['payment_bank_name'] }}" class="w-full h-full object-contain p-1">
                                                @else
                                                    <div class="flex flex-col items-center justify-center text-brand-600">
                                                        <i class="ti ti-building-bank text-xl"></i>
                                                        <span class="text-[7px] font-bold uppercase">{{ $settings['payment_bank_name'] ?? 'BANK' }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest leading-none mb-1.5">{{ $settings['payment_bank_name'] ?? 'Nomor Rekening' }}</p>
                                                <p class="text-lg lg:text-xl font-bold text-gray-900 font-display leading-none">{{ $settings['payment_bank_number'] ?? '829 012 3456' }}</p>
                                                <p class="text-[11px] font-medium text-gray-500 mt-1">a.n {{ $settings['payment_bank_holder'] ?? 'Adam Adifa' }}</p>
                                            </div>
                                        </div>
                                        <button type="button" onclick="copyAccountNumber('{{ str_replace(' ', '', $settings['payment_bank_number'] ?? '8290123456') }}')" class="flex items-center justify-center gap-2 bg-white border border-gray-200 text-gray-600 text-xs font-bold px-4 py-2.5 rounded-xl hover:border-brand-600 hover:text-brand-600 transition-all shrink-0 active:scale-95">
                                            <i class="ti ti-copy text-sm"></i>
                                            <span class="whitespace-nowrap">Salin No. Rek</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- Payment Proof --}}
                            <div class="space-y-6">
                                <label class="block text-sm font-bold text-gray-900 tracking-wide uppercase">{{ auth()->guest() ? '4' : '3' }}. Upload Bukti Transfer</label>
                                <div class="relative">
                                    <input type="file" name="payment_proof" id="payment_proof" class="hidden" accept="image/*" required onchange="previewImage(this)">
                                    <label for="payment_proof" class="cursor-pointer block w-full border-2 border-dashed border-gray-200 rounded-2xl p-8 hover:border-brand-600 transition-all text-center group bg-gray-50/30">
                                        <div id="upload-placeholder" class="space-y-3">
                                            <div class="w-14 h-14 bg-brand-50 rounded-full flex items-center justify-center text-brand-600 mx-auto group-hover:scale-110 transition-transform">
                                                <i class="ti ti-upload text-2xl"></i>
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-900">Klik untuk upload bukti transfer</p>
                                                <p class="text-[11px] text-gray-500">PNG, JPG, JPEG (Max. 2MB)</p>
                                            </div>
                                        </div>
                                        <div id="preview-container" class="hidden space-y-3">
                                            <img id="image-preview" src="#" alt="Preview" class="max-h-48 mx-auto rounded-lg shadow-sm border border-gray-100">
                                            <p class="text-sm font-bold text-brand-600">Klik untuk mengganti gambar</p>
                                        </div>
                                    </label>
                                </div>
                                @error('payment_proof')
                                    <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="p-8 lg:p-10 bg-gray-50/50 border-t border-gray-100">
                            {{-- Terms & Conditions Checkbox --}}
                            <div class="mb-6 px-1">
                                <label class="flex items-start gap-3 cursor-pointer group">
                                    <div class="relative flex items-center mt-1">
                                        <input type="checkbox" name="terms" id="terms" required class="peer h-5 w-5 cursor-pointer appearance-none rounded border border-gray-300 bg-white checked:border-brand-600 checked:bg-brand-600 transition-all focus:ring-2 focus:ring-brand-100">
                                        <i class="ti ti-check absolute text-[10px] text-white opacity-0 peer-checked:opacity-100 left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 font-black pointer-events-none"></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-500 group-hover:text-gray-900 transition-colors leading-relaxed">
                                        Saya setuju dengan <button type="button" @click="showTerms = true" class="text-brand-600 font-bold hover:underline">Syarat & Ketentuan</button> yang berlaku untuk berlangganan PresensiGPS V2.
                                    </span>
                                </label>
                                @error('terms')
                                    <p class="mt-2 text-xs text-rose-500 font-bold pl-8">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="w-full bg-brand-600 hover:bg-brand-700 text-white font-bold py-5 rounded-2xl shadow-xl shadow-brand-600/20 transition-all active:scale-[0.98] flex items-center justify-center gap-3">
                                <i class="ti ti-lock text-xl"></i>
                                <span>Kirim & Konfirmasi Pembayaran</span>
                            </button>
                            <p class="text-center text-[11px] text-gray-400 mt-5 font-medium flex items-center justify-center gap-1.5 leading-none">
                                <i class="ti ti-shield-lock text-sm opacity-50"></i>
                                Keamanan data pembayaran terjamin & enkripsi 256-bit.
                            </p>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </main>

    <!-- Terms & Conditions Modal -->
    <div x-show="showTerms" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[100] overflow-y-auto px-4 py-6 sm:px-0 flex items-center justify-center" 
         style="display: none;">
        
        {{-- Backdrop --}}
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" @click="showTerms = false"></div>

        {{-- Modal Content --}}
        <div x-show="showTerms"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="relative bg-white rounded-3xl overflow-hidden shadow-2xl transform transition-all sm:max-w-2xl sm:w-full border border-white/20">
            
            {{-- Modal Header --}}
            <div class="px-8 py-6 border-b border-gray-100 flex items-center justify-between bg-white sticky top-0 z-10">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-brand-50 rounded-xl flex items-center justify-center text-brand-600">
                        <i class="ti ti-file-certificate text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 leading-none">Syarat & Ketentuan</h3>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1.5 leading-none">Terakhir Diperbarui: 09 April 2026</p>
                    </div>
                </div>
                <button @click="showTerms = false" class="text-gray-400 hover:text-gray-900 transition-colors p-2 hover:bg-gray-50 rounded-lg">
                    <i class="ti ti-x text-2xl"></i>
                </button>
            </div>

            {{-- Modal Body --}}
            <div class="px-8 py-10 max-h-[60vh] overflow-y-auto bg-white features-scroll">
                <div class="prose prose-sm prose-slate max-w-none space-y-8">
                    <section class="space-y-3">
                        <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-brand-500"></span>
                            1. Ruang Lingkup Layanan
                        </h4>
                        <p class="text-gray-500 leading-relaxed text-[13px] font-medium pl-4">PresensiGPS V2 menyediakan platform manajemen SDM berbasis cloud yang mencakup fitur presensi, payroll, dan manajemen keuangan karyawan. Layanan ini disediakan "sebagaimana adanya" (as-is) tanpa jaminan ketersediaan fitur khusus di luar paket standar.</p>
                    </section>

                    <section class="space-y-3">
                        <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-brand-500"></span>
                            2. Kebijakan Pembayaran & Refund
                        </h4>
                        <p class="text-gray-500 leading-relaxed text-[13px] font-medium pl-4">Seluruh biaya berlangganan yang telah dibayarkan bersifat <span class="text-rose-600 font-bold italic">Final dan Non-Refundable</span> (tidak dapat dikembalikan). Pengguna bertanggung jawab penuh atas pemilihan paket yang sesuai dengan kebutuhan perusahaan sebelum melakukan transfer.</p>
                    </section>

                    <section class="space-y-3">
                        <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-brand-500"></span>
                            3. Ketersediaan Layanan (SLA)
                        </h4>
                        <p class="text-gray-500 leading-relaxed text-[13px] font-medium pl-4">Kami berkomitmen menjaga tingkat ketersediaan layanan (Uptime) sebesar <span class="text-brand-600 font-bold">99.9%</span>. Kami tidak bertanggung jawab atas kerugian finansial atau operasional yang timbul akibat gangguan teknis dari pihak ketiga (ISP, Server Cloud Provider) atau kondisi <span class="italic text-gray-900">Force Majeure</span>.</p>
                    </section>

                    <section class="space-y-3">
                        <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-brand-500"></span>
                            4. Keamanan Data & Privasi
                        </h4>
                        <p class="text-gray-500 leading-relaxed text-[13px] font-medium pl-4">Data karyawan yang Anda unggah akan dijaga kerahasiaannya dengan enkripsi standar industri. Namun, pengguna bertanggung jawab penuh atas keamanan kredensial akun (Email & Password) dan penyalahgunaan akses oleh pihak internal perusahaan.</p>
                    </section>

                    <section class="space-y-3">
                        <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-brand-500"></span>
                            5. Larangan & Penyalahgunaan
                        </h4>
                        <p class="text-gray-500 leading-relaxed text-[13px] font-medium pl-4">Dilarang keras melakukan manipulasi data, menggunakan Fake GPS, atau mencoba menembus celah keamanan sistem. Pelanggaran berat akan mengakibatkan penutupan akun secara permanen tanpa pemberitahuan dan tanpa pengembalian dana.</p>
                    </section>
                </div>
            </div>

            {{-- Modal Footer --}}
            <div class="px-8 py-6 border-t border-gray-100 bg-gray-50 flex justify-end">
                <button @click="showTerms = false" class="bg-brand-600 hover:bg-brand-700 text-white font-bold px-8 py-3 rounded-xl transition-all shadow-lg shadow-brand-600/20 active:scale-95">
                    Saya Mengerti
                </button>
            </div>
        </div>
    </div>

    <script>
        function copyAccountNumber(number) {
            navigator.clipboard.writeText(number).then(() => {
                const btn = event.currentTarget;
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="ti ti-check text-sm text-emerald-500"></i> <span class="text-emerald-600">Berhasil Disalin</span>';
                btn.classList.add('border-emerald-200', 'bg-emerald-50');
                
                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.classList.remove('border-emerald-200', 'bg-emerald-50');
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
