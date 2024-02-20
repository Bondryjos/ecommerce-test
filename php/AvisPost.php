<?php
header("Access-Control-Allow-Origin: https://garage.en.gp");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: *");
require_once 'pdo.php';
$VerifyEmploye=true;
$VerifyAcces=true;
require_once 'session.php';

$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   

    $stmt = $pdo->prepare("UPDATE avis SET `verification` = true WHERE avis_id = ? ");
    $stmt->execute([$_POST["avis_id"]]);
    
    if ($stmt->rowCount()) {
        echo json_encode(array("status" => "success", "message" => "Données du formulaire insérées avec succès"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Erreur lors de l'insertion des données du formulaire : " . $stmt->errorInfo()));
    }

    
} else {
    echo json_encode(array("status" => "error", "message" => "Requête invalide"));
}
