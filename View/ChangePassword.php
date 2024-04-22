<?php
include '../Model/db.inc.php'; 

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $username = $_SESSION['username'];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_button'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];

        if (empty($current_password) || empty($new_password)) {
            echo "Veuillez remplir tous les champs.";
            exit;
        }

        $stmt = $conn->prepare("SELECT HashedPassword, Salt FROM Utilisateurs WHERE Username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['HashedPassword'];
            $salt = $row['Salt'];

            if (password_verify($current_password . $salt, $hashed_password)) {
                $regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/";
                if (preg_match($regex, $new_password)) {
                    $new_salt = bin2hex(random_bytes(32));
                    $new_hashed_password = password_hash($new_password . $new_salt, PASSWORD_DEFAULT);

                    $update_stmt = $conn->prepare("UPDATE Utilisateurs SET HashedPassword = ?, Salt = ? WHERE Username = ?");
                    $update_stmt->bind_param("sss", $new_hashed_password, $new_salt, $username);

                    if ($update_stmt->execute()) {
                        echo "Mot de passe mis à jour avec succès.";
                    } else {
                        echo "Erreur lors de la mise à jour du mot de passe.";
                    }
                } else {
                    echo "Le nouveau mot de passe ne respecte pas les critères requis.";
                }
            } else {
                echo "Mot de passe actuel incorrect.";
            }
        } else {
            echo "Utilisateur non trouvé.";
        }
    }
} else {
    echo "Vous devez être connecté pour accéder à cette fonctionnalité.";
}


?>
