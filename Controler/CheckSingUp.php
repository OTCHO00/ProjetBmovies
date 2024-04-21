<?php
include '../Model/db.inc.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id FROM utilisateurs WHERE Username = ? AND Password = ?");
    $stmt->execute([$username, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: MyAccount.php");
        exit;
    } else {
        header("Location: Login.html?error=invalid_credentials");
        exit;
    }
} else {
    header("Location: Login.html");
    exit;
}
?>
