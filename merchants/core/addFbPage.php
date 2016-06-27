<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 04-04-2016
 * Time: 12:16 PM
 */
session_start();
require_once 'class.businessManager.php';
$dt=new businessManager();
$rdt=$dt->addFbPage($_GET["pageId"]);
echo json_encode($rdt);