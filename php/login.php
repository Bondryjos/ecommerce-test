<?php
require_once 'pdo.php';
require_once 'users.php';
include 'session.php';
header("Access-Control-Allow-Origin: https://garage.en.gp");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");
$errors = [];

if (isset($_POST["loginUser"])) {
    $email = $_POST["email"];
    $mot_de_passe = $_POST["mot_de_passe"];

    $user = verifyUserLoginPassword($pdo, $email, $mot_de_passe);
    if ($user) {
        session_regenerate_id(true);
       /* @session_start();*/
        $_SESSION["user"] = $user;
        die(json_encode(array(
            "status" => (bool)$user,
            "message" => "Authentification réussi".session_id()
            
         )));
    } else {
        die(json_encode(array(
            "status" => false,
            "message" => "Email ou mot de passe incorrect"
         )));
      
    }
}