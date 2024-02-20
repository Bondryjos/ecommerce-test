<?php
header("Access-Control-Allow-Origin: https://garage.en.gp");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: *");
require_once 'pdo.php';
$VerifyAdmin=true;
$VerifyAcces=true;
include_once 'session.php';

$horaires=$pdo->query("SELECT * FROM horaires")->fetchAll(PDO::FETCH_ASSOC);


die(json_encode(array(
    "status" => true,
    "message" => "les horaires ont été récupéré",
    "horaires" =>$horaires,
 )));