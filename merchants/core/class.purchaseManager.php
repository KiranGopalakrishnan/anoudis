<?php

/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 11-04-2016
 * Time: 09:36 PM
 */
class purchaseManager
{
    private $Date;
    public function purchaseManager(){
        $this->Date=date("Y-m-d H:m:s");
    }
    public function connect(){
        include 'db.php';
        $this->dataConn = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', ''.$user.'',''.$pass.'');
    }
    public function add_purchase($itemId,$ItemType,$amount,$purchaseBy,$bId){
        $this->connect();
        $stmt = $this->dataConn->prepare("INSERT INTO `inbound_purchases`(purchaseItemId`, `itemType`,  `amount`, `purchaseBy`, `businessId`, `datetime`, `status`) VALUES (:purchaseItemId,:itemType,:amount,:user,:bId,:Dt,:status)");
        $stmt->bindValue(":bId",$bId,PDO::PARAM_STR);
        $stmt->bindValue(":Dt",$this->Date,PDO::PARAM_STR);
        $stmt->bindValue(":itemType",$ItemType,PDO::PARAM_STR);
        $stmt->bindValue(":user",$purchaseBy,PDO::PARAM_STR);
        $stmt->bindValue(":amount",$amount,PDO::PARAM_STR);
        $stmt->bindValue(":purchaseItemId",$itemId,PDO::PARAM_STR);
        $stmt->bindValue(":status","1",PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }
}