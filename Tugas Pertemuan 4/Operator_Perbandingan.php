<?php
echo "<h3>Operator Pembandingan</h3>";

$a = 10;
$b = "10";
$c = 20;

echo "a = 10 (integer), b = '10' (string), c = 20 (integer)<br><br>";

echo "a == b (Sama secara nilai)        : " . ($a == $b ? 'TRUE' : 'FALSE') . "<br>";
echo "a === b (Identik nilai & tipe data): " . ($a === $b ? 'TRUE' : 'FALSE') . "<br>";
echo "a != c (Tidak sama)               : " . ($a != $c ? 'TRUE' : 'FALSE') . "<br>";
echo "a !== b (Tidak identik)           : " . ($a !== $b ? 'TRUE' : 'FALSE') . "<br>";
echo "a < c (Lebih kecil)               : " . ($a < $c ? 'TRUE' : 'FALSE') . "<br>";
echo "a > c (Lebih besar)               : " . ($a > $c ? 'TRUE' : 'FALSE') . "<br>";
echo "a <= 10 (Lebih kecil atau sama)      : " . ($a <= 10 ? 'TRUE' : 'FALSE') . "<br>";
echo "a >= 15 (Lebih besar atau sama)      : " . ($a >= 15 ? 'TRUE' : 'FALSE') . "<br>";
?>