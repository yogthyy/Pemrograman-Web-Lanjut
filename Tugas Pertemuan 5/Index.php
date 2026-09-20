<?php
$hostname = "localhost";
$username = "root";
$password = "";

$koneksi = mysqli_connect($hostname, $username, $password);

if (!$koneksi) {
    die("Koneksi ke MySQL gagal: " . mysqli_connect_error());
}

$database_baru = "db_akademik";
mysqli_query($koneksi, "CREATE DATABASE IF NOT EXISTS $database_baru");
mysqli_select_db($koneksi, $database_baru);

$query_tabel = "CREATE TABLE IF NOT EXISTS mahasiswa (
    NIM INT(5) PRIMARY KEY,
    Nama VARCHAR(20) NOT NULL,
    Tugas INT(5) NOT NULL,
    UTS INT(5) NOT NULL,
    UAS INT(5) NOT NULL
)";
mysqli_query($koneksi, $query_tabel);

$cek_data = mysqli_query($koneksi, "SELECT NIM FROM mahasiswa");
if (mysqli_num_rows($cek_data) == 0) {
    $query_insert = "INSERT INTO mahasiswa (NIM, Nama, Tugas, UTS, UAS) VALUES
        (10101, 'Ahmad Habibi', 80, 85, 90),
        (10102, 'Muhamad Andi', 75, 70, 80),
        (10103, 'Citra Raisa', 90, 88, 92),
        (10104, 'Dimas Erlangga', 65, 75, 70),
        (10105, 'Putri Annisa', 85, 80, 85)";
    mysqli_query($koneksi, $query_insert);
}

$query_select = "SELECT NIM, Nama, Tugas, UTS, UAS, 
                 ROUND((Tugas + UTS + UAS) / 3, 2) AS Nilai_Akhir 
                 FROM mahasiswa";
$result = mysqli_query($koneksi, $query_select);

$total_data = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Nilai Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 24px; }
        table { border-collapse: collapse; width: 720px; margin-top: 12px; }
        th, td { border: 1px solid #bbb; padding: 8px 12px; text-align: center; }
        th { background-color: #eaeaea; }
        td:nth-child(2) { text-align: left; }
        .info { font-weight: bold; margin-bottom: 8px; }
    </style>
</head>
<body>

    <h2>Data Nilai Mahasiswa</h2>
    <div class="info">Jumlah Mahasiswa: <?= $total_data; ?></div>

    <table>
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Tugas</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>Nilai Akhir</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            while ($row = mysqli_fetch_assoc($result)) : 
            ?>
                <tr>
                    <td><?= $row['NIM']; ?></td>
                    <td><?= htmlspecialchars($row['Nama']); ?></td>
                    <td><?= $row['Tugas']; ?></td>
                    <td><?= $row['UTS']; ?></td>
                    <td><?= $row['UAS']; ?></td>
                    <td><strong><?= $row['Nilai_Akhir']; ?></strong></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>