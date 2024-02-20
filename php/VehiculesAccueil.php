<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: *");

require_once 'pdo.php';

function getAllVehiculesData(PDO $pdo)
{
    try {
        $query = $pdo->prepare("SELECT * FROM vehicules ORDER BY vehicules_id desc ".(isset($_GET["limit"]) ? 'LIMIT '.intval($_GET["limit"]): ''));
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

    
        foreach ($result as &$row) {
            if (empty($row['image'])) {
                $row['image'] = '..\src\assets\Leonardo_Diffusion_XL_car_logo_in_orange_for_website_3.jpg';
            }
        }

        return $result;
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
function getAllFilterData(PDO $pdo)
{
    try {
        $query = $pdo->prepare("SELECT * FROM `vehicules` WHERE `prix` < :prix AND `kilometrage` < :kilometrage AND `annee_mise_en_circulation` < :annee_mise_en_circulation");
        $query->execute([":prix" => $_GET["prix"], ":kilometrage" => $_GET["kilometrage"], ":annee_mise_en_circulation" => $_GET["annee"]]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

    
        foreach ($result as &$row) {
            if (empty($row['image'])) {
                $row['image'] = '..\src\assets\Leonardo_Diffusion_XL_car_logo_in_orange_for_website_3.jpg';
            }
        }

        return $result;
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

if(isset($_GET["filter"])) {
    $data = getAllFilterData($pdo);
} else {
  $data = getAllVehiculesData($pdo);
}

header('Content-Type: application/json');
echo json_encode($data);
?>