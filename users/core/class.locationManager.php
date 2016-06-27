<?php

/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 28-03-2016
 * Time: 08:17 PM
 */
class locationManager
{
    private $Latitude;
    private $Longitude;
    public $dataConn;
    public function locationManager($lat,$long){
        $this->Latitude=$lat;
        $this->Longitude=$long;
    }
    public function connect(){
        include 'db.php';
        $this->dataConn = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', ''.$user.'',''.$pass.'');
    }
    public function getNearestStores($dist){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT *, ( 6371 * acos( cos( radians(:lat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( latitude ) ) ) ) AS distance FROM business HAVING distance < :dist");
        $stmt->bindValue(":lng",$this->Longitude,PDO::PARAM_STR);
        $stmt->bindValue(":lat",$this->Latitude,PDO::PARAM_STR);
        $stmt->bindValue(":dist",$dist,PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }

}