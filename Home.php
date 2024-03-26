<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>B. Movies</title>
    <link rel="stylesheet" type="text/css" href="home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Libre+Baskerville:wght@700&display=swap" rel="stylesheet">
    
    <style>

    </style>

</head>

<body>
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




</body>

</html>