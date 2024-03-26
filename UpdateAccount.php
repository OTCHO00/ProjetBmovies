<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if (isset($_POST['save_bio'])) {
        include 'db.inc.php';
        
        $userId = $_SESSION['username'];

        if (isset($_POST['bio'])) {
            $newBio = $_POST['bio'];

            $stmt = $pdo->prepare("UPDATE InfoUtilisateurs SET Bio = ? WHERE Username = ?");
            $stmt->execute([$newBio, $userId]);
            
            header("Location: MyAccount.php?success=bio_updated");
            exit;
        }
    } else {
        header("Location: MyAccount.php");
        exit;
    }
} else {
    header("Location: Login.html");
    exit;
}
?>
