# 🖥️ Sistem Informasi Pengelolaan Pembayaran SPP (Aplikasi SPP)

Sistem Informasi Pengelolaan Pembayaran SPP adalah aplikasi berbasis web yang dibangun menggunakan Laravel. Aplikasi ini dirancang untuk membantu pihak sekolah dalam mengelola data iuran Sumbangan Pembinaan Pendidikan (SPP) siswa, transaksi pembayaran, dan laporan keuangan secara efisien. Aplikasi ini menyediakan antarmuka yang ramah pengguna dengan hak akses berbasis peran untuk administrator, petugas, dan siswa.

---

## Fitur Utama

### Autentikasi & Otorisasi Pengguna
*   **Sistem Multi-Auth:** Hak akses login yang aman untuk 3 peran berbeda: Admin, Petugas, dan Siswa.
*   **Kontrol Akses Berbasis Peran:** Membatasi akses ke fitur tertentu berdasarkan peran pengguna yang sedang login.

### Manajemen Data Master (Khusus Admin)
*   **Manajemen Siswa:** Menambah, mengubah, dan menghapus data siswa termasuk NISN, nama, dan kelas.
*   **Manajemen Kelas & Jurusan:** Mengelompokkan siswa ke dalam kelas dan kompetensi keahlian masing-masing.
*   **Pengaturan Nilai SPP:** Menentukan dan mengelola nominal pembayaran SPP bulanan.

### Manajemen Transaksi & Pembayaran
*   **Input Pembayaran:** Admin dan Petugas dapat mencatat dan memvalidasi transaksi pembayaran SPP bulanan siswa.
*   **Riwayat Transaksi:** Menampilkan log kronologis yang detail dari seluruh riwayat pembayaran secara real-time.
*   **Cek Mandiri Siswa:** Siswa dapat login menggunakan NISN mereka untuk memeriksa status pembayaran (Lunas / Belum Lunas) dan riwayat pribadi tanpa harus datang ke ruang tata usaha.

### Pelaporan & Analisis
*   **Dashboard Interaktif:** Memvisualisasikan data akumulasi kutipan dan statistik pembayaran menggunakan grafik.
*   **Penyusunan Laporan:** Mengekspor laporan pembayaran lengkap ke dalam format PDF atau Excel berdasarkan rentang tanggal, kelas, atau perorangan siswa.

---

## Teknologi yang Digunakan

*   **Laravel Framework:** Framework PHP yang tangguh untuk membangun logika backend aplikasi.
*   **Vite:** Asset bundler frontend modern untuk proses pengembangan yang cepat.
*   **Bootstrap / Tailwind CSS:** Framework UI frontend untuk desain tata letak yang responsif dan bersih.
*   **MySQL Database:** Menyimpan data aplikasi termasuk data siswa, pengguna, dan transaksi pembayaran.

---

## Instalasi

Ikuti langkah-langkah berikut untuk menjalankan projek ini di komputer lokal Anda:

1. **Clone repositori**
```bash
   git clone [https://github.com/yonard1/SPP.git](https://github.com/yonard1/SPP.git)
   cd SPP
