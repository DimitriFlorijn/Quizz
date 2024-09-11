<?php
session_start();
require 'conn.php'; // Verbind met de database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Haal de gebruikersgegevens op uit de database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        header("Location: ../dashboard.php");
        exit();
    } else {
        $_SESSION['error'] = "Ongeldige gebruikersnaam of wachtwoord."; 
        header("Location: ../login.php");
        exit();
    }
}
?>
