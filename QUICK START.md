# Quick Start Guide
## Panduan Cepat Memulai Sistem Tokoanin

---

## Langkah 1: Siapkan Data Master

### 1.1. Buat Kategori Produk

**Menu:** Master Data → Kategori Produk

**Contoh Kategori:**
- Makanan Kering
- Minuman
- Bumbu Dapur
- Snack
- Perawatan Tubuh
- Elektronik

**Action:**
1. Klik **+ Tambah Kategori**
2. Masukkan nama kategori
3. Klik **Simpan**

---

### 1.2. Buat Satuan/Unit

**Menu:** Master Data → Satuan/Unit

**Contoh Satuan:**
- pcs (piece/potong)
- gram
- kg
- ml
- liter
- pack
- dus
- box

**Action:**
1. Klik **+ Tambah Satuan**
2. Masukkan nama satuan
3. Klik **Simpan**

**Tips:** Buat satuan yang paling sering dipakai dulu

---

### 1.3. Tambah Produk

**Menu:** Master Data → Master Produk

**Isi Data Produk:**

| Field | Isi dengan Contoh |
|-------|-------------------|
| Kode | PRD001 |
| Nama | Indomie Goreng Original |
| Kategori | Makanan Kering |
| Satuan Dasar | pcs |
| Harga Beli | 2500 |
| Harga Jual | 3500 |
| Tgl Kadaluarsa | 2025-12-31 |

**Action:**
1. Klik **+ Tambah Produk**
2. Isi semua field
3. Klik **Simpan**

**Penting:**
- Harga Beli & Jual adalah harga **PER SATUAN DASAR**
- Lihat panduan perhitungan untuk detail

---

### 1.4. Atur Konversi Satuan

**Menu:** Master Data → Konversi Satuan

**Contoh untuk Indomie:**

| Produk | Satuan | Multiplier |
|--------|--------|------------|
| Indomie Goreng | pcs | 1 |
| Indomie Goreng | pack | 5 |
| Indomie Goreng | dus | 40 |

**Penjelasan:**
- 1 pack = 5 pcs
- 1 dus = 40 pcs (8 pack)

**Action:**
1. Klik **+ Tambah Konversi**
2. Pilih produk
3. Pilih satuan
4. Masukkan multiplier
5. Klik **Simpan**

---

### 1.5. Atur Fee Admin (Opsional)

**Menu:** Master Data → Biaya Admin (Fee)

**Contoh Fee:**

| Platform | Kategori | Fee |
|----------|----------|-----|
| Shopee | (kosongkan) | 5.5 |
| Tokopedia | (kosongkan) | 4 |
| Grab | (kosongkan) | 5 |

**Action:**
1. Klik **+ Tambah Fee**
2. Pilih platform
3. Masukkan persentase fee
4. Klik **Simpan**

---

## Langkah 2: Mulai Transaksi

### 2.1. Beli Stok (Pembelian)

**Menu:** Transaksi → Pembelian / Stok Masuk

**Action:**
1. Klik **+ Tambah Pembelian**
2. Isi informasi pembelian:
   - No. Invoice: INV-001
   - Tanggal: (otomatis hari ini)
   - Supplier: Nama supplier
3. Cari produk dan klik untuk menambah ke cart
4. Pilih satuan, masukkan qty dan harga
5. (Opsional) Centang "Potong Biaya Admin?"
6. Klik **Simpan**

**Contoh Pembelian:**
```
Produk: Indomie Goreng
Satuan: dus
Jumlah: 5
Harga: 100000

Stok bertambah: 5 × 40 = 200 pcs
```

---

### 2.2. Cek Stok

**Menu:** Transaksi → Current Stock

**Fitur:**
- Lihat semua stok dalam satuan dasar
- Konversi ke satuan lain (pack, dus, dll)
- Filter dan search produk

---

### 2.3. Jual Produk (Kasir/POS)

**Menu:** Transaksi → Kasir / POS

**Action:**
1. Pilih platform (Offline, Shopee, Tokopedia, dll)
2. Cari produk (ketik nama/scan barcode)
3. Tekan Enter untuk masuk ke cart
4. Atur qty dan satuan di cart
5. Klik **Bayar & Simpan**

**Contoh Penjualan:**
```
Platform: Shopee
Produk: Indomie Goreng
Satuan: pack (isi 5 pcs)
Qty: 10
Harga: @ Rp 17.500

Subtotal: Rp 175.000
Fee (5.5%): Rp 9.625
Nett: Rp 165.375

Stok berkurang: 10 × 5 = 50 pcs
```

---

## Langkah 3: Lihat Laporan

### 3.1. Laporan Harian

**Menu:** Laporan → Laporan Harian

**Action:**
1. Pilih tanggal
2. Lihat ringkasan transaksi hari itu
3. Klik invoice untuk detail (jika ada)

**Informasi yang Ditampilkan:**
- Total penjualan
- Fee admin
- Nett diterima
- Total pembelian
- Profit indikasi

---

### 3.2. Laporan Bulanan

**Menu:** Laporan → Laporan Bulanan

**Action:**
1. Pilih bulan
2. Lihat ringkasan bulanan
3. Cek rekap harian

**Informasi yang Ditampilkan:**
- Total penjualan bulanan
- Fee admin bulanan
- Nett penjualan bulanan
- Total pembelian bulanan
- Estimasi profit

---

## Tips Cepat

### Saat Menambah Produk:
- ✅ Gunakan kode unik (PRD001, PRD002, dst)
- ✅ Isi harga jual lebih tinggi dari harga beli
- ✅ Isi tanggal kadaluarsa jika ada
- ❌ Jangan kosongkan satuan dasar

### Saat Membeli Stok:
- ✅ Cek multiplier konversi sebelum input
- ✅ Masukkan harga yang sesuai dengan satuan
- ❌ Jangan asal tebak multiplier

### Saat Menjual:
- ✅ Pilih platform yang benar
- ✅ Cek stok sebelum jual
- ✅ Cek ulang cart sebelum bayar
- ❌ Jangan jual melebihi stok

### Saat Melihat Laporan:
- ✅ Cek laporan harian setiap hari
- ✅ Cek laporan bulanan untuk evaluasi
- ✅ Gunakan data untuk keputusan bisnis

---

## Troubleshooting Cepat

### Problem: Produk tidak muncul di POS
**Solusi:**
- Pastikan stok > 0
- Refresh halaman POS

### Problem: Konversi tidak muncul
**Solusi:**
- Tambahkan konversi di master_konversi.php
- Pastikan multiplier benar

### Problem: Fee tidak terpotong
**Solusi:**
- Set fee di master_fee.php
- Pilih platform yang sesuai
- Centang "Potong Biaya Admin?"

### Problem: Stok tidak berkurang
**Solusi:**
- Pastikan transaksi berhasil
- Refresh halaman current_stock.php

---

## Urutan Penggunaan Rekomendasi

### Untuk Pemula:

1. **Hari 1: Setup Data Master**
   - [ ] Buat kategori (5-10 kategori)
   - [ ] Buat satuan (pcs, gram, ml, dll)
   - [ ] Tambah 10-20 produk pertama
   - [ ] Atur konversi untuk produk tersebut

2. **Hari 2: Transaksi Pertama**
   - [ ] Beli stok untuk produk pertama
   - [ ] Cek stok di current_stock.php
   - [ ] Coba jual di POS
   - [ ] Lihat laporan harian

3. **Hari 3-7: Evaluasi**
   - [ ] Tambah produk secara bertahap
   - [ ] Cek laporan harian setiap hari
   - [ ] Sesuaikan harga jika perlu
   - [ ] Atur fee untuk marketplace

4. **Minggu 2-4: Optimasi**
   - [ ] Tambah semua produk
   - [ ] Atur semua konversi
   - [ ] Cek laporan bulanan
   - [ ] Evaluasi profit

---

## Checklist Harian

### Setiap Hari:
- [ ] Cek dashboard (alert stok/expired)
- [ ] Cek stok menipis → siap restock
- [ ] Jika ada stok masuk → input pembelian
- [ ] Jika ada penjualan → gunakan POS
- [ ] Akhir hari → cek laporan harian

### Setiap Minggu:
- [ ] Cek laporan mingguan
- [ ] Evaluasi produk terlaris
- [ ] Evaluasi platform terlaris
- [ ] Restock jika perlu

### Setiap Bulan:
- [ ] Cek laporan bulanan
- [ ] Evaluasi profit/loss
- [ ] Cek produk kadaluarsa
- [ ] Atur strategi pricing

---

## Shortcut Keyboard

### Di POS:
- **Tab**: Pindah field pencarian
- **Enter**: Tambah produk ke cart
- **Esc**: Kembali ke field pencarian

### Di Browser:
- **F5**: Refresh halaman
- **Ctrl + F**: Search di halaman

---

## Kontak Support

Jika mengalami kendala:
1. Baca panduan perhitungan harga
2. Baca FAQ di panduan penggunaan
3. Hubungi admin/developer

---

**Selamat menggunakan Sistem Tokoanin!**  
**Semoga bisnis Anda sukses!**

---

**Last Updated:** April 2026
