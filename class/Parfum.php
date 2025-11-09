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

    public function getAllParfumWithCategory() {
        $stmt = $this->db->query("SELECT 
        p.id_parfum, 
        p.nama_parfum, 
        k.nama_kategori, 
        p.ukuran, 
        p.harga, 
        p.stok 
        FROM parfum p
        INNER JOIN kategori k ON p.id_kategori = k.id_kategori
        ORDER BY p.id_parfum DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getParfumById($id) {
        $stmt = $this->db->prepare("SELECT * FROM parfum WHERE id_parfum = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addParfum($nama_parfum, $id_kategori, $ukuran, $harga, $stok) {
        $stmt = $this->db->prepare("INSERT INTO parfum (nama_parfum, id_kategori, ukuran, harga, stok ) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nama_parfum, $id_kategori, $ukuran, $harga, $stok]);
        return $this->db->lastInsertId();
    }

    public function deleteParfum($id) {
        $stmt = $this->db->prepare("DELETE FROM parfum WHERE id_parfum = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    public function updateParfum($id, $nama_parfum, $id_kategori, $ukuran, $harga, $stok) {
        $stmt = $this->db->prepare("UPDATE parfum SET nama_parfum = ?, id_kategori = ?, ukuran = ?, harga = ?, stok = ? WHERE id_parfum = ?");
        $stmt->execute([$nama_parfum, $id_kategori, $ukuran, $harga, $stok, $id]);
        return $stmt->rowCount();
    }
}
?>