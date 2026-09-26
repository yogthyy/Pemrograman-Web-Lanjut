<?php
include 'koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM berita WHERE id='$id'");
$row  = mysqli_fetch_assoc($data);

if (isset($_POST['submit'])) {
    $judul   = $_POST['judul'];
    $isi     = $_POST['isi'];
    $penulis = $_POST['penulis'];
    $tanggal = $_POST['tanggal'];

    $gambar  = $_FILES['gambar']['name'];
    $sumber  = $_FILES['gambar']['tmp_name'];

    if (!empty($gambar)) {
        move_uploaded_file($sumber, 'uploads/' . $gambar);
        $query = "UPDATE berita SET 
                    judul='$judul', 
                    gambar='$gambar', 
                    isi='$isi', 
                    penulis='$penulis', 
                    tanggal='$tanggal' 
                  WHERE id='$id'";
    } else {
        $query = "UPDATE berita SET 
                    judul='$judul', 
                    isi='$isi', 
                    penulis='$penulis', 
                    tanggal='$tanggal' 
                  WHERE id='$id'";
    }

    mysqli_query($koneksi, $query);
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Berita</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }
        body {
            background-color: #ffffff;
            color: #333333;
        }
        .navbar {
            display: flex;
            align-items: center;
            padding: 12px 30px;
            border-bottom: 1px solid #e5e5e5;
            font-size: 14px;
        }
        .navbar .brand {
            color: #555555;
            font-size: 15px;
            font-weight: 500;
            margin-right: 20px;
        }
        .navbar a {
            color: #777777;
            text-decoration: none;
            margin-right: 15px;
        }
        .container {
            max-width: 750px;
            margin: 30px auto;
            padding: 0 20px;
        }
        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 18px;
        }
        .form-group label {
            display: block;
            font-size: 14px;
            margin-bottom: 6px;
        }
        .form-control {
            width: 100%;
            padding: 8px 10px;
            font-size: 14px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            outline: none;
        }
        textarea.form-control {
            resize: vertical;
            min-height: 140px;
        }
        .btn-submit {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 8px 18px;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-cancel {
            background-color: #6c757d;
            color: #ffffff;
            text-decoration: none;
            padding: 8px 16px;
            font-size: 14px;
            border-radius: 4px;
            display: inline-block;
            margin-left: 6px;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <span class="brand">Portal Berita</span>
        <a href="index.php">Home</a>
        <a href="input_berita.php">Input Berita</a>
    </div>

    <div class="container">
        <h2>Edit Berita</h2>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Judul Berita:</label>
                <input type="text" name="judul" class="form-control" value="<?= $row['judul']; ?>" required>
            </div>

            <div class="form-group">
                <label>Gambar Saat Ini:</label>
                <img src="uploads/<?= $row['gambar']; ?>" width="120" style="display:block; margin-bottom: 8px;">
                <label style="font-size: 12px; color: #666;">Pilih gambar baru jika ingin mengganti:</label>
                <input type="file" name="gambar">
            </div>

            <div class="form-group">
                <label>Isi Berita:</label>
                <textarea name="isi" class="form-control" required><?= $row['isi']; ?></textarea>
            </div>

            <div class="form-group">
                <label>Penulis:</label>
                <input type="text" name="penulis" class="form-control" value="<?= $row['penulis']; ?>" required>
            </div>

            <div class="form-group">
                <label>Tanggal:</label>
                <input type="date" name="tanggal" class="form-control" value="<?= $row['tanggal']; ?>" required>
            </div>

            <button type="submit" name="submit" class="btn-submit">Perbarui</button>
            <a href="index.php" class="btn-cancel">Batal</a>
        </form>
    </div>

</body>
</html>