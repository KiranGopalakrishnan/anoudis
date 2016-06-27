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
class userManager {
    public $userType;
    public $email;
    public $password;
    public $merchantHandle;
    public $userData;
    public $userName;
    public $passKey;
    public $GenKey;
    public $resultKey;
    public $Date;
    public $ObtainedKey;
    public $DecryptedKey;
    public function userManager($username,$email,$password){
           $this->email=$email;
           $this->password=$password;
           $this->passKey="D7E0A5L9S7V7A5G4O5N8";
           $this->Date=date("Y-m-d H:m:s");
           $this->userName=$username;
    }
    function crypto_rand_secure($min, $max)
{
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd >= $range);
    return $min + $rnd;
}

function getToken($length)
{
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet) - 1;
    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max)];
    }
    $this->GenKey = $token;
}
    public function connect(){
        include 'db.php';
        $this->dataConn = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', ''.$user.'',''.$pass.'');   
    }
    public function Login(){
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT `HashKey` FROM `users` WHERE `E-Mail` = :email");
        $stmt->bindValue(":email",$this->userName,PDO::PARAM_STR);
	$stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($resultData)>0) {

            $this->ObtainedKey = $resultData[0]["HashKey"];
            $this->decrypt();
            //echo "result decrypt : ".$this-> DecryptedKey;
            $stmt = $this->dataConn->prepare("SELECT * FROM `users` WHERE `E-Mail` = :username AND `Password` = :password");
            $stmt->bindValue(":username", $this->userName, PDO::PARAM_STR);
            $stmt->bindValue(":password", $this->DecryptedKey, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //var_dump($result);
            if (count($result) > 0) {
                $this->userData = $result;
                $this->startSession();
                return $result;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }
    public function getCurrentUserData(){
        if(count($this->userData)>0){
            return $this->userData;
        }else{
            $this->connect();
            $stmt = $this->dataConn->prepare("SELECT * FROM `users` WHERE `UserId` = :userId");
            $stmt->bindValue(":userId",$_SESSION["user"],PDO::PARAM_STR);
            $stmt->execute();
            $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultData;
        }
    }
    public function getUser($id){
            $this->connect();
            $stmt = $this->dataConn->prepare("SELECT * FROM `users` WHERE `UserId` = :userId");
            $stmt->bindValue(":userId",$id,PDO::PARAM_STR);
            $stmt->execute();
            $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultData;
    }
    public function Register($firstname,$lastname,$accType,$sex,$dob){
        $this->encrypt();
        $this->connect();
        $stmt = $this->dataConn->prepare("INSERT INTO `users`(`Firstname`, `Lastname`, `Sex`, `dob`, `AccountType`,`E-Mail`, `Username`, `Password`, `HashKey`, `Date`, `Status`) VALUES (:firstname,:lastname,:sex,:dob,:accType,:email,:username,:password,:key,:date,:status)");
        $stmt->bindValue(":email",$this->email,PDO::PARAM_STR);
        $stmt->bindValue(":username",$this->userName,PDO::PARAM_STR);
        $stmt->bindValue(":password",$this->resultkey,PDO::PARAM_STR);
        $stmt->bindValue(":firstname",$firstname,PDO::PARAM_STR);
        $stmt->bindValue(":lastname",$lastname,PDO::PARAM_STR);
        $stmt->bindValue(":sex",$sex,PDO::PARAM_STR);
        $stmt->bindValue(":dob",$dob,PDO::PARAM_STR);
        $stmt->bindValue(":accType",$accType,PDO::PARAM_STR);
        $stmt->bindValue(":key",$this->GenKey,PDO::PARAM_STR);
        $stmt->bindValue(":date",$this->Date,PDO::PARAM_STR);
        $stmt->bindValue(":status","0",PDO::PARAM_STR);
	$stmt->execute();
        //$this->initiateUser();
       
    }
    public function startSession(){
        $_SESSION["LoggedIn"]=true;
        $_SESSION["user"]=$this->userData[0]["UserId"];
        if($this->userData[0]["AccountType"]=="M"){
            $this->initiateMerchant();
        }else{
            $this->initiateUser();
        }
    }
    public function endSession(){
        unset($_SESSION["user"]);
        unset($_SESSION["userData"]);
    }
    public function initiateUser(){
        $_SESSION["userType"]="U";
    }
        
    public function initiateMerchant(){
        $_SESSION["userType"]="M";
        $_SESSION["Merchant"]= true;
        $dt = $this->getCurrentUserData();
        $_SESSION["MerchantId"]= $dt[0]["UserId"];
    }
    /*---------- Authentication Functions ----*/
    public function Authenticate(){
        if(isset($_SESSION["user"])){
            return true;
        }else{
            return false;
        }
    }
    public function AuthenticateMerchant(){
        if(isset($_SESSION["user"])&&isset($_SESSION["Merchant"])&&$_SESSION["userType"]=="M"){
            return true;
        }else{
            return false;
        }
    }
    public function emailVerification(){
        $to = "somebody@example.com";
        $subject = "My subject";
        $txt = "Hello There,/n
        Welcome to Dealsvagon,The Digital Deal Platform/n
        Please verify your E-mail by <a href='testing2016.bugs3.com/verify.php?token='".$this->userData[0]["E-Mail"].">Clicking Here</a>";
        $headers = "From: verify@dealsvagon.com" . "\r\n";
        mail($to,$subject,$txt,$headers);
    }
    
    /*---------- Cryptography Functions ----*/
    
    public function encrypt(){
      $this->getToken(rand(20,100));
      $this->resultkey = hash('sha256', $this->GenKey . $this->password . $this->passKey);
    }
     public function decrypt(){
      $this->DecryptedKey = hash('sha256', $this->ObtainedKey . $this->password . $this->passKey);
    }
}
?>
