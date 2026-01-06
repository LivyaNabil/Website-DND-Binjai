<?php
require "session.php";
require "../koneksi.php";

/* ===== VALIDASI ID ===== */
if (!isset($_GET['p']) || !is_numeric($_GET['p'])) {
    header("Location: kategori.php");
    exit;
}

$id = (int) $_GET['p'];

/* ===== AMBIL DATA KATEGORI ===== */
$stmt = $pdo->prepare("SELECT * FROM kategori WHERE id = :id");
$stmt->execute(['id' => $id]);
$data = $stmt->fetch();

if (!$data) {
    header("Location: kategori.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>

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
            <li class="breadcrumb-item">
                <a href="kategori.php" class="no-decoration text-muted">
                    Kategori
                </a>
            </li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>

    <!-- DETAIL -->
    <div class="card-custom col-lg-6 col-md-8 col-12 mb-5">
        <h3 class="mb-4">Detail Kategori</h3>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <input type="text"
                       name="kategori"
                       class="form-control"
                       value="<?= htmlspecialchars($data['nama']); ?>"
                       required>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" name="editBtn" class="btn btn-edit">
                    Simpan Perubahan
                </button>
                <button type="submit"
                        name="deleteBtn"
                        class="btn btn-delete"
                        onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                    Hapus
                </button>
            </div>
        </form>

        <?php
        /* ===== EDIT ===== */
        if (isset($_POST['editBtn'])) {
            $kategori = trim($_POST['kategori']);

            if ($kategori === $data['nama']) {
                header("Location: kategori.php");
                exit;
            }

            $cek = $pdo->prepare(
                "SELECT COUNT(*) FROM kategori WHERE nama = :nama AND id != :id"
            );
            $cek->execute([
                'nama' => $kategori,
                'id'   => $id
            ]);

            if ($cek->fetchColumn() > 0) {
                echo '<div class="alert alert-warning mt-3">Kategori sudah tersedia.</div>';
            } else {
                $update = $pdo->prepare(
                    "UPDATE kategori SET nama = :nama WHERE id = :id"
                );
                $update->execute([
                    'nama' => $kategori,
                    'id'   => $id
                ]);

                echo '<div class="alert alert-success mt-3">Kategori berhasil diupdate.</div>';
                header("refresh:1;url=kategori.php");
            }
        }

        /* ===== DELETE ===== */
        if (isset($_POST['deleteBtn'])) {
            $cekProduk = $pdo->prepare(
                "SELECT COUNT(*) FROM produk WHERE kategori_id = :id"
            );
            $cekProduk->execute(['id' => $id]);

            if ($cekProduk->fetchColumn() > 0) {
                echo '<div class="alert alert-warning mt-3">
                        Kategori tidak dapat dihapus karena sudah digunakan dalam produk.
                      </div>';
            } else {
                $delete = $pdo->prepare(
                    "DELETE FROM kategori WHERE id = :id"
                );
                $delete->execute(['id' => $id]);

                echo '<div class="alert alert-success mt-3">Kategori berhasil dihapus.</div>';
                header("refresh:1;url=kategori.php");
            }
        }
        ?>
    </div>
</div>

<?php require "footer.php"; ?>

<script src="../bootstrap5/js/bootstrap.bundle.min.js"></script>
</body>
</html>
