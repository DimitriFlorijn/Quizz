<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
    <link rel="stylesheet" href=".css"> 
</head>
<header>
      <h1>maak een account aan</h1>
  </header>
  <nav>
     <a href="index.php">Home</a>
  </nav>
<body>
    <div class="login-container">
        <h2>Registreren</h2>
        
        <!-- Foutmeldingen weergeven als ze bestaan -->
        <?php
        if (isset($_SESSION['error'])) {
            echo "<p style='color: red;'>" . htmlspecialchars($_SESSION['error']) . "</p>";
            unset($_SESSION['error']); // Foutmelding één keer tonen
        }
        ?>

        <form action="backend/registerController.php" method="POST">
            <label for="username">Gebruikersnaam:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Wachtwoord:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Registreren</button>
        </form>

        <p>Al een account?<a href="inlog.php"> Log hier in</a></p>
    </div>
</body>
</html>
