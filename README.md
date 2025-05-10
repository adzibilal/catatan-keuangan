# Aplikasi Catatan Keuangan

Aplikasi web untuk mencatat dan mengelola keuangan pribadi dengan mudah.

## Tentang Aplikasi

Catatan Keuangan adalah aplikasi berbasis web yang dibuat untuk memudahkan pengguna dalam melacak dan mengelola keuangan pribadi. Dengan antarmuka yang sederhana dan intuitif, aplikasi ini menawarkan cara yang efektif untuk mencatat pemasukan dan pengeluaran.

## Fitur Utama

- **Pencatatan Transaksi**: Catat setiap pemasukan dan pengeluaran dengan mudah
- **Kategorisasi**: Kelompokkan transaksi berdasarkan kategori untuk analisis lebih baik
- **Laporan Keuangan**: Lihat ringkasan keuangan dalam bentuk yang mudah dipahami
- **Autentikasi**: Sistem login dan register yang aman untuk melindungi data pribadi
- **Responsive Design**: Tampilan yang responsif untuk akses dari berbagai perangkat

## Teknologi yang Digunakan

- **Backend**: PHP 8.x, Laravel 10.x
- **Frontend**: HTML, CSS, JavaScript, Tailwind CSS
- **Database**: MySQL
- **Authentication**: Laravel built-in authentication

## Cara Instalasi

Ikuti langkah-langkah berikut untuk menginstal dan menjalankan aplikasi di lingkungan lokal:

1. **Clone repository**

   ```bash
   git clone https://github.com/username/catatan-keuangan.git
   cd catatan-keuangan
   ```

2. **Instal dependencies**

   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi lingkungan**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi database**

   Edit file `.env` dan sesuaikan kredensial database:

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=catatan_keuangan
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Migrasi database**

   ```bash
   php artisan migrate
   ```

6. **Jalankan server**

   ```bash
   php artisan serve
   ```

7. **Akses aplikasi**

   Buka browser dan akses `http://localhost:8000`

## Struktur Aplikasi

- **Landing Page**: Halaman utama yang menampilkan informasi tentang aplikasi
- **Authentication Pages**: Halaman login, register, dan reset password
- **Transactions**: Halaman untuk mengelola catatan keuangan

## Testing Akun

- email: admin@gmail.com
- password: admin123

## Kontribusi

Jika ingin berkontribusi pada proyek ini, silakan kirim pull request atau buka issue.

## Lisensi

Aplikasi ini dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).

## Pengembang

Dikembangkan sebagai proyek aplikasi pencatatan keuangan untuk mengelola keuangan pribadi dengan mudah.
