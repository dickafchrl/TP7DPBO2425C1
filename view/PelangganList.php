<!-- Logika -->
    <?php
        if (isset($_POST['add_pelanggan'])) {
            $pelanggan->addpelanggan(
                $_POST['nama_pelanggan'], 
                $_POST['email'], 
                $_POST['no_hp'],
                $_POST['alamat']
            );
            header("Location: ?page=pelanggan");
            exit;
        }

        if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus' && isset($_GET['id'])) {
            $pelanggan->deletePelanggan($_GET['id']);
            header("Location: ?page=pelanggan");
            exit;
        }

        if (isset($_POST['update_pelanggan'])) {
            $pelanggan->updatepelanggan(
                $_POST['id_pelanggan'], 
                $_POST['nama_pelanggan'], 
                $_POST['email'], 
                $_POST['no_hp'], 
                $_POST['alamat']
            );
            header("Location: ?page=pelanggan");
            exit;
        }
     ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data pelanggan</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h2>Tambah Data Pelanggan</h2>

    <a href="?page=pelanggan&aksi=tambah">Tambah Pelanggan</a>

    <h2>Daftar Pelanggan</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No_Hp</th>
                <th>Alamat</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pelanggan->getAllPelanggan() as $p): ?>
                <tr>
                    <td><?=$p['id_pelanggan']?></td>
                    <td><?=$p['nama_pelanggan']?></td>
                    <td><?=$p['email']?></td>
                    <td><?=$p['no_hp']?></td>
                    <td><?=$p['alamat']?></td>
                    <td>
                        <a href="?page=pelanggan&aksi=edit&id=<?= $p['id_pelanggan'] ?>">Edit</a> |
                    <a href="?page=pelanggan&aksi=hapus&id=<?= $p['id_pelanggan'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Form Tambah -->
    <?php if (isset($_GET['aksi']) && $_GET['aksi'] == 'tambah'): ?>
        <form method="post" action="?page=pelanggan">
        <label>Nama:</label>
        <input type="text" name="nama_pelanggan" required>
        
        <label>email:</label>
        <input type="email" name="email" required>
        
        <label>No Hp:</label>
        <input type="text" name="no_hp" required>
        
        <label>alamat:</label>
        <input type="text" name="alamat" required>
        
        <button type="submit" name="add_pelanggan">Tambah</button>
        </form>
    <?php endif; ?>

    <!-- Form Edit -->
     <?php if (isset($_GET['aksi']) && $_GET['aksi'] == 'edit'): ?>
    <?php
        $editPelanggan = $pelanggan->getPelangganById($_GET['id']);
        if ($editPelanggan):
    ?>
    <h3>Edit Pelanggan</h3>
    <form method="POST" action="">
        <input type="hidden" name="id_pelanggan" value="<?= $editPelanggan['id_pelanggan'] ?>">

        <label>Nama pelanggan:</label>        
        <input type="text" name="nama_pelanggan" value="<?= $editPelanggan['nama_pelanggan'] ?>" required>

        <label>Email:</label>
        <input type="text" name="email" value="<?= $editPelanggan['email'] ?>" required>
        
        <label>No Hp:</label>
        <input type="text" name="no_hp" value="<?=$editPelanggan['no_hp']?>" required>
        
        <label>Alamat:</label>
        <input type="text" name="alamat" value="<?=$editPelanggan['alamat']?>" required>
        
        <button type="submit" name="update_pelanggan">Update</button>
    </form>
    <?php else: ?>
        <p>Pelanggan tidak ditemukan.</p>
    <?php endif; ?>
    <?php endif; ?>
</body>
</html>