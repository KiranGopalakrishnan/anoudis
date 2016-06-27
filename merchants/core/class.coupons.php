<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class
 *
 * @author Kiran
 */
class coupons {
    private $couponName;
    private $couponPrice;
    private $couponActualPrice;
    private $couponDiscount;
    private $couponCampaign;
    private $couponCounty;
    private $couponDescription;
    private $couponValidFrom;
    private $couponValidTill;
    private $today;
    private $dataConn;
    private $dataTable;
    public $resultData;
    function coupons(){
        $this->today=  date("Y-m-d H:m:s");
    }
    public function connect(){
        include 'db.php';
        $this->dataConn = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', ''.$user.'',''.$pass.'');   
    }
    
    
    public function createDeal(){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `deals` WHERE `ValidFrom` < :today AND `ValidTill` > :today ORDER BY `ValidTill` ASC");
        $stmt->bindValue(":today",$this->today,PDO::PARAM_STR);
	$stmt->execute();
        $this->resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->resultData;
    }
    
    public function retrieveCoupons(){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `deals` WHERE `ValidFrom` < :today AND `ValidTill` > :today ORDER BY `ValidTill` ASC");
        $stmt->bindValue(":today",$this->today,PDO::PARAM_STR);
	$stmt->execute();
        $this->resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->resultData;
    }
    public function getPurchaseCount($id){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `purchases` WHERE `DealId` = :DealId");
        $stmt->bindValue(":DealId",$id,PDO::PARAM_STR);
	$stmt->execute();
        $this->resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->resultData;
    }
    public function retrieveMainDeal(){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `deals` WHERE `Status`= :status AND `ValidFrom` < :today AND `ValidTill` > :today");
        $stmt->bindValue(":today",$this->today,PDO::PARAM_STR);
        $stmt->bindValue(":status","6",PDO::PARAM_STR);
	$stmt->execute();
        $this->resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->resultData;
    }
    public function retrieveCouponsFromSearch($search){
        echo $search;
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `deals` WHERE `ValidFrom` < :today AND `ValidTill` > :today AND 'Description' LIKE :search OR 'dealName' LIKE :search");
        $stmt->bindValue(":today",$this->today,PDO::PARAM_STR);
        $stmt->bindValue(":search","%".$search."%",PDO::PARAM_STR);
        $stmt->execute();
	$this->resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->resultData;
    }
    public function retrieveOnInterests($userId){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `deals` WHERE `DealId` IN(SELECT `dealId` FROM `dealtags` WHERE `tagId` IN (SELECT `interestId` FROM `userinterests` WHERE `userId` = :userId)) AND (`ValidFrom` < :today AND `ValidTill` > :today) ORDER BY `ValidTill` ASC");
        $stmt->bindValue(":userId",$userId,PDO::PARAM_STR);
        $stmt->bindValue(":today",$this->today,PDO::PARAM_STR);
        
        $stmt->execute();
	$this->resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($this->resultData);
        return $this->resultData;
    }
     public function retrieveSimilarDeals($DealId){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `deals` WHERE `DealId` IN(SELECT `dealId` FROM `dealtags` WHERE `tagId` IN (SELECT `tagId` FROM `dealtags` WHERE `DealId` = :DealId)) AND (`ValidFrom` < :today AND `ValidTill` > :today) ORDER BY `ValidTill` ASC");
        $stmt->bindValue(":DealId",$DealId,PDO::PARAM_STR);
        $stmt->bindValue(":today",$this->today,PDO::PARAM_STR);
        
        $stmt->execute();
	$this->resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($this->resultData);
        return $this->resultData;
    }
    public function retrieveTags($id){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `tags` WHERE tagId IN ( SELECT `tagId` FROM `dealtags` WHERE `dealId` = ':dealId')");
        $stmt->bindValue(":DealId",$id,PDO::PARAM_STR);
        $stmt->execute();
	$this->resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->resultData;
    }
    public function getAvailableTags($search){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `tags` WHERE tagName LIKE :search");
        $stmt->bindValue(":search","%".$search."%",PDO::PARAM_STR);
        $stmt->execute();
	$this->resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->resultData;
    }
    public function fetchDeal($id){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `deals` WHERE DealId = :DealId");
        $stmt->bindValue(":DealId",$id,PDO::PARAM_STR);
        $stmt->execute();
	$this->resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->resultData;
    }
    public function fetchProfileInterests($id){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `tags` WHERE tagId IN ( SELECT `interestId` FROM `userinterests` WHERE `userId` = :userId)");
        $stmt->bindValue(":userId",$id,PDO::PARAM_STR);
        $stmt->execute();
	$this->resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->resultData;
    }
    public function retrieveLastMinuteDeals(){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `deals` WHERE `Status`= :status AND `ValidFrom` < :today AND `ValidTill` > :today");
        $stmt->bindValue(":today",$this->today,PDO::PARAM_STR);
        $stmt->bindValue(":status","3",PDO::PARAM_STR);
	$stmt->execute();
        $this->resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->resultData;
    }
    public function retrieveFeaturedDeals(){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `deals` WHERE `Status`= :status AND `ValidFrom` < :today AND `ValidTill` > :today");
        $stmt->bindValue(":today",$this->today,PDO::PARAM_STR);
        $stmt->bindValue(":status","4",PDO::PARAM_STR);
	$stmt->execute();
        $this->resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->resultData;
    }
    public function retrieveNewDeals(){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `deals` WHERE `Status`= :status AND `ValidFrom` < :today AND `ValidTill` > :today");
        $stmt->bindValue(":today",$this->today,PDO::PARAM_STR);
        $stmt->bindValue(":status","2",PDO::PARAM_STR);
	$stmt->execute();
        $this->resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->resultData;
    }
    
    public function retrieveOrdinaryDeals(){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `deals` WHERE `Status`= :status AND `ValidFrom` < :today AND `ValidTill` > :today");
        $stmt->bindValue(":today",$this->today,PDO::PARAM_STR);
        $stmt->bindValue(":status","1",PDO::PARAM_STR);
	$stmt->execute();
        $this->resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->resultData;
    }
    public function getAvailableLocation(){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `location` WHERE `Status`= :status AND `ValidFrom` < :today AND `ValidTill` > :today");
        $stmt->bindValue(":today",$this->today,PDO::PARAM_STR);
        $stmt->bindValue(":status","1",PDO::PARAM_STR);
	$stmt->execute();
        $this->resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->resultData;
    }
    public function getCategory($catId){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `categories` WHERE `categoryId`= :catId");
        $stmt->bindValue(":catId",$catId,PDO::PARAM_STR);
	$stmt->execute();
        $this->resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->resultData;
    }
     public function getCategories(){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `categories`");
	$stmt->execute();
        $this->resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->resultData;
    }
    
    
}
?>
