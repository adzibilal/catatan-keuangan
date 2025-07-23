# LAPORAN PENGUJIAN APLIKASI CATATAN KEUANGAN MENGGUNAKAN PHPUNIT

## KELOMPOK 9
**Adzi Bilal Maulana H** – 22552011164  
**Aisya Khotimatul Aula** – 222101428

---

## 📑 DAFTAR ISI

- [Pendahuluan](#1-pendahuluan)
- [Tujuan Pengujian](#2-tujuan-pengujian)
- [Tools dan Teknologi](#3-tools-dan-teknologi)
- [Struktur File Pengujian](#4-struktur-file-pengujian)
- [Implementasi Kode Pengujian](#5-implementasi-kode-pengujian)
- [Cara Menjalankan Pengujian](#6-cara-menjalankan-pengujian)
- [Hasil Pengujian](#7-hasil-pengujian)
- [Tabel Test Case](#8-tabel-test-case)
- [Kesimpulan](#9-kesimpulan)
- [Saran Pengembangan](#10-saran-pengembangan)



## 1. Pendahuluan

Aplikasi **Catatan Keuangan** adalah sistem berbasis Laravel yang digunakan untuk mencatat transaksi keuangan harian, seperti pemasukan dan pengeluaran. Untuk memastikan aplikasi berjalan dengan benar dan stabil, dilakukan pengujian otomatis menggunakan **PHPUnit**. Pengujian ini dilakukan pada beberapa fitur inti untuk mengevaluasi keandalan sistem.

---

## 2. Tujuan Pengujian

- Memastikan hanya user yang sudah login dapat mengakses halaman transaksi.
- Memastikan user dapat menambahkan transaksi dengan data yang valid.
- Memastikan guest (belum login) tidak bisa mengakses halaman transaksi.
- Menjamin bahwa data berhasil tersimpan di database setelah transaksi ditambahkan.

---

## 3. Tools dan Teknologi

| No | Tools / Library           | Keterangan                               |
|----|---------------------------|-------------------------------------------|
| 1  | Laravel 12                | Framework utama aplikasi                  |
| 2  | PHPUnit (bawaan Laravel)  | Library pengujian otomatis                |
| 3  | Laravel TestCase          | Class dasar untuk semua testing Laravel   |
| 4  | UserFactory               | Digunakan untuk membuat data user dummy   |
| 5  | RefreshDatabase           | Trait untuk reset database tiap pengujian |

---

## 4. Struktur File Pengujian

File pengujian dibuat di:

tests/Feature/TransactionTest.php

php
Salin
Edit

Test ditulis untuk:
- Melarang guest akses `/transactions`
- Membolehkan user login melihat `/transactions`
- Membolehkan user menambah transaksi baru

---

## 5. Implementasi Kode Pengujian

```php
<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_redirected_from_transactions()
    {
        $response = $this->get('/transactions');
        $response->assertRedirect('/login');
    }

    /** @test */
    public function user_can_access_transactions()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/transactions');
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_create_transaction()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/transactions', [
            'description' => 'Bayar Listrik',
            'amount' => 100000,
            'type' => 'expense'
        ]);

        $response->assertRedirect('/transactions');
        $this->assertDatabaseHas('transactions', [
            'description' => 'Bayar Listrik',
            'amount' => 100000,
            'type' => 'expense',
            'user_id' => $user->id
        ]);
    }
}
```
## **6. Cara Menjalankan Pengujian**
Jalankan pengujian menggunakan perintah berikut pada terminal:

<pre> ```bash php artisan test ``` </pre>

## **7. Hasil Pengujian**
<pre> ```bash PASS Tests\Feature\TransactionTest 
    ✓ guest_redirected_from_transactions 
    ✓ user_can_access_transactions 
    ✓ user_can_create_transaction Tests: 3 passed (8 assertions) ``` </pre>

Tests: 3 passed (8 assertions)
Seluruh pengujian berhasil, menunjukkan bahwa fitur utama aplikasi berjalan sesuai harapan.

## **8. Tabel Test Case**

| No | Nama Pengujian                    | Input / Aksi                         | Expected Output                             | Status |
|----|----------------------------------|--------------------------------------|----------------------------------------------|--------|
| 1  | guest_redirected_from_transactions | Akses `/transactions` tanpa login   | Redirect ke `/login`                         | ✅     |
| 2  | user_can_access_transactions     | Login → akses `/transactions`       | Status 200 OK, halaman transaksi tampil      | ✅     |
| 3  | user_can_create_transaction      | POST data transaksi baru            | Redirect + Data masuk ke database            | ✅     |


## **9. Kesimpulan**
Pengujian otomatis dengan PHPUnit berhasil dilakukan untuk aplikasi Catatan Keuangan. Semua fitur inti yang diuji — termasuk akses halaman transaksi dan proses penambahan transaksi — berjalan dengan baik. Dengan hasil pengujian yang sukses, dapat disimpulkan bahwa aplikasi ini stabil dan dapat digunakan dengan aman.

## **10. Saran Pengembangan**
Menambahkan pengujian validasi input (form kosong, angka negatif, dsb)

Menguji fitur export PDF/Excel

Menguji fitur hapus dan edit transaksi

Menambahkan unit test untuk model dan controller

---

## ✍️ Dibuat oleh Kelompok 9

- **Adzi Bilal Maulana H** – 22552011164  
- **Aisya Khotimatul Aula** – 222101428