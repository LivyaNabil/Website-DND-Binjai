<?php
require "koneksi.php";

if (!isset($_GET['id'])) {
    die("Produk tidak ditemukan.");
}

$id = (int) $_GET['id'];

/* ambil detail produk */
$sqlProduk = "SELECT * FROM produk WHERE id = :id LIMIT 1";
$stmtProduk = $pdo->prepare($sqlProduk);
$stmtProduk->execute(['id' => $id]);
$produk = $stmtProduk->fetch();

if (!$produk) {
    die("Produk tidak ditemukan.");
}

$kategori_id = $produk['kategori_id'];

/* produk terkait */
$sqlTerkait = "SELECT * FROM produk 
               WHERE kategori_id = :kategori_id 
               AND id != :id 
               LIMIT 4";
$stmtTerkait = $pdo->prepare($sqlTerkait);
$stmtTerkait->execute([
    'kategori_id' => $kategori_id,
    'id' => $id
]);
$produkTerkait = $stmtTerkait->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DND-Binjai | Detail Produk</title>

    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php require "navbar.php"; ?>

<!-- detail produk -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mb-5">
                <img src="image/<?= htmlspecialchars($produk['foto']) ?>" class="w-100" alt="">
            </div>

            <div class="col-md-6 offset-lg-1">
                <h1><?= htmlspecialchars($produk['nama']) ?></h1>
                <p class="fs-5">
                    <?= htmlspecialchars($produk['detail']) ?>
                </p>
                <p class="text-harga">
                    Rp. <?= number_format($produk['harga']) ?>
                </p>
                <p class="fs-5">
                    Status Ketersediaan:
                    <strong><?= htmlspecialchars($produk['ketersediaan_stok']) ?></strong>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- produk terkait -->
<div class="container-fluid py-5 warna8">
    <div class="container">
        <h2 class="text-center text-white mb-5">Produk Terkait</h2>

        <div class="row">
            <?php foreach ($produkTerkait as $data) { ?>
                <div class="col-md-6 col-lg-3 mb-3">
                    <a href="produk-detail.php?id=<?= $data['id'] ?>">
                        <div class="produk-terkait-box">
                            <img src="image/<?= htmlspecialchars($data['foto']) ?>"
                                 class="produk-terkait-image" alt="">
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php require "footer.php"; ?>

<script src="bootstrap5/js/bootstrap.bundle.min.js"></script>
<script src="fontawesome/js/all.min.js"></script>
</body>
</html>
