<?php
include '../Model/db.inc.php';
include '../Controler/PhotoProfil.php'; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Liste des Utilisateurs</title>
    <link rel="stylesheet" type="text/css" href="../Style/Admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Libre+Baskerville:wght@700&display=swap" rel="stylesheet">
    <link rel="icon" type="image" href="Images/Logo.jpg">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        th {
            padding: 10px;
            /* Ajoute un espace intérieur de 10 pixels */
        }
    </style>
    <script>
        $(document).ready(function() {
            // Chargement des utilisateurs au chargement de la page
            $.ajax({
                url: '../Model/get_users.php',
                method: 'GET',
                success: function(response) {
                    var users = response;
                    var tableBody = $('#users-table tbody');

                    users.forEach(function(user) {
                        var row = '<tr>' +
                            '<td>' + user.Username + '</td>' +
                            '<td>' + user.AdresseMail + '</td>' +
                            '<td><button class="delete-user" data-userid="' + user.Username + '">Supprimer</button></td>' +
                            '</tr>';
                        tableBody.append(row);
                    });

                    // Gestion de la suppression d'utilisateur
                    $('.delete-user').on('click', function() {
                        var username = $(this).data('userid');
                        if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
                            $.ajax({
                                url: '../Model/delete_user.php',
                                method: 'POST',
                                data: {
                                    username: username
                                },
                                success: function(deleteResponse) {
                                    alert('Utilisateur supprimé avec succès.');
                                    // Recharger la liste des utilisateurs
                                    location.reload();
                                },
                                error: function(xhr, status, error) {
                                    console.error('Erreur lors de la suppression de l\'utilisateur :', error);
                                }
                            });
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Erreur lors du chargement des utilisateurs :', error);
                }
            });
        });
    </script>
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

    <div class="container">
        <h1>Liste des Utilisateurs</h1>
        <table id="users-table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th></th> 
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</body>
<script src="../JS/search.js"></script>
<script src="../JS/menu.js"></script>
</html>