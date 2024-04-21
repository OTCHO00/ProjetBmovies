<?php include '../Controler/PhotoProfil.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>B. Movies</title>
    <link rel="stylesheet" type="text/css" href="../Style/home.css">
    <link rel="icon" type="image" href="../Images/Logo.jpg">
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


    <script src="../JS/menu.js"></script>




</body>

</html>