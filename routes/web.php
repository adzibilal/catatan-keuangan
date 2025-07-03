<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('landing');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('transactions.index');
    })->name('dashboard');

    Route::resource('transactions', TransactionController::class);
    
    // Export routes
    Route::get('/transactions/export/pdf', [TransactionController::class, 'exportPdf'])->name('transactions.export.pdf');
    Route::get('/transactions/export/excel', [TransactionController::class, 'exportExcel'])->name('transactions.export.excel');
});

Auth::routes();

// Redirect /home ke transactions.index
Route::get('/home', function () {
    return redirect()->route('transactions.index');
})->name('home');