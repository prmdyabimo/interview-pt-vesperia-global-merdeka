# 🧪 Software Engineer Test PT. Vesperia Global Merdeka

## 📋 Deskripsi Singkat

Repository ini merupakan hasil pengerjaan tes untuk posisi Software Engineer. Aplikasi ini dibangun dengan arsitektur fullstack yang terdiri dari backend (Laravel 12), frontend (React.js), dan database (PostgreSQL). Tujuannya adalah untuk menampilkan dan mengelola formulir dinamis yang bersumber dari file JSON.

---

## ✅ Fitur yang Diimplementasikan

### 🔙 Backend - Laravel 12
- Menggunakan framework **Laravel 12** sebagai backend utama
- Mengonsumsi data form dalam format **JSON**
- Menyimpan struktur form ke dalam database
- Menyediakan API untuk:
  - Mengambil struktur form
  - Menerima dan menyimpan data hasil pengisian form
- Mengikuti prinsip **clean architecture** dan separation of concern
- Dipertimbangkan efisiensi penggunaan memori saat memproses data JSON

### 🧑‍💻 Frontend - React.js
- Menggunakan **React.js** untuk membangun antarmuka pengguna
- Menarik data form dari backend API
- Menampilkan elemen form dinamis berdasarkan struktur JSON
- Mengirim hasil input pengguna ke endpoint Laravel
- UI dibuat minimalis sesuai instruksi (desain tidak dinilai)

### 🗄️ Database - PostgreSQL
- Menggunakan **PostgreSQL**
- Struktur form dan hasil isian disimpan dalam kolom bertipe **JSONB**
- Indeks ditambahkan untuk efisiensi query data JSON

---

## 🙌 Hal yang Disarankan (Nice to Have)
- ✅ Unit test untuk beberapa komponen dan endpoint
- ✅ File migrasi database menggunakan Laravel Migration

---

## 🚀 Cara Menjalankan

### 1. Clone Repository
```bash
https://github.com/prmdyabimo/interview-pt-vesperia-global-merdeka.git
