# TMS - Training Management System

Aplikasi **Training Management System (TMS)** untuk mengelola data pelatihan, instruktor, dan course.

## Requirements

| Software | Version            |
| -------- | ------------------ |
| PHP      | ^8.3               |
| Laravel  | ^12.0              |
| Composer | Latest             |
| Node.js  | Latest (untuk npm) |

### Dependencies Utama

**Production:**

-   `laravel/framework` ^12.0
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
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tms
DB_USERNAME=root
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

---

## Struktur Folder Penting

```
tms/
├── app/
│   ├── Http/
│   │   └── Controllers/       # Controller untuk handle logic request
│   └── Models/                # Model Eloquent untuk database
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
│
└── .env                       # Konfigurasi environment
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

### 3. Fitur Utama

-   **Dashboard**: Tampilan ringkasan data
-   **Master Instruktor**: CRUD data instruktor
-   **Master Course**: CRUD data course
-   **Laporan**: Halaman laporan (placeholder)

### 4. UI Components

-   **Modal Dialog**: Centered modal untuk create/edit dengan styling Admiro
-   **SweetAlert2**: Popup konfirmasi delete yang interaktif
-   **DataTables**: Tabel data responsif

---

## License

Open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
