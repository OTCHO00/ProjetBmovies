<?php
// Inclure le fichier de configuration de la base de données
include '../Model/db.inc.php';

// Vérifier si l'ID du film est fourni et est un entier valide
if (isset($_POST['serieId']) && is_numeric($_POST['serieId'])) {
    $serieId = $_POST['serieId'];

    try {
        // Préparer et exécuter la requête de suppression
        $query = "DELETE FROM Series WHERE IdSerie = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$serieId]);

        // Vérifier si des lignes ont été affectées (vérifier si la suppression a réussi)
        if ($stmt->rowCount() > 0) {
            // Suppression réussie
            echo json_encode(['success' => true, 'message' => 'Image de film supprimée avec succès.']);
        } else {
            // Aucune ligne supprimée (aucun film avec cet ID trouvé)
            echo json_encode(['success' => false, 'message' => 'Film introuvable ou déjà supprimé.']);
        }
    } catch (PDOException $e) {
        // Erreur lors de l'exécution de la requête SQL
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la suppression de l\'image de film : ' . $e->getMessage()]);
    }
} else {
    // ID du film manquant ou invalide
    echo json_encode(['success' => false, 'message' => 'ID de film manquant ou invalide.']);
}
