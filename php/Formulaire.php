<?php
header("Access-Control-Allow-Origin: https://garage.en.gp");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: *");
require_once 'pdo.php';


$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['FormulairesUsers'])) {
    $nom = $_POST['nom'];
    $prenom= $_POST['prenom'];
    $email=$_POST['email'];
    $gsm=$_POST['gsm'];
    $message = $_POST['message'];
    $vehicules=$_POST['vehicules_id'];
    if (strlen($nom)>30||strlen($nom)<2) {
        die( json_encode(array("status" => "error", "message" => "nombre de charactère insuffisant")));
       }elseif(strlen($prenom)>30||strlen($prenom)<2){
           die( json_encode(array("status" => "error", "message" => "nombre de charactère insuffisant")));
        } elseif(strlen($email)>250||strlen($email)<10){
            die( json_encode(array("status" => "error", "message" => "nombre de charactère insuffisant")));
         } elseif(strlen($gsm)>20||strlen($gsm)<6){
                die( json_encode(array("status" => "error", "message" => "nombre de charactère insuffisant")));
          } elseif(strlen($message)>550||strlen($message)<40){
                    die( json_encode(array("status" => "error", "message" => "nombre de charactère insuffisant")));
          }

    $stmt = $pdo->prepare("INSERT INTO formulaires (nom, prenom, email,gsm,message,vehicules_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nom, $prenom, $email, $gsm,$message,$vehicules]);
    
    if ($stmt->rowCount()) {
        echo json_encode(array("status" => "success", "message" => "Données du formulaire insérées avec succès"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Erreur lors de l'insertion des données du formulaire : " . $stmt->errorInfo()));
    }

    
} else {
    echo json_encode(array("status" => "error", "message" => "Requête invalide"));
}
