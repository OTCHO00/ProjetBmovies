<?php include '../Controler/PhotoProfil.php'; ?>
<?php include '../Model/serie.inc.php'; ?>                          

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>B. Movies</title>
    <link rel="stylesheet" type="text/css" href="../Style/Films.css">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Libre+Baskerville:wght@700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" type="image" href="../Images/Logo.jpg">
    <?php
    // Vérifier si le rôle de l'utilisateur est défini
    if (isset($user['RoleId'])) {
        $roleId = $user['RoleId'];

        // Conditionner le chargement du script en fonction du rôle
        if ($roleId == 1) {
            // Si le rôle est égal à 1 (Admin), inclure DetailAdmin.js
            echo '<script src="../JS/DetailSerieAdmin.js"></script>';
        } else {
            // Sinon, inclure Detail.js par défaut
            echo '<script src="../JS/Detail.js"></script>';
        }
    }
    ?>
</head>

<body>
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
    <script src="../JS/search.js"></script>
    <script src="../JS/menu.js"></script>


</body>

</html>