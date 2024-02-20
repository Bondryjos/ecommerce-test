<?php
header("Access-Control-Allow-Origin: https://garage.en.gp");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: *");

require_once 'pdo.php';

function getAllGarageData(PDO $pdo)
{
    try {
        $query = $pdo->prepare("SELECT * FROM garages");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

    
        foreach ($result as &$row) {
            if (empty($row['image_accueil'])) {
                $row['image_accueil'] = '..\src\assets\Leonardo_Diffusion_XL_car_logo_in_orange_for_website_3.jpg';
            }
        }
        foreach ($result as &$row) {
            if (empty($row['image_service'])) {
                $row['image_service'] = '..\src\assets\Leonardo_Diffusion_XL_car_logo_in_orange_for_website_3.jpg';
            }
        }

        return $result;
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

$data = getAllGarageData($pdo);

header('Content-Type: application/json');
echo json_encode($data);
?>