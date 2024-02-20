<?php
header("Access-Control-Allow-Origin: https://garage.en.gp");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: *");

require_once 'pdo.php';

function getAllAvisData(PDO $pdo)
{
    try {
        $query = $pdo->prepare("SELECT * FROM avis Where `verification`= 1 ORDER BY avis_id desc limit 3 ");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);


        return $result;
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

$data = getAllAvisData($pdo);
foreach($data as $index=>$avis) {
    foreach($avis as $nom=>$valeur) {
       // $avis[$nom] = htmlentities($valeur);
    }
   // $data[$index] = $avis;
}
header('Content-Type: application/json');
echo json_encode($data);
?>