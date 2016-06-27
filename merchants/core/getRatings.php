<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 07-03-2016
 * Time: 03:54 PM
 */
$id=$_GET["business"];
require_once 'class.businessManager.php';
require_once 'class.userManager.php';
$dt=new businessManager();
$rdt=$dt->getRatings($id);
    for ($i=0;$i<count($rdt);$i++){
        $um=new userManager("","","");
        $userData=$um->getUser($rdt[$i]["userId"]);
        $rdt[$i]["user"]=$userData;
    }
echo json_encode($rdt);

?>