<?php

#taken from the labs

define('HOST', 'localhost');
define('DB','travel');
define('USER','aente721');
define('PASS','');
define('CONN','mysql:host='.HOST.';dbname='.DB);

try{
    $pdo = new PDO (CONN,USER,PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $error){
    echo "Connection failed: ". $error->getMessage();
}

?>
