<?php
require "session.php";
require "../koneksi.php"; // PDO: $pdo

/* ================= AMBIL DATA ================= */
$stmtProduk = $pdo->query("
    SELECT p.*, k.nama AS nama_kategori
    FROM produk p
    JOIN kategori k ON p.kategori_id = k.id
");
$produk = $stmtProduk->fetchAll(PDO::FETCH_ASSOC);

$stmtKategori = $pdo->query("SELECT * FROM kategori");

function generateRandomString($length = 20){
    return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Produk</title>

<link rel="stylesheet" href="../bootstrap5/css/bootstrap.min.css">
<link rel="stylesheet" href="../fontawesome/css/all.min.css">
<link rel="stylesheet" href="../css/style.css">
</head>

<body>

<?php require "navbar.php"; ?>

<div class="container mt-5">

<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="../adminpanel">Home</a></li>
<li class="breadcrumb-item active">Produk</li>
</ol>
</nav>

<!-- ================= TAMBAH PRODUK ================= -->
<div class="card-custom col-lg-7 mb-5">
<h3 class="mb-4">Tambah Produk</h3>

<form method="post" enctype="multipart/form-data">
<div class="mb-3">
<label>Nama</label>
<input type="text" name="nama" class="form-control" required>
</div>

<div class="mb-3">
<label>Kategori</label>
<select name="kategori" class="form-control" required>
<option value="">Pilih satu</option>
<?php while($k = $stmtKategori->fetch(PDO::FETCH_ASSOC)){ ?>
<option value="<?= $k['id']; ?>"><?= htmlspecialchars($k['nama']); ?></option>
<?php } ?>
</select>
</div>

<div class="mb-3">
<label>Harga</label>
<input type="number" name="harga" class="form-control" required>
</div>

<div class="mb-3">
<label>Foto</label>
<input type="file" name="foto" class="form-control">
</div>

<div class="mb-3">
<label>Detail</label>
<textarea name="detail" class="form-control"></textarea>
</div>

<div class="mb-4">
<label>Ketersediaan</label>
<select name="ketersediaan_stok" class="form-control">
<option value="tersedia">Tersedia</option>
<option value="habis">Habis</option>
</select>
</div>

<button type="submit" name="simpan_produk" class="btn btn-simpan">Simpan</button>
</form>

<?php
/* ================= INSERT ================= */
if(isset($_POST['simpan_produk'])){
    $foto = null;

    if(!empty($_FILES['foto']['name'])){
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $foto = generateRandomString().".".$ext;
        move_uploaded_file($_FILES['foto']['tmp_name'], "../image/".$foto);
    }

    $stmt = $pdo->prepare("
        INSERT INTO produk
        (kategori_id, nama, harga, foto, detail, ketersediaan_stok)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $_POST['kategori'],
        $_POST['nama'],
        $_POST['harga'],
        $foto,
        $_POST['detail'],
        $_POST['ketersediaan_stok']
    ]);

    echo "<meta http-equiv='refresh' content='1;url=produk.php'>";
}
?>
</div>

<!-- ================= LIST PRODUK ================= -->
<div class="card-custom">
<h3 class="mb-4">List Produk</h3>

<div class="table-responsive">
<table class="table table-bordered align-middle">
<thead>
<tr>
<th>No</th>
<th>Nama</th>
<th>Kategori</th>
<th>Harga</th>
<th>Stok</th>
<th>Action</th>
</tr>
</thead>
<tbody>

<?php if(count($produk) == 0){ ?>
<tr>
<td colspan="6" class="text-center">Data produk kosong</td>
</tr>
<?php } else {
$no = 1;
foreach($produk as $p){ ?>
<tr>
<td class="text-center"><?= $no++; ?></td>
<td><?= htmlspecialchars($p['nama']); ?></td>
<td><?= htmlspecialchars($p['nama_kategori']); ?></td>
<td><?= $p['harga']; ?></td>
<td><?= ucfirst($p['ketersediaan_stok']); ?></td>
<td class="text-center">
<a href="produk-detail.php?p=<?= $p['id']; ?>" class="btn btn-action">
<i class="fas fa-search"></i>
</a>
</td>
</tr>
<?php }} ?>

</tbody>
</table>
</div>
</div>

</div>

<?php require "footer.php"; ?>
</body>
</html>
