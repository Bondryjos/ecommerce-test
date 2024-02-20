<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: *");
require_once 'pdo.php';


$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['AvisUsers'])) {
    $nom = $_POST['nom'];
    $message = $_POST['message'];
    $note = $_POST['note'];
    if (strlen($nom)>30||strlen($nom)<2) {
     die( json_encode(array("status" => "error", "message" => "nombre de charactère insuffisant")));
    }elseif(strlen($message)>250||strlen($message)<40){
        die( json_encode(array("status" => "error", "message" => "nombre de charactère insuffisant")));
    }elseif(intval($note)>=6||intval($note)<=-1){
        die( json_encode(array("status" => "error", "message" => "champ de note invalide")));
    }
    $stmt = $pdo->prepare("INSERT INTO avis (nom, message, note) VALUES (?, ?, ?)");
    $stmt->execute([$nom, $message, $note]);
    
    if ($stmt->rowCount()) {
        echo json_encode(array("status" => "success", "message" => "Données du formulaire insérées avec succès"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Erreur lors de l'insertion des données du formulaire : " . $stmt->errorInfo()));
    }

    
} else {
    echo json_encode(array("status" => "error", "message" => "Requête invalide"));
}

