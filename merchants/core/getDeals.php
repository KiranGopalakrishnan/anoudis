<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 09-05-2016
 * Time: 10:38 PM
 */
session_start();
include 'class.businessManager.php';
$dt=new businessManager();
$rdt=$dt->getDeals($_SESSION["businessId"]);