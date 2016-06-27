<?php
session_start();
//$id=$_GET["business"];
require_once 'class.businessManager.php';
    $dt=new businessManager(" "," "," ");
    $rdt=$dt->getCheckin("12");
    echo json_encode($rdt);
 ?>