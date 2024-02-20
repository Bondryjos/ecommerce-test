<?php
require_once 'config.php';
try {
    $pdo = new PDO("mysql:dbname="._DB_NAME_.";host="._DB_SERVER_.";charset=utf8mb4", _DB_USERS_ , _DB_PASSWORD_);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
