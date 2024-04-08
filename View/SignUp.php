<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../Style/Login.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <title>Sign Up</title> 
    <link rel="icon" type="image" href="Images/Logo.jpg">
    <style>
        .error-message {
            color: red;
            padding-top: 10px;
            text-align: center;
        }
        
    </style>
</head>
<body>
    <header class="header">
        <a href="Home.php" class="logo">B. Movies</a>
  
        <nav class="navbar">
            <a href="Home.php">Acceuil</a>
            <a href="Movies.php">Films</a>
            <a href="Series.php">Series</a>
        </nav>
    </header>

    <div class="wrapper">
        <form id="signupForm" action="../Controler/connexion.php"  method="post"> 
            <h1>Sign Up</h1> 

            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <button type="submit" class="btn">Sign Up</button> 
        </form>

        <div class="register-link">
            <p>Vous avez déjà un compte ? <a href="Login.html">Connectez-vous</a></p>
        </div>

        <div id="errorMessage" class="error-message"></div>

        <script>
            document.getElementById('signupForm').addEventListener('submit', function(event) {
                event.preventDefault(); 

                var form = this;
                var formData = new FormData(form);
                var password = formData.get('password');

                
                if (!isValidPassword(password)) {
                    document.getElementById('errorMessage').textContent = "Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et faire plus de 6 caractères.";
                    document.getElementById('errorMessage').setAttribute('aria-invalid', 'true');
                    return;
                }

                
                fetch(form.action, {
                    method: form.method,
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        
                        window.location.href = "Home.php"; 
                    } else {
                        
                        document.getElementById('errorMessage').textContent = data.message;
                        document.getElementById('errorMessage').setAttribute('aria-invalid', 'true');
                    }
                })
                .catch(error => console.error('Error:', error));
            });

            
            function isValidPassword(password) {
                
                var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/;
                return regex.test(password);
            }
        </script>
    </div>
</body>
</html>
