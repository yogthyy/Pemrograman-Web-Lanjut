<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hasil CAPTCHA</title>
</head>
<body>
    <h2 align="center">Informasi Login:</h2>
    <p align="center">
    <?php
    $nama = $_POST["username"] ?? $_POST["email"] ?? '';
    $pwd = $_POST["password"] ?? '';
    // memanggil lagi session untuk dimulai
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    // mengecek apakah user menginput captcha dengan benar
    // jika captcha salah, maka akan menjalankan yang pertama
    if (!isset($_SESSION["code"]) || $_SESSION["code"] != ($_POST["kodecaptcha"] ?? '')) {
        echo "Username anda adalah <b>" . htmlspecialchars($nama) . "</b>"; echo "<br />";
        echo "Password anda adalah <b>" . htmlspecialchars($pwd) . "</b>"; echo "<br />"; echo "<br />";
        echo "Kode CAPTCHA anda salah";
    } else { // jika captcha benar, maka perintah yang bawah akan dijalankan
        echo "Username anda <b>" . htmlspecialchars($nama) . "</b>"; echo "<br />";
        echo "Password anda <b>" . htmlspecialchars($pwd) . "</b>"; echo "<br />"; echo "<br />";
        echo "Kode CAPTCHA anda benar";
    }
    ?>
    </p>
</body>
</html>
