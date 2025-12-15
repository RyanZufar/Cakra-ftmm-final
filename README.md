# Notes Project

## Identitas Kelompok
- **Nomor Kelompok**: Kelompok K
- **Judul Project**: Cakra FTMM
- **Nama Anggota Kelompok**:
  1. MUHAMMAD FAZIL IRVAN PUTRA (164231022)
  2. RICHARD RAFFAEL DWI NANDA (164231023)
  3. RACHMA NABILA PUTRI (164231073)
  4. RYAN ZUFAR AHMADI (164231096)
  5. MELDA JESICA TELSYE SALAKA (164231108)

## List Library yang Digunakan

### Backend (PHP - Laravel)
- **Framework**: Laravel 12.0
- **Authentication**: Laravel Breeze
- **Development Tools**: 
  - Laravel Sail
  - Laravel Pail
  - Laravel Tinker
  - Laravel Pint
- **Testing**: 
  - Pest
  - Mockery
  - FakerPHP

### Frontend (JavaScript & CSS)
- **Build Tool**: Vite
- **Styling**: Tailwind CSS
- **Interactivity**: Alpine.js
- **HTTP Client**: Axios
- **Plugins**: 
  - @tailwindcss/forms
  - autoprefixer

## Tata Cara Penggunaan Code

Berikut adalah langkah-langkah untuk menjalankan project ini di komputer lokal Anda:

### 1. Prasyarat
Pastikan Anda telah menginstall:
- PHP >= 8.2
- Composer
- Node.js & NPM

### 2. Instalasi Dependensi
Jalankan perintah berikut di terminal:

```bash
# Install dependensi PHP
composer install

# Install dependensi JavaScript
npm install
```

### 3. Konfigurasi Environment
Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Kemudian generate application key:

```bash
php artisan key:generate
```

Sesuaikan konfigurasi database di file `.env` jika diperlukan (default menggunakan SQLite atau MySQL).

### 4. Setup Database
Jalankan migrasi database:

```bash
php artisan migrate
```

### 5. Menjalankan Aplikasi
Untuk menjalankan aplikasi dalam mode development:

```bash
npm run dev
```

Jika Anda menggunakan `composer run dev`, perintah ini akan menjalankan beberapa service sekaligus (server, queue, logs, vite).

Atau jika ingin menjalankan server PHP dan build aset secara terpisah:

```bash
php artisan serve
npm run dev
```

Akses aplikasi melalui browser di `http://localhost:8000`.

### 6. Testing
Untuk menjalankan automated testing:

```bash
php artisan test
```
