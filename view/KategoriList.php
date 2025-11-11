<!-- Logika -->
    <?php
        if (isset($_POST['add_kategori'])) {
            $kategori->addKategori(
                $_POST['nama_kategori'], 
                $_POST['deskripsi']
            );
            header("Location: ?page=kategori");
            exit;
        }

        if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus' && isset($_GET['id'])) {
            $kategori->deleteKategori($_GET['id']);
            header("Location: ?page=kategori");
            exit;
        }

        if (isset($_POST['update_kategori'])) {
            $kategori->updateKategori(
                $_POST['id_kategori'], 
                $_POST['nama_kategori'],
                $_POST['deskripsi']
            );
            header("Location: ?page=kategori");
            exit;
        }
     ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kategori</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h2>Tambah Data Kategori</h2>

    <a href="?page=kategori&aksi=tambah">Tambah Kategori</a>

    <h2>Daftar Kategori</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kategori->getAllKategori() as $k): ?>
                <tr>
                    <td><?=$k['id_kategori']?></td>
                    <td><?=$k['nama_kategori']?></td>
                    <td><?=$k['deskripsi']?></td>
                    <td>
                        <a href="?page=kategori&aksi=edit&id=<?= $k['id_kategori'] ?>">Edit</a> |
                        <a href="?page=kategori&aksi=hapus&id=<?= $k['id_kategori'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Form Tambah -->
    <?php if (isset($_GET['aksi']) && $_GET['aksi'] == 'tambah'): ?>
        <form method="post" action="?page=kategori">
        <label>Nama:</label>
        <input type="text" name="nama_kategori" required>
        
        <label>deskripsi:</label>
        <input type="text" name="deskripsi" required>
        
        <button type="submit" name="add_kategori">Tambah</button>
        </form>
    <?php endif; ?>

    <!-- Form Edit -->
     <?php if (isset($_GET['aksi']) && $_GET['aksi'] == 'edit'): ?>
    <?php
        $editKategori = $kategori->getKategoriById($_GET['id']);
        if ($editKategori):
    ?>
    <h3>Edit Kategori</h3>
    <form method="POST" action="">
        <input type="hidden" name="id_kategori" value="<?= $editKategori['id_kategori'] ?>">

        <label>Nama Kategori:</label>        
        <input type="text" name="nama_kategori" value="<?= $editKategori['nama_kategori'] ?>" required>

        <label>Deskripsi:</label>
        <input type="text" name="deskripsi" value="<?= $editKategori['deskripsi'] ?>" required>
                
        <button type="submit" name="update_kategori">Update</button>
    </form>
    <?php else: ?>
        <p>Kategori tidak ditemukan.</p>
    <?php endif; ?>
    <?php endif; ?>
</body>
</html>