# TP7DPBO2025C1

## JANJI
Saya Dicka Fachrunaldo Kartamiharja dengan NIM 2407846 mengerjakan Tugas Praktikum 7 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahan-Nya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## Desain ERD
<img width="1224" height="519" alt="image" src="https://github.com/user-attachments/assets/3044bb1b-8158-4029-9d10-e1d34860b687" />

## Desain Program
Prgoram ini menggunakan 5 Entitas
1. Pelanggan
   - Menyimpan data dari pelanggan
   - Atribut (id_pelanggan, nama, email, no_hp, alamat )
3. Transaksi
    - Menyimpan data transaksi pelanggan
    - atribut (id_transaksi, id_pelanggan, tanggal_transaksi, total_harga, metode_pembayaran)
5. Kategori
   - Menyimpan data dari kategori
   - atribut (id_kategori, nama_kategori, deskripsi)
7. Parfum
   - menyimpan data parfum
   - atribut (id_parfum, nama_parfum, id_kategori, ukuran, harga, stok)
9. Detail Transaksi
   - menyimpan data dari transaksi dan parfum pembelian nya
   - atribut (id_detail, id_transaksi, id_parfum, jumlah, subtotal)

## Alur Program
1. Halaman Utama (index.php)
- Menampilkan navigasi menuju page CRUD
- meng-include tampilan sesuai dengan $_GET['page']
2. CRUD pelanggan
- Create: Form tambah pelanggan (nama, email, no_hp, telepon)
- Read: Tabel daftar pelanggan
- Update: Form edit pelanggan
- Delete: Tombol hapus pelanggan
3. CRUD transaksi
- Create: Form tambah transaksi (id_pelanggan, tanggal_transaksi, total_harga, metode_pembayaran)
- Read: Tabel daftar transaksi
- Update: Form edit transaksi
- Delete: Tombol hapus transaksi
4. parfum
- Create: Form tambah parfum (nama_parfum, id_kategori, ukuran, harga, stok)
- Read: Tabel daftar parfum
- Update: Form edit parfum
- Delete: Tombol hapus parfum
5. Detail_transaksi
- Read: Tabel daftar detail_transaksi
- search

## Keamanan
- Menggunakan Prepared Statement untuk mencegah SQL Injection
- Modularisasi melalui pemisahan class dan include view
- Menggunakan PDO untuk perantara ke Database
- Kode terpisah antara tampilan (view/) dan logika (class/)

## Dokum
https://github.com/user-attachments/assets/8b783e88-a642-4e2b-9abf-05d16ffa96ee


