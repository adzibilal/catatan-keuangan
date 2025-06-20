# Setup Environment Postman - Catatan Keuangan REST API

## Overview
Dokumen ini menjelaskan cara setup environment di Postman untuk REST API Catatan Keuangan (token-based).

## Langkah-langkah Setup Environment

### 1. Buat Environment Baru
1. Buka Postman
2. Klik tombol **"Environments"** di sidebar kiri
3. Klik tombol **"+"** untuk membuat environment baru
4. Beri nama: `Catatan Keuangan Local`

### 2. Tambahkan Variables
Tambahkan variable berikut:

| Variable Name | Initial Value                | Current Value                | Type    |
|---------------|-----------------------------|------------------------------|---------|
| `base_url`    | `http://127.0.0.1:8000`     | `http://127.0.0.1:8000`      | Default |
| `token`       | (kosong, isi setelah login) | (kosong, isi setelah login)  | Default |

### 3. Save Environment
1. Klik tombol **"Save"**
2. Environment akan muncul di dropdown di pojok kanan atas Postman

### 4. Pilih Environment
1. Di dropdown environment (pojok kanan atas), pilih `Catatan Keuangan Local`
2. Pastikan environment aktif sebelum menjalankan request

## Cara Kerja Token
- Setelah login/register, copy token dari response
- Set token ke variable `token` di environment
- Semua request yang butuh autentikasi akan otomatis menggunakan Bearer Token ini

## Contoh Environment JSON

```json
{
  "id": "catatan-keuangan-env",
  "name": "Catatan Keuangan Local",
  "values": [
    {
      "key": "base_url",
      "value": "http://127.0.0.1:8000",
      "type": "default",
      "enabled": true
    },
    {
      "key": "token",
      "value": "",
      "type": "default",
      "enabled": true
    }
  ],
  "_postman_variable_scope": "environment"
}
```

## Troubleshooting
- Pastikan token sudah diisi setelah login/register
- Jika token expired, login ulang dan update token
- Pastikan environment aktif sebelum testing

## Support
Jika mengalami masalah dengan environment:
1. Pastikan aplikasi berjalan
2. Token sudah diisi
3. Environment sudah aktif 