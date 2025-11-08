<?php
require_once 'config/db.php';

class Parfum {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllParfum() {
        $stmt = $this->db->query("SELECT * FROM parfum");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }   

    public function getParfumById($id) {
        $stmt = $this->db->prepare("SELECT * FROM parfum WHERE id_parfum = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addParfum($nama_parfum, $id_kategori, $ukuran, $harga, $stok) {
        $stmt = $this->db->prepare("INSERT INTO parfum (nama_parfum, id_kategori, ukuran, harga, stok) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nama_parfum, $id_kategori, $ukuran, $harga]);
        return $this->db->lastInsertId();
    }

    public function deleteParfum($id) {
        $stmt = $this->db->prepare("DELETE FROM parfum WHERE id_parfum = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    public function updateStock($id, $stok) {
        $stmt = $this->db->prepare("UPDATE parfum SET stok = ? WHERE id_parfum = ?");
        return $stmt->execute([$stok, $id]);
    }

    public function updateParfum($id, $nama_parfum, $id_kategori, $ukuran, $harga, $stok) {
        $stmt = $this->db->prepare("UPDATE parfum SET nama_parfum = ?, id_kategori = ?, ukuran = ?, harga = ?, stok = ? WHERE id_parfum = ?");
        $stmt->execute([$nama_parfum, $id_kategori, $ukuran, $harga, $id]);
        return $stmt->rowCount();
    }
}
?>