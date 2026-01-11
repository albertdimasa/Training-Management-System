# TMS - Training Management System

Aplikasi **Training Management System (TMS)** untuk mengelola data pelatihan, klien, instruktur, course, peserta, dan keuangan.

## Requirements

| Software   | Version            |
| ---------- | ------------------ |
| PHP        | ^8.3               |
| Laravel    | ^11.0              |
| Node.js    | Latest (untuk npm) |
| PostgreSQL | ^15                |

---

## Cara Setup & Run

### 1. Clone Repository

```bash
git clone <repository-url>
cd tms
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Setup Database

Edit file `.env` untuk konfigurasi database:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=tms_db
DB_USERNAME=postgres
DB_PASSWORD=
```

Jalankan migrasi dan seeder:

```bash
php artisan migrate:fresh --seed
```

### 5. Jalankan Aplikasi

```bash
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

### 6. Login

| Role  | Email         | Password |
| ----- | ------------- | -------- |
| Admin | admin@tms.com | password |

---

## Module Structure

Aplikasi ini terdiri dari **4 modul utama**:

### 1. Master

-   **Client** - Data perusahaan/pelanggan
-   **Contact** - Kontak PIC dari client
-   **Venue** - Tempat pelatihan

### 2. Education

-   **Course** - Daftar materi pelatihan
-   **Instructor** - Data trainer/instruktur
-   **Training Batch** - Jadwal batch pelatihan
-   **Participant** - Data peserta pelatihan
-   **Enrollment** - Pendaftaran peserta ke batch
-   **Attendance** - Kehadiran harian
-   **Certificate** - Sertifikat yang diterbitkan

### 3. Operation

-   **Order** - Order header & line items
-   **Invoice** - Tagihan ke client
-   **Payment** - Pembayaran dari client

### 4. Financial

-   **Account** - Chart of Accounts
-   **Journal** - Journal entries (header & line)
-   **Trial Balance** - Neraca saldo (handled by JournalController)

---

## Design Decisions

### Mengapa JournalController Menangani Trial Balance?

`JournalController` menangani tampilan **Trial Balance (Neraca Saldo)** dengan mendelegasikan business logic ke `TrialBalanceService`:

1. **Separation of Concerns**

    - `JournalController` hanya menangani HTTP layer (request/response)
    - `TrialBalanceService` menangani semua business logic perhitungan saldo

2. **Single Source of Truth**  
   Trial Balance dihitung langsung dari data `JournalLine` yang di-join dengan `JournalHeader`. Ini memastikan konsistensi antara jurnal dan neraca saldo.

3. **Naming Convention**  
   Dalam konteks akuntansi, "Journal" sering merujuk ke keseluruhan sistem pencatatan termasuk Trial Balance.

### Arsitektur

```
┌─────────────────────┐     ┌─────────────────────────┐
│  JournalController  │────▶│  TrialBalanceService    │
│  - index()          │     │  - getTrialBalance()    │
│  - Handle HTTP      │     │  - getAccountBalances() │
└─────────────────────┘     │  - groupAccountsByType()│
                            └─────────────────────────┘
```

### Fitur Filter Tanggal

Trial Balance mendukung filter berdasarkan rentang tanggal:

-   **start_date**: Default ke tanggal 1 bulan berjalan
-   **end_date**: Opsional, hingga tanggal tertentu

Filter bekerja dengan join `journal_lines` ↔ `journal_headers` pada kolom `journal_date`.

```php
// JournalController
$startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
$endDate = $request->input('end_date');
$groupedAccounts = $this->trialBalanceService->getTrialBalance($startDate, $endDate);
```

### Perbedaan Trial Balance vs Balance Sheet

| Aspek         | Trial Balance                                      | Balance Sheet                                  |
| ------------- | -------------------------------------------------- | ---------------------------------------------- |
| **Periode**   | Range: `start_date` → `end_date`                   | Kumulatif: semua transaksi **s/d akhir bulan** |
| **Tipe Akun** | Semua (ASSET, LIABILITY, EQUITY, REVENUE, EXPENSE) | Hanya ASSET, LIABILITY, EQUITY                 |
| **Tujuan**    | Aktivitas transaksi dalam periode                  | Posisi keuangan kumulatif pada titik waktu     |

**Query perbedaan:**

```php
// Trial Balance - rentang tanggal
->where('journal_date', '>=', $startDate)
->where('journal_date', '<=', $endDate)

// Balance Sheet - kumulatif sampai akhir bulan
->where('journal_date', '<=', $endDate)  // Tanpa start_date
```

### Participant vs Client (Order & Enrollment)

**Alur pendaftaran:**

```
┌─────────────┐                    ┌─────────────────┐
│ Participant │───enrollment──────▶│ Training Batch  │
│ (Individu)  │                    │ (Jadwal kursus) │
└─────────────┘                    └─────────────────┘

┌─────────────┐    ┌──────────────┐    ┌─────────────────┐
│   Client    │───▶│ Order Header │───▶│   Order Lines   │
│ (Perusahaan)│    │ (1 per order)│    │ (multi-batch)   │
└─────────────┘    └──────────────┘    └─────────────────┘
```

**Penjelasan:**

-   **Participant** → Orang yang ikut training, masuk ke tabel `enrollments` (1 peserta ke 1 batch)
-   **Client** → Perusahaan yang memesan training, masuk ke tabel `order_headers` + `order_lines`
-   **1 Order Header** = 1 Client, bisa memilih beberapa Training Batch dengan Course ID berbeda

**Contoh:**

```
Client: PT ABC
└── Order Header #001
    ├── Order Line: Batch #5 (Course: Laravel)
    ├── Order Line: Batch #8 (Course: React)
    └── Order Line: Batch #12 (Course: DevOps)
```

## Database Schema

### Tables (17 total)

| Module    | Tables                                                                                                     |
| --------- | ---------------------------------------------------------------------------------------------------------- |
| Master    | `clients`, `contacts`, `venues`                                                                            |
| Education | `courses`, `instructors`, `training_batches`, `participants`, `enrollments`, `attendances`, `certificates` |
| Operation | `order_headers`, `order_lines`, `invoices`, `payments`                                                     |
| Financial | `accounts`, `journal_headers`, `journal_lines`                                                             |

---

## Folder Structure

```
tms/
├── app/
│   ├── Enums/                     # Enum definitions
│   │   ├── Master/
│   │   ├── Education/
│   │   ├── Operation/
│   │   └── Financial/
│   ├── Http/Controllers/
│   │   ├── Master/                # Client, Contact, Venue
│   │   ├── Education/             # Course, Instructor, Batch, Participant
│   │   ├── Operation/             # Order, Invoice, Payment
│   │   └── Financial/             # Account, Journal
│   └── Models/
│       ├── Master/
│       ├── Education/
│       ├── Operation/
│       └── Financial/
│
├── database/
│   ├── migrations/                # 18 migration files
│   └── seeders/                   # 16 seeder files
│
├── resources/views/
│   ├── layouts/                   # default.blade.php, public.blade.php
│   ├── partials/                  # sidebar, footer
│   ├── dashboard/                 # Dashboard view
│   ├── master/                    # Client, Contact, Venue views
│   ├── education/                 # Course, Instructor views
│   ├── operation/                 # Order, Invoice, Payment views
│   ├── financial/                 # Account, Journal views
│   └── public/                    # Public pages
│
└── routes/
    └── web.php                    # Route definitions
```

---

## Seeded Data

Seeder menyediakan data dummy untuk testing:

| Entity           | Count |
| ---------------- | ----- |
| Clients          | 50    |
| Contacts         | ~100  |
| Venues           | 20    |
| Instructors      | 25    |
| Courses          | 30    |
| Training Batches | 120   |
| Participants     | 600   |
| Orders           | 320   |
| Invoices         | ~200  |
| Payments         | ~300  |
| Enrollments      | ~2000 |
| Certificates     | ~500  |
| Accounts         | 22    |
| Journals         | ~800  |

---

## Features

### Implemented

-   ✅ Authentication (Login/Logout)
-   ✅ Dashboard with dynamic stats
-   ✅ Master CRUD (Client, Contact, Venue)
-   ✅ Education CRUD (Course, Instructor)
-   ✅ Role-based access (Admin)
-   ✅ Database seeders with realistic data

### Planned

-   📋 Training Batch management UI
-   📋 Participant enrollment flow
-   📋 Order & Invoice management
-   📋 Financial reports
-   📋 Export to Excel/PDF

---

## License

Open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
