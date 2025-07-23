# SCRIPT PRESENTASI PROYEK CATATAN KEUANGAN
## UAS Web Development - Laravel Framework

---

### PEMBUKAAN

**[ ADZI ] :**
Selamat pagi/siang/sore, perkenalkan saya Adzi dan ini adalah Aisya. Hari ini kami akan mempresentasikan proyek UAS kami yaitu aplikasi Catatan Keuangan yang dibangun menggunakan Laravel Framework.

**[ AISYA ] :**
Terima kasih. Sebelum kami mulai presentasi, izinkan kami menjelaskan overview dari proyek ini. Aplikasi Catatan Keuangan ini adalah sistem manajemen keuangan pribadi yang memungkinkan pengguna untuk mencatat, mengelola, dan melaporkan transaksi keuangan mereka.

---

### 1. OVERVIEW APLIKASI

**[ ADZI ] :**
Aplikasi ini memiliki fitur-fitur utama sebagai berikut:
- Sistem autentikasi user (login, register, logout)
- CRUD transaksi keuangan (pemasukan dan pengeluaran)
- Dashboard dengan ringkasan keuangan
- Export laporan dalam format PDF dan Excel
- API REST untuk integrasi dengan frontend
- Pengujian otomatis menggunakan PHPUnit

**[ AISYA ] :**
Untuk teknologi yang digunakan, kami menggunakan:
- Laravel 12 sebagai framework backend
- MySQL sebagai database
- Bootstrap untuk styling
- PHPUnit untuk testing
- Postman untuk testing API

---

### 2. DEMONSTRASI APLIKASI

**[ ADZI ] :**
Mari kita mulai dengan demonstrasi aplikasi. Pertama, saya akan menunjukkan halaman landing page aplikasi.

*[Demonstrasi: Buka browser, akses aplikasi]*

Seperti yang bisa dilihat, ini adalah halaman utama aplikasi kami. Pengguna dapat melakukan registrasi atau login untuk mengakses fitur utama.

**[ AISYA ] :**
Sekarang saya akan mendemonstrasikan proses registrasi dan login.

*[Demonstrasi: Registrasi user baru]*

Setelah berhasil login, pengguna akan diarahkan ke dashboard yang menampilkan ringkasan keuangan mereka.

**[ ADZI ] :**
Dashboard ini menampilkan:
- Total saldo
- Total pemasukan bulan ini
- Total pengeluaran bulan ini
- Grafik transaksi terbaru
- Daftar transaksi terbaru

**[ AISYA ] :**
Sekarang saya akan mendemonstrasikan fitur utama yaitu menambah transaksi baru.

*[Demonstrasi: Tambah transaksi]*

Pengguna dapat menambahkan transaksi dengan mengisi:
- Deskripsi transaksi
- Jumlah nominal
- Tipe transaksi (pemasukan/pengeluaran)
- Tanggal transaksi

---

### 3. EXPORT LAPORAN PDF DAN EXCEL

**[ AISYA ] :**
Sekarang saya akan mendemonstrasikan fitur export laporan dalam format PDF dan Excel.

*[Demonstrasi: Export PDF]*

Untuk export PDF, kami menggunakan library DomPDF. Laporan ini mencakup:
- Ringkasan keuangan
- Daftar transaksi
- Grafik dan statistik

**[ ADZI ] :**
Dan untuk export Excel, kami menggunakan library Maatwebsite Excel:

*[Demonstrasi: Export Excel]*

Laporan Excel ini memungkinkan pengguna untuk:
- Melihat data dalam format spreadsheet
- Melakukan analisis lanjutan
- Berbagi data dengan aplikasi lain

---

### 4. PENGUJIAN DENGAN PHPUNIT

**[ ADZI ] :**
Sekarang saya akan menjelaskan pengujian yang telah kami implementasikan menggunakan PHPUnit.

*[Buka terminal, jalankan test]*

Mari saya jalankan test suite kami:

```bash
php artisan test
```

**[ ADZI ] :**
Seperti yang bisa dilihat, semua test berhasil dijalankan. Ini memastikan bahwa aplikasi kami berfungsi dengan baik dan tidak ada regresi ketika melakukan perubahan kode.

---

### 5. DEPLOYMENT DAN KONFIGURASI

**[ ADZI ] :**
Untuk deployment, kami telah menyiapkan konfigurasi environment yang diperlukan:

**Environment Configuration:**
- Database configuration
- File storage configuration
- ENV configuration

---

### 6. KESIMPULAN

**[ ADZI ] :**
Sebagai kesimpulan, aplikasi Catatan Keuangan ini telah memenuhi semua requirement yang diminta:

✅ **API Laravel** - Telah diimplementasikan dengan RESTful endpoints
✅ **Integrasi Frontend** - Menggunakan Fetch API dan CORS
✅ **Testing dengan Postman** - Semua endpoint telah ditest
✅ **Deployment** - Konfigurasi environment telah disiapkan
✅ **Export PDF/Excel** - Fitur laporan telah diimplementasikan
✅ **PHPUnit Testing** - Test coverage yang komprehensif

**[ AISYA ] :**
Aplikasi ini siap untuk digunakan dan dapat dikembangkan lebih lanjut dengan fitur-fitur tambahan seperti:
- Notifikasi email
- Multi-currency support
- Budget planning
- Financial goals tracking

---

### PENUTUP

**[ ADZI ] :**
Terima kasih atas perhatiannya. Apakah ada pertanyaan mengenai implementasi atau fitur aplikasi kami?

**[ AISYA ] :**
Jika tidak ada pertanyaan, presentasi kami selesai. Terima kasih!

---