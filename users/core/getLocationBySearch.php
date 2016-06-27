<?php
include 'class.locationManager';
$dt = new locationManager($_GET["search"]);
$rdt = $dt->getLocationBySearch();
echo json_encode($rdt);
?>
