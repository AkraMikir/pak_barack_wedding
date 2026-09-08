# Product Requirements Document (PRD)
## Web Undangan Pernikahan — Astri & Ridho

**Versi:** 1.0  
**Tanggal:** 1 September 2026  
**Status:** Final — Siap Implementasi

---

## 1. Ringkasan & Tujuan Proyek

Proyek ini adalah pembuatan **website undangan pernikahan digital** untuk pasangan **Sulastri (Astri)** dan **Ridho Iriano Sudarmazena**. Sistem ini dirancang untuk menggantikan undangan fisik dengan menyediakan informasi acara yang elegan, interaktif, mudah diakses melalui smartphone, dan mempermudah rekapitulasi kehadiran tamu secara otomatis melalui basis data terpusat.

---

## 2. Kebutuhan Fungsional (Fitur)

### 2.1 Penyapaan Tamu Dinamis
- Halaman pembuka (*cover*) menangkap parameter URL `?to=` dari sistem rute Laravel
- Menampilkan sapaan personal kepada tamu berdasarkan nilai parameter tersebut
- Contoh: `https://domain.com/?to=Budi` — *"Kepada Yth. Budi"*

### 2.2 Hitung Mundur Acara (Countdown Timer)
- Penghitung waktu mundur visual yang berjalan secara **real-time**
- Menampilkan **Hari, Jam, Menit, Detik** menuju hari-H
- Target waktu: **Jum'at, 23 Oktober 2026 pukul 08.00 WIB**
- Implementasi: Vanilla JS dengan `setInterval` setiap 1 detik

### 2.3 Sistem RSVP Terpadu
- Formulir interaktif dengan field:
  - Nama tamu (auto-filled dari parameter `?to=` jika tersedia)
  - Status kehadiran: `Hadir` / `Tidak Hadir`
  - Jumlah rombongan (hanya aktif jika status = Hadir)
  - Kolom ucapan / doa (opsional)
- Data dikirim via AJAX ke endpoint Laravel dan tersimpan ke MySQL

### 2.4 Buku Tamu Real-time
- Menampilkan daftar ucapan, doa, dan harapan yang dikirimkan tamu
- Di-render dari database, tampil seperti feed yang bisa di-scroll
- Update tanpa refresh halaman (polling atau setelah submit RSVP)

### 2.5 Akses Lokasi Instan
- Tombol **"Buka di Google Maps"** mengarah ke lokasi acara
- Alamat: Jln. Lombok RT 05 RW 01, Ds. Mergawati, Kec. Kroya, Kab. Cilacap

### 2.6 Salin Rekening Pintar (Copy to Clipboard)
- Tombol salin pada setiap nomor rekening di bagian Amplop Digital
- Implementasi: `navigator.clipboard.writeText()` via Vanilla JS
- Feedback visual: teks tombol berubah menjadi *"Tersalin!"* selama ±2 detik

---

## 3. Struktur Informasi Acara

### 3.1 Profil Mempelai

| | Mempelai Wanita | Mempelai Pria |
|---|---|---|
| **Nama Lengkap** | Sulastri | Ridho Iriano Sudarmazena |
| **Nama Panggilan** | Astri | Ridho |
| **Ayah** | Bapak Yasmudin | Bapak Wahyu Darma Putra |
| **Ibu** | Ibu Rasiwen | Ibu Yeni Handayani |

### 3.2 Jadwal Acara

| Acara | Waktu | Keterangan |
|---|---|---|
| **Akad Nikah** | 08.00 WIB | Jum'at, 23 Oktober 2026 |
| **Resepsi Pernikahan** | 10.00 WIB | Jum'at, 23 Oktober 2026 |

### 3.3 Lokasi Acara

> **Kediaman Mempelai Wanita**
> Jln. Lombok RT 05 RW 01
> Ds. Mergawati, Kec. Kroya, Kab. Cilacap

Seluruh rangkaian acara (Akad & Resepsi) diselenggarakan di lokasi yang sama.

### 3.4 Amplop Digital & Kado

**Rekening Bank:**

| Pemilik | Bank | Nomor Rekening |
|---|---|---|
| Ridho Iriano Sudarmazena | BCA | *(diisi saat implementasi)* |
| Sulastri | BCA | *(diisi saat implementasi)* |

**Pengiriman Kado Fisik:**
a.n. Sulastri / Keluarga Bpk. Yasmudin
Jln. Lombok RT 05 RW 01, Ds. Mergawati, Kec. Kroya, Kab. Cilacap

---

## 4. Spesifikasi Teknis & Lingkungan

### 4.1 Stack Teknologi

| Layer | Teknologi | Peran |
|---|---|---|
| **Backend / Routing** | Laravel (PHP) | Pengelola rute, controller, API endpoint RSVP |
| **Frontend Interaktivitas** | Vanilla JavaScript | Countdown timer, copy clipboard, form handling |
| **Styling / UI** | Tailwind CSS | Desain antarmuka, responsivitas |
| **Database** | MySQL | Penyimpanan data RSVP |

### 4.2 Skema Database

**Tabel: `rsvps`**

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT UNSIGNED, PK, AUTO_INCREMENT | Primary key |
| `guest_name` | VARCHAR(255), NOT NULL | Nama tamu |
| `status_hadir` | ENUM('Hadir', 'Tidak'), NOT NULL | Status kehadiran |
| `jumlah_rombongan` | TINYINT UNSIGNED, NULLABLE | Jumlah orang dalam rombongan |
| `wishes` | TEXT, NULLABLE | Ucapan / doa dari tamu |
| `created_at` | TIMESTAMP | Waktu submit |
| `updated_at` | TIMESTAMP | Waktu update terakhir |

### 4.3 Routing Laravel

| Method | URI | Action |
|---|---|---|
| `GET` | `/` | Menampilkan halaman undangan (baca param `?to=`) |
| `POST` | `/rsvp` | Menyimpan data RSVP ke database |
| `GET` | `/rsvp/wishes` | Mengambil daftar ucapan tamu (JSON) |

### 4.4 Target Tampilan
- **Mobile-First Design** — diprioritaskan untuk layar ponsel (320px–480px)
- Tetap proporsional di layar lebih besar (tablet / desktop)
- Tidak ada horizontal scroll pada mobile

---

## 5. Alur Pengguna (User Flow)

```
Tamu menerima link undangan
        |
        v
Buka URL: domain.com/?to=NamaTamu
        |
        v
Halaman cover muncul -> Sapaan personal + tombol "Buka Undangan"
        |
        v
Scroll ke bawah:
  [Profil Mempelai] -> [Countdown Timer] -> [Detail Acara & Lokasi]
        |
        v
Isi & Submit Form RSVP
        |
        v
Muncul di Buku Tamu (feed ucapan)
        |
        v
Klik tombol Maps / Salin Rekening (opsional)
```

---

## 6. Kriteria Penerimaan (Definition of Done)

- [ ] Halaman menampilkan sapaan personal dari parameter `?to=`
- [ ] Countdown timer berjalan real-time dan akurat ke 23 Oktober 2026 08.00 WIB
- [ ] Form RSVP berhasil menyimpan data ke tabel `rsvps`
- [ ] Buku tamu menampilkan ucapan tamu yang sudah submit
- [ ] Tombol Google Maps membuka lokasi yang benar
- [ ] Tombol salin rekening berfungsi dengan feedback visual
- [ ] Tampilan mobile tidak ada elemen yang terpotong atau horizontal scroll
- [ ] Halaman dapat diakses tanpa login (public access)

---

*Dokumen ini adalah panduan utama pengembangan. Setiap perubahan kebutuhan harus didiskusikan dan dicatat sebagai revisi versi baru.*
