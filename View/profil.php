<?php include '../Controler/PhotoProfil.php'; ?>
<?php include 'ChangePassword.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B.Movies</title>
    <link rel="stylesheet" href="../Style/profil.css">
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
                        <img src="<?php echo isset($user['PhotoProfil']) ? $user['PhotoProfil'] : '../Images/X.png'; ?>" alt="Profile Picture">
                        <h2><?php echo isset($user['Username']) ? $user['Username'] : ''; ?></h2>
                    </div>
                    <hr>

                    <a href="profil.php" class="link">
                        <img src="../Images/profile.png">
                        <p> Profile </p>
                    </a>
                    <a href="favorite-movies.php" class="link">
                        <img src="../Images/fav.png">
                        <p>Likes</p>
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
    <div class="container">
        <div class="hero">
            <div class="card">
                <h1><?php echo isset($user['Username']) ? $user['Username'] : ''; ?></h1>
                <img src="<?php echo isset($user['PhotoProfil']) ? $user['PhotoProfil'] : '../Images/X.png'; ?>" class="profil-pic">
                <label for="file-input">Changer Photo de Profil</label>
                <form id="upload-form" method="post" enctype="multipart/form-data">
                    <input type="file" name="profile_picture" id="file-input" accept="image/jpeg, image/png, image/jpg" class="input-file">
                </form>
            </div>
        </div>

        <div class="hero2">
            <div class="card">
                <h2>Profil</h2>
                </br>
                <div class="input-box">
                    <input type="text" id="username" name="username" placeholder="Username" value="<?php echo isset($user['Username']) ? $user['Username'] : ''; ?>">
                    <i class='bx bxs-user'></i>
                </div>
                </br>
                <div class="input-box">
                    <input type="email" id="email" name="email" placeholder="E-mail" value="<?php echo isset($user['AdresseMail']) ? $user['AdresseMail'] : ''; ?>">
                    <i class='bx bxs-lock-alt'></i>
                </div>

                <h2>Mot de Passe</h2>
                </br>
                <div class="input-box">
                    <input type="password" id="current_password" name="password" placeholder="Mot de Passe">
                    <i class='bx bxs-lock-alt'></i>
                </div>
                </br>
                <div class="input-box">
                    <input type="password" id="new_password" name="Newpassword" placeholder="Nouveau Mot de Passe">
                    <i class='bx bxs-lock-alt'></i>
                </div>
            </div>
        </div>
    </div>

    <div class="Save">
        <button id="save-button" class="pill">Sauvegarder</button>
    </div>

    <script src="../JS/menu.js"></script>
    <script src="../JS/PP.js"></script>
    <script>
        document.getElementById('save-button').addEventListener('click', function() {
            document.getElementById('upload-form').submit();
        });
    </script>


</body>

</html>