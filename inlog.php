<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>homescreen</title>
    <link rel="stylesheet" href=".css">
</head>
<body>
   <header>
      <h1>Welkom tot de quizz</h1>
  </header>
  <?php
    $QuizzAchievmentNumber;
  ?>
  <nav>
     <a href="index.php">Home</a>
  </nav>
  <label for="username">Gebruikersnaam:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Wachtwoord:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Login">
        <a href="register.php">nog geen accountn? maak hier aan</a>

  

  <footer>
        <p>&copy; the quizzler</p>
  </footer>
</body>


</html>

