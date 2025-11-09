<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Parfum</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h2>Tambah Data Parfum</h2>
    
    <a href="?page=parfum&aksi=tambah">Tambah Parfum</a>

    <h2>Daftar Parfum</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Ukuran</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($parfum->getAllParfumWithCategory() as $p): ?>
            <tr>
                <td><?=$p['id_parfum']?></td>
                <td><?=$p['nama_parfum']?></td>
                <td><?=$p['nama_kategori']?></td>
                <td><?=$p['ukuran']?></td>
                <td><?=$p['harga']?></td>
                <td><?=$p['stok']?></td>
                <td>
                    <a href="?page=parfum&aksi=edit&id=<?= $p['id_parfum'] ?>">Edit</a> |
                    <a href="?page=parfum&aksi=hapus&id=<?= $p['id_parfum'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Form Tambah -->
    <?php if (isset($_GET['aksi']) && $_GET['aksi'] == 'tambah'): ?>
        <form method="post" action="?page=parfum">
        <label>Nama:</label>
        <input type="text" name="nama_parfum" required>
        
        <label>ID kategori:</label>
        <input type="number" name="id_kategori" required>
        
        <label>ukuran:</label>
        <input type="text" name="ukuran" required>
        
        <label>harga:</label>
        <input type="number" name="harga" required>
        
        <button type="submit" name="add_parfum">Tambah</button>
        </form>
    <?php endif; ?>

    <!-- Form Edit -->
    <?php if (isset($_GET['aksi']) && $_GET['aksi'] == 'edit'): ?>
    <?php
        $editParfum = $parfum->getParfumById($_GET['id']);
        if ($editParfum):
    ?>
    <h3>Edit Parfum</h3>
    <form method="POST" action="">
        <input type="hidden" name="id_parfum" value="<?= $editParfum['id_parfum'] ?>">

        <label>Nama Parfum:</label>        
        <input type="text" name="nama_parfum" value="<?= $editParfum['nama_parfum'] ?>" required>
        
        <label>ID Kategori:</label>
        <select name="id_kategori" required>
            <?php foreach($kategori->getAllKategori() as $k): ?>
                 <option value="<?= $k['id_kategori'] ?>" <?= $k['id_kategori'] == $editParfum['id_kategori'] ? 'selected' : '' ?>>
                    <?= $k['nama_kategori'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Ukuran:</label>
        <input type="text" name="ukuran" value="<?= $editParfum['ukuran'] ?>" required>
        
        <label>Harga</label>
        <input type="number" name="harga" value="<?=$editParfum['harga']?>" required>
        
        <label>Stok</label>
        <input type="number" name="stok" value="<?=$editParfum['stok']?>" required>
        
        <button type="submit" name="update_parfum">Update</button>
    </form>
    <?php else: ?>
        <p>parfum tidak ditemukan.</p>
    <?php endif; ?>
    <?php endif; ?>


    <!-- Logika -->
     <?php
        if (isset($_POST['add_parfum'])) {
            $parfum->addParfum(
                $_POST['nama_parfum'], 
                $_POST['id_kategori'], 
                $_POST['ukuran'], 
                $_POST['harga'], 
                $_POST['stok']
            );
            header("Location: ?page=parfum");
            exit;
        }

        if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus' && isset($_GET['id'])) {
            $parfum->deleteParfum($_GET['id']);
            header("Location: ?page=pengguna");
            exit;
        }

        if (isset($_POST['update_parfum'])) {
            $parfum->updateParfum(
                $_POST['id_parfum'],
                $_POST['nama_parfum'], 
                $_POST['id_kategori'], 
                $_POST['ukuran'], 
                $_POST['harga'], 
                $_POST['stok']
            );
            header("Location: ?page=parfum");
            exit;
        }
     ?>
</body>
</html>