<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 19-03-2016
 * Time: 04:51 PM
 */
$id=$_GET["business"];
include 'class.pointsManager.php';
$dt=new pointsManager();
for($i=0;$i<count($_POST["points"]);$i++)
{
    $p="point".$i;
    $rdt=$dt->updatePointSet($_GET[$p],$_GET["for"]);
}
echo true;
?>