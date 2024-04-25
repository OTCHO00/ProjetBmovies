<?php
session_start();

if (isset($_POST['contentId']) && isset($_POST['likeType']) && isset($_POST['username'])) {
    $contentId = $_POST['contentId'];
    $likeType = $_POST['likeType'];
    $username = $_POST['username'];

    // Connexion à la base de données
    $host = 'ec2-3-208-28-102.compute-1.amazonaws.com';
    $dbname = 'b_movies';
    $dbusername = 'root';
    $dbpassword = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparation de la requête de suppression en fonction du type de contenu
        if ($likeType === 'film') {
            $sql = "DELETE FROM Likes WHERE Username = :username AND IdFilm = :contentId";
        } elseif ($likeType === 'serie') {
            $sql = "DELETE FROM Likes WHERE Username = :username AND IdSerie = :contentId";
        }

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':contentId', $contentId, PDO::PARAM_INT);

        // Exécution de la requête
        $stmt->execute();

        // Vérification du nombre de lignes affectées
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => 'Like retiré avec succès pour le contenu ID : ' . $contentId]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Aucun like correspondant trouvé pour le contenu ID : ' . $contentId]);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur de connexion : ' . $e->getMessage()]);
    }

    // Fermeture de la connexion
    $pdo = null;
} else {
    echo json_encode(['success' => false, 'message' => 'Paramètres manquants']);
}
?>
