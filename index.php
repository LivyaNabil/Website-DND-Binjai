<?php
require "koneksi.php";

$sql = "SELECT id, nama, harga, foto, detail FROM produk LIMIT 6";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$produk = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DND-Binjai | Home</title>

    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php require "navbar.php"; ?>

<!-- banner -->
<div class="container-fluid banner d-flex align-items-center">
    <div class="container text-center text-white">
        <h1>Toko DND_Binjai</h1>
        <h3>Menjual Berbagai Jenis Snack, Hampers & Parcel</h3>

        <div class="col-md-8 offset-md-2">
            <form method="get" action="produk.php">
                <div class="input-group input-group-lg my-4">
                    <input type="text" class="form-control" placeholder="Nama Produk" name="keyword">
                    <button type="submit" class="btn warna11 text-white">Telusuri</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- kategori -->
<div class="container-fluid py-5">
    <div class="container text-center">
        <h3>Kategori Terlaris</h3>
        <div class="row mt-5">
            <div class="col-md-4 mb-3">
                <div class="highlighted-kategori kategori-kue-tradisional d-flex justify-content-center align-items-center">
                    <h4 class="text-white shadow">
                        <a class="no-decoration" href="produk.php?kategori=1">Kue Tradisional</a>
                    </h4>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="highlighted-kategori kategori-parcel d-flex justify-content-center align-items-center">
                    <h4 class="text-white shadow">
                        <a class="no-decoration" href="produk.php?kategori=4">Parcel dan Hampers</a>
                    </h4>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="highlighted-kategori kategori-snack d-flex justify-content-center align-items-center">
                    <h4 class="text-white shadow">
                        <a class="no-decoration" href="produk.php?kategori=3s">Snack dan Camilan</a>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- tentang kami -->
<div class="container-fluid warna7 py-5">
    <div class="container text-center">
        <h3 class="warna8 text-white py-2">Cerita DND Binjai</h3>
        <p class="fs-5 mt-3">
                DND Binjai lahir dari ketelitian dalam memilih bahan serta
                kecintaan terhadap cita rasa tradisional yang autentik. Sejak awal,
                kami berkomitmen untuk menghadirkan kue tradisional, snack, parcel,
                dan hampers dengan kualitas terbaik melalui proses yang higienis dan 
                terjaga. Bagi kami, setiap produk bukan sekadar sajian, melainkan bentuk 
                tanggung jawab untuk memberikan rasa, kualitas, dan kepuasan yang dapat 
                dipercaya oleh pelanggan.
        </p>
    </div>
</div>

<!-- produk -->
<div class="container-fluid py-5">
    <div class="container text-center">
        <h3>Produk DND Binjai</h3>

        <div class="row mt-5">
            <?php foreach ($produk as $data) { ?>
                <div class="col-sm-6 col-md-4 mb-3">
                    <div class="card h-100 shadow">
                        <div class="image-box">
                            <img src="image/<?= htmlspecialchars($data['foto']) ?>" class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title warna-nama py-1">
                                <?= htmlspecialchars($data['nama']) ?>
                            </h4>
                            <p class="card-text text-truncate">
                                <?= htmlspecialchars($data['detail']) ?>
                            </p>
                            <p class="card-text text-harga">
                                Rp. <?= number_format($data['harga']) ?>
                            </p>
                            <a href="produk-detail.php?id=<?= $data['id'] ?>" class="btn warna11 shadow">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <a class="btn btn-outline-warning mt-4" href="produk.php">Lihat Selengkapnya</a>
    </div>
</div>

<?php require "footer.php"; ?>

<script src="bootstrap5/js/bootstrap.bundle.min.js"></script>
<script src="fontawesome/js/all.min.js"></script>
</body>
</html>
