<?php
include('../Model/db.inc.php');

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT HashedPassword, Salt FROM Utilisateurs WHERE Username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user) {
    $hashedPassword = hash('sha256', $password . $user['Salt']);

    if ($hashedPassword === $user['HashedPassword']) {
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;


        $response = ["success" => true];
    } else {
        $response = ["success" => false];
    }
} else {
    $response = ["success" => false];
}

header('Content-Type: application/json');
echo json_encode($response);
