<?php include 'PhotoProfil.php'; ?>

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
                <a href="Series.php">Series</a>
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
                            <img src="<?php echo isset($user['PhotoProfil']) ? $user['PhotoProfil'] : 'Images/X.png'; ?>" alt="Profile Picture">
                            <h2><?php echo isset($user['Username']) ? $user['Username'] : ''; ?></h2>
                        </div>
                        <hr>

                        <a href="profil.php" class="link">
                            <img src="../Images/profile.png">
                            <p> Profile </p>
                        </a>
                        <a href="#" class="link">
                            <img src="../Images/setting.png">
                            <p> Aide & Support </p>
                        </a>
                        <a href="../Controler/Logout.php" class="link">
                            <img src="../Images/logout.png">
                            <p> Déconnexion </p>
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