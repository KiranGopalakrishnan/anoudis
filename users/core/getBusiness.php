<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 07-03-2016
 * Time: 03:54 PM
 */
    $id=$_GET["business"];
    include 'class.businessManager.php';
    $dt=new businessManager(" "," "," ");
    $rdt=$dt->getBusiness($id);
    echo json_encode($rdt);

?>