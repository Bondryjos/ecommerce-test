<?php
header("Access-Control-Allow-Origin: https://garage.en.gp");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: *");
require_once 'pdo.php';
$VerifyEmploye=true;
$VerifyAcces=true;
include_once 'session.php';

$formulaires=$pdo->query("SELECT * FROM formulaires")->fetchAll(PDO::FETCH_ASSOC);

foreach($formulaires as $index=>$avis) {
    foreach($avis as $nom=>$valeur) {
      //  $avis[$nom] = htmlentities($valeur);
    }
   // $formulaires[$index] = $avis;
}
die(json_encode(array(
    "status" => true,
    "message" => "les avis ont été récupéré",
    "formulaires" =>$formulaires,
 )));
