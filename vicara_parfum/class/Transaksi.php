<?php
require_once 'vicara_parfum/config/db.php';

class Transaksi {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllTransaksi() {
        $stmt = $this->db->query("SELECT * FROM transaksi");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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