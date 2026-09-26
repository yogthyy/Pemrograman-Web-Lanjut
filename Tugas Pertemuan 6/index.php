<?php
include 'koneksi.php';

$query = "SELECT * FROM berita ORDER BY id DESC";
$hasil = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Portal Berita - Home</title>
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
            color: #000000;
            font-weight: bold;
        }
        .container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 0 20px;
        }
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .btn-add {
            background-color: #007bff;
            color: #ffffff;
            padding: 8px 14px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 10px 12px;
            text-align: left;
            vertical-align: middle;
        }
        th {
            background-color: #f7f7f7;
        }
        .img-thumb {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 3px;
        }
        .btn-action {
            display: inline-block;
            padding: 5px 10px;
            font-size: 12px;
            border-radius: 3px;
            text-decoration: none;
            margin-right: 4px;
        }
        .btn-edit {
            background-color: #ffc107;
            color: #000000;
        }
        .btn-delete {
            background-color: #dc3545;
            color: #ffffff;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <span class="brand">Portal Berita</span>
        <a href="index.php" class="active">Home</a>
        <a href="tambah.php">Input Berita</a>
    </div>

    <div class="container">
        <div class="header-section">
            <h2>Daftar Berita</h2>
            <a href="tambah.php" class="btn-add">+ Tambah Berita</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width: 40px; text-align: center;">No</th>
                    <th style="width: 100px; text-align: center;">Gambar</th>
                    <th>Judul</th>
                    <th>Isi Berita</th>
                    <th>Penulis</th>
                    <th style="width: 110px; text-align: center;">Tanggal</th>
                    <th style="width: 130px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1; 
                while ($row = mysqli_fetch_assoc($hasil)) { 
                ?>
                    <tr>
                        <td style="text-align: center;"><?= $no++; ?></td>
                        <td style="text-align: center;">
                            <img src="uploads/<?= $row['gambar']; ?>" class="img-thumb" alt="Gambar">
                        </td>
                        <td><strong><?= $row['judul']; ?></strong></td>
                        <td><?= substr($row['isi'], 0, 100); ?>...</td>
                        <td><?= $row['penulis']; ?></td>
                        <td style="text-align: center;"><?= $row['tanggal']; ?></td>
                        <td style="text-align: center;">
                            <a href="edit.php?id=<?= $row['id']; ?>" class="btn-action btn-edit">Edit</a>
                            <a href="hapus.php?id=<?= $row['id']; ?>" class="btn-action btn-delete" onclick="return confirm('Hapus berita ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>