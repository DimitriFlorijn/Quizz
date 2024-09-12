<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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

  <div class="login-container">
      <h2>Login</h2>

      <?php
      session_start(); 
      if (isset($_SESSION['error'])) {
          echo "<p style='color: red;'>" . htmlspecialchars($_SESSION['error']) . "</p>";
          unset($_SESSION['error']); 
      }
      ?>

      <form action="backend/loginController.php" method="POST">
          <label for="username">Gebruikersnaam:</label><br>
          <input type="text" id="username" name="username" required placeholder="Voer je gebruikersnaam in"><br><br>

          <label for="password">Wachtwoord:</label><br>
          <input type="password" id="password" name="password" required placeholder="Voer je wachtwoord in"><br><br>

          <button type="submit">Login</button>
      </form>

      <p>Nog geen account? <a href="register.php">Maak hier een aan</a>.</p>
  </div>

  <footer>
        <p>&copy; The Quizzler</p>
  </footer>
</body>
</html>
