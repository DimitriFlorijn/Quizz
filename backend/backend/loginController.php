<?php
session_start();
require 'conn.php'; 

function clean_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Functie om inlogpogingen te beperken (brute-force bescherming)
function limit_login_attempts($pdo, $username) {
    $stmt = $pdo->prepare("SELECT attempts, last_attempt FROM login_attempts WHERE username = ?");
    $stmt->execute([$username]);
    $attempt = $stmt->fetch();

    if ($attempt) {
        $current_time = time();
        $time_difference = $current_time - strtotime($attempt['last_attempt']);

        // Reset pogingen na 15 minuten
        if ($time_difference > 900) {
            $stmt = $pdo->prepare("UPDATE login_attempts SET attempts = 0 WHERE username = ?");
            $stmt->execute([$username]);
            return false;
        }

        // Blokkeer inlog als er 5 pogingen zijn binnen 15 minuten
        if ($attempt['attempts'] >= 5) {
            return true;
        }
    }
    return false;
}

// Functie om mislukte inlogpoging te registreren
function record_failed_login($pdo, $username) {
    $stmt = $pdo->prepare("SELECT * FROM login_attempts WHERE username = ?");
    $stmt->execute([$username]);
    $attempt = $stmt->fetch();

    if ($attempt) {
        $stmt = $pdo->prepare("UPDATE login_attempts SET attempts = attempts + 1, last_attempt = NOW() WHERE username = ?");
        $stmt->execute([$username]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO login_attempts (username, attempts, last_attempt) VALUES (?, 1, NOW())");
        $stmt->execute([$username]);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = clean_input($_POST['username']);
    $password = clean_input($_POST['password']);

    if (!empty($username) && !empty($password)) {

        // Beperk het aantal inlogpogingen
        if (limit_login_attempts($pdo, $username)) {
            $_SESSION['error'] = "Te veel mislukte inlogpogingen. Probeer het over 15 minuten opnieuw.";
            header("Location: ../login.php");
            exit();
        }

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Reset inlogpogingen na succesvolle login
            $stmt = $pdo->prepare("DELETE FROM login_attempts WHERE username = ?");
            $stmt->execute([$username]);

            
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['id']; 
            header("Location: ../dashboard.php");
            exit();
        } else {
            // Registreer mislukte inlogpoging
            record_failed_login($pdo, $username);
            $_SESSION['error'] = "Ongeldige gebruikersnaam of wachtwoord."; 
            header("Location: ../login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Vul alle velden in.";
        header("Location: ../login.php");
        exit();
    }
}
?>
