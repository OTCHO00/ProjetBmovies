<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $filmId = $_POST['filmId'];
    $likeStatus = $_POST['likeStatus']; 
    $username = $_SESSION['username'];
    $nomfilm = $_SESSION['nomfilm'];


    $host = 'localhost';
    $dbname = 'b_movies';
    $dbusername = 'root';
    $dbpassword = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('Erreur de connexion à la base de données : ' . $e->getMessage());
    }

    $sql = "INSERT INTO Likes (Username, IdFilm, NomFilm, LikeStatus) 
        SELECT :username, :filmId, :nomfilm, :likeStatus 
        FROM Films WHERE IdFilm = :filmId
        ON DUPLICATE KEY UPDATE LikeStatus = :likeStatus";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':filmId', $filmId, PDO::PARAM_INT);
    $stmt->bindParam(':likeStatus', $likeStatus, PDO::PARAM_STR);
    $stmt->bindParam(':nomfilm', $nomfilm, PDO::PARAM_STR);
    
    try {
        $stmt->execute();
        echo 'Like/dislike enregistré avec succès !';
    } catch (PDOException $e) {
        echo '' . $e->getMessage();
    }

    $pdo = null;
}
?>
