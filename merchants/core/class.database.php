<?php

/**
 * This class was developed as part of a web project called iconnect which required me to pull data out of a mysql database freequenctly.
 * This class deals with various basic functionalities required for you to pull data out of a database.
 * Only one instance of the class is required for various sub functions which include retrieving using a where claus,Retrieving using Greater than ,Ordered By,Like  
 *
 * @author Kiran
 */
class database {
    private $dbName;
    private $dbUsername;
    private $dbPassword;
    private $dbHostname;
    private $dbVar;
    function database($name,$user,$pass,$host){
        $this->dbName=$name;
        $this->dbUsername=$user;
        $this->dbPassword=$pass;
        $this->dbHostname=$host;
    }
    public function connect(){
        $this->dbVar = new PDO('mysql:host='.$this->dbHostname.';dbname='.$this->dbName.';charset=utf8', ''.$this->dbUsername.'',''.$this->dbPassword.'');
        return true;
    }
   
}
?>