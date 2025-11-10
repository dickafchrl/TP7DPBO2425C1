<?php
require_once 'config/db.php';

class Kategori {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllKategori() {
        $stmt = $this->db->query("SELECT * FROM kategori");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getKategoriById($id) {
        $stmt = $this->db->prepare("SELECT * FROM kategori WHERE id_kategori = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addKategori($nama_kategori, $deskripsi) {
        $stmt = $this->db->prepare("INSERT INTO kategori (nama_kategori, deskripsi) VALUES (?, ?)");
        $stmt->execute([$nama_kategori, $deskripsi]);
        return $this->db->lastInsertId();
    }

    public function deleteKategori($id) {
        $stmt = $this->db->prepare("DELETE FROM kategori WHERE id_kategori = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    public function updateKategori($id, $nama_kategori, $deskripsi) {
        $stmt = $this->db->prepare("UPDATE kategori SET nama_kategori = ?, deskripsi = ? WHERE id_kategori = ?");
        $stmt->execute([$nama_kategori, $deskripsi, $id]);
        return $stmt->rowCount();
    }
}
?>