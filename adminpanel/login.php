<?php
session_start();
require "../koneksi.php";

$error = '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Admin</title>

<link rel="stylesheet" href="../bootstrap5/css/bootstrap.min.css">
<link rel="stylesheet" href="../fontawesome/css/all.min.css">
<link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="login-wrapper">
    <div class="login-card">

        <div class="login-title">Login Untuk Admin</div>
        <div class="login-head">Panel Administrator</div>

        <form method="post">
            <div class="mb-3">
                <label>Username</label>
                <input type="text"
                       name="username"
                       class="form-control"
                       required
                       autocomplete="off">
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password"
                       name="password"
                       class="form-control"
                       required>
            </div>

            <button type="submit"
                    name="loginbtn"
                    class="btn btn-login w-100">
                Login
            </button>
        </form>

        <?php if ($error): ?>
            <div class="alert alert-warning text-center mt-3">
                <?= $error; ?>
            </div>
        <?php endif; ?>

        <?php
        if (isset($_POST['loginbtn'])) {

            $username = trim($_POST['username']);
            $password = md5($_POST['password']); // MD5 tetap dipakai

            $stmt = $pdo->prepare(
                "SELECT id, username, password
                 FROM admin
                 WHERE username = :username
                 LIMIT 1"
            );
            $stmt->execute(['username' => $username]);
            $admin = $stmt->fetch();

            if ($admin) {
                if ($password === $admin['password']) {

                    $_SESSION['login'] = true;
                    $_SESSION['username'] = $admin['username'];
                    $_SESSION['admin_id'] = $admin['id'];

                    header("Location: ../adminpanel");
                    exit;

                } else {
                    $error = "Password salah";
                }
            } else {
                $error = "Akun tidak ditemukan";
            }
        }
        ?>

    </div>
</div>

<script src="../bootstrap5/js/bootstrap.bundle.min.js"></script>
</body>
</html>
