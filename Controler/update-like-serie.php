<?php
session_start();
include '../Model/db.inc.php';

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Vérifier les données postées
    if (isset($_POST['serieId'], $_POST['action'], $_POST['serieName'])) {
        $serieId = $_POST['serieId'];
        $action = $_POST['action'];
        $serieName = $_POST['serieName'];
        $username = $_SESSION['username'];

        // Préparer la requête d'insertion ou de mise à jour dans la table Likes
        $stmt = $pdo->prepare("INSERT INTO Likes (Username, IdSerie, LikeStatus) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE LikeStatus = ?");
        
        // Exécuter la requête avec les valeurs liées
        if ($stmt->execute([$username, $serieId, $action, $action])) {
            echo json_encode(["success" => true, "message" => "Action '$action' enregistrée avec succès pour la série : $serieName"]);
        } else {
            echo json_encode(["success" => false, "message" => "Erreur lors de l'enregistrement de l'action '$action' pour la série : $serieName"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Paramètres manquants pour enregistrer l'action."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Vous devez être connecté pour effectuer cette action."]);
}
?>
