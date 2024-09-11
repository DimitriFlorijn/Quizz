<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homescreen</title>
    <link rel="stylesheet" href=".css"> 
</head>
<body>
   <header>
      <h1>inloggen</h1>
  </header>

  

  <nav>
     <a href="index.php">Home</a>
  </nav>

  <!-- Formulier voor gebruikersinlog -->
  <form action="login.php" method="POST"> <!-- Zorg ervoor dat je formulier een actie en methode heeft -->
      <label for="username">Gebruikersnaam:</label><br>
      <input type="text" id="username" name="username" required><br><br>

      <label for="password">Wachtwoord:</label><br>
      <input type="password" id="password" name="password" required><br><br>

      <input type="submit" value="Login">
  </form>

  <p>Nog geen account?<a href="register.php"> Maak hier een aan.</a></p>

  <footer>
        <p>&copy; The Quizzler</p>
  </footer>
</body>
</html>
