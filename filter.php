<?php
session_start();

if(isset($_GET['category'])) {
    $category = $_GET['category'];

    $host = 'localhost'; 
    $dbname = 'b_movies';
    $dbusername = 'root';
    $dbpassword = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT IdFilm, poster, NomFilm FROM Films WHERE Genre = :category"; 
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->execute();

        $films = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($films);
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}
?>
