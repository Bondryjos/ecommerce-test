<?php
header("Access-Control-Allow-Origin: https://garage.en.gp");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

$VerifyAcces=true;
$VerifyEmploye=true;
require_once 'pdo.php';
require_once 'session.php';


die(json_encode(array(
    "status" => true,
    "message" => "accès autorisé"
 ))); 