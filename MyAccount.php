<?php
include 'db.inc.php';
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $userId = $_SESSION['username'];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_bio'])) {
        var_dump($_POST);
        if (isset($_POST['bio'])) {
            $newBio = $_POST['bio'];

            $stmt = $pdo->prepare("UPDATE InfoUtilisateurs SET Bio = ? WHERE Username = ?");
            $stmt->execute([$newBio, $userId]);

            header("Location: MyAccount.php");
            exit;
        }
    }

    $stmt = $pdo->prepare("SELECT Username, AdresseMail FROM utilisateurs WHERE Username = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmtInfo = $pdo->prepare("SELECT DateNaissance, Bio, Pays, Phone FROM InfoUtilisateurs WHERE Username = ?");
    $stmtInfo->execute([$userId]);
    $userInfo = $stmtInfo->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $username = $user['Username'];
        $email = $user['AdresseMail'];
        $nom = ''; 
        if (isset($userInfo['NomUtilisateur'])) {
            $nom = $userInfo['NomUtilisateur'];
        }
        $bio = isset($userInfo['Bio']) ? $userInfo['Bio'] : '';
        $pays = isset($userInfo['Pays']) ? $userInfo['Pays'] : '';
        $phone = isset($userInfo['Phone']) ? $userInfo['Phone'] : '';
    } else {
    }
} else {
    header("Location: Login.html");
    exit;
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>B. Movies</title>
    <link rel="stylesheet" type="text/css" href="MyAccount.css">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Libre+Baskerville:wght@700&display=swap" rel="stylesheet">
    <link rel="icon" type="image" href="Images/Logo.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1b1d1f;
        }

        header a:hover {
            color: #ffffff;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <header class="header">
        <a href="Home.php" class="logo">B. Movies</a>

        <nav class="navbar">
            <a href="Home.php">Acceuil</a>
            <a href="Movies.php">Films</a>
            <a href="MyAccount.php">Mon Compte</a>
            <form id="form">
                <input type="text" placeholder="Search" id="search" class="search">
            </form>
        </nav>
    </header>
    <div class="container light-style flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4" style="color:white;">
            My Account
        </h4>
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change password</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-info">Info</a>
                        <a class="list-group-item list-group-item-action" href="Logout.php">Déconnexion</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general">
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control mb-1" name="username" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>
">
                                </div>
                                <form id="profileForm" action="MyAccount.php" method="post">
                                    <div class="form-group">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="nom" value="<?php echo htmlspecialchars($nom); ?>">
                                    </div>
                                </form>
                                <div class="form-group">
                                    <label class="form-label">E-mail</label>
                                    <input type="text" class="form-control mb-1" name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>
">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-change-password">
                            <div class="card-body pb-2">
                                <div class="form-group">
                                    <label class="form-label">Current password</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">New password</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Repeat new password</label>
                                    <input type="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-info">
                            <div class="card-body pb-2">
                                <form id="profileForm" action="MyAccount.php" method="post">
                                    <div class="form-group">
                                        <label class="form-label">Bio</label>
                                        <textarea class="form-control" rows="5" name="bio"><?php echo isset($bio) ? htmlspecialchars($bio) : ''; ?></textarea>
                                    </div>
                                </form>
                                <form id="profileForm" action="MyAccount.php" method="post">
                                    <div class="form-group">
                                        <label class="form-label">Pays</label>
                                        <input type="text" class="form-control" name="pays" value="<?php echo htmlspecialchars($pays); ?>">
                                    </div>
                                </form>
                            </div>
                            <hr class="border-light m-0">
                            <form id="profileForm" action="MyAccount.php" method="post">
                                <div class="card-body pb-2">
                                    <div class="form-group">
                                        <label class="form-label">Phone</label>
                                        <input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form id="profileForm" action="MyAccount.php" method="post">
            <div class="text-right mt-3">
                <button type="submit" name="save_bio" class="btn btn-primary" style="background-color: rgb(0, 0, 0); border-color: rgb(0, 0, 0); color: white;">Save changes</button>
                <button type="button" class="btn btn-default" style="color:white;">Cancel</button>
            </div>
        </form>

    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">

    </script>
</body>

</html>