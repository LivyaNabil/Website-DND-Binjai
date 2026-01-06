<?php
require "session.php";
require "../koneksi.php";

/* ===== AMBIL DATA KATEGORI ===== */
$stmtKategori = $pdo->query("SELECT * FROM kategori ORDER BY id DESC");
$dataKategori = $stmtKategori->fetchAll();
$jumlahKategori = count($dataKategori);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>

    <link rel="stylesheet" href="../bootstrap5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<?php require "navbar.php"; ?>

<div class="container mt-5">

    <!-- BREADCRUMB -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="../adminpanel" class="no-decoration text-muted">
                    <i class="fa-solid fa-house-chimney"></i> Home
                </a>
            </li>
            <li class="breadcrumb-item active">Kategori</li>
        </ol>
    </nav>

    <!-- TAMBAH KATEGORI -->
    <div class="card-custom col-lg-6 col-md-8 col-12 mb-5">
        <h3 class="mb-3">Tambah Kategori</h3>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <input type="text"
                       name="kategori"
                       class="form-control"
                       placeholder="Input nama kategori"
                       autocomplete="off"
                       required>
            </div>

            <button type="submit" name="simpan_kategori" class="btn btn-simpan">
                Simpan
            </button>
        </form>

        <?php
        if (isset($_POST['simpan_kategori'])) {
            $kategori = trim($_POST['kategori']);

            $cek = $pdo->prepare(
                "SELECT COUNT(*) FROM kategori WHERE nama = :nama"
            );
            $cek->execute(['nama' => $kategori]);

            if ($cek->fetchColumn() > 0) {
                echo '<div class="alert alert-warning mt-3">Kategori sudah tersedia.</div>';
            } else {
                $insert = $pdo->prepare(
                    "INSERT INTO kategori (nama) VALUES (:nama)"
                );
                $insert->execute(['nama' => $kategori]);

                echo '<div class="alert alert-success mt-3">Kategori berhasil disimpan.</div>';
                header("refresh:1;url=kategori.php");
            }
        }
        ?>
    </div>

    <!-- LIST KATEGORI -->
    <div class="card-custom mb-5">
        <h3 class="mb-4">List Kategori</h3>

        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>Nama</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if ($jumlahKategori === 0) {
                    echo '<tr><td colspan="3" class="text-center">Data kategori tidak tersedia</td></tr>';
                } else {
                    $no = 1;
                    foreach ($dataKategori as $row) {
                ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['nama']); ?></td>
                        <td class="text-center">
                            <a href="kategori-detail.php?p=<?= $row['id']; ?>"
                               class="btn btn-action btn-sm">
                                <i class="fas fa-search"></i>
                            </a>
                        </td>
                    </tr>
                <?php } } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php require "footer.php"; ?>

<script src="../bootstrap5/js/bootstrap.bundle.min.js"></script>
<script src="../fontawesome/js/all.min.js"></script>
</body>
</html>
