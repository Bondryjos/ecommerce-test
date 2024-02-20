<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
require_once 'pdo.php';

function verifyUserLoginPassword(PDO $pdo, string $email, string $mot_de_passe):array|bool
{
    $query = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $query->bindValue(":email", $email, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);
 
     if ($user && password_verify($mot_de_passe, $user["mot_de_passe"])) {
        return $user;
    } else {
        return false;
    }
}

?>