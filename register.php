
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
    <link rel="stylesheet" href=".css">
</head>
<body>
    <div class="login-container">
        <h2>Registreren</h2>
        
        <!-- Foutmeldingen weergeven als ze bestaan -->
        
        <form action="backend/registerController.php" method="POST">
            <label for="username">Gebruikersnaam:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Wachtwoord:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Registreren</button>
            <h2></h2>
        </form>
        
        <a href="inlog.php">al een account? Log hier in</a>
    </div>
</body>
</html>
