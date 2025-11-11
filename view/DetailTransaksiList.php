<!-- Logika -->
    <?php
        // Tambah
        if (isset($_POST['add_detail'])) {
            $detailtransaksi->addDetailTransaksi(
                $_POST['id_transaksi'],
                $_POST['id_parfum'],
                $_POST['jumlah'],
                $_POST['subtotal']
            );
            header("Location: ?page=detail");
            exit;
        }

        // Hapus
        if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus' && isset($_GET['id'])) {
            $detailtransaksi->deleteDetailTransaksi($_GET['id']);
            header("Location: ?page=detail");
            exit;
        }

        // Update
        if (isset($_POST['update_detail'])) {
            $detailtransaksi->updateDetailTransaksi(
                $_POST['id_detail'],
                $_POST['id_transaksi'],
                $_POST['id_parfum'],
                $_POST['jumlah'],
                $_POST['subtotal']
            );
            header("Location: ?page=detail");
            exit;
        }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h2>Tambah Detail Transaksi</h2>
    
    <a href="?page=detail&aksi=tambah">Tambah Detail</a>

    <h2>Daftar Detail Transaksi</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID Detail</th>
                <th>Nama Pelanggan</th>
                <th>Parfum</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detailtransaksi->getAllDetailTransaksiWithRelasi() as $d): ?>
            <tr>
                <td><?=$d['id_detail']?></td>
                <td><?=$d['nama_pelanggan']?></td>
                <td><?=$d['nama_parfum']?></td>
                <td><?=$d['jumlah']?></td>
                <td><?=$d['subtotal']?></td>
                <td>
                    <a href="?page=detail&aksi=edit&id=<?= $d['id_detail'] ?>">Edit</a> |
                    <a href="?page=detail&aksi=hapus&id=<?= $d['id_detail'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Form Tambah -->
    <?php if (isset($_GET['aksi']) && $_GET['aksi'] == 'tambah'): ?>
        <form method="post" action="?page=detail">
            <label>Transaksi:</label>
            <select name="id_transaksi" required>
                <?php foreach($transaksi->getAllTransaksiWithPelanggan() as $t): ?>
                    <option value="<?=$t['id_transaksi']?>"><?=$t['id_transaksi']?> - <?=$t['nama_pelanggan']?></option>
                <?php endforeach; ?>
            </select>

            <label>Parfum:</label>
            <select name="id_parfum" required>
                <?php foreach($parfum->getAllParfum() as $p): ?>
                    <option value="<?=$p['id_parfum']?>"><?=$p['nama_parfum']?></option>
                <?php endforeach; ?>
            </select>

            <label>Jumlah:</label>
            <input type="number" name="jumlah" value="1" required>

            <label>Subtotal:</label>
            <input type="number" name="subtotal" required>

            <button type="submit" name="add_detail">Tambah</button>
        </form>
    <?php endif; ?>

    <!-- Form Edit -->
    <?php if (isset($_GET['aksi']) && $_GET['aksi'] == 'edit'): ?>
    <?php
        $editDetail = $detailtransaksi->getDetailById($_GET['id']);
        if ($editDetail):
    ?>
        <h3>Edit Detail Transaksi</h3>
        <form method="post" action="?page=detail">
            <input type="hidden" name="id_detail" value="<?= $editDetail['id_detail'] ?>">

            <label>Transaksi:</label>
            <select name="id_transaksi"required>
                <?php foreach($transaksi->getAllTransaksiWithPelanggan() as $d): ?>
                    <option value="<?=$d['id_transaksi']?>" <?= $d['id_transaksi'] == $editDetail['id_transaksi'] ? 'selected' : '' ?>>
                        <?=$d['id_transaksi']?> - <?=$d['nama_pelanggan']?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Parfum:</label>
            <select name="id_parfum" required>
                <?php foreach($parfum->getAllParfum() as $p): ?>
                    <option value="<?=$p['id_parfum']?>" <?= $p['id_parfum'] == $editDetail['id_parfum'] ? 'selected' : '' ?>>
                        <?=$p['nama_parfum']?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Jumlah:</label>
            <input type="number" name="jumlah" value="<?=$editDetail['jumlah']?>" required>

            <label>Subtotal:</label>
            <input type="number" name="subtotal" value="<?=$editDetail['subtotal']?>" required>

            <button type="submit" name="update_detail">Update</button>
        </form>
    <?php else: ?>
        <p>Detail transaksi tidak ditemukan.</p>
    <?php endif; ?>
    <?php endif; ?>
</body>
</html>