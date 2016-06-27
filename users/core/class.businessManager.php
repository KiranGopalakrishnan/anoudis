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
        include 'db.php';
        $this->dataConn = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', ''.$user.'',''.$pass.'');
    }
    function initiateBusiness($id){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `business` WHERE MerchantId` = :userId");
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
        $stmt = $this->dataConn->prepare("INSERT INTO `business` (`businessName`, `businessCategory`, `businessStreet`, `businessCityId`, `businessProvinceId`, `businessPostalcode`, `businessBuildingNumber`, `Description`, `dateTime`, `status`, `MerchantId`) VALUES (:name, :category, :street, :city, :province, :postalcode,:bNumber, :desc,:dateTime, :status,:merchantId)");
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
        $stmt = $this->dataConn->prepare("INSERT INTO `follows` (`followedWho`, `followedBy`, `dateTime`) VALUES (:business,:user,:date);");
        $stmt->bindValue(":user",$_SESSION["user"],PDO::PARAM_STR);
        $stmt->bindValue(":business",$id,PDO::PARAM_STR);
        $stmt->bindValue(":date",$this->Date,PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return true;
    }
    function addReviews($id){
        $this->connect();
        $stmt = $this->dataConn->prepare("INSERT INTO `follows` (`followedWho`, `followedBy`, `dateTime`) VALUES (:business,:user,:date);");
        $stmt->bindValue(":user",$_SESSION["user"],PDO::PARAM_STR);
        $stmt->bindValue(":business",$id,PDO::PARAM_STR);
        $stmt->bindValue(":date",$this->Date,PDO::PARAM_STR);
        $stmt->execute();
        return true;
    }
    function checkIn($id,$user){
       
            $this->connect();
            $stmt = $this->dataConn->prepare("INSERT INTO `checkin` (`checkinFrom`, `checkinTo`, `dateTime`) VALUES (:user,:business,:date)");
            $stmt->bindValue(":user",$user,PDO::PARAM_STR);
            $stmt->bindValue(":business",$id,PDO::PARAM_STR);
            $stmt->bindValue(":date",$this->Date,PDO::PARAM_STR);
            $stmt->execute();
            return true;
    }
    function addCustomer($bId,$userId){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `customers` WHERE `userId` = :userId AND `businessId` = :businessId");
        $stmt->bindValue(":userId",$userId,PDO::PARAM_STR);
        $stmt->bindValue(":businessId",$bId,PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(!count($resultData)>0) {
            $stmt = $this->dataConn->prepare("INSERT INTO `customers`(`userId`, `businessId`, `dateTime`) VALUES (:userId,:businessId,:date)");
            $stmt->bindValue(":userId", $userId, PDO::PARAM_STR);
            $stmt->bindValue(":businessId", $bId, PDO::PARAM_STR);
            $stmt->bindValue(":date", $this->Date, PDO::PARAM_STR);
            $stmt->execute();
            return true;
        }else{
            return false;
        }
    }
    function getHotDeals(){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `deals` WHERE `ValidTill` > :date");
        $stmt->bindValue(":date",$this->Date,PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }
}
?>