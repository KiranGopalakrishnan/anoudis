<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 07-03-2016
 * Time: 01:03 PM
 */
class businessManager{
    private $businessId;
    private $dataConn;
    private $error;
    private $Date;
    function businessManager(){
        $this->Date=date("Y-m-d H:m:s");
    }
    public function connect(){
        require 'db.php';
        $this->dataConn = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', ''.$user.'',''.$pass.'');
    }
    function initiateBusiness($id){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `business` WHERE `MerchantId` = :userId");
        $stmt->bindValue(":userId",$id,PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($resultData)<1)
        {
            return false;
        }else{
            $_SESSION["BusinessId"] = $resultData[0]["businessId"];
            return true;
        }
    }
    function getAllBusiness($id){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `business` WHERE `MerchantId` = :userId");
        $stmt->bindValue(":userId",$id,PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($resultData)<1)
        {
            $this->error="Business Does Not Exist !";
            return $this->error;
        }else{
            $data="";
            $tempData="";
            $index="";
            if(isset($_SESSION["BusinessId"])){
                for($i=0;$i<count($resultData);$i++){
                        if($resultData[$i]["businessId"]==$_SESSION["BusinessId"]){
                            $data=$resultData[$i];
                            $tempData=$resultData[0];
                            $resultData[0]=$data;
                            $resultData[$i]=$tempData;
                        }
                }

            }
            return $resultData;
        }
    }
    function getBusiness($id){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `business` WHERE `businessId` = :userId");
        $stmt->bindValue(":userId",$id,PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($resultData)<1)
        {
            $this->error="Business Does Not Exist !";
            return $this->error;
        }else{
            return $resultData;
        }
    }

    public function addBusiness($name,$category,$bNumber,$street,$city,$province,$postalCode,$description){
        //$this->encrypt();
        $this->connect();
        $stmt = $this->dataConn->prepare("INSERT INTO `dealsvagon_fd`.`business` (`businessName`, `businessCategory`, `businessStreet`, `businessCityId`, `businessProvinceId`, `businessPostalcode`, `businessBuildingNumber`, `Description`, `dateTime`, `status`, `MerchantId`) VALUES (:name, :category, :street, :city, :province, :postalcode,:bNumber, :desc,:dateTime, :status,:merchantId)");
        $stmt->bindValue(":name",$name,PDO::PARAM_STR);
        $stmt->bindValue(":category",$category,PDO::PARAM_STR);
        $stmt->bindValue(":bNumber",$bNumber,PDO::PARAM_STR);
        $stmt->bindValue(":street",$street,PDO::PARAM_STR);
        $stmt->bindValue(":desc",$description,PDO::PARAM_STR);
        $stmt->bindValue(":city",$city,PDO::PARAM_STR);
        $stmt->bindValue(":status","1",PDO::PARAM_STR);
        $stmt->bindValue(":province",$province,PDO::PARAM_STR);
        $stmt->bindValue(":dateTime",$this->Date,PDO::PARAM_STR);
        $stmt->bindValue(":postalcode",$postalCode,PDO::PARAM_STR);
        $stmt->bindValue(":merchantId",$_SESSION["MerchantId"],PDO::PARAM_STR);
        $stmt->execute();
        $id=$this->dataConn->lastInsertId();
        $_SESSION["BusinessId"]=$id;
    }
    function getRatings($id){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `ratings` WHERE `business` = :userId");
        $stmt->bindValue(":userId",$id,PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($resultData)<1)
        {
            $this->error="Not Rated !";
            return $this->error;
        }else{
            return $resultData;
        }
    }
    function getFollowers($id){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `follows` WHERE `followedWho` = :userId");
        $stmt->bindValue(":userId",$id,PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($resultData)<1)
        {
            $this->error="No Followers !";
            return $this->error;
        }else{
            return $resultData;
        }
    }
    function checkFollowStatus($id){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `follows` WHERE `followedWho` = :business AND `followedBy` = :userId ");
        $stmt->bindValue(":business",$id,PDO::PARAM_STR);
        $stmt->bindValue(":userId",$_SESSION["user"],PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($resultData)<1)
        {
            return false;
        }else{
            return true;
        }
    }
    function addFollower($id){
        $this->connect();
        $stmt = $this->dataConn->prepare("INSERT INTO `dealsvagon_fd`.`follows` (`followedWho`, `followedBy`, `dateTime`) VALUES (:business,:user,:date);");
        $stmt->bindValue(":user",$_SESSION["user"],PDO::PARAM_STR);
        $stmt->bindValue(":business",$id,PDO::PARAM_STR);
        $stmt->bindValue(":date",$this->Date,PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return true;
    }
    function addReviews($id){
        $this->connect();
        $stmt = $this->dataConn->prepare("INSERT INTO `dealsvagon_fd`.`follows` (`followedWho`, `followedBy`, `dateTime`) VALUES (:business,:user,:date);");
        $stmt->bindValue(":user",$_SESSION["user"],PDO::PARAM_STR);
        $stmt->bindValue(":business",$id,PDO::PARAM_STR);
        $stmt->bindValue(":date",$this->Date,PDO::PARAM_STR);
        $stmt->execute();
        return true;
    }
    function checkIn(){
        $this->connect();
        $stmt = $this->dataConn->prepare("INSERT INTO `dealsvagon_fd`.`follows` (`followedWho`, `followedBy`, `dateTime`) VALUES (:business,:user,:date);");
        $stmt->bindValue(":user",$_SESSION["user"],PDO::PARAM_STR);
        $stmt->bindValue(":business",$id,PDO::PARAM_STR);
        $stmt->bindValue(":date",$this->Date,PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return true;
    }
     function getCheckin($id){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `checkin` WHERE `checkinTo` = :bId");
        $stmt->bindValue(":bId",$id,PDO::PARAM_STR);
        //$stmt->bindValue(":sts","1",PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }
    function addFbPage($id){
        $this->connect();
        $stmt = $this->dataConn->prepare("UPDATE `business` SET `pageId`=:pageId WHERE `businessId`= :bId");
        $stmt->bindValue(":pageId",$id,PDO::PARAM_STR);
        $stmt->bindValue(":bId",$_SESSION["BusinessId"],PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return true;
    }
    function checkFbPage(){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `dealsvagon_fd`.`business` WHERE `businessId`= :bId");
        $stmt->bindValue(":bId",$_SESSION["BusinessId"],PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($resultData)>0){
            if($resultData[0]["pageId"]!=""){
                return $resultData;
            }
            else{
                return false;
            }
        }else{
            return "No Data Found";
        }
    }
    function getRemainingPoints($businessId){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `points_remaining` WHERE `businessId`= :bId");
        $stmt->bindValue(":bId",$businessId,PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultData;
    }
    /*function initiateRemainingPts($pts){
        $this->connect();
        $stmt = $this->dataConn->prepare("INSERT INTO `points_remaining`(`businessId`, `points`, `lastUpdate`) VALUES (:bId,:pts,:dt)");
        $stmt->bindValue(":bId",$_SESSION["BusinessId"],PDO::PARAM_STR);
        $stmt->bindValue(":pts",$pts,PDO::PARAM_STR);
        $stmt->bindValue(":dt",$this->Date,PDO::PARAM_STR);
        $stmt->execute();
    }
    function updateRemainingPts($pts){
        $this->connect();
        $stmt = $this->dataConn->prepare("UPDATE `points_remaining` SET `points`=`points` + :pts WHERE `businessId`=:bId");
        $stmt->bindValue(":bId",$_SESSION["BusinessId"],PDO::PARAM_STR);
        $stmt->bindValue(":pts",$pts,PDO::PARAM_STR);
        $stmt->bindValue(":dt",$this->Date,PDO::PARAM_STR);
        $stmt->execute();
    }*/

    function getCustomers($bid){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT DISTINCT ON (userId) * FROM `customers` WHERE `businessId` = :bId");
        $stmt->bindValue(":bId",$bid,PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }
    function getSingleCustomers($bid){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT DISTINCT ON (userId) * FROM `customers` WHERE `businessId` = :bId");
        $stmt->bindValue(":bId",$bid,PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }
    function getDeals($bid){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `deals` WHERE `BusinessId` = :bId");
        $stmt->bindValue(":bId",$bid,PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }
    function addCustomer($bid,$user){
        $this->connect();
        $stmt = $this->dataConn->prepare("INSERT INTO `customers`( `userId`, `businessId`, `dateTime`) VALUES (:user,:bId,:dt)");
        $stmt->bindValue(":bId",$bid,PDO::PARAM_STR);
        $stmt->bindValue(":user",$user,PDO::PARAM_STR);
        $stmt->bindValue(":dt",$this->Date,PDO::PARAM_STR);
        $stmt->execute();
    }
    function addDevice($fId,$bId){
        $this->connect();
        $stmt = $this->dataConn->prepare("UPDATE `users` SET `firebaseId`=:id WHERE `UserId` = :business");
        $stmt->bindValue(":id",$fId,PDO::PARAM_STR);
        $stmt->bindValue(":business",$bId,PDO::PARAM_STR);
        $stmt->execute();
        return true;
    }
}
?>