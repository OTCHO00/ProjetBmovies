<?php
// Vérifiez si la requête AJAX contient les données nécessaires
if (isset($_POST['filmId']) && isset($_POST['action'])) {
    // Récupérez les données de la requête AJAX
    $filmId = $_POST['filmId'];
    $action = $_POST['action'];

    // Incluez votre fichier de configuration de la base de données
    include 'db.inc.php'; // Assurez-vous de renseigner le chemin correct

    try {
        // Connexion à la base de données
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Supprimer le like ou le dislike en fonction de l'action
        if ($action === 'removeLike') {
            $stmt = $pdo->prepare("DELETE FROM Likes WHERE IdFilm = :filmId AND LikeStatus = 'like'");
        } elseif ($action === 'removeDislike') {
            $stmt = $pdo->prepare("DELETE FROM Likes WHERE IdFilm = :filmId AND LikeStatus = 'dislike'");
        }

        // Liaison des paramètres et exécution de la requête
        $stmt->bindParam(':filmId', $filmId, PDO::PARAM_INT);
        $stmt->execute();

        // Réponse JSON pour indiquer le succès
        echo json_encode(array('success' => true));
    } catch (PDOException $e) {
        // En cas d'erreur, renvoyez une réponse JSON avec l'erreur
        echo json_encode(array('success' => false, 'error' => $e->getMessage()));
    }

    // Fermer la connexion à la base de données
    $pdo = null;
} else {
    // Si des données essentielles sont manquantes dans la requête AJAX, renvoyez une réponse JSON avec un message d'erreur
    echo json_encode(array('success' => false, 'error' => 'Données manquantes dans la requête AJAX.'));
}
?>
