<?php
header("Access-Control-Allow-Origin: https://garage.en.gp");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: *");

require_once 'pdo.php';

function getAllHorairesData(PDO $pdo)
{
    try {
        $query = $pdo->prepare("SELECT * FROM horaires");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);


        return $result;
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

$data = getAllHorairesData($pdo);

header('Content-Type: application/json');
echo json_encode($data);
?>