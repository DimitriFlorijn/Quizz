<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inloggen</title>
    <link rel="stylesheet" href=".css"> 
</head>
<body>
    <header>
        <h1>Inloggen</h1>
    </header>

    <nav>
        <a href="index.php">Home</a>
    </nav>

    <main class="login-container">
        <h2>Login</h2>

        <?php
        session_start(); 
        if (isset($_SESSION['error'])) {
            echo "<p class='error-message'>" . htmlspecialchars($_SESSION['error']) . "</p>";
            unset($_SESSION['error']); 
        }
        ?>  

        <form action="start.php" method="POST">
            <div class="form-group">
                <label for="username">Gebruikersnaam:</label>
                <input 
                    type="text" 
                    id="username" 
                    name="username" 
                    required 
                    placeholder="Voer je gebruikersnaam in" 
                    aria-label="Gebruikersnaam invoeren"
                >
            </div>

            <div class="form-group">
                <label for="password">Wachtwoord:</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required 
                    placeholder="Voer je wachtwoord in" 
                    aria-label="Wachtwoord invoeren"
                >
            </div>

            <button type="submit" class="login">Login</button>
        </form>

        <p>Nog geen account? <a href="register.php">Maak er hier een</a>.</p>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> The Quizzler. Alle rechten voorbehouden.</p>
    </footer>
</body>
</html>
