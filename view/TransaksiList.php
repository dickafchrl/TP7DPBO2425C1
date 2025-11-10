<!-- Logika -->

<?php
    if (isset($_POST['add_transaksi'])) {
        $transaksi->addTransaksi(
            $_POST['id_pelanggan'],
            $_POST['tanggal_transaksi'],
            $_POST['total_harga'],
            $_POST['metode_pembayaran']
        );
        header("Location: ?page=transaksi");
        exit;
    }

    if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus' && isset($_GET['id'])) {
        $transaksi->deleteTransaksi($_GET['id']);
        header("Location: ?page=transaksi");
        exit;
    }

    if (isset($_POST['update_transaksi'])) {
        $transaksi->updateTransaksi(
            $_POST['id_transaksi'],
            $_POST['id_pelanggan'],
            $_POST['tanggal_transaksi'],
            $_POST['total_harga'],
            $_POST['metode_pembayaran']
        );
        header("Location: ?page=transaksi");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data transaksi</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h2>Tambah Data Transaksi</h2>

    <a href="?page=transaksi&aksi=tambah">Tambah transaksi</a>

    <h2>Daftar transaksi</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Id Pelanggan</th>
                <th>Tanggal Transaksi</th>
                <th>Total Harga</th>
                <th>Metode Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transaksi->getAllTransaksi() as $t): ?>
                <tr>
                    <td><?=$t['id_transaksi']?></td>
                    <td><?=$t['id_pelanggan']?></td>
                    <td><?=$t['tanggal_transaksi']?></td>
                    <td><?=$t['total_harga']?></td>
                    <td><?=$t['metode_pembayaran']?></td>
                    <td>
                        <a href="?page=transaksi&aksi=edit&id=<?= $t['id_transaksi'] ?>">Edit</a> |
                        <a href="?page=transaksi&aksi=hapus&id=<?= $t['id_transaksi'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Form Tambah -->
    <?php if (isset($_GET['aksi']) && $_GET['aksi'] == 'tambah'): ?>
        <h3>Tambah Data</h3>
        <form method="post" action="?page=transaksi">
        <label>Id Pelanggan:</label>
        <label>Pelanggan:</label>
        <select name="id_pelanggan" required>
            <?php foreach($pelanggan->getAllPelanggan() as $p): ?>
                <option value="<?= $p['id_pelanggan'] ?>"><?= $p['nama_pelanggan'] ?></option>
            <?php endforeach; ?>
        </select>
        
        <label>Tanggal Transaksi:</label>
        <input type="text" name="tanggal_transaksi" required>
        
        <label>Total Harga:</label>
        <input type="text" name="total_harga" required>
        
        <label>Metode Pembayaran:</label>
        <input type="text" name="metode_pembayaran" required>

        <button type="submit" name="add_transaksi">Tambah</button>
        </form>
    <?php endif; ?>

    <!-- Form Edit -->
     <?php if (isset($_GET['aksi']) && $_GET['aksi'] == 'edit'): ?>
    <?php
        $editTransaksi = $transaksi->getTransaksiById($_GET['id']);
        if ($editTransaksi):
    ?>
    <h3>Edit Transaksi</h3>
    <form method="POST" action="">
        <input type="hidden" name="id_transaksi" value="<?= $editTransaksi['id_transaksi'] ?>">

        <label>Id Pelanggan:</label>        
        <select name="id_pelanggan" required>
            <?php foreach($pelanggan->getAllPelanggan() as $p): ?>
                <option value="<?= $p['id_pelanggan'] ?>"><?= $p['nama_pelanggan'] ?></option>
            <?php endforeach; ?>
        </select>

        <label>Tanggal Transaksi:</label>
        <input type="text" name="tanggal_transaksi" value="<?= $editTransaksi['tanggal_transaksi'] ?>" required>
        
        <label>Total Harga:</label>
        <input type="text" name="total_harga" value="<?= $editTransaksi['total_harga'] ?>" required>
        
        <label>Metode Pembayaran:</label>
        <input type="text" name="metode_pembayaran" value="<?= $editTransaksi['metode_pembayaran'] ?>" required>
                
        <button type="submit" name="update_transaksi">Update</button>
    </form>
    <?php else: ?>
        <p>transaksi tidak ditemukan.</p>
    <?php endif; ?>
    <?php endif; ?>
</body>
</html>