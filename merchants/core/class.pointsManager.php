<?php

/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 19-03-2016
 * Time: 03:53 PM
 */
class pointsManager
{
    private $id;
    private $Date;
    public $ERROR;
    private $dataConn;
    function pointsManager(){
        $this->Date=date("Y-m-d H:m:s");
    }
    public function connect(){
        include 'db.php';
        $this->dataConn = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', ''.$user.'',''.$pass.'');
    }
    public function getPointSets($bId){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `points_set` WHERE `businessId` = :bId");
        $stmt->bindValue(":bId",$_SESSION["BusinessId"],PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }
    public function getPointAreas(){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `points_areas`");
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }
    public function getPointRegister(){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `points_register` WHERE `businessId` = :bId");
        $stmt->bindValue(":bId",$_SESSION["BusinessId"],PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }
    public function addPointSet($points,$for){
        $this->connect();
        $stmt = $this->dataConn->prepare("INSERT INTO `points_set`(`points`, `pointsFor`, `businessId`, `dateTime`) VALUES (:points,:pointsFor,:bId,:dateTime)");
        $stmt->bindValue(":bId",$_SESSION["BusinessId"],PDO::PARAM_STR);
        $stmt->bindValue(":points",$points,PDO::PARAM_STR);
        $stmt->bindValue(":pointsFor",$for,PDO::PARAM_STR);
        $stmt->bindValue(":dateTime",$this->Date,PDO::PARAM_STR);
        $stmt->execute();
    }
    public function updatePointSet($points,$for){
        $this->connect();
        $stmt = $this->dataConn->prepare("UPDATE `points_set` SET `points`=:points WHERE `pointsFor` = :forP AND `businessId` = :bId");
        $stmt->bindValue(":bId",$_SESSION["BusinessId"],PDO::PARAM_STR);
        $stmt->bindValue(":forP",$for,PDO::PARAM_STR);
        $stmt->bindValue(":points",$points,PDO::PARAM_STR);
        $stmt->execute();
    }
    public function addToPointsRegister($points,$businessId,$action,$user){
        //$action = 02 is points been given and 01 is points redeemed
        $this->connect();
        if($action=="01"){
            $stmt = $this->dataConn->prepare("INSERT INTO `points_register`(`points`, `businessId`, `userId`, `ACTION`, `datetime`) VALUES (:points,:bId,:user,:ACTION,:dateTime)");
            $stmt->bindValue(":bId",$businessId,PDO::PARAM_STR);
            $stmt->bindValue(":user",$user,PDO::PARAM_STR);
            $stmt->bindValue(":points",$points,PDO::PARAM_STR);
            $stmt->bindValue(":ACTION","DB",PDO::PARAM_STR);//credited
            $stmt->bindValue(":dateTime",$this->Date,PDO::PARAM_STR);
            $stmt->execute();
        }
        else if($action=="02"){
            $this->connect();
            $stmt = $this->dataConn->prepare("UPDATE `points_remaining` SET `points`= `points` - :pointsRem,`lastUpdate`= :dateTime WHERE `businessId` = :bId");
            $stmt->bindValue(":bId",$businessId,PDO::PARAM_STR);
            $stmt->bindValue(":dateTime",$this->Date,PDO::PARAM_STR);
            $stmt->bindValue(":pointsRem",$points,PDO::PARAM_STR);
            $stmt->execute();
            $stmt = $this->dataConn->prepare("INSERT INTO `points_register`(`points`, `businessId`, `userId`, `ACTION`, `datetime`) VALUES (:points,:bId,:user,:ACTION,:dateTime)");
            $stmt->bindValue(":bId",$businessId,PDO::PARAM_STR);
            $stmt->bindValue(":user",$user,PDO::PARAM_STR);
            $stmt->bindValue(":points",$points,PDO::PARAM_STR);
            $stmt->bindValue(":ACTION","CR",PDO::PARAM_STR);//credited
            $stmt->bindValue(":dateTime",$this->Date,PDO::PARAM_STR);
            $stmt->execute();
        }


    }
}