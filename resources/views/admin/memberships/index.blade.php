@extends('layouts.admin')

@section('title', 'Kelola keanggotaan')
@section('description', 'Verifikasi pembayaran dan kelola status langganan member Anda.')

@section('breadcrumbs')
<nav class="flex items-center gap-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest mb-1 font-poppins">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-brand-600 transition-colors">Dashboard</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <span class="text-brand-600 font-semibold tracking-widest">Membership</span>
</nav>
@endsection

@section('actions')
@endsection

@section('content')
<div class="w-full -mt-6 space-y-6 pb-0 font-poppins text-inter">
    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="group bg-white rounded-xl border border-gray-100 p-7 relative overflow-hidden transition-all hover:shadow-2xl hover:shadow-amber-500/10 shadow-sm shadow-black/[0.02]">
            <div class="absolute top-0 right-0 w-32 h-32 bg-amber-500/5 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
            <div class="flex items-center gap-5 relative z-10">
                <div class="w-14 h-14 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600 shadow-inner border border-amber-50">
                    <i class="ti ti-clock-bolt text-3xl"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Menunggu Approval</p>
                    <div class="flex items-baseline gap-2">
                        <p class="text-3xl font-display font-bold text-gray-900 leading-none">{{ \App\Models\MembershipTransaction::where('status', 'pending')->count() }}</p>
                        <span class="text-[9px] font-bold text-amber-600 bg-amber-100/50 px-2 py-0.5 rounded-md uppercase tracking-tight">Penting</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="group bg-white rounded-xl border border-gray-100 p-7 relative overflow-hidden transition-all hover:shadow-2xl hover:shadow-emerald-500/10 shadow-sm shadow-black/[0.02]">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/5 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
            <div class="flex items-center gap-5 relative z-10">
                <div class="w-14 h-14 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 shadow-inner border border-emerald-50">
                    <i class="ti ti-shield-check text-3xl"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total Aktif</p>
                    <p class="text-3xl font-display font-bold text-gray-900 leading-none">{{ \App\Models\MembershipSubscription::where('status', 'active')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="group bg-white rounded-xl border border-gray-100 p-7 relative overflow-hidden transition-all hover:shadow-2xl hover:shadow-brand-500/10 shadow-sm shadow-black/[0.02]">
            <div class="absolute top-0 right-0 w-32 h-32 bg-brand-500/5 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
            <div class="flex items-center gap-5 relative z-10">
                <div class="w-14 h-14 bg-brand-50 rounded-xl flex items-center justify-center text-brand-600 shadow-inner border border-brand-50">
                    <i class="ti ti-receipt-2 text-3xl"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total Transaksi</p>
                    <p class="text-3xl font-display font-bold text-gray-900 leading-none">{{ \App\Models\MembershipTransaction::count() }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Transactions Table Section --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] overflow-hidden">
        <div class="p-8 border-b border-gray-50 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white">
            <div>
                <h2 class="text-lg font-bold text-gray-900 tracking-tight flex items-center gap-3 uppercase">
                    Daftar Transaksi 
                    <span class="text-[10px] bg-brand-50 text-brand-600 px-2 py-1 rounded-lg uppercase tracking-widest font-bold">Terbaru</span>
                </h2>
                <p class="text-xs text-gray-400 mt-1 font-semibold uppercase tracking-wider leading-none">Kelola verifikasi pembayaran lisensi secara manual.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="relative">
                    <i class="ti ti-filter text-gray-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                    <select class="pl-10 pr-10 py-2.5 bg-gray-50/50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all appearance-none cursor-pointer">
                        <option>Semua Status</option>
                        <option>Pending</option>
                        <option>Approved</option>
                        <option>Rejected</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto bg-white">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/50 text-gray-400 text-[10px] font-bold uppercase tracking-widest border-b border-gray-50">
                        <th class="px-8 py-6">Informasi Pelanggan</th>
                        <th class="px-6 py-6 text-center">Paket & Durasi</th>
                        <th class="px-6 py-6 border-x border-gray-50/50">Total Pembayaran</th>
                        <th class="px-6 py-6 text-center">Status Transaksi</th>
                        <th class="px-6 py-6">Waktu Submit</th>
                        <th class="px-8 py-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($transactions as $transaction)
                    <tr class="group hover:bg-brand-50/30 transition-all duration-300">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center font-bold text-brand-600 text-lg border-2 border-white shadow-sm ring-1 ring-brand-100">
                                    {{ substr($transaction->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 text-sm leading-tight mb-1 group-hover:text-brand-600 transition-colors uppercase tracking-tight">{{ $transaction->user->name }}</p>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest leading-none">{{ $transaction->user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-6 text-center">
                            <div class="inline-flex flex-col items-center">
                                <span class="text-[13px] font-bold text-gray-800 uppercase tracking-tight">{{ $transaction->pricingPlan->name }}</span>
                                <span class="text-[9px] font-bold uppercase tracking-[0.1em] mt-1 px-2 py-0.5 rounded-lg border border-gray-100 {{ $transaction->plan_type === 'yearly' ? 'bg-brand-50 text-brand-600 border-brand-100' : 'bg-gray-50 text-gray-400' }}">
                                    {{ $transaction->plan_type }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-6 border-x border-gray-50/50">
                            <p class="font-bold text-gray-900 text-sm">Rp {{ number_format($transaction->amount) }}</p>
                            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-0.5 leading-none">Transfer Bank</p>
                        </td>
                        <td class="px-6 py-6 text-center">
                            @if($transaction->status == 'pending')
                                <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-600 px-3 py-1.5 rounded-xl text-[10px] font-bold uppercase tracking-widest ring-1 ring-amber-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    Pending
                                </span>
                            @elseif($transaction->status == 'approved')
                                <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-600 px-3 py-1.5 rounded-xl text-[10px] font-bold uppercase tracking-widest ring-1 ring-emerald-100">
                                    <i class="ti ti-circle-check"></i> Approved
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-600 px-3 py-1.5 rounded-xl text-[10px] font-bold uppercase tracking-widest ring-1 ring-rose-100">
                                    <i class="ti ti-circle-x"></i> Rejected
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-6">
                            <div class="text-[10px] font-bold text-gray-500 leading-tight uppercase tracking-widest">
                                {{ $transaction->created_at->format('d M Y') }}
                                <span class="block text-[9px] text-gray-400 font-bold mt-1 tracking-widest">{{ $transaction->created_at->format('H:i') }} WIB</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <a href="{{ route('admin.memberships.show', $transaction->id) }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gray-50 text-gray-600 hover:bg-brand-600 hover:text-white hover:shadow-lg hover:shadow-brand-600/20 transition-all font-bold text-xs group/btn shadow-sm">
                                <i class="ti {{ $transaction->status == 'pending' ? 'ti-list-check' : 'ti-eye' }} text-lg"></i>
                                <span class="uppercase tracking-widest text-[10px]">{{ $transaction->status == 'pending' ? 'Verifikasi' : 'Detail' }}</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-24 text-center">
                            <div class="flex flex-col items-center opacity-20">
                                <i class="ti ti-receipt-off text-7xl mb-4"></i>
                                <p class="font-bold text-xl uppercase tracking-widest">Belum ada transaksi</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($transactions->hasPages())
        <div class="px-8 py-6 bg-gray-50/30 border-t border-gray-50">
            {{ $transactions->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
