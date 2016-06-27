<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 07-03-2016
 * Time: 03:58 PM
 */
$id=$_GET["business"];
require_once 'class.businessManager.php';
$dt=new businessManager(" "," "," ");
$rdt=$dt->getFollowers($id);
echo json_encode($rdt);

?>