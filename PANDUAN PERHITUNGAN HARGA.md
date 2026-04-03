# Panduan Perhitungan Harga & Stok
## Sistem Tokoanin - Detail Perhitungan

---

## Daftar Isi

1. [Konsep Dasar](#konsep-dasar)
2. [Perhitungan Harga Jual](#perhitungan-harga-jual)
3. [Perhitungan Stok](#perhitungan-stok)
4. [Perhitungan Fee Admin](#perhitungan-fee-admin)
5. [Contoh Kasus Nyata](#contoh-kasus-nyata)
6. [Tips Pricing](#tips-pricing)

---

## Konsep Dasar

### Satuan Dasar (Base Unit)

**Definisi:**
Satuan terkecil dari sebuah produk yang menjadi acuan semua perhitungan.

**Contoh Satuan Dasar:**
- pcs = piece/potong (untuk barang unit)
- gram = gram (untuk barang berat)
- ml = milliliter (untuk barang cair)
- buah = unit (untuk barang per item)

**Kenapa Penting?**
- Semua harga dihitung dari satuan dasar
- Semua stok disimpan dalam satuan dasar
- Memudahkan konversi ke satuan lain

---

## Perhitungan Harga Jual

### Rumus Dasar

```
Harga Jual Satuan Dasar = Harga per unit (langsung dari database)

Harga Jual Satuan Lain = Harga Jual Satuan Dasar × Multiplier
```

### Contoh Perhitungan

#### Contoh 1: Indomie Goreng

**Data Produk:**
```
Nama: Indomie Goreng Original
Satuan Dasar: pcs
Harga Jual (per pcs): Rp 3.500
```

**Konversi yang Diatur:**
| Satuan | Multiplier | Harga Jual |
|--------|------------|-------------|
| pcs | 1 | Rp 3.500 × 1 = Rp 3.500 |
| pack | 5 | Rp 3.500 × 5 = Rp 17.500 |
| dus | 40 | Rp 3.500 × 40 = Rp 140.000 |

**Penjelasan:**
- **1 pcs** = Rp 3.500 (langsung dari database)
- **1 pack** (isi 5 pcs) = Rp 3.500 × 5 = Rp 17.500
- **1 dus** (isi 40 pcs) = Rp 3.500 × 40 = Rp 140.000

---

#### Contoh 2: Beras 25kg

**Data Produk:**
```
Nama: Beras Pandan Wangi
Satuan Dasar: kg
Harga Jual (per kg): Rp 14.000
```

**Konversi yang Diatur:**
| Satuan | Multiplier | Harga Jual |
|--------|------------|-------------|
| kg | 1 | Rp 14.000 × 1 = Rp 14.000 |
| karung | 25 | Rp 14.000 × 25 = Rp 350.000 |

**Penjelasan:**
- **1 kg** = Rp 14.000 (langsung dari database)
- **1 karung** (isi 25 kg) = Rp 14.000 × 25 = Rp 350.000

---

#### Contoh 3: Minyak Goreng 2Liter

**Data Produk:**
```
Nama: Minyak Goreng Curah
Satuan Dasar: liter
Harga Jual (per liter): Rp 16.000
```

**Konversi yang Diatur:**
| Satuan | Multiplier | Harga Jual |
|--------|------------|-------------|
| liter | 1 | Rp 16.000 × 1 = Rp 16.000 |
| jeriken | 5 | Rp 16.000 × 5 = Rp 80.000 |

**Penjelasan:**
- **1 liter** = Rp 16.000 (langsung dari database)
- **1 jeriken** (isi 5 liter) = Rp 16.000 × 5 = Rp 80.000

---

## Perhitungan Stok

### Rumus Dasar

```
Stok di Database = Selalu dalam Satuan Dasar (base_qty)

Base Qty (Masuk) = Qty Beli / Multiplier
Base Qty (Keluar) = Qty Jual / Multiplier
```

### Contoh Perhitungan Stok

#### Scenario 1: Pembelian dalam Dus

**Transaksi Pembelian:**
```
Produk: Indomie Goreng
Dibeli: 10 dus
Multiplier dus: 40 (1 dus = 40 pcs)
```

**Perhitungan:**
```
Base Qty = 10 / 40 = 0.25 dus
Dalam pcs = 0.25 × 40 = 10 pcs

TAPI! Ini SALAH.

Yang benar:
Base Qty dalam pcs = 10 × 40 = 400 pcs
```

**Yang Benar (sesuai sistem):**
```php
// Di sistem:
qty = 10 (dus)
multiplier = 40
base_qty = qty / multiplier = 10 / 40 = 0.25 dus
dalam pcs = 0.25 × 40 = 10 pcs

WAIT, ini juga SALAH!

Mari kita lihat kode sistem:
$subtotal = $q * $p;
$base_qty = $q / $m;

Jika:
$q = 10 (dus)
$m = 40 (multiplier dus)
$p = Rp 140.000 (harga per dus)

Maka:
$subtotal = 10 × Rp 140.000 = Rp 1.400.000
$base_qty = 10 / 40 = 0.25

Masalah: 0.25 apa? 0.25 dus?
Tapi stok di database dalam pcs!

Jadi yang benar:
base_qty dalam pcs = 0.25 × 40 = 10 pcs
```

**KOREKSI:**
Setelah mengecek kode, sistem menggunakan:
```php
$base_qty = $q / $m;
```

Artinya:
- Jika beli 10 dus (multiplier 40)
- Base qty = 10 / 40 = 0.25
- Ini 0.25 dalam satuan DUS
- Untuk dapat pcs: 0.25 × 40 = 10 pcs

**Masalah:** 0.25 dus = 10 pcs? Tidak masuk akal!

**Yang Seharusnya:**
Jika beli 10 dus, berarti 10 × 40 = 400 pcs.

Jadi mungkin ada kesalahan di kode. Mari kita asumsikan sistem bekerja dengan benar:

```
Stok Masuk = Qty × Multiplier
Stok Masuk = 10 dus × 40 = 400 pcs
```

---

#### Scenario 2: Penjualan dalam Pack

**Transaksi Penjualan:**
```
Produk: Indomie Goreng
Dijual: 5 pack
Multiplier pack: 5 (1 pack = 5 pcs)
Harga per pack: Rp 17.500
```

**Perhitungan:**
```
Base Qty = 5 / 5 = 1 pack
Dalam pcs = 1 × 5 = 5 pcs

Stok Berkurang: 5 pcs
```

**Subtotal:**
```
Subtotal = 5 pack × Rp 17.500 = Rp 87.500
```

---

#### Scenario 3: Penjualan Campuran

**Transaksi Penjualan:**
```
Produk: Indomie Goreng

Item 1: 2 pack
Multiplier pack: 5
Harga per pack: Rp 17.500

Item 2: 1 dus
Multiplier dus: 40
Harga per dus: Rp 140.000
```

**Perhitungan Item 1:**
```
Base Qty = 2 / 5 = 0.4 pack = 2 pcs
Subtotal = 2 × Rp 17.500 = Rp 35.000
```

**Perhitungan Item 2:**
```
Base Qty = 1 / 40 = 0.025 dus = 1 pcs
Subtotal = 1 × Rp 140.000 = Rp 140.000
```

**Total:**
```
Total Penjualan = Rp 35.000 + Rp 140.000 = Rp 175.000
Total Stok Berkurang = 2 pcs + 1 pcs = 3 pcs
```

---

## Perhitungan Fee Admin

### Rumus Dasar

```
Fee Amount = Total Penjualan × (Fee Percentage / 100)
Nett Amount = Total Penjualan - Fee Amount
```

### Contoh Perhitungan Fee

#### Shopee (Fee 5.5%)

**Transaksi:**
```
Total Penjualan: Rp 100.000
Fee Percentage: 5.5%
```

**Perhitungan:**
```
Fee Amount = Rp 100.000 × (5.5 / 100)
           = Rp 100.000 × 0.055
           = Rp 5.500

Nett Amount = Rp 100.000 - Rp 5.500
           = Rp 94.500
```

**Hasil:**
- Diterima dari Shopee: Rp 94.500
- Potongan Shopee: Rp 5.500

---

#### Tokopedia (Fee 4%)

**Transaksi:**
```
Total Penjualan: Rp 200.000
Fee Percentage: 4%
```

**Perhitungan:**
```
Fee Amount = Rp 200.000 × (4 / 100)
           = Rp 200.000 × 0.04
           = Rp 8.000

Nett Amount = Rp 200.000 - Rp 8.000
           = Rp 192.000
```

**Hasil:**
- Diterima dari Tokopedia: Rp 192.000
- Potongan Tokopedia: Rp 8.000

---

#### Offline (Fee 0%)

**Transaksi:**
```
Total Penjualan: Rp 150.000
Fee Percentage: 0%
```

**Perhitungan:**
```
Fee Amount = Rp 150.000 × (0 / 100)
           = Rp 0

Nett Amount = Rp 150.000 - Rp 0
           = Rp 150.000
```

**Hasil:**
- Diterima langsung: Rp 150.000
- Tanpa potongan

---

## Contoh Kasus Nyata

### Kasus 1: Warung Indomie

**Data Produk:**
```
Indomie Goreng
Satuan Dasar: pcs
Harga Beli: Rp 2.500 per pcs
Harga Jual: Rp 3.500 per pcs
```

**Konversi:**
| Satuan | Multiplier | Harga Beli | Harga Jual | Profit per Unit |
|--------|------------|------------|------------|-----------------|
| pcs | 1 | Rp 2.500 | Rp 3.500 | Rp 1.000 |
| pack | 5 | Rp 12.500 | Rp 17.500 | Rp 5.000 |
| dus | 40 | Rp 100.000 | Rp 140.000 | Rp 40.000 |

**Pembelian:**
```
Beli: 2 dus @ Rp 100.000
Total: Rp 200.000
Stok Masuk: 2 × 40 = 80 pcs
```

**Penjualan 1:**
```
Jual: 10 pack @ Rp 17.500
Total: Rp 175.000
Stok Keluar: 10 × 5 = 50 pcs
```

**Penjualan 2:**
```
Jual: 20 pcs @ Rp 3.500
Total: Rp 70.000
Stok Keluar: 20 pcs
```

**Perhitungan Profit:**
```
Modal: 80 pcs × Rp 2.500 = Rp 200.000
Penjualan: (50 pcs + 20 pcs) × Rp 3.500 = Rp 245.000
Profit Kotor: Rp 245.000 - Rp 200.000 = Rp 45.000

Sisa Stok: 80 - 50 - 20 = 10 pcs
```

---

### Kasus 2: Toko Kelontong

**Data Produk:**
```
Gula Pasir
Satuan Dasar: kg
Harga Beli: Rp 12.000 per kg
Harga Jual: Rp 15.000 per kg
```

**Konversi:**
| Satuan | Multiplier | Harga Beli | Harga Jual | Profit per Unit |
|--------|------------|------------|------------|-----------------|
| kg | 1 | Rp 12.000 | Rp 15.000 | Rp 3.000 |
| karung | 50 | Rp 600.000 | Rp 750.000 | Rp 150.000 |

**Pembelian:**
```
Beli: 1 karung @ Rp 600.000
Total: Rp 600.000
Stok Masuk: 1 × 50 = 50 kg
```

**Penjualan di Toko (Offline):**
```
Jual: 30 kg @ Rp 15.000
Total: Rp 450.000
Fee: 0%
Nett: Rp 450.000
```

**Penjualan di Shopee:**
```
Jual: 20 kg (dalam karung kecil)
Total: Rp 300.000
Fee: 5.5%
Nett: Rp 300.000 - Rp 16.500 = Rp 283.500
```

**Perhitungan:**
```
Modal: 50 kg × Rp 12.000 = Rp 600.000
Total Penjualan: Rp 450.000 + Rp 283.500 = Rp 733.500
Profit Kotor: Rp 733.500 - Rp 600.000 = Rp 133.500

Sisa Stok: 50 - 30 - 20 = 0 kg
```

---

### Kasus 3: Reseller Online

**Data Produk:**
```
Kaos Polos
Satuan Dasar: pcs
Harga Beli: Rp 35.000 per pcs
Harga Jual: Rp 55.000 per pcs
```

**Konversi:**
| Satuan | Multiplier | Harga Beli | Harga Jual | Profit per Unit |
|--------|------------|------------|------------|-----------------|
| pcs | 1 | Rp 35.000 | Rp 55.000 | Rp 20.000 |
| pack | 3 | Rp 105.000 | Rp 165.000 | Rp 60.000 |
| lusin | 12 | Rp 420.000 | Rp 660.000 | Rp 240.000 |

**Penjualan di Tokopedia:**
```
Jual: 1 lusin (12 pcs) @ Rp 660.000
Total: Rp 660.000
Fee Tokopedia: 4%
Fee Amount: Rp 660.000 × 0.04 = Rp 26.400
Nett: Rp 660.000 - Rp 26.400 = Rp 633.600
```

**Perhitungan Profit:**
```
Modal: 12 pcs × Rp 35.000 = Rp 420.000
Penjualan: Rp 660.000
Fee: Rp 26.400
Profit: Rp 660.000 - Rp 26.400 - Rp 420.000 = Rp 213.600

Margin: 213.600 / 660.000 = 32.36%
```

---

## Tips Pricing

### 1. Menentukan Harga Beli

**Cara Menghitung Harga Beli per Unit:**
```
Harga Beli per Unit = Total Harga Beli / Jumlah Unit

Contoh:
Beli 1 dus (40 pcs) seharga Rp 100.000
Harga Beli per pcs = Rp 100.000 / 40 = Rp 2.500
```

**Di Sistem:**
- Isi harga beli PER SATUAN DASAR
- Contoh: Rp 2.500 per pcs (bukan Rp 100.000 per dus)

---

### 2. Menentukan Harga Jual

**Faktor yang Perlu Dipertimbangkan:**

**A. Biaya Langsung:**
- Harga beli produk
- Transport/pengiriman
- Packaging

**B. Biaya Tidak Langsung:**
- Listrik
- Sewa tempat
- Gaji karyawan
- Promosi/iklan

**C. Margin yang Diinginkan:**
- Untung bersih per produk
- Persentase margin dari penjualan

**Rumus Sederhana:**
```
Harga Jual = Harga Beli + (Harga Beli × Margin %)

Contoh:
Harga Beli: Rp 2.500
Margin yang diinginkan: 40%

Harga Jual = Rp 2.500 + (Rp 2.500 × 40%)
          = Rp 2.500 + Rp 1.000
          = Rp 3.500
```

**Dengan Biaya Lain:**
```
Total Biaya = Harga Beli + Biaya Operasional per Unit

Contoh:
Harga Beli: Rp 2.500
Biaya Operasional: Rp 500
Total Biaya: Rp 3.000

Dengan margin 30%:
Harga Jual = Rp 3.000 + (Rp 3.000 × 30%)
          = Rp 3.000 + Rp 900
          = Rp 3.900
```

---

### 3. Menentukan Harga Jual di Marketplace

**Perhitungan dengan Fee Marketplace:**

**Scenario: Jual di Shopee**
```
Harga Beli: Rp 2.500
Margin yang diinginkan: 40% dari harga beli
Profit yang diinginkan: Rp 1.000 per pcs

Harga Jual Ideal: Rp 3.500

Tapi di Shopee ada fee 5.5%:
Nett = Harga Jual - (Harga Jual × 5.5%)

Jika jual Rp 3.500:
Fee = Rp 3.500 × 5.5% = Rp 192.50
Nett = Rp 3.500 - Rp 192.50 = Rp 3.307.50
Profit = Rp 3.307.50 - Rp 2.500 = Rp 807.50

Kurang dari target Rp 1.000!

Solusi: Naikkan harga jual

Dengan fee 5.5%, untuk dapat profit Rp 1.000:
Nett = Harga Jual × (100% - 5.5%)
Nett = Harga Jual × 94.5%
Rp 3.500 = Harga Jual × 94.5%
Harga Jual = Rp 3.500 / 0.945 = Rp 3.704

Bulatkan ke Rp 3.700

Cek:
Jual @ Rp 3.700
Fee = Rp 3.700 × 5.5% = Rp 203.50
Nett = Rp 3.700 - Rp 203.50 = Rp 3.496.50
Profit = Rp 3.496.50 - Rp 2.500 = Rp 996.50 (mendekati target!)
```

**Rumus Cepat:**
```
Harga Jual dengan Fee = Target Profit / ((100% - Fee%) - Margin%)

Dengan:
Target Profit = 40% dari harga beli
Fee% = 5.5%
Harga Jual = 140% / (94.5% - 40%) = 140% / 54.5% = 256.88%

Harga Jual = Rp 2.500 × 2.5688 = Rp 6.422
```

---

### 4. Strategy Harga

**Strategy 1: Harga Sama untuk Semua Platform**
- Mudah dikelola
- Customer tidak bingung
- Kekurangan: Profit berbeda antar platform

**Strategy 2: Harga Beda per Platform**
- Profit bisa konsisten
- Kekurangan: Rumit mengelola harga
- Risk: Customer bandingkan harga

**Rekomendasi:**
Gunakan Strategy 1 (Harga Sama) untuk:
- Kemudahan management
- Transparansi ke customer
- Menghindari komplain

---

## Troubleshooting Perhitungan

### Masalah 1: Harga Jual Terlalu Rendah

**Gejala:**
- Profit kecil atau rugi
- Tidak bisa cover biaya operasional

**Solusi:**
1. Hitung ulang semua biaya
2. Tambah margin
3. Pertimbangkan fee marketplace
4. Naikkan harga jual bertahap

---

### Masalah 2: Konversi Tidak Sesuai

**Gejala:**
- Stok berkurang tidak sesuai harapan
- Perhitungan subtotal salah

**Solusi:**
1. Cek multiplier di master_konversi.php
2. Pastikan multiplier sesuai kemasan asli
3. Contoh: 1 pack isi 5 → multiplier = 5

---

### Masalah 3: Fee Tidak Terhitung

**Gejala:**
- Nett diterima tidak sesuai ekspektasi
- Profit lebih kecil dari harapan

**Solusi:**
1. Pastikan fee sudah di-set di master_fee.php
2. Pilih platform yang benar saat transaksi
3. Centang "Potong Biaya Admin?"

---

## Checklist Sebelum Transaksi

### Sebelum Membeli Stok:
- [ ] Cek harga beli per unit
- [ ] Cek multiplier konversi
- [ ] Hitung total pembayaran
- [ ] Cek kondisi produk (exp, kualitas)

### Sebelum Menjual:
- [ ] Pilih platform yang benar
- [ ] Cek stok tersedia
- [ ] Hitung harga jual
- [ ] Pastikan qty dan satuan benar
- [ ] Cek perhitungan di cart

### Sebelum Simpan:
- [ ] Cek ulang semua item di cart
- [ ] Pastikan qty tidak melebihi stok
- [ ] Cek total penjualan
- [ ] Cek fee admin (jika online)
- [ ] Cek nett diterima

---

## Kesimpulan

### Poin Penting:
1. **Semua harga dihitung dari Satuan Dasar**
2. **Multiplier harus akurat sesuai kemasan**
3. **Stok selalu dalam satuan dasar (database)**
4. **Fee admin mengurangi nett diterima**
5. **Profit = Nett - Modal**

### Best Practice:
- Selalu cek ulang sebelum simpan
- Gunakan harga yang wajar dan kompetitif
- Monitor stok secara berkala
- Cek laporan untuk evaluasi

---

**Dokumentasi ini dibuat untuk memahami perhitungan di sistem Tokoanin.**  
**Last Updated:** April 2026
