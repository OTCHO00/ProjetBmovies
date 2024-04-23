<?php
$host = 'ec2-3-208-28-102.compute-1.amazonaws.com';
$dbname = 'b_movies';
$dbusername = 'root';
$dbpassword = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}


if (isset($_GET['genre'])) {
    $genreFilter = $_GET['genre'];
    $sql = "SELECT IdFilm, poster, NomFilm FROM Films WHERE Genre = :genre";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':genre', $genreFilter, PDO::PARAM_STR);
    $stmt->execute();
} else {
    $sql = "SELECT IdFilm, poster, NomFilm FROM Films";
    $stmt = $pdo->query($sql);
}

if ($stmt->rowCount() > 0) {
    echo '<div class="image-row">';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<a class="movie-link" data-film-id="' . $row["IdFilm"] . '" data-film-name="' . $row["NomFilm"] . '"><img src="../Images/' . $row["poster"] . '" alt="' . $row["NomFilm"] . '"></a>';
    }
    echo '</div>';
} else {
    echo "0 results";
}

$pdo = null;
