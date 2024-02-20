<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
require_once 'required_files.php';

$data = 
[
    'clients' => [
        [
            'title' => 'Jhon',
            'description' => 'je suis très satisfait du service proposé'
        ],
        [
            'title' => 'alphonse',
            'description' => 'merci pour le service proposé'
        ],
        [
            'title' => 'joe',
            'description' => 'je suis très satisfait du service proposé'
        ]
    ]
        ];



echo json_encode($data);
