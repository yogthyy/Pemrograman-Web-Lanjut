<?php
$pesan = "";
$status = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $usernameBenar = "Muhamad Yogi Iswara";
    $passwordBenar = "2507411088";

    $user = isset($_POST['username']) ? trim($_POST['username']) : '';
    $pass = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Validasi menggunakan operator identik dan operator logika
    if ($user === $usernameBenar && $pass === $passwordBenar) {
        $pesan = "Selamat datang Admin";
        $status = "sukses";
    } else {
        $pesan = "Login gagal";
        $status = "gagal";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <style>
        body { font-family: sans-serif; margin-top: 50px; }
        .login-box { border: 1px solid #ccc; padding: 20px; width: 300px; margin: auto; }
        .input-group { margin-bottom: 15px; }
        .input-group label { display: block; margin-bottom: 5px; }
        .input-group input { width: 90%; padding: 5px; }
        .pesan {
            margin-top: 15px;
            text-align: center;
            font-weight: bold;
            font-size: 14px;
        }
        .pesan-sukses { color: green; }
        .pesan-gagal { color: red; }
    </style>
</head>
<body>

    <div class="login-box">
        <center><h2>LOGIN</h2></center>
        
        <!-- Form mengirim data ke file ini sendiri via method POST -->
        <form method="POST" action="">
            <div class="input-group">
                <label>Username:</label>
                <input type="text" name="username" placeholder="Masukkan Username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required>
            </div>
            <div class="input-group">
                <label>Password:</label>
                <input type="password" name="password" placeholder="Masukkan Password" required>
            </div>
            <center><button type="submit" name="login">Masuk</button></center>
        </form>

        <?php if (!empty($pesan)): ?>
            <div class="pesan <?php echo ($status === 'sukses') ? 'pesan-sukses' : 'pesan-gagal'; ?>">
                <?php echo $pesan; ?>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>