<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["filmId"]) && isset($_POST["action"]) && $_POST["action"] === "remove-like") {
        $filmId = $_POST["filmId"];

        // Opérations pour retirer le like du film avec $filmId
        // Par exemple, mettre à jour une base de données pour indiquer que le like est retiré

        $response = [
            'success' => true,
            'message' => 'Like retiré avec succès pour le film ID : ' . $filmId
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}

$response = [
    'success' => false,
    'message' => 'Requête invalide pour la suppression du like'
];

header('Content-Type: application/json');
echo json_encode($response);
