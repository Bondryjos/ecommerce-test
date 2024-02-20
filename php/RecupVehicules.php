<?php
header("Access-Control-Allow-Origin: https://garage.en.gp");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: *");
require_once 'pdo.php';
$VerifyEmploye=true;
$VerifyAcces=true;
include_once 'session.php';

$vehicules=$pdo->query("SELECT * FROM vehicules")->fetchAll(PDO::FETCH_ASSOC);


die(json_encode(array(
    "status" => true,
    "message" => "les avis ont été récupéré",
    "vehicules" =>$vehicules,
 )));