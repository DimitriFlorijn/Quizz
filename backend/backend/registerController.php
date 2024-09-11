<?php
session_start();
require 'conn.php'; // Database-verbinding maken

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $existing_user = $stmt->fetch();

        if ($existing_user) {
            $_SESSION['error'] = "Deze gebruikersnaam bestaat al. Kies een andere.";
            header("Location: ../register.php");
            exit();
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $hashed_password]);

        header("Location: ../login.php");
        exit();
    } else {
        $_SESSION['error'] = "Vul alle velden in.";
        header("Location: ../register.php");
        exit();
    }
}
?>
