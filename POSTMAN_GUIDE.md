# Panduan Penggunaan Postman Collection - Catatan Keuangan REST API

## Overview
Postman collection ini berisi endpoint REST API aplikasi Catatan Keuangan. Collection ini digunakan untuk testing API berbasis token (Bearer Token) dan format JSON.

## Setup Awal

### 1. Import Collection
1. Buka Postman
2. Klik tombol "Import"
3. Pilih file `postman_collection.json`
4. Collection akan muncul di sidebar Postman

### 2. Setup Environment Variables
Collection ini menggunakan environment variable berikut:

- `base_url`: URL dasar aplikasi (default: `http://127.0.0.1:8000`)
- `token`: Bearer Token (akan otomatis terisi setelah login/register berhasil)

### 3. Menjalankan Aplikasi
Pastikan aplikasi Laravel sudah berjalan:
```bash
php artisan serve
```

## Cara Autentikasi & Testing API

### 1. Register
- Jalankan request **Register** untuk membuat akun baru
- Endpoint: `POST /api/register`
- Body: JSON (lihat contoh di collection)
- **Token akan otomatis terisi** di environment variable `token`

### 2. Login
- Jalankan request **Login** dengan email & password
- Endpoint: `POST /api/login`
- Body: JSON
- **Token akan otomatis terisi** di environment variable `token`

### 3. Cek Token Otomatis
- Buka **Console** di Postman (View > Show Postman Console)
- Setelah login/register berhasil, lihat log: "Token extracted from login/register: [token]"
- Token sudah otomatis tersimpan di environment

### 4. Testing Endpoint Lain
- Jalankan request lain (profile, transaksi, dashboard) dengan Bearer Token
- Header Authorization: `Bearer {{token}}` akan otomatis terisi

## Struktur Collection

### 1. Auth
- Register: `POST /api/register` (token otomatis terisi)
- Login: `POST /api/login` (token otomatis terisi)
- Profile: `GET /api/profile`
- Update Profile: `PUT /api/profile`
- Logout: `POST /api/logout`

### 2. Transactions
- List Transactions: `GET /api/transactions`
- Create Transaction: `POST /api/transactions`
- Get Transaction by ID: `GET /api/transactions/{id}`
- Update Transaction: `PUT /api/transactions/{id}`
- Delete Transaction: `DELETE /api/transactions/{id}`
- Transaction Statistics: `GET /api/transactions/statistics`

### 3. Dashboard
- Dashboard Overview: `GET /api/dashboard`
- Dashboard Summary: `GET /api/dashboard/summary`
- Dashboard Insights: `GET /api/dashboard/insights`

## Troubleshooting

### 1. Token Error
- Pastikan sudah login/register dan token sudah di-set di environment
- Jika token expired, login ulang
- Cek console Postman untuk melihat log ekstraksi token

### 2. Validation Error
- Pastikan format data JSON sesuai dengan yang diharapkan
- Cek field required

### 3. Authentication Error
- Pastikan header Authorization: Bearer sudah terisi
- Pastikan token valid

### 4. Database Error
- Pastikan database sudah berjalan dan sudah migrate

## Data Testing

### Akun Default
- Email: admin@gmail.com
- Password: admin123

### Contoh Data Transaksi
- description: Gaji Bulanan
- amount: 5000000
- type: income

## Security Notes
- Semua endpoint API menggunakan Bearer Token
- Tidak perlu CSRF token untuk endpoint API
- Data dikirim dan diterima dalam format JSON

## Support
Jika mengalami masalah:
1. Pastikan aplikasi Laravel berjalan
2. Database sudah migrate
3. Token sudah di-set di environment
4. Cek response error untuk detail
5. Buka console Postman untuk melihat log ekstraksi token 