<?php
require "session.php";
require "../koneksi.php";

/* ===== HITUNG KATEGORI ===== */
$stmtKategori = $pdo->query("SELECT COUNT(*) FROM kategori");
$jumlahKategori = $stmtKategori->fetchColumn();

/* ===== HITUNG PRODUK ===== */
$stmtProduk = $pdo->query("SELECT COUNT(*) FROM produk");
$jumlahProduk = $stmtProduk->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="../bootstrap5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<?php require "navbar.php"; ?>

<div class="container mt-5">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <i class="fa-solid fa-house-chimney"></i> Home
            </li>
        </ol>
    </nav>

    <!-- Greeting -->
    <h2 class="mb-4">Halo <?= htmlspecialchars($_SESSION['username']); ?></h2>

    <!-- Dashboard Cards -->
    <div class="row mt-4">

        <!-- KATEGORI -->
        <div class="col-lg-4 col-md-6 col-12 mb-4">
            <div class="summary-card summary-kategori">
                <div class="row align-items-center">
                    <div class="col-5 text-center">
                        <i class="fas fa-align-justify fa-6x dashboard-icon"></i>
                    </div>
                    <div class="col-7">
                        <h3 class="fs-4 summary-title">Kategori</h3>
                        <p class="fs-5 mb-1"><?= $jumlahKategori; ?> Kategori</p>
                        <a href="kategori.php" class="summary-link">
                            Lihat Detail →
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- PRODUK -->
        <div class="col-lg-4 col-md-6 col-12 mb-4">
            <div class="summary-card summary-produk">
                <div class="row align-items-center">
                    <div class="col-5 text-center">
                        <i class="fas fa-briefcase fa-6x dashboard-icon"></i>
                    </div>
                    <div class="col-7">
                        <h3 class="fs-4 summary-title">Produk</h3>
                        <p class="fs-5 mb-1"><?= $jumlahProduk; ?> Produk</p>
                        <a href="produk.php" class="summary-link">
                            Lihat Detail →
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php require "footer.php"; ?>

<script src="../bootstrap5/js/bootstrap.bundle.min.js"></script>
</body>
</html>
