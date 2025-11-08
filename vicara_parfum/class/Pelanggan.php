<?php
require_once 'vicara_parfum/config/db.php';

class Pelanggan {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllPelanggan() {
        $stmt = $this->db->query("SELECT * FROM pelanggan");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addPelanggan($nama_pelanggan, $email, $no_hp, $alamat) {
        $stmt = $this->db->prepare("INSERT INTO pelanggan (nama_pelanggan, email, no_hp, alamat) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nama_pelanggan, $email, $no_hp, $alamat]);
        return $this->db->lastInsertId();
    }

    public function deletePelanggan($id) {
        $stmt = $this->db->prepare("DELETE FROM pelanggan WHERE id_pelanggan = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    public function updatePelanggan($id, $nama_pelanggan, $email, $no_hp, $alamat) {
        $stmt = $this->db->prepare("UPDATE pelanggan SET nama_pelanggan = ?, email = ?, no_hp = ?, alamat = ? WHERE id_pelanggan = ?");
        $stmt->execute([$nama_pelanggan, $email, $no_hp, $alamat, $id]);
        return $stmt->rowCount();
    }
}
?>