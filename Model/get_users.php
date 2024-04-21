<?php
include '../Model/db.inc.php';

try {
    // Sélectionner les données des utilisateurs avec un rôle spécifique (ex: RoleId = 2 pour les utilisateurs non-administrateurs)
    $query = "SELECT Username, AdresseMail FROM Utilisateurs WHERE RoleId = 2";
    $stmt = $pdo->query($query);

    // Récupérer les résultats sous forme de tableau associatif
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retourner les données des utilisateurs sous forme de JSON
    header('Content-Type: application/json');
    echo json_encode($users);
} catch (PDOException $e) {
    // En cas d'erreur lors de la récupération des utilisateurs
    http_response_code(500); // Erreur interne du serveur
    echo json_encode(['error' => 'Erreur lors de la récupération des utilisateurs : ' . $e->getMessage()]);
}
?>
