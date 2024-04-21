<?php
    $host = 'localhost';
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
        $sql = "SELECT IdSerie, poster, NomSerie FROM Series WHERE Genre = :genre";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':genre', $genreFilter, PDO::PARAM_STR);
        $stmt->execute();
    } else {
        $sql = "SELECT IdSerie, poster, NomSerie FROM Series";
        $stmt = $pdo->query($sql);
    }

    if ($stmt->rowCount() > 0) {
        echo '<div class="image-row">';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<a class="movie-link" data-serie-id="' . $row["IdSerie"] . '" data-serie-name="' . $row["NomSerie"] . '"><img src="../Series/' . $row["poster"] . '" alt="' . $row["NomSerie"] . '"></a>';
        }
        echo '</div>';
    } else {
        echo "0 results";
    }

    $pdo = null;
    ?>