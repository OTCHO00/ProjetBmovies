<?php

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT l.IdFilm, l.IdSerie, f.poster AS film_poster, f.NomFilm AS film_name, s.poster AS serie_poster, s.NomSerie AS serie_name
                FROM Likes l
                LEFT JOIN Films f ON l.IdFilm = f.IdFilm
                LEFT JOIN Series s ON l.IdSerie = s.IdSerie
                WHERE l.Username = :username";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo '<div class="image-row">';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (!empty($row['film_poster'])) {
                    // Afficher le poster du film si disponible
                    echo '<a class="movie-link" data-film-id="' . $row["IdFilm"] . '" data-film-name="' . $row["film_name"] . '"><img src="../Images/' . $row["film_poster"] . '" alt="' . $row["film_name"] . '"></a>';
                } elseif (!empty($row['serie_poster'])) {
                    // Afficher le poster de la série si disponible
                    echo '<a class="movie-link" data-serie-id="' . $row["IdSerie"] . '" data-serie-name="' . $row["serie_name"] . '"><img src="../Series/' . $row["serie_poster"] . '" alt="' . $row["serie_name"] . '"></a>';
                }
            }
            echo '</div>';
        } else {
            echo "Aucun film ou série aimé par cet utilisateur.";
        }
    } catch (PDOException $e) {
        die('Erreur de requête SQL : ' . $e->getMessage());
    }
} else {
    header('Location: login.php');
    exit();
}
?>
