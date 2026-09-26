<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $judul   = $_POST['judul'];
    $isi     = $_POST['isi'];
    $penulis = $_POST['penulis'];
    $tanggal = $_POST['tanggal'];

    $gambar = $_FILES['gambar']['name'];
    $sumber = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($sumber, 'uploads/' . $gambar);

    $query = "INSERT INTO berita (judul, gambar, isi, penulis, tanggal) 
              VALUES ('$judul', '$gambar', '$isi', '$penulis', '$tanggal')";
    mysqli_query($koneksi, $query);

    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Berita</title>
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
        .navbar a.active {
            color: #555555;
        }
        .container {
            max-width: 750px;
            margin: 30px auto;
            padding: 0 20px;
        }
        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #222222;
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
        input[type="file"] {
            font-size: 13px;
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
        .btn-submit:hover {
            background-color: #0069d9;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <span class="brand">Portal Berita</span>
        <a href="index.php">Home</a>
        <a href="tambah.php" class="active">Input Berita</a>
    </div>

    <div class="container">
        <h2>Input Berita</h2>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Judul Berita:</label>
                <input type="text" name="judul" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Gambar:</label>
                <input type="file" name="gambar" required>
            </div>

            <div class="form-group">
                <label>Isi Berita:</label>
                <textarea name="isi" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label>Penulis:</label>
                <input type="text" name="penulis" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Tanggal:</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>

            <button type="submit" name="submit" class="btn-submit">Submit</button>
        </form>
    </div>

</body>
</html>