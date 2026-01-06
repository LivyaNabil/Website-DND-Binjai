<?php
require "koneksi.php";

/* ambil semua kategori */
$stmtKategori = $pdo->query("SELECT * FROM kategori");
$kategoriList = $stmtKategori->fetchAll();

/* default query produk */
$sqlProduk = "SELECT * FROM produk";
$params = [];

/* filter keyword */
if (!empty($_GET['keyword'])) {
    $sqlProduk .= " WHERE nama LIKE :keyword";
    $params['keyword'] = '%' . $_GET['keyword'] . '%';
}

/* filter kategori */
elseif (!empty($_GET['kategori'])) {
    $sqlProduk .= " WHERE kategori_id = :kategori_id";
    $params['kategori_id'] = (int) $_GET['kategori'];
}

$stmtProduk = $pdo->prepare($sqlProduk);
$stmtProduk->execute($params);
$produkList = $stmtProduk->fetchAll();
$countData = count($produkList);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DND-Binjai | Produk</title>

    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php require "navbar.php"; ?>

<!-- banner -->
<div class="container-fluid banner-produk d-flex align-items-center">
    <div class="container text-white text-center">
        <h1>Produk</h1>
        <h4 class="text-center mx-auto mt-3 text-dibawah-produk">
            "menghadirkan cita rasa yang dibuat dengan dedikasi, kreatifitas, dan standar yang konsisten"
        </h4>
    </div>
</div>

<!-- body -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row">

            <!-- kategori -->
            <div class="col-lg-3 mb-5">
                <h3>Kategori</h3>
                <ul class="list-group kategori-list py-3">
                    <?php foreach ($kategoriList as $kat) {
                        $active = ($_GET['kategori'] ?? '') == $kat['id'];
                    ?>
                        <li class="list-group-items kategori-item <?= $active ? 'active' : '' ?>">
                            <a href="produk.php?kategori=<?= $kat['id'] ?>">
                                <?= htmlspecialchars($kat['nama']) ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <!-- produk -->
            <div class="col-lg-9">
                <h3 class="text-center mb-3">Produk</h3>

                <div class="row">
                    <?php if ($countData < 1) { ?>
                        <div class="col-12">
                            <div class="alert alert-warning text-center">
                                Produk tidak ditemukan.
                            </div>
                        </div>
                    <?php } ?>

                    <?php foreach ($produkList as $produk) { ?>
                        <div class="col-md-4 mb-4 py-2">
                            <div class="card h-100 shadow">
                                <div class="image-box">
                                    <img src="image/<?= htmlspecialchars($produk['foto']) ?>" class="card-img-top">
                                </div>

                                <div class="card-body text-center">
                                    <h4 class="card-title warna-nama">
                                        <?= htmlspecialchars($produk['nama']) ?>
                                    </h4>
                                    <p class="card-text text-truncate">
                                        <?= htmlspecialchars($produk['detail']) ?>
                                    </p>
                                    <p class="card-text text-harga">
                                        Rp. <?= number_format($produk['harga']) ?>
                                    </p>
                                    <a href="produk-detail.php?id=<?= $produk['id'] ?>"
                                       class="btn warna11 text-white">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
</div>

<?php require "footer.php"; ?>

<script src="bootstrap5/js/bootstrap.bundle.min.js"></script>
<script src="fontawesome/js/all.min.js"></script>
</body>
</html>
