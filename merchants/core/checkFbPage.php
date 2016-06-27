<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 11-04-2016
 * Time: 01:13 PM
 */
session_start();
require_once 'class.businessManager.php';
$dt=new businessManager();
$rdt=$dt->checkFbPage();
echo json_encode($rdt);