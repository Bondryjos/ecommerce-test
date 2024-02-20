<?php
header("Access-Control-Allow-Origin: https://garage.en.gp");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: *");
$VerifyEmploye=true;
$VerifyAcces=true;
require_once 'pdo.php';
require_once 'session.php';

$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["vehicules_id"])) {
        if ($_FILES["image"]["error"] > 0) {
            echo "Erreur lors du téléchargement: " . $_FILES["image"]["error"];
        } else {
            $uploadDirectory = "../src/assets/";
    
            $fileName = $_FILES["image"]["name"];
            $image =  "/src/assets/$fileName";
            $destination = $uploadDirectory . $fileName;
    
            move_uploaded_file($_FILES["image"]["tmp_name"], $destination)
            ;
        }
       
        $stmt = $pdo->prepare("UPDATE vehicules SET `prix` = ?,`image` = ?, `annee_mise_en_circulation` = ?, `kilometrage` = ?, `titre` = ?, `description` = ? WHERE vehicules_id = ?");
        
        $stmt->execute([
            $_POST["prix"],
            $image,
            $_POST["annee_mise_en_circulation"],
            $_POST["kilometrage"],
            $_POST["titre"],
            $_POST["description"],
            $_POST["vehicules_id"]
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
