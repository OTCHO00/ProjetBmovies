<?php include '../Controler/PhotoProfil.php'; ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>B. Movies - Films par genre</title>
    <link rel="stylesheet" type="text/css" href="../Style/Films.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" type="image" href="Images/Logo.jpg">
</head>
<header class="header">
        <a href="Home.php" class="logo">B. Movies</a>

        <nav class="navbar">
            <a href="Home.php">Accueil</a>
            <a href="Movies.php">Films</a>
            <a href="Series.php">Séries</a>

            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                echo '<img src="' . (isset($user['PhotoProfil']) ? $user['PhotoProfil'] : '../Images/X.png') . '" class="user-pic" onclick="toggleMenu()">';
            } else {
                echo '<a href="SignUp.php">Inscrivez-vous</a>';
            }
            ?>

            <div class="sub-menu-wrap" id="subMenu">
                <div class="sub-menu">
                    <div class="user-info">
                        <img src="<?php echo isset($user['PhotoProfil']) ? $user['PhotoProfil'] : '../Images/X.png'; ?>" alt="Photo de profil">
                        <h2><?php echo isset($user['Username']) ? $user['Username'] : ''; ?></h2>
                    </div>
                    <hr>

                    <?php
                    if (isset($user['RoleId'])) {
                        $roleId = $user['RoleId'];

                        // Utilisation de $roleId pour conditionner le comportement de l'interface
                        if ($roleId == 1) {
                            // L'utilisateur a le rôle d'administrateur
                            echo '<a href="User.php" class="link">
                                    <img src="../Images/profile.png">
                                    <p> Administrateur</p>
                                </a>
                                <a href="favorite-movies.php" class="link">
                                    <img src="../Images/fav.png">
                                    <p>Ajouter</p>
                                </a>';
                                            } else {
                                                // L'utilisateur a un rôle standard
                                                echo '<a href="profil.php" class="link">
                                    <img src="../Images/profile.png">
                                    <p>Profile</p>
                                </a>
                                <a href="favorite-movies.php" class="link">
                                    <img src="../Images/fav.png">
                                    <p>Likes</p>
                                </a>';
                        }
                    }
                    ?>

                    <a href="../Controler/Logout.php" class="link">
                        <img src="../Images/logout.png">
                        <p>Déconnexion</p>
                    </a>
                </div>
            </div>

            <form id="form">
                <input type="text" placeholder="Rechercher" id="search" class="search">
            </form>
        </nav>
    </header>

<body>
    <div class="buton">
        <h3>Categories : </h3>
        <a href="get_series_by_genre.php?genre=all"><button class="btn">All</button></a>
        <br>
        <a href="get_series_by_genre.php?genre=Action"><button class="btn">Action</button></a>
        <br>
        <a href="get_series_by_genre.php?genre=Drame"><button class="btn">Drame</button></a>
        <br>
        <a href="get_series_by_genre.php?genre=Horreur"><button class="btn">Horreur</button></a>
        <br>
        <a href="get_series_by_genre.php?genre=Science-Fiction"><button class="btn">SF</button></a>
        <br>
        <a href="get_series_by_genre.php?genre=other"><button class="btn">Autres</button></a>
    </div>

    <?php
    if (isset($_GET['genre'])) {
        $genre = $_GET['genre'];

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

        if ($genre === 'all') {
            $sql = "SELECT IdSerie, poster, NomSerie FROM Series";
            $stmt = $pdo->query($sql);
        } else if ($genre === 'other') {
            $sql = "SELECT IdSerie, poster, NomSerie FROM Series WHERE Genre IN ('Guerre', 'Gangster', 'Animation', 'Super Hero', 'Thriller', 'Western', 'Comédie', 'Biographie', 'Crime', 'Fantastique', 'Mystère')";
            $stmt = $pdo->query($sql);
        } else {
            $sql = "SELECT IdSerie, poster, NomSerie FROM Series WHERE Genre = :genre";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
            $stmt->execute();
        }

        if ($stmt->rowCount() > 0) {
            echo '<div class="image-row">';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<a class="movie-link"><img src="../Series/' . $row["poster"] . '" alt="' . $row["NomSerie"] . '"></a>';
            }
            echo '</div>';
        } else {
            echo "Aucune Serie trouvé pour ce genre.";
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
<script src="../JS/DetailSerie.js"></script>
<script src="../JS/search.js"></script>
<script src="../JS/menu.js"></script>
