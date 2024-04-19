<?php
session_start();
include 'db.inc.php';

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Vérifier les données postées
    if (isset($_POST['filmId'], $_POST['action'])) {
        $filmId = $_POST['filmId'];
        $action = $_POST['action'];
        $username = $_SESSION['username'];

        // Supprimer le like/dislike pour le film spécifié
        $stmt_delete = $conn->prepare("DELETE FROM Likes WHERE Username = ? AND IdFilm = ? AND LikeStatus = ?");
        $stmt_delete->bind_param("sis", $username, $filmId, $action);
        
        if ($stmt_delete->execute()) {
            echo ucfirst($action) . " supprimé avec succès pour le film.";
        } else {
            echo "Erreur lors de la suppression du " . $action . " pour le film.";
        }
    } else {
        echo "Paramètres manquants pour supprimer un like/dislike.";
    }
} else {
    echo "Vous devez être connecté pour supprimer un like/dislike.";
}
?>
