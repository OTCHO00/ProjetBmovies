<?php
session_start();

include '../Model/db.inc.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $username = $_SESSION['username'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_picture'])) {
        $file_name = $_FILES['profile_picture']['name'];
        $file_tmp = $_FILES['profile_picture']['tmp_name'];
        $file_type = $_FILES['profile_picture']['type'];

        $upload_dir = "../Images/";
        $target_file = $upload_dir . basename($file_name);

        if (move_uploaded_file($file_tmp, $target_file)) {
            $query = "UPDATE Utilisateurs SET PhotoProfil = ? WHERE Username = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$target_file, $username]);
        } else {
            echo "Erreur lors du téléchargement du fichier.";
        }
    }

    // Modifier la requête SQL pour inclure RoleId
    $query = "SELECT Username, AdresseMail, PhotoProfil, RoleId FROM Utilisateurs WHERE Username = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
}
?>
