# InfoNow! - Platform Manajemen Artikel

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2+">
  <img src="https://img.shields.io/badge/Tailwind_CSS-4.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS 4.x">
  <img src="https://img.shields.io/badge/Vite-7.x-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite 7.x">
</p>

## 📖 Tentang Proyek

**InfoNow!** adalah aplikasi web manajemen artikel yang dibangun dengan Laravel 12. Platform ini memungkinkan admin untuk membuat, mengedit, dan mengelola artikel dengan mudah, serta menyediakan halaman landing yang menarik untuk pembaca.

### ✨ Fitur Utama

- 🔐 **Sistem Autentikasi** - Login & Register dengan validasi
- 📝 **CRUD Artikel** - Create, Read, Update, Delete artikel
- 🖼️ **Upload Gambar** - Gambar unggulan untuk setiap artikel dengan fallback placeholder
- 🏠 **Landing Page** - Tampilan publik yang menarik dengan 3 artikel terbaru
- 📋 **List Artikel** - Halaman semua artikel dengan pagination
- 📄 **Detail Artikel** - Halaman detail dengan fitur share (WhatsApp & Copy Link)
- 📊 **Dashboard** - Statistik real-time (total artikel, admin, artikel hari ini)
- 🔍 **Search & Filter** - Pencarian artikel dengan DataTables
- 📱 **Responsive Design** - Optimal di desktop, tablet, dan mobile
- 🎨 **Modern UI** - Tailwind CSS dengan Alpine.js untuk interaktivitas

---

## 🛠️ Tech Stack

| Teknologi | Versi | Deskripsi |
|-----------|-------|-----------|
| **Laravel** | 12.x | PHP Framework untuk backend |
| **PHP** | 8.2+ | Bahasa pemrograman server-side |
| **Tailwind CSS** | 4.x | CSS Framework untuk styling |
| **Alpine.js** | 3.x | JavaScript framework untuk interaktivitas |
| **Vite** | 7.x | Build tool & HMR |
| **DataTables** | - | Table dengan search, sort, pagination |
| **jQuery** | - | JavaScript library |

---

## 📋 Persyaratan Sistem

Sebelum memulai, pastikan sistem Anda memenuhi persyaratan berikut:

- **PHP** >= 8.2
- **Composer** >= 2.0
- **Node.js** >= 18.x
- **NPM** atau **Yarn**
- **SQLite** (default) atau **MySQL/PostgreSQL**
- **Git** (untuk clone repository)

---

## 🚀 Instalasi & Setup

### 1. Clone Repository

```bash
git clone <repository-url>
cd article-web
```

### 2. Install Dependencies

#### Cara Otomatis (Recommended)

```bash
composer setup
```

Command ini akan menjalankan:
- `composer install` - Install PHP dependencies
- Copy `.env.example` ke `.env`
- `php artisan key:generate` - Generate application key
- `php artisan migrate` - Jalankan database migrations
- `npm install` - Install Node.js dependencies
- `npm run build` - Build assets untuk production

#### Cara Manual

```bash
# Install PHP dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Jalankan migrations
php artisan migrate

# Install Node.js dependencies
npm install

# Build assets
npm run build
```

### 3. Konfigurasi Database

#### SQLite (Default)

Tidak perlu konfigurasi tambahan. Database SQLite akan dibuat otomatis di `database/database.sqlite`.

#### MySQL/PostgreSQL

Edit file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=article_web
DB_USERNAME=root
DB_PASSWORD=
```

Kemudian jalankan:

```bash
php artisan migrate
```

### 4. Setup Storage Link

```bash
php artisan storage:link
```

Command ini membuat symbolic link dari `public/storage` ke `storage/app/public` untuk akses file upload.

### 5. (Opsional) Seed Database

```bash
php artisan db:seed
```

Atau untuk reset database dan seed ulang:

```bash
php artisan migrate:fresh --seed
```

---

## 🏃 Menjalankan Aplikasi

### Mode Development (Recommended)

Jalankan semua service development secara bersamaan:

```bash
composer dev
```

Command ini akan menjalankan:
- **PHP Development Server** - `http://localhost:8000`
- **Queue Worker** - Background job processing
- **Laravel Pail** - Real-time log viewer
- **Vite Dev Server** - Hot Module Replacement (HMR)

### Mode Manual

Buka **3 terminal** terpisah:

**Terminal 1 - PHP Server:**
```bash
php artisan serve
```

**Terminal 2 - Vite (HMR):**
```bash
npm run dev
```

**Terminal 3 - Queue Worker (Opsional):**
```bash
php artisan queue:work
```

### Akses Aplikasi

- **Landing Page**: http://localhost:8000
- **Dashboard**: http://localhost:8000/dashboard (Perlu login)
- **Login**: http://localhost:8000/login
- **Register**: http://localhost:8000/register

---

---


## 🛠️ Command

### Development

```bash
# Format code dengan Laravel Pint
vendor/bin/pint

# Run tests
composer test
php artisan test

# Clear cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# List routes
php artisan route:list
```

### Database

```bash
# Run migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Fresh migrations
php artisan migrate:fresh

# Seed database
php artisan db:seed

# Fresh + Seed
php artisan migrate:fresh --seed
```

### Assets

```bash
# Development (dengan HMR)
npm run dev

# Production build
npm run build

# Watch untuk perubahan
npm run watch
```

### Generate

```bash
# Controller
php artisan make:controller NamaController

# Model
php artisan make:model NamaModel

# Migration
php artisan make:migration create_table_name

# Seeder
php artisan make:seeder NamaSeeder
```


---


## 📄 License

Proyek ini menggunakan [MIT License](https://opensource.org/licenses/MIT).

---


## 📞 Support

Jika ada pertanyaan atau masalah, silakan buat issue di repository ini.

---

