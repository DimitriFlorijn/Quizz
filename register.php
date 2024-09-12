<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
    <link rel="stylesheet" href=".css"> 
</head>
<body>

<header>
    <h1>Maak een account aan</h1>
</header>

<nav>
    <a href="index.php">Home</a>
</nav>

<div class="register-container">
    <h2>Registreren</h2>
    
    <?php
    session_start(); 
    if (isset($_SESSION['error'])) {
        echo "<p style='color: red;'>" . htmlspecialchars($_SESSION['error']) . "</p>";
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
        echo "<p style='color: green;'>" . htmlspecialchars($_SESSION['success']) . "</p>";
        unset($_SESSION['success']); 
    }
    ?>

    <form action="backend/registerController.php" method="POST">
        <label for="username">Gebruikersnaam:</label>
        <input type="text" id="username" name="username" required maxlength="50" placeholder="Voer je gebruikersnaam in">

        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" required minlength="8" placeholder="Voer je wachtwoord in">

        <button type="submit">Registreren</button>
    </form>

    <p>Al een account? <a href="inlog.php">Log hier in</a></p>
</div>

</body>
</html>
