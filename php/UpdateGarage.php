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
    if (isset($_POST["garages_id"])) {
        if ($_FILES["image_accueil"]["error"] > 0) {
            echo "Erreur lors du téléchargement: " . $_FILES["image_accueil"]["error"];
        } else {
            $uploadDirectory = "../src/assets/";
    
            $fileName = $_FILES["image_accueil"]["name"];
            $image =  "/src/assets/$fileName";
            $destination = $uploadDirectory . $fileName;
    
            move_uploaded_file($_FILES["image_accueil"]["tmp_name"], $destination)
            ;
        }
        if ($_FILES["image_service"]["error"] > 0) {
            echo "Erreur lors du téléchargement: " . $_FILES["image_service"]["error"];
        } else {
            $uploadDirectory = "../src/assets/";
    
            $fileName = $_FILES["image_service"]["name"];
            $imageService =  "/src/assets/$fileName";
            $destination = $uploadDirectory . $fileName;
    
            move_uploaded_file($_FILES["image_service"]["tmp_name"], $destination)
            ;
        }
        $stmt = $pdo->prepare("UPDATE garages SET `titre_service` = ?, `description_service` = ?, `image_service` = ?, `titre_accueil` = ?, `description_accueil` = ?, `image_accueil` = ?, `gsm` = ?, `adresse` = ? WHERE garages_id = ?");
        
        $stmt->execute([
            $_POST["titre_service"],
            $_POST["description_service"],
            $imageService,
            $_POST["titre_accueil"],
            $_POST["description_accueil"],
            $image,
            $_POST["gsm"],
            $_POST["adresse"],
            $_POST["garages_id"]
        ]);

        if ($stmt->rowCount()) {
            echo json_encode(array("status" => "success", "message" => "Données du formulaire mises à jour avec succès"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Erreur lors de la mise à jour des données du formulaire : " . json_encode($stmt->errorInfo())));
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "Garages_id non fourni dans la requête POST"));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Requête invalide"));
}
?>
