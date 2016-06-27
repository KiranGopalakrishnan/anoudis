<?php

/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 25-04-2016
 * Time: 09:08 PM
 */
class insightManager
{
    public $Date;
    public $dataConn;
    function insightManager(){
        $this->Date=Date("Y-m-d");
    }
    public function connect(){
        require 'db.php';
        $this->dataConn = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', ''.$user.'',''.$pass.'');
    }
    function getRewardsInsights($bid,$action,$mnth){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT SUM(points) as points,MONTH(dateTime) as mnth FROM `points_register` WHERE `businessId` = :bId AND `ACTION` = :action AND MONTH(dateTime) > :mnth  GROUP BY MONTH(dateTime) ");
        $stmt->bindValue(":bId",$bid,PDO::PARAM_STR);
        $stmt->bindValue(":action",$action,PDO::PARAM_STR);
        $stmt->bindValue(":mnth",$mnth,PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }
    function getCheckinInsights($bid){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `checkin` WHERE `checkinTo` = :bId");
        $stmt->bindValue(":bId",$bid,PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }
    function getPurchaseInsights($bid,$itemType){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `inbound_purchases` WHERE `businessId` = :bId AND `itemType` = :itemType");
        $stmt->bindValue(":bId",$bid,PDO::PARAM_STR);
        $stmt->bindValue(":itemType",$itemType,PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }
    function getDashboardInsights($bid,$itemType,$week){
        $this->connect();
        if($week==1){
            $dt1=Date("Y-m-d",strtotime("-1 week"));
            $dt2=$this->Date;
        }if($week==0){
            $dt1=Date("Y-m-d",strtotime("-2 week"));
            $dt2=Date("Y-m-d",strtotime("-1 week"));
        }
        $combData="";
        $stmt = $this->dataConn->prepare("SELECT * FROM `inbound_purchases` WHERE `businessId` = :bId AND `itemType` = :itemType AND `datetime` > :dt1 AND `datetime` < :dt2 ");
        $stmt->bindValue(":bId",$bid,PDO::PARAM_STR);
        $stmt->bindValue(":dt1",$dt1,PDO::PARAM_STR);
        $stmt->bindValue(":dt2",$dt2,PDO::PARAM_STR);
        $stmt->bindValue(":itemType",$itemType,PDO::PARAM_STR);
        $stmt->execute();
        $resultData1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = $this->dataConn->prepare("SELECT * FROM `activity` WHERE `businessId` = :bId AND `activityType` = :itemType AND `datetime` > :dt1 AND `datetime` < :dt2 ");
        $stmt->bindValue(":bId",$bid,PDO::PARAM_STR);
        $stmt->bindValue(":dt1",$dt1,PDO::PARAM_STR);
        $stmt->bindValue(":dt2",$dt2,PDO::PARAM_STR);
        $stmt->bindValue(":itemType","ENG",PDO::PARAM_STR);
        $stmt->execute();
        $resultData2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = $this->dataConn->prepare("SELECT * FROM `customers` WHERE `businessId` = :bId AND `datetime` > :dt1 AND `datetime` < :dt2 ");
        $stmt->bindValue(":bId",$bid,PDO::PARAM_STR);
        $stmt->bindValue(":dt1",$dt1,PDO::PARAM_STR);
        $stmt->bindValue(":dt2",$dt2,PDO::PARAM_STR);
        $stmt->execute();
        $resultData3 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $combData["purchases"]=$resultData1;
        $combData["engagement"]=$resultData2;
        $combData["customers"]=$resultData3;
        return $combData;
    }
    function getCustomerInsights($bid){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `customers` WHERE `businessId` = :bId");
        $stmt->bindValue(":bId",$bid,PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }
    function getInsights($bid){
        $this->connect();
        $combData="";
        $oldDate="";
        $resultData="";
        for($i=1;$i<6;$i++){
            if($i==1){
                $dt1=Date("Y-m-d",strtotime("-".$i." month"));
                $dt2=Date("Y-m-d");
                $oldDate=$dt1;
            }else{
                $dt2=$oldDate;
                $dt1=Date("Y-m-d",strtotime("-".$i." month"));
                $oldDate=$dt1;
            }
            $stmt = $this->dataConn->prepare("SELECT * FROM `inbound_purchases` WHERE `businessId` = :bId  AND `datetime` > :dt1 AND `datetime` < :dt2 ");
            $stmt->bindValue(":bId",$bid,PDO::PARAM_STR);
            $stmt->bindValue(":dt1",$dt1,PDO::PARAM_STR);
            $stmt->bindValue(":dt2",$dt2,PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(count($data) < 1){
                $data=array("purchaseId"=> "0", "purchaseItemId"=> "0", "itemType" => "DEAL", "amount"=> "0", "purchaseBy" => "0","date"=> $dt2 );
            }
            //$data["date"]=$dt2;
            $resultData[$i]=$data;
        }
        return $resultData;
    }
    function getLargestAudience($bId){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT sex, TIMESTAMPDIFF( YEAR, dob, CURDATE( ) ) AS age, COUNT( * ) AS total
FROM customers
LEFT JOIN users ON users.UserId = customers.userId WHERE customers.businessId = :bId GROUP BY age, sex");
        $stmt->bindValue(":bId",$bId,PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}