<!-- FOR -->
<?php for ($i = 1; $i <= 5; $i++) { echo "Angka ke-$i <br>"; } ?>

<!-- WHILE -->
<?php
$x = 1;
while ($x <= 5) {
    echo "Angka $x <br>";
    $x++;
}
?>
<!-- foreach (untuk array) -->
<?php
$buah = ["Apel", "Jeruk", "Mangga"];
foreach ($buah as $b) {
    echo "Buah: $b <br>";
}
?>