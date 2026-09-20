<?php
echo "<h3>Operator Increment & Decrement</h3>";
// Pre-Increment
$a = 5;
echo "Nilai awal a = $a <br>";
echo "Nilai saat ++\$a dievaluasi: " . (++$a) . "<br>";
echo "Nilai akhir a: $a <br><br>";
// Post-Increment
$b = 5;
echo "Nilai awal b = $b <br>";
echo "Nilai saat \$b++ dievaluasi: " . ($b++) . "<br>";
echo "Nilai akhir b: $b <br><br>";
// Pre-Decrement
$c = 5;
echo "Nilai awal c = $c <br>";
echo "Nilai saat --\$c dievaluasi: " . (--$c) . "<br>";
echo "Nilai akhir c: $c <br><br>";
// Post-Decrement
$d = 5;
echo "Nilai awal d = $d <br>";
echo "Nilai saat \$d-- dievaluasi: " . ($d--) . "<br>";
echo "Nilai akhir d: $d <br>";
?>