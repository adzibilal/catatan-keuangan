# Panduan Deployment Laravel - Menghilangkan /public dari URL

## Masalah
Saat deploy Laravel ke hosting, URL harus menggunakan `/public` di akhir, contoh:
```
https://domain.com/public/
```

## Solusi
File-file berikut telah dibuat untuk mengatasi masalah ini:

### 1. `.htaccess` (Root Directory)
File ini mengarahkan semua request ke folder `public` dan melindungi file-file sensitif.

### 2. `index.php` (Root Directory)
File ini sebagai fallback untuk memastikan semua request diarahkan ke `public/index.php`.

### 3. `web.config` (Root Directory)
File ini untuk kompatibilitas dengan server IIS (jika diperlukan).

### 4. `robots.txt` (Root Directory)
File ini untuk SEO dan mencegah akses ke direktori sensitif oleh search engine.

## Cara Kerja
1. Ketika user mengakses `https://domain.com/`, `.htaccess` akan mengarahkan ke `public/`
2. File `public/index.php` akan memproses request Laravel
3. Semua file dan direktori sensitif dilindungi dari akses langsung

## Keamanan
- File `.env`, `.log`, `.sql` diblokir
- Direktori `vendor/`, `storage/`, `config/`, dll diblokir
- Header keamanan ditambahkan (X-Content-Type-Options, X-Frame-Options, X-XSS-Protection)

## Testing
Setelah upload file-file ini ke hosting, coba akses:
- ✅ `https://domain.com/` (seharusnya berfungsi)
- ❌ `https://domain.com/vendor/` (seharusnya diblokir)
- ❌ `https://domain.com/.env` (seharusnya diblokir)

## Catatan
- Pastikan mod_rewrite diaktifkan di hosting
- Jika menggunakan IIS, file `web.config` akan digunakan
- Jika masih ada masalah, cek error log hosting 