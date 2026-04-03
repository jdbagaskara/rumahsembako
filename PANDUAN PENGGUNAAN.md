# Panduan Penggunaan Sistem Tokoanin
## Sistem Manajemen Toko & POS

---

## Daftar Isi

1. [Pendahuluan](#pendahuluan)
2. [Struktur Menu](#struktur-menu)
3. [Master Data](#master-data)
4. [Transaksi](#transaksi)
5. [Laporan](#laporan)
6. [Perhitungan Harga & Fee](#perhitungan-harga--fee)
7. [FAQ](#faq)

---

## Pendahuluan

Sistem **Tokoanin** adalah aplikasi berbasis web untuk mengelola toko retail dengan fitur lengkap:
- Manajemen stok produk multi-satuan
- Point of Sale (POS) dengan support berbagai platform
- Tracking kadaluarsa produk
- Laporan keuangan harian & bulanan
- Manajemen biaya admin per platform

---

## Struktur Menu

### 1. Dashboard
**Ringkasan Utama:**
- **Penjualan Hari Ini**: Total penjualan, jumlah transaksi, nett diterima
- **Pembelian Hari Ini**: Total pembelian stok hari ini
- **Profit Bulan Ini**: Selisih antara nett penjualan dan pembelian
- **Inventori**: Jumlah total produk dengan alert stok menipis/habis/kadaluarsa

**Fitur Alert:**
- ⚠️ **Stok Menipis**: Produk dengan stok ≤ 5
- 🔴 **Stok Habis**: Produk dengan stok = 0
- ⏰ **Kadaluarsa**: Produk yang akan expired dalam 30 hari
- ⚠️ **Expired**: Produk yang sudah kadaluarsa

**Grafik & Chart:**
- Tren Penjualan vs Pembelian (7 hari terakhir)
- Distribusi Platform Penjualan bulan berjalan

**Widget Tambahan:**
- Top 5 Produk Terlaris bulan ini
- 7 Transaksi Penjualan Terakhir
- Peringatan Stok (maks. 8 produk)
- Peringatan Kadaluarsa (maks. 5 produk)

---

## Master Data

### 1. Kategori Produk (`master_kategori.php`)

**Fungsi:** Mengelompokkan produk berdasarkan kategori

**Cara Penggunaan:**
1. Klik **+ Tambah Kategori**
2. Masukkan nama kategori
3. Klik **Simpan**

**Contoh Kategori:**
- Makanan Kering
- Minuman
- Bumbu Dapur
- Snack
- Perawatan Tubuh

---

### 2. Satuan/Unit (`master_unit.php`)

**Fungsi:** Mengelola satuan ukuran produk

**Satuan Dasar (Base Unit):**
- Satuan terkecil dari produk
- Digunakan untuk perhitungan stok di database
- Contoh: pcs, gram, ml, buah

**Contoh Satuan:**
- pcs = piece/pieces (potong)
- gram = gram
- kg = kilogram
- ml = milliliter
- liter = liter
- pack = pack/kemasan
- box = dus/kardus
- dus = dus

---

### 3. Master Produk (`master_produk.php`)

**Fungsi:** Mengelola data produk lengkap

**Field yang Diisi:**

| Field | Keterangan | Contoh |
|-------|------------|--------|
| Kode Produk | Kode unik untuk identifikasi | PRD001 |
| Nama Produk | Nama lengkap produk | Indomie Goreng |
| Kategori | Kelompok produk | Makanan |
| Satuan Dasar | Satuan terkecil untuk stok | pcs |
| Harga Beli | Modal harga per satuan dasar | Rp 2.500 |
| Harga Jual | Harga jual per satuan dasar | Rp 3.500 |
| Tgl Kadaluarsa | Tanggal expired produk | 2025-12-31 |

**Penting: Harga Beli & Harga Jual**
- Kedua harga adalah harga **PER SATUAN DASAR**
- Sistem akan otomatis mengkonversi ke satuan lain sesuai konversi
- Lihat bagian [Perhitungan Harga](#perhitungan-harga--fee) untuk detail

**Contoh Pengisian:**
```
Kode: PRD001
Nama: Indomie Goreng Original
Kategori: Makanan
Satuan Dasar: pcs
Harga Beli: Rp 2.500 per pcs
Harga Jual: Rp 3.500 per pcs
Exp Date: 2025-12-31
```

---

### 4. Konversi Satuan (`master_konversi.php`)

**Fungsi:** Mengatur konversi antar satuan produk

**Kenapa Perlu Konversi?**
Produk bisa dijual dalam berbagai satuan:
- **Satuan Dasar**: pcs (potong)
- **Satuan Jual**: Pack (5 pcs), Dus (40 pcs), etc.

**Cara Pengisian:**

| Field | Keterangan | Contoh |
|-------|------------|--------|
| Pilih Produk | Pilih produk yang akan dikonversi | Indomie Goreng |
| Satuan | Satuan tujuan konversi | Pack |
| Multiplier | Jumlah satuan dasar dalam 1 satuan tujuan | 5 |

**Contoh Konversi Indomie:**

| Satuan | Multiplier | Penjelasan |
|--------|------------|-------------|
| pcs | 1 | 1 pcs = 1 pcs (satuan dasar) |
| Pack | 5 | 1 pack = 5 pcs |
| Dus | 40 | 1 dus = 40 pcs (8 pack) |
| Karton | 240 | 1 karton = 240 pcs (6 dus) |

**Penting:**
- Satuan dasar SELALU memiliki multiplier = 1
- Multiplier harus sesuai dengan kemasan asli produk
- Stok di database dihitung dalam satuan dasar (pcs)

---

### 5. Biaya Admin/Fee (`master_fee.php`)

**Fungsi:** Mengatur potongan biaya admin per platform

**Platform yang Didukung:**
- Offline (tanpa fee)
- Shopee
- Tokopedia
- Grab
- GoFood
- Lazada
- Lainnya

**Cara Pengisian:**

| Field | Keterangan | Contoh |
|-------|------------|--------|
| Platform | Nama marketplace/platform | Shopee |
| Kategori | (Opsional) Kategori produk spesifik | Makanan |
| Potongan (%) | Persentase fee dari penjualan | 5.5 |

**Contoh Fee Shopee:**
```
Platform: Shopee
Kategori: (kosongkan = semua kategori)
Potongan: 5.5%

Artinya: Setiap penjualan di Shopee akan dipotong 5.5%
```

**Perhitungan:**
```
Total Penjualan: Rp 100.000
Fee Admin (5.5%): Rp 5.500
Nett Diterima: Rp 94.500
```

---

## Transaksi

### 1. Pembelian / Stok Masuk (`pembelian.php` & `pembelian_add.php`)

**Fungsi:** Mencatat pembelian stok dari supplier

**Alur Kerja:**

1. **Klik "Tambah Pembelian"** di halaman Pembelian

2. **Isi Informasi Pembelian:**
   - No. Invoice: Bebas (contoh: INV-001)
   - Tanggal: Otomatis hari ini
   - Supplier: Nama supplier (opsional)

3. **Pilih Produk:**
   - Cari produk berdasarkan kode/nama
   - Klik produk untuk menambahkan ke cart

4. **Setelah Produk Dipilih:**
   - **Satuan**: Pilih satuan (pcs, pack, dus, dll)
   - **Jumlah**: Masukkan jumlah sesuai satuan yang dipilih
   - **Harga Satuan**: Harga per satuan yang dipilih

5. **Contoh Pengisian:**

   **Scenario 1: Beli Per Pcs**
   ```
   Produk: Indomie Goreng
   Satuan: pcs
   Jumlah: 100
   Harga: Rp 2.500

   Perhitungan:
   - Subtotal = 100 × Rp 2.500 = Rp 250.000
   - Base Qty = 100 / 1 = 100 pcs (masuk database)
   ```

   **Scenario 2: Beli Per Dus**
   ```
   Produk: Indomie Goreng
   Satuan: dus (1 dus = 40 pcs)
   Jumlah: 5
   Harga: Rp 100.000 (per dus)

   Perhitungan:
   - Subtotal = 5 × Rp 100.000 = Rp 500.000
   - Base Qty = 5 / 40 = 0.125 dus = 200 pcs (masuk database)
   ```

6. **Potong Biaya Admin (Opsional):**
   - Centang "Potong Biaya Admin?" jika pembelian dikenakan fee
   - Pilih platform dan persentase fee
   - Sistem otomatis menghitung potongan

7. **Klik "Simpan"**
   - Stok otomatis bertambah
   - Transaksi tercatat di sistem

**Stok yang Bertambah:**
- Selalu dihitung dalam **satuan dasar** (base_qty)
- Sistem otomatis menambah stok ke tabel products

---

### 2. Current Stock / Stok Barang (`current_stock.php`)

**Fungsi:** Melihat stok saat ini dan konversi ke berbagai satuan

**Fitur:**
- **Tabel Stok Dasar**: Menampilkan stok dalam satuan dasar
- **Konversi ke**: Mengubah stok ke satuan lain (pack, dus, dll)

**Contoh Tampilan:**

| Produk | Stok Dasar | Konversi ke | Hasil |
|--------|-------------|-------------|-------|
| Indomie Goreng | 1000 pcs | Pack (5 pcs) | 200 pack |
| Indomie Goreng | 1000 pcs | Dus (40 pcs) | 25 dus |

**Cara Menggunakan:**
1. Lihat stok dasar (sudah dalam satuan terkecil)
2. Pilih satuan tujuan di dropdown "Konversi ke"
3. Hasil otomatis muncul

**Warna Badge:**
- 🟢 **Hijau**: Stok aman (> 10)
- 🟡 **Kuning**: Stok menipis (1-10)
- 🔴 **Merah**: Stok habis (0)

---

### 3. Kasir / POS (`penjualan_pos.php`)

**Fungsi:** Point of Sale untuk transaksi penjualan

**Alur Kerja:**

1. **Pilih Platform** (kiri atas):
   - **Offline**: Toko fisik (tanpa fee admin)
   - **Shopee**: Jualan di Shopee (ada fee)
   - **Tokopedia**: Jualan di Tokopedia (ada fee)
   - **Grab**: Grab/GoFood (ada fee)
   - **Lainnya**: Platform lain

2. **Cari Produk:**
   - Ketik nama produk atau scan barcode
   - Tekan Enter untuk menambahkan ke keranjang
   - Produk otomatis masuk cart

3. **Di Keranjang:**

   **Baris 1:** Nama & Kode Produk
   - Tidak bisa diedit

   **Baris 2:** Kontrol Produk
   - **Satuan**: Pilih satuan (pcs, pack, dus, dll)
     - Otomatis mengubah harga satuan
     - Otomatis menghitung maksimal qty berdasarkan stok

   - **Tombol Qty**:
     - **−**: Kurangi jumlah
     - **Input**: Masukkan jumlah manual
     - **+**: Tambah jumlah

   - **Harga**:
     - Subtotal: Qty × Harga Satuan
     - @: Harga per satuan

   - **Tombol Sampah**: Hapus item dari keranjang

4. **Contoh Transaksi:**

   **Scenario 1: Jual Per Pcs**
   ```
   Produk: Indomie Goreng
   Satuan: pcs
   Harga: @ Rp 3.500
   Qty: 10

   Subtotal: 10 × Rp 3.500 = Rp 35.000
   ```

   **Scenario 2: Jual Per Pack**
   ```
   Produk: Indomie Goreng
   Satuan: pack (1 pack = 5 pcs)
   Harga: @ Rp 17.500 (Rp 3.500 × 5)
   Qty: 4

   Subtotal: 4 × Rp 17.500 = Rp 70.000
   Base Qty: 4 × 5 = 20 pcs (berkurang dari stok)
   ```

5. **Perhitungan Fee Admin (Jika Online):**

   Jika platform = Shopee (fee 5.5%):
   ```
   Subtotal: Rp 100.000
   Fee Admin (5.5%): Rp 5.500
   Nett Diterima: Rp 94.500
   ```

   Jika platform = Offline:
   ```
   Subtotal: Rp 100.000
   Fee Admin: Rp 0
   Nett Diterima: Rp 100.000
   ```

6. **Klik "Bayar & Simpan"**
   - Invoice otomatis dibuat
   - Stok otomatis berkurang
   - Transaksi tercatat
   - Modal success muncul

**Validasi Stok:**
- Sistem mencegah penjualan melebihi stok tersedia
- Alert muncul jika qty melebihi stok
- Contoh: Stok 50 pcs, mau jual 60 pcs → **Tidak bisa**

---

## Laporan

### 1. Laporan Harian (`report_harian.php`)

**Fungsi:** Melihat ringkasan transaksi per hari

**Fitur:**
- **Filter Tanggal**: Pilih tanggal yang ingin dilihat
- **Summary Cards**: Penjualan, Fee, Nett, Pembelian
- **Per Platform**: Breakdown penjualan per marketplace
- **Top Produk**: Produk terlaris hari itu
- **Daftar Transaksi**: Detail semua transaksi

**Cara Menggunakan:**
1. Pilih tanggal di bagian atas
2. Sistem otomatis menampilkan data hari tersebut
3. Klik invoice (jika ada) untuk melihat detail

**Informasi yang Ditampilkan:**
- Total Penjualan: Bruto sebelum fee
- Total Fee Admin: Potongan platform
- Nett Diterima: Bersih setelah fee
- Total Pembelian: Stok yang dibeli hari itu
- Profit Indikasi: Nett - Pembelian

---

### 2. Laporan Bulanan (`report_bulanan.php`)

**Fungsi:** Melihat ringkasan transaksi per bulan

**Fitur:**
- **Filter Bulan**: Pilih bulan yang ingin dilihat
- **Summary Cards**: Penjualan, Fee, Nett, Pembelian, Profit
- **Per Platform**: Breakdown penjualan per marketplace
- **Top 10 Produk**: Produk terlaris bulan itu
- **Rekap Harian**: Detail transaksi per tanggal

**Estimasi Profit:**
```
Profit = Nett Penjualan - Total Pembelian

Contoh:
Nett Penjualan: Rp 50.000.000
Total Pembelian: Rp 30.000.000
Profit: Rp 20.000.000
```

**Warna Indikator:**
- 🟢 **Hijau**: Untung (profit positif)
- 🔴 **Merah**: Rugi (profit negatif)

---

## Perhitungan Harga & Fee

### Sistem Perhitungan Harga

**Konsep Dasar:**
1. Semua harga disimpan dalam **Satuan Dasar**
2. Harga jual satuan lain dihitung otomatis dari harga dasar
3. Konversi menggunakan multiplier yang sudah diatur

**Rumus Utama:**
```
Harga Satuan Dasar = Harga Dasar
Harga Satuan Lain = Harga Dasar × Multiplier

Contoh:
Harga Dasar (per pcs): Rp 3.500

Harga per Pack (5 pcs):
= Rp 3.500 × 5 = Rp 17.500

Harga per Dus (40 pcs):
= Rp 3.500 × 40 = Rp 140.000
```

### Perhitungan Stok

**Stok di Database:**
- Selalu dalam **Satuan Dasar** (base_qty)
- Sistem mengkonversi semua transaksi ke satuan dasar

**Rumus Konversi:**
```
Base Qty = Qty / Multiplier

Contoh Pembelian:
Beli: 5 dus
Multiplier dus: 40
Base Qty = 5 / 40 = 0.125 dus
= 0.125 × 40 = 200 pcs

Contoh Penjualan:
Jual: 10 pack
Multiplier pack: 5
Base Qty = 10 / 5 = 2 pack
= 2 × 5 = 10 pcs (berkurang dari stok)
```

### Perhitungan Fee Admin

**Rumus:**
```
Fee Amount = Total Penjualan × (Fee % / 100)
Nett Amount = Total Penjualan - Fee Amount

Contoh Shopee (Fee 5.5%):
Total Penjualan: Rp 100.000
Fee Amount = Rp 100.000 × 0.055 = Rp 5.500
Nett Amount = Rp 100.000 - Rp 5.500 = Rp 94.500
```

**Platform Tanpa Fee:**
- Offline: Fee 0%
- Nett = Total Penjualan

### Contoh Lengkap Transaksi

**Scenario: Penjualan di Shopee**

**Data Produk:**
```
Nama: Indomie Goreng
Satuan Dasar: pcs
Harga Jual: Rp 3.500 per pcs

Konversi:
- 1 pack = 5 pcs
- 1 dus = 40 pcs
```

**Transaksi:**
```
Platform: Shopee (Fee 5.5%)
Item 1: 10 pack @ Rp 17.500
Item 2: 5 dus @ Rp 140.000
```

**Perhitungan:**

**Item 1:**
```
Qty: 10 pack
Multiplier: 5
Base Qty: 10 / 5 = 2 pack = 10 pcs
Subtotal: 10 × Rp 17.500 = Rp 175.000
```

**Item 2:**
```
Qty: 5 dus
Multiplier: 40
Base Qty: 5 / 40 = 0.125 dus = 5 pcs
Subtotal: 5 × Rp 140.000 = Rp 700.000
```

**Total:**
```
Total Penjualan: Rp 175.000 + Rp 700.000 = Rp 875.000
Fee Admin (5.5%): Rp 875.000 × 0.055 = Rp 48.125
Nett Diterima: Rp 875.000 - Rp 48.125 = Rp 826.875

Stok Berkurang:
10 pcs + 5 pcs = 15 pcs (dalam satuan dasar)
```

---

## Pengaturan Akun

### Profil Saya (`view-profile.php`)

**Menampilkan:**
- Username
- Role (Jabatan)
- Tanggal terdaftar

### Ubah Password (`update_pass.php`)

**Cara Mengubah:**
1. Masukkan **Password Saat Ini**
2. Masukkan **Password Baru** (min. 6 karakter)
3. Masukkan **Konfirmasi Password Baru**
4. Klik **Update Password**

**Validasi:**
- Password saat ini harus benar
- Password baru = konfirmasi password
- Minimal 6 karakter

### Logout (`logout.php`)

**Fungsi:** Keluar dari sistem
- Menghapus semua session
- Redirect ke halaman login

---

## FAQ

### Q: Bagaimana jika produk tidak punya tanggal kadaluarsa?
**A:** Kosongkan saja field "Tgl Kadaluarsa" saat menambah produk. Sistem hanya akan menampilkan alert untuk produk yang memiliki tanggal kadaluarsa.

### Q: Apa bedanya Harga Beli dan Harga Jual?
**A:** 
- **Harga Beli**: Modal Anda untuk mendapatkan produk
- **Harga Jual**: Harga Anda menjual ke customer
- **Profit**: Harga Jual - Harga Beli (belum termasuk biaya lain)

### Q: Bagaimana jika saya beli dalam dus tapi jual per pcs?
**A:** Tidak masalah! Sistem akan mengkonversi:
- Beli: 5 dus → stok bertambah 200 pcs (5 × 40)
- Jual: 10 pcs → stok berkurang 10 pcs

### Q: Bisakah satu produk punya banyak satuan?
**A:** Ya! Anda bisa menambahkan konversi sebanyak yang dibutuhkan:
- pcs, pack, dus, karton, dll
- Sistem akan menghitung semua secara otomatis

### Q: Bagaimana jika harga beli dan jual beda platform?
**A:** Untuk saat ini, harga jual sama untuk semua platform. Bedanya hanya di fee admin yang dipotong dari penjualan.

### Q: Apa yang terjadi jika stok habis?
**A:** 
- Produk muncul di alert "Stok Habis"
- Tidak bisa dijual di POS (sistem mencegah)
- Perlu restock melalui Pembelian

### Q: Bagaimana melihat profit bersih?
**A:** Lihat di **Laporan Bulanan**, bagian **Estimasi Profit**:
```
Profit = Nett Penjualan - Total Pembelian
```

### Q: Bisakah mengedit transaksi yang sudah disimpan?
**A:** Untuk saat ini, transaksi yang sudah disimpan **tidak bisa diedit atau dihapus**. Pastikan data sudah benar sebelum menyimpan.

### Q: Bagaimana jika salah input pembelian/penjualan?
**A:** 
- Tidak ada fitur edit/hapus untuk transaksi
- Solusi: Lakukan penyesuaian manual:
  - Jika salah beli: Beli lagi dengan qty negatif (belum didukung)
  - Jika salah jual: Catat manual di luar sistem
  - Saran: Selalu cek ulang sebelum simpan

### Q: Apa bedanya Stok Dasar dan Stok Jual?
**A:** 
- **Stok Dasar**: Stok aktual dalam satuan terkecil (di database)
- **Stok Jual**: Stok dalam satuan jual (pack, dus, dll)
- Sistem otomatis mengkonversi antar keduanya

### Q: Kenapa harus isi Satuan Dasar?
**A:** Karena:
- Satuan dasar adalah acuan semua perhitungan
- Memudahkan konversi ke satuan lain
- Mencegah kebingungan dalam perhitungan stok

---

## Tips & Best Practices

### 1. Pengelolaan Stok
- Selalu cek **Peringatan Kadaluarsa** sebelum stok expired
- Restock sebelum stok benar-benar habis
- Gunakan **batch/lot number** jika produk punya exp berbeda (belum didukung)

### 2. Penentuan Harga
- Hitung semua biaya (transport, listrik, gaji, dll)
- Tambah margin ke harga beli
- Pertimbangkan fee marketplace jika jual online

### 3. Penggunaan Konversi
- Selalu cek multiplier sesuai kemasan asli
- Contoh: 1 pack isi 5 pcs → multiplier = 5
- Jangan asal tebak!

### 4. Transaksi Penjualan
- Pilih platform dengan benar (Offline vs Online)
- Cek ulang keranjang sebelum bayar
- Pastikan qty dan satuan sudah benar

### 5. Laporan
- Cek laporan harian setiap hari
- Cek laporan bulanan untuk evaluasi
- Gunakan data untuk keputusan bisnis

---

## Troubleshooting

### Masalah: Produk tidak muncul di POS
**Solusi:**
- Pastikan stok > 0
- Pastikan produk sudah punya satuan dasar
- Refresh halaman POS

### Masalah: Konversi tidak muncul
**Solusi:**
- Pastikan sudah tambah konversi di master_konversi.php
- Pastikan multiplier sudah benar

### Masalah: Fee tidak terpotong
**Solusi:**
- Pastikan sudah set fee di master_fee.php
- Pilih platform yang sesuai saat transaksi
- Centang "Potong Biaya Admin?"

### Masalah: Stok tidak berkurang setelah jual
**Solusi:**
- Pastikan transaksi berhasil disimpan
- Cek di current_stock.php
- Refresh halaman

---

## Changelog

### Versi 1.0 (Saat Ini)
- ✅ Dashboard dengan alert lengkap
- ✅ Master Data (Kategori, Unit, Produk, Konversi, Fee)
- ✅ Pembelian / Stok Masuk
- ✅ Current Stock dengan konversi
- ✅ Point of Sale (POS)
- ✅ Laporan Harian & Bulanan
- ✅ Tracking Kadaluarsa
- ✅ Manajemen Akun (Profil, Ubah Password, Logout)
- ✅ Multi-platform support (Offline, Shopee, Tokopedia, dll)

---

## Kontak & Support

Untuk pertanyaan atau kendala, hubungi:
- Developer: [Nama Anda]
- Email: [Email Anda]
- Telepon: [No. HP Anda]

---

**Dokumentasi ini dibuat untuk memudahkan penggunaan sistem Tokoanin.**  
**Last Updated:** April 2026
