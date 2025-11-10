<?php
require_once 'class/Parfum.php';
require_once 'class/Pelanggan.php';
require_once 'class/Kategori.php';
require_once 'class/Transaksi.php';
require_once 'class/Detail_Transaksi.php';

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
        <h1 style="text-align:center">
            Vicara
        </h1>
    </header>
    <hr>
    
    <p>Welcome to Vicara the essence of bold youth and quiet luxury</p>
    
    <nav class="navbar">
        <div class="logo"></div>
        <ul>
            <li><a href="?page=detail">Detail Data</a></li>
            <li><a href="?page=parfum">Data Parfum</a></li>
            <li><a href="?page=pelanggan">Data Pelanggan</a></li>
            <li><a href="?page=transaksi">Data Transaksi</a></li>
            <li><a href="?page=kategori">Data Kategori</a></li>
        </ul>
    </nav>
    
    <hr>

    <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            if ($page == 'detail') include 'view/DetailTransaksiList.php';
            elseif ($page == 'parfum') include 'view/ParfumList.php';
            elseif ($page == 'pelanggan') include 'view/PelangganList.php';
            elseif ($page == 'transaksi') include 'view/TransaksiList.php';
            elseif ($page == 'kategori') include 'view/KategoriList.php';
        }
    ?>
    
    <footer class="main-footer">
        <p>&copy; 2025 Vicara Parfum. All right reserved.</p>
    </footer>
</body>
</html>