<?php

/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 16-03-2016
 * Time: 06:39 AM
 */
class subscriptionManager
{
    private $id;
    private $Date;
    public $ERROR;
    private $dataConn;
    function subscriptionManager($userId){
        $this->id=$userId;
        $this->Date=date("Y-m-d H:m:s");
    }
    public function connect(){
        require 'db.php';
        $this->dataConn = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', ''.$user.'',''.$pass.'');
    }
    function addSubscription($mId,$subId,$term,$stripeId){
            $this->connect();
            $stmt = $this->dataConn->prepare("INSERT INTO `subscription_purchases`(`merchantId`, `subItemId`, `stripeId`, `datetime`, `term`, `status`) VALUES ( :merchantId, :item, :stripeId, :datetime, :term, :status)");
            $stmt->bindValue(":item", $subId, PDO::PARAM_STR);
            $stmt->bindValue(":term", $term, PDO::PARAM_STR);
            $stmt->bindValue(":datetime", $this->Date, PDO::PARAM_STR);
            $stmt->bindValue(":stripeId", $stripeId, PDO::PARAM_STR);
            $stmt->bindValue(":status", "1", PDO::PARAM_STR);
            $stmt->bindValue(":merchantId", $mId, PDO::PARAM_STR);
            $stmt->execute();
        //$subData=$this->getSubscriptionData($subId);
        //$this->addPoints($subData[0]["subPrice"]);
    }
    function getSubscription($sub){
        $this->connect();
        $check=$this->getSubscriptionData($sub);
        if(count($check)>0)
        {
            $stmt = $this->dataConn->prepare("SELECT * FROM `subscription_purchases` WHERE `businessId` = :id AND `subItemId` = :sub");
            $stmt->bindValue(":id",$_SESSION["BusinessId"],PDO::PARAM_STR);
            $stmt->bindValue(":sub",$sub,PDO::PARAM_STR);
            $stmt->execute();
            $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultData;
        }
        else{

            return false;
        }
    }
    function getAllSubscription(){
        $this->connect();
            $stmt = $this->dataConn->prepare("SELECT * FROM `subscriptions`");
            $stmt->execute();
            $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultData;
    }
    function addPoints($pts)
    {
        require_once 'class.businessManager.php';
        $bm=new businessManager();
        $dt=$bm->getRemainingPoints($_SESSION["BusinessId"]);
        $this->connect();
        if (count($dt)<1)
        {
            $stmt = $this->dataConn->prepare("INSERT INTO `points_remaining`(`remainingPointsId`, `businessId`, `points`, `lastUpdate`) VALUES (:bId,:pts,:lUpdate)");
            $stmt->bindValue(":bId", $_SESSION["BusinessId"], PDO::PARAM_STR);
            $stmt->bindValue(":pts", $pts, PDO::PARAM_STR);
            $stmt->bindValue(":lUpdate", date("Y-m-d"), PDO::PARAM_STR);
            $stmt->execute();
        }else{
            $stmt = $this->dataConn->prepare("UPDATE `points_remaining` SET `points` = `points`+:pts ,`lastUpdate`= :dt WHERE `businessId`=:bId");
            $stmt->bindValue(":bId", $_SESSION["BusinessId"], PDO::PARAM_STR);
            $stmt->bindValue(":pts", $pts, PDO::PARAM_STR);
            $stmt->bindValue(":lUpdate", date("Y-m-d"), PDO::PARAM_STR);
            $stmt->execute();
        }
    }
    function getSubscriptionModels(){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `subscriptions`");
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }
    function getSubscriptionData($subId){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `subscriptions` WHERE `subId` = :sub");
        $stmt->bindValue(":sub",$subId,PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }
    function checkSubscription($subId){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `subscription_purchases` WHERE `businessId` = :sub");
        $stmt->bindValue(":sub",$subId,PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }
    function stripeInit(){

        require_once('./stripe-php-3.12.1/init.php');
        $stripe = array(
            "secret_key"      => "sk_test_XxW7nUJgv88c3FV4dWfUpNtg",
            "publishable_key" => "pk_test_QTw0opvzku52xDEXZh05jznU"
        );

        \Stripe\Stripe::setApiKey($stripe['secret_key']);
    }
    function addUserToPlan($plan,$email){

    $this->stripeInit();
// Get the credit card details submitted by the form
        $token = $_POST['stripeToken'];

        $customer = \Stripe\Customer::create(array(
                "source" => $token,
                "plan" => $plan,
                "email" => $email)
        );
        return $customer;
    }
}