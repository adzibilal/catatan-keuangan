<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        $totalIncome = Transaction::where('user_id', Auth::id())
            ->where('type', 'income')
            ->sum('amount');
            
        $totalExpense = Transaction::where('user_id', Auth::id())
            ->where('type', 'expense')
            ->sum('amount');
            
        $balance = $totalIncome - $totalExpense;
        
        return view('transactions.index', compact('transactions', 'totalIncome', 'totalExpense', 'balance'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:income,expense',
        ]);

        Transaction::create([
            'user_id' => Auth::id(),
            'description' => $request->description,
            'amount' => $request->amount,
            'type' => $request->type,
        ]);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $this->authorize('view', $transaction);
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }
        
        return view('transactions.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:income,expense',
        ]);

        $transaction->update($request->all());

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil dihapus');
    }

    /**
     * Export transactions to PDF
     */
    public function exportPdf()
    {
        $transactions = Transaction::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        $totalIncome = Transaction::where('user_id', Auth::id())
            ->where('type', 'income')
            ->sum('amount');
            
        $totalExpense = Transaction::where('user_id', Auth::id())
            ->where('type', 'expense')
            ->sum('amount');
            
        $balance = $totalIncome - $totalExpense;

        $pdf = PDF::loadView('transactions.export-pdf', compact('transactions', 'totalIncome', 'totalExpense', 'balance'));
        
        return $pdf->download('laporan-transaksi-' . date('Y-m-d') . '.pdf');
    }

    /**
     * Export transactions to Excel (CSV format)
     */
    public function exportExcel()
    {
        $transactions = Transaction::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        $totalIncome = Transaction::where('user_id', Auth::id())
            ->where('type', 'income')
            ->sum('amount');
            
        $totalExpense = Transaction::where('user_id', Auth::id())
            ->where('type', 'expense')
            ->sum('amount');
            
        $balance = $totalIncome - $totalExpense;

        $filename = 'laporan-transaksi-' . date('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($transactions, $totalIncome, $totalExpense, $balance) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header
            fputcsv($file, ['LAPORAN TRANSAKSI KEUANGAN']);
            fputcsv($file, ['Tanggal Export: ' . date('d/m/Y H:i:s')]);
            fputcsv($file, ['']);
            
            // Summary
            fputcsv($file, ['Total Pemasukan:', 'Rp ' . number_format($totalIncome, 0, ',', '.')]);
            fputcsv($file, ['Total Pengeluaran:', 'Rp ' . number_format($totalExpense, 0, ',', '.')]);
            fputcsv($file, ['Saldo:', 'Rp ' . number_format($balance, 0, ',', '.')]);
            fputcsv($file, ['']);
            
            // Table header
            fputcsv($file, ['No', 'Tanggal', 'Deskripsi', 'Jumlah', 'Tipe']);
            
            // Data
            $no = 1;
            foreach ($transactions as $transaction) {
                fputcsv($file, [
                    $no++,
                    $transaction->created_at->format('d/m/Y'),
                    $transaction->description,
                    'Rp ' . number_format($transaction->amount, 0, ',', '.'),
                    $transaction->type === 'income' ? 'Pemasukan' : 'Pengeluaran'
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
