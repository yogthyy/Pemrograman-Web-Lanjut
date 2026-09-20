<!DOCTYPE html> <!-- Muhamad Yogi Iswara,2507411088,TI 3C -->
<html>
<head>
    <title>Latihan Membuat Perkenalan Diri dengan PHP</title>
</head>
<body>

    <h2>Form Perkenalan Diri</h2>
    <form method="POST" action="">
        Nama: <input type="text" name="nama" required><br><br>
        NIM: <input type="text" name="nim" required><br><br>
        Semester: <input type="number" name="semester" required><br><br>
        Program Studi: <input type="text" name="prodi" required><br><br>
        Umur: <input type="number" name="umur" required><br><br>
        Hobi: <input type="text" name="hobi" required><br><br>
        Cita-cita: <input type="text" name="citacita" required><br><br>
        <button type="submit" name="submit">Tampilkan</button>
    </form>

    <hr>

    <?php
    if (isset($_POST['submit'])) {
        echo "<h3>Hasil Perkenalan:</h3>";
        echo "Halo, perkenalkan nama saya <b>" . ($_POST['nama']) . "</b>.<br>";
        echo "NIM saya <b>" . ($_POST['nim']) . "</b>, saat ini berada di semester <b>" . ($_POST['semester']) . "</b> program studi <b>" . ($_POST['prodi']) . "</b>.<br>";
        echo "Saya berumur <b>" . ($_POST['umur']) . "</b> tahun.<br>";
        echo "Hobi saya adalah <b>" . ($_POST['hobi']) . "</b> dan saya memiliki cita-cita menjadi seorang <b>" . ($_POST['citacita']) . "</b>.<br>";
    }
    ?>

</body>
</html>