<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 19-03-2016
 * Time: 07:39 PM
 */
include 'class.businessManager.php';
$dt=new businessManager();
$rdt=$dt->initiateBusiness($_SESSION['MerchantId']);

?>
