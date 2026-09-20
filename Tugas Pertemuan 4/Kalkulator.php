<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Sederhana</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .calculator-card {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 350px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-top: 0;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-size: 14px;
        }
        input[type="number"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #0d0d0d;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #161616;
        }
        .result-box {
            margin-top: 20px;
            padding: 15px;
            background-color: #e9ecef;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
        .error-box {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>

<div class="calculator-card">
    <h2>Kalkulator Sederhana</h2>
    
    <form method="POST" action="">
        <div class="form-group">
            <label for="angka1">Angka Pertama:</label>
            <input type="number" step="any" name="angka1" id="angka1" value="<?php echo isset($_POST['angka1']) ? htmlspecialchars($_POST['angka1']) : ''; ?>" required>
        </div>

        <div class="form-group">
            <label for="operator">Operator:</label>
            <select name="operator" id="operator" required>
                <?php
                $ops = ['+' => '+', '-' => '-', '*' => '*', '/' => '/', '%' => '%'];
                $selected_op = isset($_POST['operator']) ? $_POST['operator'] : '+';
                foreach ($ops as $key => $label) {
                    $selected = ($selected_op === $key) ? 'selected' : '';
                    echo "<option value=\"$key\" $selected>$label</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="angka2">Angka Kedua:</label>
            <input type="number" step="any" name="angka2" id="angka2" value="<?php echo isset($_POST['angka2']) ? htmlspecialchars($_POST['angka2']) : ''; ?>" required>
        </div>

        <button type="submit" name="hitung">Hitung</button>
    </form>

    <?php
    if (isset($_POST['hitung'])) {
        $angka1 = (float)$_POST['angka1'];
        $angka2 = (float)$_POST['angka2'];
        $operator = $_POST['operator'];
        $hasil = null;
        $error = null;

        switch ($operator) {
            case '+':
                $hasil = $angka1 + $angka2;
                break;
            case '-':
                $hasil = $angka1 - $angka2;
                break;
            case '*':
                $hasil = $angka1 * $angka2;
                break;
            case '/':
                if ($angka2 == 0) {
                    $error = "Kesalahan: Tidak dapat membagi dengan nol!";
                } else {
                    $hasil = $angka1 / $angka2;
                }
                break;
            case '%':
                if ($angka2 == 0) {
                    $error = "Kesalahan: Operasi modulus dengan nol tidak diperbolehkan!";
                } else {
                    $hasil = fmod($angka1, $angka2);
                }
                break;
            default:
                $error = "Operator tidak valid!";
                break;
        }

        if ($error !== null) {
            echo "<div class='result-box error-box'>$error</div>";
        } else {
            echo "<div class='result-box'>Hasil: $angka1 $operator $angka2 = " . round($hasil, 4) . "</div>";
        }
    }
    ?>
</div>

</body>
</html>