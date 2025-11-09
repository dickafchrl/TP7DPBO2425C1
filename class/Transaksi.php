<?php
require_once 'config/db.php';

class Transaksi {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllTransaksi() {
        $stmt = $this->db->query("SELECT * FROM transaksi");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllTransaksiWithPelanggan() {
        $stmt = $this->db->prepare("SELECT
        t.id_transaksi,
        t.tanggal_transaksi,
        p.nama_pelanggan,
        t.metode_pembayaran
        FROM transaksi t
        INNER JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
        ORDER BY t.id_transaksi DESC
        ");
        $stmt->execute();
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    public function addTransaksi($id_pelanggan, $tanggal_transaksi, $total_harga, $metode_pembayaran) {
        $stmt = $this->db->prepare("INSERT INTO transaksi (id_pelanggan, tanggal_transaksi, total_harga, metode_pembayaran) VALUES (?, ?, ?, ?)");
        $stmt->execute([$id_pelanggan, $tanggal_transaksi, $total_harga, $metode_pembayaran]);
        return $this->db->lastInsertId();
    }

    public function deleteTransaksi($id) {
        $stmt = $this->db->prepare("DELETE FROM transaksi WHERE id_transaksi = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    public function updateTransaksi($id, $id_pelanggan, $tanggal_transaksi, $total_harga, $metode_pembayaran) {
        $stmt = $this->db->prepare("UPDATE transaksi SET id_pelanggan = ?, tanggal_transaksi = ?, total_harga = ?, metode_pembayaran = ? WHERE id_transaksi = ?");
        $stmt->execute([$id_pelanggan, $tanggal_transaksi, $total_harga, $metode_pembayaran, $id]);
        return $stmt->rowCount();
    }
}
?>