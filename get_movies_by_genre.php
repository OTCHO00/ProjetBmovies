<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>B. Movies - Films par genre</title>
    <link rel="stylesheet" type="text/css" href="Movie.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" type="image" href="Images/Logo.jpg">
    <style>
        .enlarged-image {
            position: fixed;
            width: 585px;
            height: 850px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 90%;
            max-height: 90vh;
            z-index: 9999;
        }

        .close-button {
            display: none;
        }

        .btn {
            width: 100px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .blurred-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            z-index: 9998;
        }

        .buton h4 {
            padding-top: 20px;
        }

        button {
            margin-top: 10px;
            border: 2px solid #fff;
            padding: 1em 2em;
            border-radius: 3em;
            background-color: transparent;
            color: black;
            cursor: pointer;
        }

        .image-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .image-row .movie-link {
            width: calc(33.33% - 10px);
            padding-left: 160px;
            margin-right: 0.1%;
        }

        .image-row .movie-link img {
            width: 350px;
            height: 500px;
            border: 2px solid #000;
            border-radius: 5px;
        }
    </style>
</head>
<header class="header">
    <a href="Home.php" class="logo">B. Movies</a>

    <nav class="navbar">
        <a href="Home.php">Acceuil</a>
        <a href="Movies.php">Films</a>
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            echo '<a href="MyAccount.php">Mon Compte</a>';
        } else {
            echo '<a href="SignUp.php">Inscrivez-vous</a>';
        }
        ?>
        <form id="form">
            <input type="text" placeholder="Rechercher" id="search" class="search">
        </form>
    </nav>
</header>

<body>
    <div class="buton">
        <h3>Categories : </h3>
        <a href="get_movies_by_genre.php?genre=all"><button class="btn">All</button></a>
        <br>
        <a href="get_movies_by_genre.php?genre=Action"><button class="btn">Action</button></a>
        <br>
        <a href="get_movies_by_genre.php?genre=Drame"><button class="btn">Drame</button></a>
        <br>
        <a href="get_movies_by_genre.php?genre=Horreur"><button class="btn">Horreur</button></a>
        <br>
        <a href="get_movies_by_genre.php?genre=Science-Fiction"><button class="btn">SF</button></a>
        <br>
        <a href="get_movies_by_genre.php?genre=other"><button class="btn">Autres</button></a>
    </div>

    <?php
    if (isset($_GET['genre'])) {
        $genre = $_GET['genre'];

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

        if ($genre === 'all') {
            $sql = "SELECT IdFilm, poster, NomFilm FROM Films";
            $stmt = $pdo->query($sql);
        } else if ($genre === 'other') {
            $sql = "SELECT IdFilm, poster, NomFilm FROM Films WHERE Genre IN ('Guerre', 'Gangster', 'Animation', 'Super Hero', 'Thriller', 'Western', 'Comédie', 'Biographie', 'Crime', 'Fantastique', 'Mystère')";
            $stmt = $pdo->query($sql);
        } else {
            $sql = "SELECT IdFilm, poster, NomFilm FROM Films WHERE Genre = :genre";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
            $stmt->execute();
        }

        if ($stmt->rowCount() > 0) {
            echo '<div class="image-row">';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<a class="movie-link"><img src="Images/' . $row["poster"] . '" alt="' . $row["NomFilm"] . '"></a>';
            }
            echo '</div>';
        } else {
            echo "Aucun film trouvé pour ce genre.";
        }

        $pdo = null;
    }
    ?>
</body>
<footer class="footer" id="footer">
    <div class="container">
        <div class="row">
            <div class="footer-col">
                <h4>Company</h4>
                <ul>
                    <li><a href="#"></a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Get Help</h4>
                <ul>
                    <li><a href="#">About Us</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Mentions Légales</h4>
                <ul>
                    <li><a href="mentionL.php">Mentions Légales</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<script src="Detail.js"></script>
<script>
    $(document).ready(function() {
        $('#search').on('input', function() {
            var searchTerm = $(this).val().toLowerCase();
            var imagesFound = false;

            $('.movie-link').each(function() {
                var altText = $(this).find('img').attr('alt').toLowerCase();
                if (!altText.includes(searchTerm)) {
                    $(this).hide();
                } else {
                    imagesFound = true;
                    $(this).show();
                }
            });

            if (!imagesFound) {
                if ($('.image-row p').length === 0) {
                    $('.image-row').append('<p>Aucun résultat trouvé pour cette recherche.</p>');
                    $('#footer').css('position', 'fixed').css('bottom', '0');
                }
            } else {
                $('.image-row p').remove();
                $('#footer').css('position', 'static');
            }
        });
    });
</script>