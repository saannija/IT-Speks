<?php
$vac_SQL = "SELECT COUNT(*) as total FROM it_speks_vakances WHERE Izdzests = 0";
$result = mysqli_query($savienojums, $vac_SQL);

$news_SQL = "SELECT COUNT(*) as total FROM it_speks_jaunumi WHERE Izdzests = 0";
$result = mysqli_query($savienojums, $news_SQL);

$rinda = mysqli_fetch_array($result);
$visas_rindas = $rinda['total'];

$rindas_lapa = 5;

$visas_lapas = ceil($visas_rindas / $rindas_lapa);

$sobrideja_lapa = isset($_GET['lapa']) ? (int)$_GET['lapa'] : 1;
if ($sobrideja_lapa < 1) {
    $sobrideja_lapa = 1;
} elseif ($sobrideja_lapa > $visas_lapas) {
    $sobrideja_lapa = $visas_lapas;
}

$offset = ($sobrideja_lapa - 1) * $rindas_lapa;

?>