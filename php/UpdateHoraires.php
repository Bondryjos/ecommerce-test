<?php
header("Access-Control-Allow-Origin: https://garage.en.gp");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: *");
$VerifyAdmin=true;
$VerifyAcces=true;
require_once 'pdo.php';
require_once 'session.php';

$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (isset($_POST["horaires_id"])) {
        
       
        
        $stmt = $pdo->prepare("UPDATE horaires SET `horaires_du_matin` = ?,`horaires_du_soir` = ?, `jours` = ?  WHERE horaires_id = ?");
        
        $stmt->execute([
            $_POST["horaires_du_matin"],
            $_POST["horaires_du_soir"],
            $_POST["jours"],
            $_POST["horaires_id"]
        ]);

        if ($stmt->rowCount()) {
            echo json_encode(array("status" => "success", "message" => "Données du formulaire mises à jour avec succès"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Erreur lors de la mise à jour des données du formulaire : " . json_encode($stmt->errorInfo())));
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "Vehicules_id non fourni dans la requête POST"));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Requête invalide"));
}
?>
