<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi Keuangan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }
        .header p {
            margin: 5px 0 0 0;
            font-size: 12px;
        }
        .summary {
            margin-bottom: 20px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .summary-label {
            font-weight: bold;
            width: 150px;
        }
        .summary-value {
            text-align: right;
            width: 150px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .income {
            color: #28a745;
        }
        .expense {
            color: #dc3545;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN TRANSAKSI KEUANGAN</h1>
        <p>Tanggal Export: {{ date('d/m/Y H:i:s') }}</p>
        <p>Dibuat oleh: {{ Auth::user()->name }}</p>
    </div>

    <div class="summary">
        <div class="summary-row">
            <span class="summary-label">Total Pemasukan:</span>
            <span class="summary-value income">Rp {{ number_format($totalIncome, 0, ',', '.') }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Total Pengeluaran:</span>
            <span class="summary-value expense">Rp {{ number_format($totalExpense, 0, ',', '.') }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Saldo:</span>
            <span class="summary-value {{ $balance >= 0 ? 'income' : 'expense' }}">Rp {{ number_format($balance, 0, ',', '.') }}</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Tanggal</th>
                <th>Deskripsi</th>
                <th class="text-right">Jumlah</th>
                <th class="text-center">Tipe</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $index => $transaction)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $transaction->created_at->format('d/m/Y') }}</td>
                    <td>{{ $transaction->description }}</td>
                    <td class="text-right {{ $transaction->type === 'income' ? 'income' : 'expense' }}">
                        Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                    </td>
                    <td class="text-center">
                        {{ $transaction->type === 'income' ? 'Pemasukan' : 'Pengeluaran' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada transaksi</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 30px; text-align: center; font-size: 10px; color: #666;">
        <p>Laporan ini dibuat secara otomatis oleh sistem Catatan Keuangan</p>
        <p>© {{ date('Y') }} Catatan Keuangan. All rights reserved.</p>
    </div>
</body>
</html> 