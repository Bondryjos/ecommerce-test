<?php
header("Access-Control-Allow-Origin: https://garage.en.gp");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Credentials: true");
require_once 'pdo.php';
$VerifyAdmin=true;
$VerifyAcces=true;
require_once 'session.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $role = $_POST['role'];

    if (empty($nom) || empty($email) || empty($mot_de_passe) || empty($role)) {
        echo json_encode(array("status" => "error", "message" => "Tous les champs doivent être remplis."));
        exit();
    }

    $hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (nom, email, mot_de_passe, role) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nom, $email, $hashed_password, $role]);

    if ($stmt->rowCount()) {
        echo json_encode(array("status" => "success", "message" => "Données du formulaire insérées avec succès"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Erreur lors de l'insertion des données du formulaire."));
    }

} else {
    echo json_encode(array("status" => "error", "message" => "Requête invalide"));
}
?>
