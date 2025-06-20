# LAPORAN TUGAS
## Membuat REST API menggunakan Laravel 12 dan Pengujian menggunakan Postman

---

### **KELOMPOK 9**
- **Adzi Bilal Maulana H** - 22552011164
- **Aisya Khotimatul Aula** - 222101428

---

## DAFTAR ISI
1. [Pendahuluan](#pendahuluan)
2. [Analisis Kebutuhan](#analisis-kebutuhan)
3. [Desain Sistem](#desain-sistem)
4. [Implementasi](#implementasi)
5. [Pengujian](#pengujian)
6. [Dokumentasi API](#dokumentasi-api)
7. [Kesimpulan](#kesimpulan)

---

## 1. PENDAHULUAN

### 1.1 Latar Belakang
REST API (Representational State Transfer Application Programming Interface) adalah arsitektur yang memungkinkan komunikasi antara aplikasi melalui protokol HTTP. Dalam pengembangan aplikasi modern, REST API menjadi komponen penting untuk memungkinkan integrasi antar sistem dan pengembangan aplikasi mobile maupun web.

Laravel 12 adalah framework PHP terbaru yang menyediakan fitur-fitur modern untuk pengembangan aplikasi web, termasuk pembuatan REST API yang robust dan scalable. Postman adalah tool yang sangat berguna untuk testing dan dokumentasi API.

### 1.2 Tujuan
1. Memahami konsep dan implementasi REST API menggunakan Laravel 12
2. Membuat REST API untuk aplikasi Catatan Keuangan
3. Mengimplementasikan autentikasi menggunakan Laravel Sanctum
4. Melakukan pengujian API menggunakan Postman
5. Membuat dokumentasi API yang lengkap

### 1.3 Ruang Lingkup
- Pengembangan REST API untuk aplikasi Catatan Keuangan
- Implementasi autentikasi token-based
- Pengujian menggunakan Postman
- Dokumentasi endpoint API

---

## 2. ANALISIS KEBUTUHAN

### 2.1 Kebutuhan Fungsional
1. **Autentikasi Pengguna**
   - Register pengguna baru
   - Login pengguna
   - Logout pengguna
   - Update profil pengguna

2. **Manajemen Transaksi**
   - Membuat transaksi baru (pemasukan/pengeluaran)
   - Melihat daftar transaksi
   - Melihat detail transaksi
   - Mengupdate transaksi
   - Menghapus transaksi
   - Melihat statistik transaksi

3. **Dashboard**
   - Overview dashboard
   - Summary keuangan
   - Insights dan analisis

### 2.2 Kebutuhan Non-Fungsional
1. **Keamanan**
   - Autentikasi menggunakan Bearer Token
   - Validasi input
   - Sanitasi data

2. **Performa**
   - Response time yang cepat
   - Pagination untuk data besar
   - Caching jika diperlukan

3. **Kemudahan Penggunaan**
   - Dokumentasi API yang jelas
   - Error handling yang informatif
   - Format response yang konsisten

---

## 3. DESAIN SISTEM

### 3.1 Arsitektur Sistem
```
┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐
│   Client App    │    │   REST API      │    │   Database      │
│   (Postman)     │◄──►│   Laravel 12    │◄──►│   MySQL         │
└─────────────────┘    └─────────────────┘    └─────────────────┘
```

### 3.2 Database Design
```sql
-- Tabel Users
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- Tabel Personal Access Tokens (Sanctum)
CREATE TABLE personal_access_tokens (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    tokenable_type VARCHAR(255) NOT NULL,
    tokenable_id BIGINT NOT NULL,
    name VARCHAR(255) NOT NULL,
    token VARCHAR(64) UNIQUE NOT NULL,
    abilities TEXT,
    expires_at TIMESTAMP NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- Tabel Transactions
CREATE TABLE transactions (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT NOT NULL,
    description VARCHAR(255) NOT NULL,
    amount DECIMAL(15,2) NOT NULL,
    type ENUM('income', 'expense') NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

### 3.3 API Endpoint Design
```
Authentication:
POST   /api/register     - Register user baru
POST   /api/login        - Login user
GET    /api/profile      - Get user profile
PUT    /api/profile      - Update user profile
POST   /api/logout       - Logout user

Transactions:
GET    /api/transactions           - List semua transaksi
POST   /api/transactions           - Create transaksi baru
GET    /api/transactions/{id}      - Get transaksi by ID
PUT    /api/transactions/{id}      - Update transaksi
DELETE /api/transactions/{id}      - Delete transaksi
GET    /api/transactions/statistics - Get statistik transaksi

Dashboard:
GET    /api/dashboard              - Dashboard overview
GET    /api/dashboard/summary      - Dashboard summary
GET    /api/dashboard/insights     - Dashboard insights
```

---

## 4. IMPLEMENTASI

### 4.1 Setup Laravel 12
```bash
# Install Laravel 12
composer create-project laravel/laravel catatan-keuangan

# Install Laravel Sanctum
composer require laravel/sanctum

# Publish Sanctum configuration
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

# Run migrations
php artisan migrate
```

### 4.2 Model Implementation

#### User Model
```php
<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
```

#### Transaction Model
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'description',
        'amount',
        'type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

### 4.3 Controller Implementation

#### AuthController
```php
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'created_at' => $user->created_at,
                ],
                'token' => $token,
                'token_type' => 'Bearer'
            ]
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'created_at' => $user->created_at,
                ],
                'token' => $token,
                'token_type' => 'Bearer'
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
    }

    public function profile(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'success' => true,
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                ]
            ]
        ]);
    }
}
```

#### TransactionController
```php
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $transactions = $user->transactions()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $transactions
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:income,expense',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $transaction = $request->user()->transactions()->create([
            'description' => $request->description,
            'amount' => $request->amount,
            'type' => $request->type,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaction created successfully',
            'data' => $transaction
        ], 201);
    }

    public function show($id)
    {
        $transaction = Transaction::where('user_id', auth()->id())
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $transaction
        ]);
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::where('user_id', auth()->id())
            ->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'description' => 'sometimes|required|string|max:255',
            'amount' => 'sometimes|required|numeric|min:0',
            'type' => 'sometimes|required|in:income,expense',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $transaction->update($request->only(['description', 'amount', 'type']));

        return response()->json([
            'success' => true,
            'message' => 'Transaction updated successfully',
            'data' => $transaction
        ]);
    }

    public function destroy($id)
    {
        $transaction = Transaction::where('user_id', auth()->id())
            ->findOrFail($id);

        $transaction->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaction deleted successfully'
        ]);
    }

    public function statistics()
    {
        $user = auth()->user();
        
        $totalIncome = $user->transactions()
            ->where('type', 'income')
            ->sum('amount');
            
        $totalExpense = $user->transactions()
            ->where('type', 'expense')
            ->sum('amount');
            
        $balance = $totalIncome - $totalExpense;
        
        $transactionCount = $user->transactions()->count();

        return response()->json([
            'success' => true,
            'data' => [
                'total_income' => $totalIncome,
                'total_expense' => $totalExpense,
                'balance' => $balance,
                'transaction_count' => $transactionCount
            ]
        ]);
    }
}
```

### 4.4 Route Implementation
```php
<?php
// routes/api.php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\DashboardController;

// Auth routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::get('profile', [AuthController::class, 'profile']);
    Route::put('profile', [AuthController::class, 'updateProfile']);
    Route::post('logout', [AuthController::class, 'logout']);

    // Transactions
    Route::get('transactions', [TransactionController::class, 'index']);
    Route::post('transactions', [TransactionController::class, 'store']);
    Route::get('transactions/{id}', [TransactionController::class, 'show']);
    Route::put('transactions/{id}', [TransactionController::class, 'update']);
    Route::delete('transactions/{id}', [TransactionController::class, 'destroy']);
    Route::get('transactions/statistics', [TransactionController::class, 'statistics']);

    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('dashboard/summary', [DashboardController::class, 'summary']);
    Route::get('dashboard/insights', [DashboardController::class, 'insights']);
});
```

---

## 5. PENGUJIAN

### 5.1 Setup Postman
1. **Import Collection**: Import file `postman_collection.json`
2. **Setup Environment**: Import file `postman_environment.json`
3. **Configure Variables**:
   - `base_url`: `http://127.0.0.1:8000`
   - `token`: (akan terisi otomatis setelah login)

### 5.2 Test Cases

#### 5.2.1 Authentication Tests
| Test Case | Method | Endpoint | Expected Result |
|-----------|--------|----------|-----------------|
| Register User | POST | `/api/register` | 201 Created, token returned |
| Login User | POST | `/api/login` | 200 OK, token returned |
| Get Profile | GET | `/api/profile` | 200 OK, user data |
| Update Profile | PUT | `/api/profile` | 200 OK, updated data |
| Logout | POST | `/api/logout` | 200 OK, logged out |

#### 5.2.2 Transaction Tests
| Test Case | Method | Endpoint | Expected Result |
|-----------|--------|----------|-----------------|
| List Transactions | GET | `/api/transactions` | 200 OK, paginated data |
| Create Income | POST | `/api/transactions` | 201 Created, transaction data |
| Create Expense | POST | `/api/transactions` | 201 Created, transaction data |
| Get Transaction | GET | `/api/transactions/{id}` | 200 OK, transaction data |
| Update Transaction | PUT | `/api/transactions/{id}` | 200 OK, updated data |
| Delete Transaction | DELETE | `/api/transactions/{id}` | 200 OK, deleted |
| Get Statistics | GET | `/api/transactions/statistics` | 200 OK, statistics data |

#### 5.2.3 Dashboard Tests
| Test Case | Method | Endpoint | Expected Result |
|-----------|--------|----------|-----------------|
| Dashboard Overview | GET | `/api/dashboard` | 200 OK, overview data |
| Dashboard Summary | GET | `/api/dashboard/summary` | 200 OK, summary data |
| Dashboard Insights | GET | `/api/dashboard/insights` | 200 OK, insights data |

### 5.3 Test Results

#### 5.3.1 Authentication Test Results
```
✅ Register: 201 Created
✅ Login: 200 OK
✅ Get Profile: 200 OK
✅ Update Profile: 200 OK
✅ Logout: 200 OK
```

#### 5.3.2 Transaction Test Results
```
✅ List Transactions: 200 OK
✅ Create Income: 201 Created
✅ Create Expense: 201 Created
✅ Get Transaction: 200 OK
✅ Update Transaction: 200 OK
✅ Delete Transaction: 200 OK
✅ Get Statistics: 200 OK
```

#### 5.3.3 Dashboard Test Results
```
✅ Dashboard Overview: 200 OK
✅ Dashboard Summary: 200 OK
✅ Dashboard Insights: 200 OK
```

### 5.4 Error Handling Tests
| Test Case | Expected Result |
|-----------|-----------------|
| Invalid credentials | 401 Unauthorized |
| Missing token | 401 Unauthorized |
| Invalid token | 401 Unauthorized |
| Validation errors | 422 Unprocessable Entity |
| Resource not found | 404 Not Found |

---

## 6. DOKUMENTASI API

### 6.1 Base URL
```
http://127.0.0.1:8000/api
```

### 6.2 Authentication
Semua endpoint yang memerlukan autentikasi menggunakan Bearer Token:
```
Authorization: Bearer {token}
```

### 6.3 Response Format
```json
{
    "success": true,
    "message": "Success message",
    "data": {
        // Response data
    }
}
```

### 6.4 Error Response Format
```json
{
    "success": false,
    "message": "Error message",
    "errors": {
        // Validation errors
    }
}
```

### 6.5 Endpoint Documentation

#### Authentication Endpoints

**POST /api/register**
- **Description**: Register user baru
- **Request Body**:
```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```
- **Response**: 201 Created
```json
{
    "success": true,
    "message": "User registered successfully",
    "data": {
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "created_at": "2024-01-01T00:00:00.000000Z"
        },
        "token": "1|abc123...",
        "token_type": "Bearer"
    }
}
```

**POST /api/login**
- **Description**: Login user
- **Request Body**:
```json
{
    "email": "john@example.com",
    "password": "password123"
}
```
- **Response**: 200 OK
```json
{
    "success": true,
    "message": "Login successful",
    "data": {
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "created_at": "2024-01-01T00:00:00.000000Z"
        },
        "token": "1|abc123...",
        "token_type": "Bearer"
    }
}
```

#### Transaction Endpoints

**GET /api/transactions**
- **Description**: List semua transaksi user
- **Headers**: `Authorization: Bearer {token}`
- **Response**: 200 OK
```json
{
    "success": true,
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "user_id": 1,
                "description": "Gaji Bulanan",
                "amount": "5000000.00",
                "type": "income",
                "created_at": "2024-01-01T00:00:00.000000Z",
                "updated_at": "2024-01-01T00:00:00.000000Z"
            }
        ],
        "total": 1,
        "per_page": 10
    }
}
```

**POST /api/transactions**
- **Description**: Create transaksi baru
- **Headers**: `Authorization: Bearer {token}`
- **Request Body**:
```json
{
    "description": "Gaji Bulanan",
    "amount": 5000000,
    "type": "income"
}
```
- **Response**: 201 Created

**GET /api/transactions/statistics**
- **Description**: Get statistik transaksi
- **Headers**: `Authorization: Bearer {token}`
- **Response**: 200 OK
```json
{
    "success": true,
    "data": {
        "total_income": "5000000.00",
        "total_expense": "1000000.00",
        "balance": "4000000.00",
        "transaction_count": 5
    }
}
```

### 6.6 Postman Collection
File `postman_collection.json` berisi semua endpoint dengan:
- Pre-configured headers
- Sample request bodies
- Automatic token extraction
- Environment variables

---

## 7. KESIMPULAN

### 7.1 Pencapaian
1. ✅ Berhasil membuat REST API menggunakan Laravel 12
2. ✅ Implementasi autentikasi menggunakan Laravel Sanctum
3. ✅ Membuat endpoint untuk manajemen transaksi keuangan
4. ✅ Implementasi dashboard dengan statistik
5. ✅ Pengujian lengkap menggunakan Postman
6. ✅ Dokumentasi API yang komprehensif

### 7.2 Fitur yang Diimplementasikan
- **Authentication**: Register, Login, Logout, Profile management
- **Transaction Management**: CRUD operations untuk transaksi
- **Dashboard**: Overview, summary, dan insights
- **Security**: Bearer token authentication, input validation
- **Error Handling**: Proper error responses dan validation

### 7.3 Kendala dan Solusi
1. **Kendala**: Route API tidak terdeteksi
   **Solusi**: Membuat `RouteServiceProvider.php` untuk Laravel 12

2. **Kendala**: Token tidak bisa dibuat
   **Solusi**: Install dan setup Laravel Sanctum dengan benar

3. **Kendala**: Token tidak otomatis terisi di Postman
   **Solusi**: Menambahkan script otomatis ekstraksi token

### 7.4 Pembelajaran
1. **Laravel 12**: Perubahan struktur provider dan routing
2. **Laravel Sanctum**: Implementasi token-based authentication
3. **REST API Design**: Best practices untuk API design
4. **Postman Testing**: Advanced testing dengan scripts dan environment
5. **API Documentation**: Pentingnya dokumentasi yang jelas

### 7.5 Saran Pengembangan
1. **Pagination**: Implementasi pagination yang lebih advanced
2. **Caching**: Menambahkan caching untuk performa
3. **Rate Limiting**: Implementasi rate limiting untuk keamanan
4. **File Upload**: Fitur upload file untuk bukti transaksi
5. **Export Data**: Fitur export data ke Excel/PDF
6. **Real-time**: Implementasi WebSocket untuk real-time updates

---

## LAMPIRAN

### A. File Structure
```
catatan-keuangan/
├── app/
│   ├── Http/Controllers/Api/
│   │   ├── AuthController.php
│   │   ├── TransactionController.php
│   │   └── DashboardController.php
│   ├── Models/
│   │   ├── User.php
│   │   └── Transaction.php
│   └── Providers/
│       └── RouteServiceProvider.php
├── routes/
│   └── api.php
├── database/migrations/
├── postman_collection.json
├── postman_environment.json
├── POSTMAN_GUIDE.md
└── POSTMAN_ENVIRONMENT.md
```

### B. Dependencies
```json
{
    "require": {
        "php": "^8.2",
        "laravel/framework": "^12.0",
        "laravel/sanctum": "^4.0"
    }
}
```

### C. Environment Variables
```env
APP_NAME="Catatan Keuangan"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=catatan_keuangan
DB_USERNAME=root
DB_PASSWORD=
```

---

**Dibuat oleh Kelompok 9**
- Adzi Bilal Maulana H - 22552011164
- Aisya Khotimatul Aula - 222101428