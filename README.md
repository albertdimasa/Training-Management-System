# TMS - Training Management System

Aplikasi **Training Management System (TMS)** untuk mengelola data pelatihan, instruktor, dan course.

## Requirements

| Software | Version            |
| -------- | ------------------ |
| PHP      | ^8.3               |
| Laravel  | ^11.0              |
| Node.js  | Latest (untuk npm) |
| Postgres | ^18                |

### Dependencies Utama

**Production:**

-   `laravel/framework` ^11.0
-   `laravel/tinker` ^2.10.1

**Development:**

-   `fakerphp/faker` ^1.23
-   `laravel/pail` ^1.2.2
-   `laravel/pint` ^1.24
-   `laravel/sail` ^1.41
-   `phpunit/phpunit` ^11.5.3

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
DB_CONNECTION=pqsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=tms_db
DB_USERNAME=postgres
DB_PASSWORD=
```

Jalankan migrasi dan seeder:

```bash
php artisan migrate
php artisan db:seed
```

### 5. Jalankan Aplikasi

```bash
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

### 6. Login

| Field    | Value           |
| -------- | --------------- |
| Email    | admin@test.com  |
| Password | password        |


---

## Struktur Folder Penting

```
tms/
├── app/
│   ├── Http/
│   │   └── Controllers/       # Controller untuk handle logic request
│   │       └── Master/        # Controller untuk handle master data
│   │       └── Report/        # Controller untuk handle report data
│   └── Models/                # Model Eloquent untuk database
│       └── Master/            # Model untuk master data
│       └── Report/            # Model untuk report data
│
├── database/
│   ├── migrations/            # File migrasi struktur database
│   └── seeders/               # Data dummy untuk development
│
├── public/
│   └── assets/                # Asset statis (CSS, JS, images)
│       ├── css/               # Stylesheet (Admiro template)
│       ├── js/                # JavaScript files
│       └── images/            # Gambar dan icon
│
├── resources/
│   └── views/                 # Blade templates
│       ├── layouts/           # Layout utama (default.blade.php)
│       ├── partials/          # Komponen partial (sidebar, footer)
│       ├── master/            # Halaman master data
│       │   ├── instructor/    # CRUD Instruktor
│       │   └── course/        # CRUD Course
│       └── template/          # Template referensi (Admiro)
│
├── routes/
│   └── web.php                # Definisi routing aplikasi
```

---

## Pendekatan & Arsitektur

### 1. MVC Pattern

Aplikasi menggunakan pola **Model-View-Controller** standar Laravel:

-   **Model**: Eloquent ORM untuk interaksi database
-   **View**: Blade templating engine
-   **Controller**: Handle request dan business logic

### 2. Template Admin

Menggunakan **Admiro Admin Template** (Bootstrap 5) untuk UI yang modern dan responsif.

### 3. Fitur Utama yang sudah bisa digunakan

-   **Autentikasi**: Login aplikasi
-   **Master Instruktor**: CRUD data instruktor
-   **Master Course**: CRUD data course

### 4. Fitur yang akan diimplementasikan

-   **Dashboard**: Realtime ringkasan data
-   **Laporan**: Laporan data (Export Excel & PDF)

---

<!-- ## License

Open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT). -->
