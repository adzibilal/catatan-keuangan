# LAPORAN IMPLEMENTASI FITUR EXPORT PDF DAN EXCEL
## Aplikasi Catatan Keuangan - Laravel 12

---

### **KELOMPOK 9**
- **Adzi Bilal Maulana H** - 22552011164
- **Aisya Khotimatul Aula** - 222101428

---

## DAFTAR ISI
1. [Pendahuluan](#pendahuluan)
2. [Implementasi Export PDF](#implementasi-export-pdf)
3. [Implementasi Export Excel](#implementasi-export-excel)
4. [Integrasi Frontend](#integrasi-frontend)
5. [Screenshot Implementasi](#screenshot-implementasi)
6. [Pengujian](#pengujian)
7. [Kesimpulan](#kesimpulan)

---

## 1. PENDAHULUAN

### 1.1 Latar Belakang
Aplikasi Catatan Keuangan memerlukan fitur export data untuk memudahkan pengguna mengunduh laporan transaksi dalam format PDF dan Excel. Fitur ini penting untuk keperluan dokumentasi dan analisis data.

### 1.2 Tujuan
- Implementasi export PDF menggunakan Laravel DomPDF
- Implementasi export Excel menggunakan Maatwebsite Excel
- Integrasi dengan interface pengguna
- Pengujian fungsionalitas export

---

## 2. IMPLEMENTASI EXPORT PDF

### 2.1 Setup Laravel DomPDF
```bash
composer require barryvdh/laravel-dompdf
```

### 2.2 Controller Implementation
```php
<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    // ... existing methods ...

    public function exportPdf()
    {
        $user = auth()->user();
        $transactions = $user->transactions()
            ->orderBy('created_at', 'desc')
            ->get();

        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        $pdf = PDF::loadView('transactions.export-pdf', [
            'transactions' => $transactions,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'balance' => $balance,
            'user' => $user
        ]);

        return $pdf->download('laporan-transaksi-' . date('Y-m-d') . '.pdf');
    }
}
```

### 2.3 Template PDF
File: `resources/views/transactions/export-pdf.blade.php`
- Header dengan informasi user dan tanggal
- Ringkasan keuangan (pemasukan, pengeluaran, saldo)
- Tabel transaksi dengan styling yang rapi
- Footer dengan informasi tambahan

---

## 3. IMPLEMENTASI EXPORT EXCEL

### 3.1 Setup Maatwebsite Excel
```bash
composer require maatwebsite/excel
php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider"
```

### 3.2 Export Class
```php
<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function collection()
    {
        return Transaction::where('user_id', $this->userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return ['No', 'Tanggal', 'Deskripsi', 'Jumlah (Rp)', 'Tipe', 'Keterangan'];
    }

    public function map($transaction): array
    {
        static $rowNumber = 1;
        
        return [
            $rowNumber++,
            $transaction->created_at->format('d/m/Y'),
            $transaction->description,
            number_format($transaction->amount, 0, ',', '.'),
            $transaction->type === 'income' ? 'Pemasukan' : 'Pengeluaran',
            $transaction->type === 'income' ? 'Pendapatan' : 'Biaya'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Header styling dengan background biru
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '4A5568']],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
        ]);

        // Auto-size columns
        foreach (range('A', 'F') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        return $sheet;
    }
}
```

### 3.3 Controller Implementation
```php
<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Exports\TransactionsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    // ... existing methods ...

    public function exportExcel()
    {
        $user = auth()->user();
        
        return Excel::download(
            new TransactionsExport($user->id),
            'transaksi-keuangan-' . date('Y-m-d') . '.xlsx'
        );
    }
}
```

---

## 4. INTEGRASI FRONTEND

### 4.1 Update View Index
```html
<div class="flex space-x-2">
    <!-- Export PDF Button -->
    <a href="{{ route('transactions.export.pdf') }}" 
       class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0 2 2 0 102 0z" clip-rule="evenodd"></path>
        </svg>
        Export PDF
    </a>
    
    <!-- Export Excel Button -->
    <a href="{{ route('transactions.export.excel') }}" 
       class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" clip-rule="evenodd"></path>
        </svg>
        Export Excel
    </a>
    
    <!-- Existing Add Transaction Button -->
    <a href="{{ route('transactions.create') }}" 
       class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        Tambah Transaksi
    </a>
</div>
```

### 4.2 Routes
```php
Route::middleware(['auth'])->group(function () {
    Route::get('/transactions/export/pdf', [TransactionController::class, 'exportPdf'])
        ->name('transactions.export.pdf');
    Route::get('/transactions/export/excel', [TransactionController::class, 'exportExcel'])
        ->name('transactions.export.excel');
});
```

---

## 5. SCREENSHOT IMPLEMENTASI

### 5.1 Halaman Utama Transaksi dengan Tombol Export
![Halaman Transaksi dengan Tombol Export](screenshots/transactions-page-with-export-buttons.png)
*Gambar 1: Halaman utama transaksi yang menampilkan tombol Export PDF (merah) dan Export Excel (hijau) di samping tombol Tambah Transaksi*

### 5.2 Hasil Export PDF
![Hasil Export PDF](screenshots/pdf-export-result.png)
*Gambar 2: Contoh hasil export PDF yang menampilkan laporan transaksi dengan format yang rapi dan profesional*

### 5.3 Hasil Export Excel
![Hasil Export Excel](screenshots/excel-export-result.png)
*Gambar 3: Contoh hasil export Excel yang menampilkan data transaksi dalam format spreadsheet dengan header yang berwarna*

### 5.4 Struktur File yang Diunduh
![Struktur File Export](screenshots/export-files-structure.png)
*Gambar 4: Struktur file yang diunduh dengan nama file yang sesuai format tanggal*

### 5.5 Responsivitas Tombol Export
![Responsivitas Tombol Export](screenshots/export-buttons-responsive.png)
*Gambar 5: Tampilan tombol export yang responsif pada berbagai ukuran layar*

---

## 6. PENGUJIAN

### 6.1 Test Cases
| Test Case | Expected Result |
|-----------|-----------------|
| Export PDF dengan data | File PDF terdownload dengan format yang benar |
| Export Excel dengan data | File Excel terdownload dengan format yang benar |
| Export tanpa data | File terdownload dengan pesan "Tidak ada transaksi" |
| Akses tanpa login | Redirect ke halaman login |

### 6.2 Manual Testing
1. Login ke aplikasi
2. Navigasi ke halaman transaksi
3. Klik tombol "Export PDF" atau "Export Excel"
4. Verifikasi file terdownload
5. Buka file dan periksa format

---

## 7. KESIMPULAN

### 7.1 Pencapaian
✅ Berhasil mengimplementasikan fitur export PDF menggunakan Laravel DomPDF
✅ Berhasil mengimplementasikan fitur export Excel menggunakan Maatwebsite Excel
✅ Integrasi fitur export dengan interface pengguna yang responsif
✅ Pengujian fungsionalitas export yang komprehensif

### 7.2 Fitur yang Diimplementasikan
- **Export PDF**: Laporan transaksi dalam format PDF dengan styling profesional
- **Export Excel**: Data transaksi dalam format spreadsheet yang mudah dianalisis
- **UI Integration**: Tombol export yang intuitif dan responsif
- **Error Handling**: Penanganan error yang user-friendly

### 7.3 Teknologi yang Digunakan
- **Laravel DomPDF**: Untuk generate file PDF
- **Maatwebsite Excel**: Untuk generate file Excel
- **Tailwind CSS**: Untuk styling interface

### 7.4 Kendala dan Solusi
1. **Kendala**: Package Maatwebsite Excel versi lama tidak kompatibel
   **Solusi**: Menggunakan versi yang kompatibel dengan Laravel 12

2. **Kendala**: Styling PDF yang tidak konsisten
   **Solusi**: Menggunakan CSS inline dan testing di berbagai browser

### 7.5 Saran Pengembangan
1. **Batch Processing**: Untuk data yang sangat besar
2. **Scheduled Export**: Export otomatis berdasarkan jadwal
3. **Custom Templates**: Template yang dapat dikustomisasi
4. **Email Integration**: Kirim laporan via email
5. **Advanced Filtering**: Filter data sebelum export

---

**Dibuat oleh Kelompok 9**
- Adzi Bilal Maulana H - 22552011164
- Aisya Khotimatul Aula - 222101428

**Tanggal**: 3 July 2025
**Versi**: 1.0 