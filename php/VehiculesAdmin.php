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
    $prix= $_POST['prix'];
    $annee_mise_en_circulation=$_POST['annee_mise_en_circulation'];
    $kilometrage=$_POST['kilometrage'];
    $titre = $_POST['titre'];
    $description=$_POST['description'];
    $users_id=$_SESSION['user']['users_id'];
     
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
    $stmt = $pdo->prepare("INSERT INTO vehicules (prix, image, annee_mise_en_circulation, titre, kilometrage,  description , users_id ) VALUES (?, ?, ?, ?, ?, ?,?)");
    $stmt->execute([$prix, $image, $annee_mise_en_circulation, $titre,$kilometrage,$description,$users_id ]);
    
    if ($stmt->rowCount()) {
        echo json_encode(array("status" => "success", "message" => "Données du formulaire insérées avec succès"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Erreur lors de l'insertion des données du formulaire : " . $stmt->errorInfo()));
    }

    
} else {
    echo json_encode(array("status" => "error", "message" => "Requête invalide"));
}
