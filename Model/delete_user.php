<?php
include '../Controler/db.inc.php';

// Vérifier si le paramètre username est présent dans la requête POST
if (isset($_POST['username'])) {
    $username = $_POST['username'];

    try {
        // Préparer la requête SQL de suppression
        $query = "DELETE FROM Utilisateurs WHERE Username = ?";
        $stmt = $pdo->prepare($query);
        
        // Exécuter la requête en liant le paramètre
        $stmt->execute([$username]);

        // Vérifier si des lignes ont été affectées
        if ($stmt->rowCount() > 0) {
            // Succès de la suppression
            echo json_encode(['success' => true]);
        } else {
            // Aucun utilisateur supprimé (peut-être que l'utilisateur n'existe pas)
            echo json_encode(['success' => false, 'message' => 'Aucun utilisateur trouvé avec ce nom d\'utilisateur.']);
        }
    } catch (PDOException $e) {
        // Erreur lors de l'exécution de la requête SQL
        http_response_code(500); // Erreur interne du serveur
        echo json_encode(['error' => 'Erreur lors de la suppression de l\'utilisateur : ' . $e->getMessage()]);
    }
} else {
    // Paramètre manquant dans la requête POST
    http_response_code(400); // Mauvaise requête
    echo json_encode(['error' => 'Paramètre manquant : username']);
}
?>
