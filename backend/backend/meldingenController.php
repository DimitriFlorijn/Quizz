<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    $msg = "eerst inloggen voordat je kan zien wat u heeft";
    header("Location: ../login.php?msg=" . urlencode($msg)); // urlencode() voor veilige URL-passing
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'conn.php';

    // Actie verwerken
    if ($_POST['action'] == 'create') {
        $name = $_POST['name'] ?? ''; 
        $discription = $_POST['discription'] ?? ''; 

        // Validatie
        $errors = [];
        if (empty($name)) {
            $errors[] = "naam is verplicht.";
        }
        if (empty($beschrijving)) {
            $errors[] = "Beschrijving is verplicht.";
        }

        if (empty($errors)) {
            $query = "INSERT INTO Users (name, discription) VALUES (:name, :discription)";
            $statement = $conn->prepare($query);
            $statement->execute([
                ':name' => $name,
                ':discription' => $discription
            ]);
            $msg = "Gebruiker succesvol aangemaakt";
            header("Location: ../meldingen/index.php?msg=" . urlencode($msg));
            exit;
        }
    }

    if ($_POST['action'] == 'update') {
        $errors = [];
        $id = $_POST['id'] ?? null;
        $capaciteit = $_POST['capaciteit'] ?? null;
        $prioriteit = isset($_POST['prioriteit']) ? 1 : 0;
        $melder = $_POST['melder'] ?? '';
        $overige_info = $_POST['overige_info'] ?? '';

        if (empty($id) || !is_numeric($id)) {
            $errors[] = "Ongeldige ID.";
        }
        if (!is_numeric($capaciteit)) {
            $errors[] = "Capaciteit moet een nummer zijn.";
        }
        if (empty($melder)) {
            $errors[] = "Melder is verplicht.";
        }

        // Als er geen fouten zijn, update de record
        if (empty($errors)) {
            $query = "UPDATE meldingen SET capaciteit = :capaciteit, prioriteit = :prioriteit, melder = :melder, overige_info = :overige_info WHERE id = :id";
            $statement = $conn->prepare($query);
            $statement->execute([
                ':capaciteit' => $capaciteit,
                ':prioriteit' => $prioriteit,
                ':melder' => $melder,
                ':overige_info' => $overige_info,
                ':id' => $id
            ]);
            $msg = "Melding succesvol bijgewerkt";
            header("Location: ../meldingen/index.php?msg=" . urlencode($msg));
            exit;
        }
    }

    if ($_POST['action'] == 'delete') {
        $id = $_POST['id'] ?? null;

        // Validatie
        if (empty($id) || !is_numeric($id)) {
            $msg = "Ongeldige ID voor verwijdering.";
            header("Location: ../meldingen/index.php?msg=" . urlencode($msg));
            exit;
        }

        // Verwijderen uit database
        $query = "DELETE FROM quizz WHERE id = :id";
        $statement = $conn->prepare($query);
        $statement->execute([':id' => $id]);

        $msg = "Melding succesvol verwijderd";
        header("Location: ../meldingen/index.php?msg=" . urlencode($msg));
        exit;
    }
}
?>
