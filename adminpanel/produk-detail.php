<?php
require "session.php";
require "../koneksi.php"; // koneksi PDO, variabel: $pdo

$id = $_GET['p'] ?? null;
if (!$id) {
    header("Location: produk.php");
    exit;
}

/* ================= AMBIL DATA PRODUK ================= */
$stmt = $pdo->prepare("
    SELECT p.*, k.nama AS nama_kategori
    FROM produk p
    JOIN kategori k ON p.kategori_id = k.id
    WHERE p.id = ?
");
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    header("Location: produk.php");
    exit;
}

/* ================= KATEGORI LAIN ================= */
$stmtKategori = $pdo->prepare("
    SELECT * FROM kategori WHERE id != ?
");
$stmtKategori->execute([$data['kategori_id']]);

function generateRandomString($length = 20){
    return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Detail Produk</title>

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
<li class="breadcrumb-item"><a href="produk.php">Produk</a></li>
<li class="breadcrumb-item active">Detail</li>
</ol>
</nav>

<div class="card-custom col-lg-8 mb-5">
<h3 class="mb-4">Detail Produk</h3>

<form method="post" enctype="multipart/form-data">

<div class="mb-3">
<label>Nama</label>
<input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama']); ?>" required>
</div>

<div class="mb-3">
<label>Kategori</label>
<select name="kategori" class="form-control">
<option value="<?= $data['kategori_id']; ?>">
<?= htmlspecialchars($data['nama_kategori']); ?>
</option>
<?php while($k = $stmtKategori->fetch(PDO::FETCH_ASSOC)) { ?>
<option value="<?= $k['id']; ?>"><?= htmlspecialchars($k['nama']); ?></option>
<?php } ?>
</select>
</div>

<div class="mb-3">
<label>Harga</label>
<input type="number" name="harga" class="form-control" value="<?= $data['harga']; ?>" required>
</div>

<div class="row mb-4">
<div class="col-md-6">
<label>Foto Saat Ini</label><br>
<img src="../image/<?= $data['foto']; ?>" class="preview">
</div>
<div class="col-md-6">
<label>Ganti Foto</label>
<input type="file" name="foto" class="form-control">
</div>
</div>

<div class="mb-3">
<label>Detail</label>
<textarea name="detail" class="form-control" rows="6"><?= htmlspecialchars($data['detail']); ?></textarea>
</div>

<div class="mb-4">
<label>Ketersediaan</label>
<select name="ketersediaan_stok" class="form-control">
<option value="<?= $data['ketersediaan_stok']; ?>">
<?= ucfirst($data['ketersediaan_stok']); ?>
</option>
<option value="<?= $data['ketersediaan_stok']=='tersedia'?'habis':'tersedia'; ?>">
<?= $data['ketersediaan_stok']=='tersedia'?'Habis':'Tersedia'; ?>
</option>
</select>
</div>

<div class="d-flex justify-content-between">
<button type="submit" name="simpan" class="btn btn-simpan">Simpan</button>
<button type="submit" name="hapus" class="btn btn-hapus"
onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
</div>
</form>

<?php
/* ================= UPDATE ================= */
if(isset($_POST['simpan'])){
    $stmt = $pdo->prepare("
        UPDATE produk SET
        kategori_id = ?,
        nama = ?,
        harga = ?,
        detail = ?,
        ketersediaan_stok = ?
        WHERE id = ?
    ");
    $stmt->execute([
        $_POST['kategori'],
        $_POST['nama'],
        $_POST['harga'],
        $_POST['detail'],
        $_POST['ketersediaan_stok'],
        $id
    ]);

    if(!empty($_FILES['foto']['name'])){
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $newName = generateRandomString().".".$ext;
        move_uploaded_file($_FILES['foto']['tmp_name'], "../image/".$newName);

        $stmtFoto = $pdo->prepare("UPDATE produk SET foto=? WHERE id=?");
        $stmtFoto->execute([$newName, $id]);
    }

    echo "<meta http-equiv='refresh' content='1;url=produk.php'>";
}

/* ================= DELETE ================= */
if(isset($_POST['hapus'])){
    $stmt = $pdo->prepare("DELETE FROM produk WHERE id=?");
    $stmt->execute([$id]);
    echo "<meta http-equiv='refresh' content='1;url=produk.php'>";
}
?>

</div>
</div>

<?php require "footer.php"; ?>
</body>
</html>
