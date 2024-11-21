<?php
session_start(); 
require 'conn.php'; 

function clean_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = clean_input($_POST['username']);
    $password = clean_input($_POST['password']);
    $funnyname = clean_input($_POST['funnyname']);

    if (!empty($username) && !empty($password)) {
        
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $existing_user = $stmt->fetch();

        if ($existing_user) {
            $_SESSION['error'] = "Deze gebruikersnaam is al in gebruik. Kies een andere.";
            header("Location: ../register.php");
            exit();
        }

        // Hash het wachtwoord voordat het in de database wordt opgeslagen
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (username, password, funnyname) VALUES (?, ?)");
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
