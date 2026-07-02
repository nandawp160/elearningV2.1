@extends('layouts.app')

@section('title', 'Laporan Keuangan')

@section('content')
@php $percent = $totalInvoiced > 0 ? ($totalPaid / $totalInvoiced) * 100 : 0; @endphp
<div class="space-y-6">
    <div class="card">
        <div class="card-header">
            <div>
                <h1 class="page-title">Laporan Keuangan</h1>
                <p class="page-subtitle">Ringkasan transaksi dan performa pembayaran</p>
            </div>
            <button onclick="window.print()" class="btn btn-outline no-print">
                <i class="fas fa-print"></i>
                Cetak Laporan
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
        <div class="stat-card">
            <div>
                <p class="stat-label">Total Pendapatan</p>
                <p class="stat-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
            <div class="stat-icon bg-emerald-50 text-emerald-600">
                <i class="fas fa-wallet"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <p class="stat-label">Transaksi</p>
                <p class="stat-value">{{ $paymentCount }}</p>
            </div>
            <div class="stat-icon bg-amber-50 text-amber-600">
                <i class="fas fa-exchange-alt"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <p class="stat-label">Piutang (Sisa)</p>
                <p class="stat-value">Rp {{ number_format($pendingAmount, 0, ',', '.') }}</p>
            </div>
            <div class="stat-icon bg-rose-50 text-rose-600">
                <i class="fas fa-user-clock"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <p class="stat-label">Realisasi</p>
                <p class="stat-value">{{ number_format($percent, 1) }}%</p>
                <div class="mt-2 h-2 rounded-full bg-slate-100 dark:bg-slate-800 overflow-hidden">
                    <div style="width: {{ $percent }}%" class="h-full bg-teal-500"></div>
                </div>
            </div>
            <div class="stat-icon bg-sky-50 text-sky-600">
                <i class="fas fa-percent"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">
        <div class="xl:col-span-8">
            <div class="card p-0 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Rincian Transaksi</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="table-ui w-full">
                        <thead>
                            <tr>
                                <th class="px-6 py-4 text-left">Tanggal</th>
                                <th class="px-6 py-4 text-left">Nama Siswa</th>
                                <th class="px-6 py-4 text-left">No. Invoice</th>
                                <th class="px-6 py-4 text-left">Jumlah</th>
                                <th class="px-6 py-4 text-left">Metode</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($payments as $payment)
                            <tr>
                                <td class="px-6 py-4 text-sm">{{ $payment->payment_date->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-sm">{{ $payment->invoice->student->name }}</td>
                                <td class="px-6 py-4 text-sm">{{ $payment->invoice->invoice_number }}</td>
                                <td class="px-6 py-4 text-sm font-semibold text-emerald-600">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm uppercase">{{ $payment->payment_method }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-slate-500">Tidak ada transaksi dalam periode ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="xl:col-span-4">
            <div class="card">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Filter Laporan</h3>
                <form action="{{ route('reports.index') }}" method="GET" class="space-y-4">
                    <div>
                        <label class="field-label mb-2 block">Tanggal Mulai</label>
                        <input type="date" name="start_date" value="{{ $startDate }}" class="input">
                    </div>
                    <div>
                        <label class="field-label mb-2 block">Tanggal Selesai</label>
                        <input type="date" name="end_date" value="{{ $endDate }}" class="input">
                    </div>
                    <div>
                        <label class="field-label mb-2 block">Metode Pembayaran</label>
                        <select name="payment_method" class="select">
                            <option value="">Semua Metode</option>
                            <option value="cash" {{ request('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                            <option value="transfer" {{ request('payment_method') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                            <option value="qris" {{ request('payment_method') == 'qris' ? 'selected' : '' }}>QRIS</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-full">
                        <i class="fas fa-filter"></i>
                        Terapkan Filter
                    </button>
                </form>

                <hr class="my-6 border-slate-200 dark:border-slate-800">

                <h6 class="text-xs font-semibold uppercase text-slate-400 mb-4">Ringkasan Metode</h6>
                @foreach($methodSummary as $method => $data)
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-semibold text-slate-600 uppercase">{{ $method }} ({{ $data['count'] }})</span>
                    <span class="text-sm font-semibold text-emerald-600">Rp {{ number_format($data['total'], 0, ',', '.') }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        header, footer, aside, nav, .no-print, form, button {
            display: none !important;
        }
        body {
            background-color: white !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .shadow, .shadow-sm, .shadow-lg, .shadow-xl {
            box-shadow: none !important;
        }
    }
</style>
@endsection
