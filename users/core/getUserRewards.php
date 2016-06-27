<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 30-03-2016
 * Time: 01:53 PM
 */
include 'class.pointsManager.php';
$dt = new pointsManager();
$rdt=$dt->getPointsByUser($_GET["userId"]);
//var_dump($rdt);
if(count($rdt)>0){
    echo json_encode($rdt);
}else
{
    echo json_encode(false);
}
?>