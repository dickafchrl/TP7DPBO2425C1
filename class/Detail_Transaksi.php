<?php
require_once 'config/db.php';

class DetailTransaksi {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    
    public function getAllDetailTransaksi() {
        $stmt = $this->db->query("SELECT * FROM detail_transaksi");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getDetailById($id) {
        $stmt = $this->db->prepare("SELECT * FROM detail_transaksi WHERE id_detail = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getAllDetailTransaksiWithRelasi() {       
        $stmt = $this->db->query("SELECT 
            dt.id_detail,
            t.tanggal_transaksi,
            p.nama_pelanggan,
            pf.nama_parfum,
            pf.ukuran,
            dt.jumlah,
            dt.subtotal,
            t.metode_pembayaran
            FROM detail_transaksi dt
            INNER JOIN transaksi t ON dt.id_transaksi = t.id_transaksi
            INNER JOIN parfum pf ON dt.id_parfum = pf.id_parfum
            INNER JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
            ORDER BY dt.id_detail DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addDetailTransaksi($id_transaksi, $id_parfum, $jumlah, $subtotal) {
        $stmt = $this->db->prepare("INSERT INTO detail_transaksi (id_transaksi, id_parfum, jumlah, subtotal) VALUES (?, ?, ?, ?)");
        $stmt->execute([$id_transaksi, $id_parfum, $jumlah, $subtotal]);
        return $this->db->lastInsertId();
    }

    public function deleteDetailTransaksi($id) {
        $stmt = $this->db->prepare("DELETE FROM detail_transaksi WHERE id_detail = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    public function updateDetailTransaksi($id, $id_transaksi, $id_parfum, $jumlah, $subtotal) {
        $stmt = $this->db->prepare("UPDATE detail_transaksi SET id_transaksi = ?, id_parfum = ?, jumlah = ?, subtotal = ? WHERE id_detail = ?");
        $stmt->execute([$id_transaksi, $id_parfum, $jumlah, $subtotal, $id]);
        return $stmt->rowCount();
    }
}
?>