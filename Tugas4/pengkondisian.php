<!-- IF-ELSE -->
<?php
$nilai = 80;
if ($nilai >= 75) {
    echo "Lulus";
} else {
    echo "Tidak Lulus";
}
?>

<!-- SWITCH -->
<?php
$hari = "Senin";
 
switch ($hari) {
    case "Senin":
        echo "Hari ini Senin";
        break;
    case "Selasa":
        echo "Hari ini Selasa";
        break;
    default:
        echo "Hari tidak diketahui";
}
?>

