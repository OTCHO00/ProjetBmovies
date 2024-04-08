<?php
session_start(); 

include('db.inc.php');

if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
    $response = ["success" => false, "message" => "All fields are required"];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response = ["success" => false, "message" => "Invalid email address"];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

$stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM Utilisateurs WHERE Username = ? OR AdresseMail = ?");
$stmt->execute([$username, $email]);
$result = $stmt->fetch();

if ($result['count'] > 0) {
    $response = ["success" => false, "message" => "Username or email already exists"];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

$salt = bin2hex(random_bytes(32));

$hashedPassword = hash('sha256', $password . $salt);

$date = date('Y-m-d H:i:s');

$insertSql = "INSERT INTO Utilisateurs (Username, HashedPassword, Salt, AdresseMail, DateInscription, RoleId) VALUES (?, ?, ?, ?, ?, ?)";
$insertStmt = $pdo->prepare($insertSql);

if ($insertStmt) {
    $defaultRoleId = 2;
    $insertStmt->bindValue(1, $username, PDO::PARAM_STR);
    $insertStmt->bindValue(2, $hashedPassword, PDO::PARAM_STR);
    $insertStmt->bindValue(3, $salt, PDO::PARAM_STR);
    $insertStmt->bindValue(4, $email, PDO::PARAM_STR);
    $insertStmt->bindValue(5, $date, PDO::PARAM_STR);
    $insertStmt->bindValue(6, $defaultRoleId, PDO::PARAM_INT);

    $insertStmt->execute();

    if ($insertStmt->rowCount() > 0) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username; 

        $response = ["success" => true, "message" => "User registered successfully"];
    } else {
        $response = ["success" => false, "message" => "Error creating user"];
    }

    $insertStmt->closeCursor();
} else {
    $response = ["success" => false, "message" => "Error preparing insert statement"];
}

header('Content-Type: application/json');
echo json_encode($response);
