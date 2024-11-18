<?php
define("HOST","localhost");
define("USER","root");
define("PASS","");

function connect($base){
    $dsn="mysql:host".HOST."baseprojet".$base;
    $user=USER;
    $pass=PASS;
    try{
        $idcon=new PDO($dsn,$user,$pass);
        return $idcon;
        echo "connected succefully";
    }
    catch (PDOException $except){
        echo "Echec de la connexion",$except->getMessage();
        return FALSE;
        exit();
    }
}
connect("locationvoiturebd");

?>





  