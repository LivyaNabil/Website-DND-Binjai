<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Navbar</title>

   
     <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css">
     <link rel="stylesheet" href="css/style.css">
</head>

<body class="body">

<nav class="navbar navbar-expand-lg navbar-dark bg-coklat fixed-top ">

    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="image/LOGO_DND.png" alt="Logo" class="me-2" style="height:50px;">
            DND_Binjai
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMenu"
                aria-controls="navbarMenu"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarMenu">
            <ul class="navbar-nav mb-2 mb-lg-0">
                
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tentang-kami.php">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="produk.php">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="adminpanel">
                        <i class="fa-solid fa-right-to-bracket"></i>
                    Login</a>
                </li>
                
                
            </ul>
        </div>

    </div>
</nav>

<script src="bootstrap5/js/bootstrap.bundle.min.js"></script>
</body>
</html>
