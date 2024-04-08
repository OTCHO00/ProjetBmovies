<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>B. Movies</title>
    <link rel="stylesheet" type="text/css" href="Style/mention.css">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Libre+Baskerville:wght@700&display=swap" rel="stylesheet">
    <link rel="icon" type="image" href="Images/Logo.jpg">
</head>
<body>
    <header class="header">
        <a href="Home.php" class="logo">B. Movies</a>

        <nav class="navbar">
            <a href="Home.php">Acceuil</a>
            <a href="Movies.php">Films</a>
            <a href="Series.php">Series</a>
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

    <div class="mention-legale">
        <h2>Mentions Légales</h2>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac diam eget est commodo vehicula vel nec odio.
            Vestibulum tristique, nisl in fermentum fringilla, libero elit iaculis justo, eu cursus libero justo ac erat.
        </p>
        <p>
            Fusce consectetur orci vitae libero sodales, vel blandit dui luctus.
            Curabitur quis nunc vitae mi tincidunt malesuada nec quis turpis. Ut bibendum tortor ac mauris tristique, ut posuere justo tristique.
        </p>
        <p>
            Fusce consectetur orci vitae libero sodales, vel blandit dui luctus.
            Curabitur quis nunc vitae mi tincidunt malesuada nec quis turpis. Ut bibendum tortor ac mauris tristique, ut posuere justo tristique.
        </p>

        <h2>Hébergement</h2>
        <p>
            Nulla facilisi. Sed at consectetur mi. Nunc vel justo vitae augue viverra ultricies.
            In eu sapien at nulla tincidunt sodales. Aliquam vel luctus elit, sit amet ultricies est.
        </p>
        <p>Ceci est un paragraphe.</p>
        <br>
        <p>Ceci est un autre paragraphe, séparé par un saut de ligne.</p>
        <p>Ceci est un paragraphe.</p>
        <br>
        <p>Ceci est un autre paragraphe, séparé par un saut de ligne.</p>
        <p>Ceci est un paragraphe.</p>
        <br>
        <p>Ceci est un autre paragraphe, séparé par un saut de ligne.</p>
        <p>
            Fusce consectetur orci vitae libero sodales, vel blandit dui luctus.
            Curabitur quis nunc vitae mi tincidunt malesuada nec quis turpis. Ut bibendum tortor ac mauris tristique, ut posuere justo tristique.
        </p>
        <p>
            Fusce consectetur orci vitae libero sodales, vel blandit dui luctus.
            Curabitur quis nunc vitae mi tincidunt malesuada nec quis turpis. Ut bibendum tortor ac mauris tristique, ut posuere justo tristique.
        </p>

        <h2>Contact</h2>
        <p>
            Fusce consectetur orci vitae libero sodales, vel blandit dui luctus.
            Curabitur quis nunc vitae mi tincidunt malesuada nec quis turpis. Ut bibendum tortor ac mauris tristique, ut posuere justo tristique.
        </p>
        <p>
            Fusce consectetur orci vitae libero sodales, vel blandit dui luctus.
            Curabitur quis nunc vitae mi tincidunt malesuada nec quis turpis. Ut bibendum tortor ac mauris tristique, ut posuere justo tristique.
        </p>
        <p>
            Fusce consectetur orci vitae libero sodales, vel blandit dui luctus.
            Curabitur quis nunc vitae mi tincidunt malesuada nec quis turpis. Ut bibendum tortor ac mauris tristique, ut posuere justo tristique.
        </p>
        <p>
            Fusce consectetur orci vitae libero sodales, vel blandit dui luctus.
            Curabitur quis nunc vitae mi tincidunt malesuada nec quis turpis. Ut bibendum tortor ac mauris tristique, ut posuere justo tristique.
        </p>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="#"></a></li>
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
</body>
</html>
