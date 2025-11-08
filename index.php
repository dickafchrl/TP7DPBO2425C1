<?php
require_once 'vicara_parfum/class/Parfum.php';
require_once 'vicara_parfum/class/Pelanggan.php';
require_once 'vicara_parfum/class/Kategori.php';
require_once 'vicara_parfum/class/Transaksi.php';
require_once 'vicara_parfum/class/Detail_Transaksi.php';

$parfum = new Parfum();
$pelanggan = new Pelanggan();
$kategori = new Kategori();
$transaksi = new Transaksi();
$detailtransaksi = new DetailTransaksi();


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Vicara System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>
            Vicara Parfum
        </h1>
    </header>
</body>
</html>