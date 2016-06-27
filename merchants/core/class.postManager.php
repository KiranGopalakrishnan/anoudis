<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 08-03-2016
 * Time: 08:51 AM
 */
class postManager{
    private $postId;
    private $dataConn;
    private $error;
    private $Date;
    private $InsertedPostId;
    function postManager(){
        $this->Date=date("Y-m-d H:m:s");
    }
    public function connect(){
        include 'db.php';
        $this->dataConn = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', ''.$user.'',''.$pass.'');
    }
    public function addPost($category,$entity){
        $this->connect();
        $stmt = $this->dataConn->prepare("INSERT INTO `dealsvagon_fd`.`posts` (`postBy`, `entityType`, `contentType`, `dateTime`, `status`) VALUES (:businessId, :entity, :contentType, :dateTime, :status)");
        $stmt->bindValue(":contentType",$category,PDO::PARAM_STR);
        $stmt->bindValue(":entity",$entity,PDO::PARAM_STR);
        $stmt->bindValue(":dateTime",$this->Date,PDO::PARAM_STR);
        $stmt->bindValue(":status","1",PDO::PARAM_STR);
        $stmt->bindValue(":businessId",$_SESSION["BusinessId"],PDO::PARAM_STR);
        $stmt->execute();
        $this->InsertedPostId = $this->dataConn->lastInsertId();
    }
    public function addDeal($dname,$dPrice,$aPrice,$discount,$desc,$vFrom,$vValid){
        $this->connect();
        $stmt = $this->dataConn->prepare("INSERT INTO `deals`(`BusinessId`, `DealName`, `DealPrice`, `ActualPrice`, `Discount`, `Description`, `ValidFrom`, `ValidTill`, `Status`) VALUES (:bId,:dealname,:dPrice,:aPrice,:discount,:descr,:vFrom,:vTill,:status)");
        $stmt->bindValue(":dealname",$dname,PDO::PARAM_STR);
        $stmt->bindValue(":dPrice",$dPrice,PDO::PARAM_STR);
        $stmt->bindValue(":aPrice",$aPrice,PDO::PARAM_STR);
        $stmt->bindValue(":discount",$discount,PDO::PARAM_STR);
        $stmt->bindValue(":descr",$desc,PDO::PARAM_STR);
        $stmt->bindValue(":vFrom",date("Y-m-d", strtotime($vFrom)),PDO::PARAM_STR);
        $stmt->bindValue(":vTill",date("Y-m-d", strtotime($vValid)),PDO::PARAM_STR);
        $stmt->bindValue(":status","1",PDO::PARAM_STR);
        $stmt->bindValue(":bId",$_SESSION["BusinessId"],PDO::PARAM_STR);
        $stmt->execute();
        return $this->dataConn->lastInsertId();;
    }

    /*public function addPhotos($content){
        $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
        $targetPath = "../uploads/photos/".$_FILES['file']['name']; // Target path where file is to be stored
        move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
        $path_info = pathinfo($_FILES['file']['name']);
        $this->connect();
        $stmt = $this->dataConn->prepare("INSERT INTO `dealsvagon_fd`.`photos` (`postId`, `photoName`, `photoContent`, `dateTime`, `status`) VALUES (:lastPostId, :photoName, :content, :dateTime, :status)");
        $stmt->bindValue(":lastPostId",$this->InsertedPostId,PDO::PARAM_STR);
        $stmt->bindValue(":dateTime",$this->Date,PDO::PARAM_STR);
        $stmt->bindValue(":status","1",PDO::PARAM_STR);
        $stmt->bindValue(":photoName",$_FILES['file']['name'].$path_info['extension'],PDO::PARAM_STR);
        $stmt->bindValue(":content",$content,PDO::PARAM_STR);
        $stmt->execute();
    }*/

    public function addPhotos($id){
        $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
        $path_info = pathinfo($_FILES['file']['name']);
        $targetPath = "../uploads/photos/".md5($id).".".$path_info['extension']; // Target path where file is to be stored
        move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
        $path_info = pathinfo($_FILES['file']['name']);
        $this->connect();
       /* $stmt = $this->dataConn->prepare("INSERT INTO `dealsvagon_fd`.`photos` (`postId`, `photoName`, `photoContent`, `dateTime`, `status`) VALUES (:lastPostId, :photoName, :content, :dateTime, :status)");
        $stmt->bindValue(":lastPostId",$this->InsertedPostId,PDO::PARAM_STR);
        $stmt->bindValue(":dateTime",$this->Date,PDO::PARAM_STR);
        $stmt->bindValue(":status","1",PDO::PARAM_STR);
        $stmt->bindValue(":photoName",$_FILES['file']['name'].$path_info['extension'],PDO::PARAM_STR);
        $stmt->bindValue(":content",$content,PDO::PARAM_STR);
        $stmt->execute();*/
    }
    public function readBusinessPosts($id){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `posts` WHERE `postBy` = :businessId AND `entityType` = 'B'");
        $stmt->bindValue(":businessId",$id,PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        for($i=0;$i<count($resultData);$i++){
            switch($resultData[$i]["contentType"]){
                case "text" :
                    $stmt = $this->dataConn->prepare("SELECT * FROM `textposts` WHERE `postId` = :postid");
                    break;
                case "photo" :
                    $stmt = $this->dataConn->prepare("SELECT * FROM `photos` WHERE `postId` = :postid");
                    break;
            }
            $stmt->bindValue(":postid",$resultData[$i]["postId"],PDO::PARAM_STR);
            $stmt->execute();
            $resultData[$i]["postData"]= $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt = $this->dataConn->prepare("SELECT * FROM `business` WHERE `businessId` = :businessId");
            $stmt->bindValue(":businessId",$resultData[$i]["postBy"],PDO::PARAM_STR);
            $stmt->execute();
            $resultData[$i]["user"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        if(count($resultData)>0)
        {
            return $resultData;
        }else{
            return false;
        }
    }
    public function readPosts($id){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `posts` WHERE `postBy` = :businessId AND `entityType` = 'B'");
        $stmt->bindValue(":businessId",$id,PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        for($i=0;$i<count($resultData);$i++){
            switch($resultData[$i]["contentType"]){
                case "text" :
                    $stmt = $this->dataConn->prepare("SELECT * FROM `textposts` WHERE `postId` = :postid");
                    break;
                case "photo" :
                    $stmt = $this->dataConn->prepare("SELECT * FROM `photos` WHERE `postId` = :postid");
                    break;
            }
            $stmt->bindValue(":postid",$resultData[$i]["postId"],PDO::PARAM_STR);
            $stmt->execute();
            $resultData[$i]["postData"]= $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt = $this->dataConn->prepare("SELECT * FROM `business` WHERE `businessId` = :businessId");
            $stmt->bindValue(":businessId",$resultData[$i]["postBy"],PDO::PARAM_STR);
            $stmt->execute();
            $resultData[$i]["user"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        if(count($resultData)>0)
        {
            return $resultData;
        }else{
            return false;
        }
    }
}
?>