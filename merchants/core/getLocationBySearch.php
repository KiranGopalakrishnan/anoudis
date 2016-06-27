<?php
require_once 'class.locationManager';
$dt = new locationManager($_GET["search"]);
$rdt = $dt->getLocationBySearch();
echo json_encode($rdt);
?>
