<?php

session_set_cookie_params([
   'lifetime' => 3600,
    'path' => '/',
    'domain' => _DOMAIN_,
    'secure' => true,
    'httponly' => true,
]);

session_start();

if (isset($VerifyAcces)&&$VerifyAcces){
   /* print_r($_SESSION);*/
    if (empty($_SESSION["user"])){
        die(json_encode(array(
            "status" => false,
            "message" => "vous devez vous connecter"
         )));  
    }
}
if (isset($VerifyAdmin)&&$VerifyAdmin){
    if (!isset($_SESSION["user"]["role"])||$_SESSION["user"]["role"]!="admin"){
        die(json_encode(array(
            "status" => false,
            "message" => "accès reservé a l'admin"
         )));  
    }
}
if (isset($VerifyEmploye)&&$VerifyEmploye){
    if (!isset($_SESSION["user"]["role"])||($_SESSION["user"]["role"]!="employe"&&$_SESSION["user"]["role"]!="admin")){
        die(json_encode(array(
            "status" => false,
            "message" => "accès reservé a l'employe"
         )));  
    }
}


