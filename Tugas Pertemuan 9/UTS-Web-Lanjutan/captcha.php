<?php
// Inisialisasi session jika belum aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Fungsi untuk mengacak string captcha sesuai materi
if (!function_exists('acakCaptcha')) {
    function acakCaptcha() {
        $alphabet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        // untuk menyatakan $pass sebagai array
        $pass = array();

        // masukkan -2 dalam string length
        $panjangAlpha = strlen($alphabet) - 2;
        for ($i = 0; $i < 6; $i++) {
            $n = rand(0, $panjangAlpha);
            $pass[] = $alphabet[$n];
        }

        // ubah array menjadi string
        return implode($pass);
    }
}

// untuk mengacak captcha
$code = acakCaptcha();
$_SESSION["code"] = $code;

// Bersihkan output buffer jika ada
if (ob_get_level() > 0) {
    ob_clean();
}

// Anti-cache headers
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

// Periksa apakah GD library aktif
if (function_exists('imagecreatetruecolor')) {
    // lebar dan tinggi captcha
    $wh = imagecreatetruecolor(173, 50);

    // background color biru (RGB: 22, 86, 165)
    $bgc = imagecolorallocate($wh, 22, 86, 165);

    // text color abu-abu (RGB: 223, 230, 233)
    $fc = imagecolorallocate($wh, 223, 230, 233);

    imagefill($wh, 0, 0, $bgc);

    // ( $image , $fontsize , $string , $fontcolor )
    imagestring($wh, 10, 50, 15, $code, $fc);

    // buat gambar
    header('content-type: image/jpg');
    imagejpeg($wh);
    imagedestroy($wh);
    exit;
} else {
    // Fallback jika GD belum aktif di server
    header('content-type: image/svg+xml');
    echo '<svg xmlns="http://www.w3.org/2000/svg" width="173" height="50" viewBox="0 0 173 50">';
    echo '<rect width="100%" height="100%" fill="rgb(22, 86, 165)"/>';
    echo '<text x="50%" y="55%" font-family="monospace, Courier" font-size="20" font-weight="bold" fill="rgb(223, 230, 233)" letter-spacing="4" text-anchor="middle" dominant-baseline="middle">' . htmlspecialchars($code) . '</text>';
    echo '</svg>';
    exit;
}
