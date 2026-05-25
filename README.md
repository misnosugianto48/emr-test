# Simple Electronic Medical Record (EMR) System

Sistem Pencatatan Rekam Medis Elektronik (EMR) sederhana untuk Klinik/Rumah Sakit Rawat Jalan. Sistem ini mengelola data pasien, pendaftaran kunjungan, asesmen klinis oleh dokter/perawat, hingga laporan statistik kunjungan.

---

## 🚀 Fitur Utama

Sistem ini dirancang dengan alur kerja pelayanan klinik yang teratur:

1. **Pendaftaran Pasien & Kunjungan**
   - **Manajemen Pasien**: CRUD lengkap data pasien dengan validasi data yang ketat.
   - **Kunjungan Baru**: Menggunakan komponen **Select2** untuk memudahkan pencarian data pasien lama tanpa harus membuat baru, beserta fitur pembatalan kunjungan (`cancelled`).

2. **Asesmen Rawat Jalan (Rekam Medis Dokter)**
   - **Tanda-tanda Vital**: Tekanan Darah (mmHg), Suhu Tubuh (°C), dan Berat Badan (kg).
   - **Pemeriksaan Medis**: Anamnesis Keluhan Utama, Diagnosis Awal, Terapi / Tindakan, dan Catatan Internal Dokter.
   - **Pembaruan Status Otomatis**: Status Kunjungan otomatis diperbarui dari `registered` (Terdaftar) menjadi `assessed` (Sudah Asesmen) seketika setelah hasil asesmen disimpan secara aman di dalam **Database Transaction**.

3. **Laporan Kunjungan (Visit Reports)**
   - **Advanced Query Filter**: Penyaringan laporan fleksibel berdasarkan rentang Tanggal, Nama Pasien, Dokter, Diagnosis, dan Status Kunjungan.
   - **Summary Info Box**: Menampilkan statistik ringkasan total kunjungan, antrean belum diperiksa, selesai diperiksa, dan batal yang berubah secara dinamis berdasarkan filter aktif.

4. **Keamanan & Autentikasi**
   - Seluruh panel dilindungi oleh sistem autentikasi **Laravel Breeze**.
   - Pengunjung anonim akan otomatis diblokir dan dialihkan langsung ke halaman **Login**.
   - Setelah masuk (Login), pengguna langsung diarahkan ke halaman **Visit Reports** (Laporan Kunjungan) sebagai pusat dashboard operasional.

---

## 🏛️ Arsitektur Aplikasi (Layered Architecture)

Aplikasi ini dibangun menggunakan arsitektur berlapis (*Layered Architecture*) untuk memastikan kerapian kode, modularitas, kemudahan pengujian, dan skalabilitas di masa depan:

```
Request ➔ Controller ➔ Service Layer ➔ Repository Layer ➔ Eloquent Model / Database
  │           ▲
  ▼           │
Form Request Validation
```

* **Controller**: Bertanggung jawab atas alur navigasi HTTP dan merender tampilan (*view*).
* **Form Request Validation**: Memastikan seluruh inputan formulir aman, lengkap, dan tervalidasi sebelum masuk ke logika bisnis.
* **Service Layer**: Menangani seluruh aturan dan logika bisnis (misalnya kalkulasi status medis).
* **Repository Layer**: Lapisan khusus untuk mengabstraksikan kueri database (Eloquent) agar tidak bercampur dengan logika bisnis.

---

## 🛠️ Stack Teknologi

* **Core Framework**: Laravel 13 (PHP 8.2+)
* **Authentication**: Laravel Breeze
* **Admin Panel UI**: Laravel AdminLTE v3
* **CSS & Components Framework**: Bootstrap 5 & FontAwesome 5
* **Interactions**: Select2 (Pencarian Dropdown Dinamis) & jQuery
* **Database**: MySQL

---

## 💻 Langkah Instalasi & Uji Coba

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi di lingkungan lokal Anda:

### 1. Persiapan Awal
Pastikan Anda sudah berada di direktori proyek dan jalankan pemasangan dependensi backend serta frontend:
```bash
composer install
npm install
```

### 2. Konfigurasi Environment
Salin berkas konfigurasi `.env` dan sesuaikan pengaturan koneksi database MySQL Anda:
```bash
cp .env.example .env
```
Jangan lupa generate app key:
```bash
php artisan key:generate
```

### 3. Migrasi & Seeder Database
Jalankan migrasi tabel beserta seeder untuk membuat akun Admin awal secara otomatis:
```bash
php artisan migrate --seed
```

### 4. Menjalankan Server Lokal
Jalankan server aplikasi Laravel bersamaan dengan compiler aset Vite di terminal terpisah:
```bash
# Terminal 1 (Backend)
php artisan serve

# Terminal 2 (Vite Assets compiler)
npm run dev
```

---

## 🔑 Kredensial Login Default

Setelah server berjalan, buka peramban dan akses alamat server lokal Anda (secara default: `http://127.0.0.1:8000`). Anda akan langsung diarahkan ke halaman Login. Gunakan akun berikut:

* **Email**: `admin@emr.com`
* **Password**: `password`

---
*EMR-Test System © 2026. Made with ❤️ using Laravel, AdminLTE ChatGPT and Antigravity.*
