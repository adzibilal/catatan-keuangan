# 🚀 Postman Collection - Catatan Keuangan API

## 📋 Daftar File

- `postman_collection.json` - Collection utama dengan semua endpoint
- `postman_environment.json` - Environment variables untuk local development
- `POSTMAN_GUIDE.md` - Panduan lengkap penggunaan collection
- `POSTMAN_ENVIRONMENT.md` - Panduan setup environment
- `README_POSTMAN.md` - File ini (overview cepat)

## ⚡ Quick Start

### 1. Import Collection & Environment
```bash
# Import collection
File: postman_collection.json

# Import environment  
File: postman_environment.json
```

### 2. Setup Environment
1. Pilih environment `Catatan Keuangan Local` di dropdown
2. Pastikan `base_url` sudah benar: `http://127.0.0.1:8000`

### 3. Jalankan Aplikasi
```bash
php artisan serve
```

### 4. Testing Flow
1. **Get CSRF Token** ⭐ (WAJIB DULU)
2. **Login** dengan `admin@gmail.com` / `admin123`
3. **Get All Transactions** untuk melihat data
4. **Create Transaction** untuk menambah data
5. Test endpoint lainnya sesuai kebutuhan

## 🔧 Perubahan Utama (Fix CSRF Error)

### ✅ Yang Sudah Diperbaiki
- ✅ CSRF token otomatis diekstrak dari halaman login
- ✅ Format request menggunakan `application/x-www-form-urlencoded`
- ✅ PUT/DELETE menggunakan POST dengan `_method` field
- ✅ Environment variables sudah disetup dengan benar

### ❌ Yang Tidak Lagi Digunakan
- ❌ JSON format untuk request body
- ❌ Manual CSRF token input
- ❌ Method PUT/DELETE langsung

## 📚 Dokumentasi Lengkap

- **Panduan Lengkap**: `POSTMAN_GUIDE.md`
- **Setup Environment**: `POSTMAN_ENVIRONMENT.md`
- **Database Schema**: `catatan_keuangan.sql`

## 🎯 Endpoint yang Tersedia

### Authentication
- `GET /login` - Get CSRF Token ⭐
- `POST /login` - Login
- `POST /register` - Register
- `POST /logout` - Logout
- `POST /password/email` - Forgot Password
- `POST /password/reset` - Reset Password

### Transactions
- `GET /transactions` - Get All Transactions
- `GET /transactions/{id}` - Get Transaction by ID
- `POST /transactions` - Create Transaction
- `POST /transactions/{id}` - Update Transaction (with _method: PUT)
- `POST /transactions/{id}` - Delete Transaction (with _method: DELETE)

### Dashboard
- `GET /dashboard` - Get Dashboard
- `GET /home` - Get Home (redirects to transactions)

### Landing Page
- `GET /` - Get Landing Page

## 🐛 Troubleshooting

### CSRF Token Error
```
Error: "CSRF token mismatch"
```
**Solusi**: Jalankan "Get CSRF Token" terlebih dahulu

### Connection Error
```
Error: "Connection refused"
```
**Solusi**: Pastikan `php artisan serve` sudah berjalan

### Environment Variables Not Found
```
Error: "{{base_url}} not found"
```
**Solusi**: Pilih environment yang benar di dropdown

## 📊 Data Testing

### Akun Default
```
Email: admin@gmail.com
Password: admin123
```

### Contoh Transaksi
```json
// Income
{
  "description": "Gaji Bulanan",
  "amount": "5000000",
  "type": "income"
}

// Expense
{
  "description": "Belanja Bulanan", 
  "amount": "350000",
  "type": "expense"
}
```

## 🔐 Security Notes

- CSRF protection aktif untuk semua POST/PUT/DELETE
- Authentication required untuk transactions & dashboard
- Session-based authentication
- Password hashing dengan bcrypt

## 📞 Support

Jika mengalami masalah:
1. Cek dokumentasi di `POSTMAN_GUIDE.md`
2. Pastikan aplikasi Laravel berjalan
3. Cek environment variables sudah benar
4. Jalankan "Get CSRF Token" terlebih dahulu

---

**Happy Testing! 🎉** 