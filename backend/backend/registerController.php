<?php
session_start();
require 'conn.php'; 

// Functie om invoer schoon te maken en te valideren
function clean_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = clean_input($_POST['username']);
    $password = clean_input($_POST['password']);

    // Controleer of gebruikersnaam en wachtwoord zijn ingevuld
    if (!empty($username) && !empty($password)) {
             

        // Controleer of de gebruikersnaam al bestaat
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $existing_user = $stmt->fetch();

        if ($existing_user) {
            $_SESSION['error'] = "Deze gebruikersnaam is al in gebruik. Kies een andere.";
            header("Location: ../register.php");
            exit();
        }

        // Wachtwoord hashen en gebruiker opslaan in de database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        if ($stmt->execute([$username, $hashed_password])) {
            $_SESSION['success'] = "Registratie succesvol! Je kunt nu inloggen.";
            header("Location: ../login.php");
            exit();
        } else {
            $_SESSION['error'] = "Er ging iets mis tijdens het registreren. Probeer het opnieuw.";
            header("Location: ../register.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Vul alle velden in.";
        header("Location: ../register.php");
        exit();
    }
}
?>
