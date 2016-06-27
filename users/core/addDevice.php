<?php
session_start();
$_SESSION["device"]=$_POST["token"];
var_dump($_SESSION["device"]);