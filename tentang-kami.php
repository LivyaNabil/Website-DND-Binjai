<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DND-Binjai | Tentang Kami</title>

<link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css">
<link rel="stylesheet" href="fontawesome/css/all.min.css">
<link rel="stylesheet" href="css/style.css">


</head>

<body>

<?php require "navbar.php"; ?>

<!-- ===== BANNER (TETAP PUNYA KAMU) ===== -->
<div class="container-fluid banner-about d-flex align-items-center">
    <div class="container text-white text-center">
        <h1>Tentang Kami</h1>
        <div class="divider mt-3">━━━━━━━━━━━━━━</div>
    </div>
</div>

<!-- ===== ISI TENTANG KAMI (BARU & RAPI) ===== -->
<div class="about-page py-5">
    <div class="container">

        <div class="about-card mb-5">
            <h3 class="about-title text-center mb-4">DND Binjai</h3>

            <p class="fs-5 text-center">
                DND Binjai merupakan usaha yang bergerak di bidang penjualan
                <strong>kue tradisional, snack, parcel, dan hampers</strong>
                dengan cita rasa khas yang tetap terjaga.
            </p>

            <p class="fs-5 text-center">
                Kami menggunakan bahan pilihan dan proses yang higienis
                untuk memastikan setiap produk memiliki kualitas terbaik
                dan layak dinikmati di setiap momen spesial.
            </p>

            <p class="fs-5 text-center mb-0">
                Bagi kami, kepuasan pelanggan bukan sekadar tujuan,
                tetapi komitmen yang terus kami jaga.
            </p>
        </div>

        <!-- VALUE SECTION -->
        <div class="row g-4">
            <div class="col-md-4">
                <div class="value-box">
                    <i class="fa-solid fa-cookie-bite"></i>
                    <h5 class="fw-bold mt-2">Tradisional</h5>
                    <p class="mb-0">Rasa autentik khas Nusantara.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="value-box">
                    <i class="fa-solid fa-star"></i>
                    <h5 class="fw-bold mt-2">Berkualitas</h5>
                    <p class="mb-0">Bahan pilihan & proses higienis.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="value-box">
                    <i class="fa-solid fa-handshake"></i>
                    <h5 class="fw-bold mt-2">Terpercaya</h5>
                    <p class="mb-0">Mengutamakan kepuasan pelanggan.</p>
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