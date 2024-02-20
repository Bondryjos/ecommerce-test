<?php
header("Access-Control-Allow-Origin: https://garage.en.gp");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

require_once "config.php";
require_once "session.php";

if(isset($_SESSION['user'])){   
    session_destroy();
    echo json_encode(["status" => true]);
    exit();
} else {
    echo json_encode(["status" => false, "message" => "Utilisateur non connecté"]);
    exit();
}
?>