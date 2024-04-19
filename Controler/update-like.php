<?php
session_start();
include 'db.inc.php';

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Vérifier les données postées
    if (isset($_POST['filmId'], $_POST['action'], $_POST['filmName'])) {
        $filmId = $_POST['filmId'];
        $action = $_POST['action'];
        $filmName = $_POST['filmName'];
        $username = $_SESSION['username'];

        // Préparer la requête d'insertion ou de mise à jour
        $stmt = $pdo->prepare("INSERT INTO Likes (Username, IdFilm, LikeStatus) VALUES (:username, :filmId, :action) ON DUPLICATE KEY UPDATE LikeStatus = :action");
        
        // Liaison des valeurs aux paramètres
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':filmId', $filmId, PDO::PARAM_INT);
        $stmt->bindParam(':action', $action, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            echo "Action ($action) enregistrée avec succès pour le film : $filmName";
        } else {
            echo "Erreur lors de l'enregistrement de l'action ($action) pour le film : $filmName";
        }
    } else {
        echo "Paramètres manquants pour enregistrer l'action.";
    }
} else {
    echo "Vous devez être connecté pour effectuer cette action.";
}
?>
