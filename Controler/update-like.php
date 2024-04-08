<?php

include'db.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['filmId']) && isset($_POST['action']) && isset($_POST['filmName'])) {
    $filmId = $_POST['filmId'];
    $action = $_POST['action'];
    $filmName = $_POST['filmName'];

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pdo->beginTransaction();

        if ($action === 'like') {
            $stmt = $pdo->prepare("INSERT INTO Likes (IdFilm, LikeStatus, FilmName) VALUES (:filmId, 'like', :filmName)");
        } elseif ($action === 'dislike') {
            $stmt = $pdo->prepare("INSERT INTO Likes (IdFilm, LikeStatus, FilmName) VALUES (:filmId, 'dislike', :filmName)");
        }
        $stmt->bindParam(':filmId', $filmId, PDO::PARAM_INT);
        $stmt->bindParam(':filmName', $filmName, PDO::PARAM_STR);
        $stmt->execute();

        $pdo->commit();

        echo json_encode(array('success' => true));

    } catch (PDOException $e) {
        $pdo->rollBack();
        echo json_encode(array('success' => false, 'error' => $e->getMessage()));
    }

    $pdo = null;
} else {
    echo json_encode(array('success' => false, 'error' => 'Invalid request data'));
}
?>
