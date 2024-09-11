<?php
session_start();

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    $msg = "Eerst inloggen voordat u verder kunt.";
    header("Location: ../login.php?msg=" . urlencode($msg));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'conn.php';

    // Verwerk de 'create' actie
    if ($_POST['action'] == 'create') {
        $name = $_POST['name'] ?? ''; 
        $description = $_POST['discription'] ?? ''; // Correct spelling to 'description'

        // Validatie van de input
        $errors = [];
        if (empty($name)) {
            $errors[] = "Naam is verplicht.";
        }
        if (empty($description)) {
            $errors[] = "Beschrijving is verplicht.";
        }

        if (empty($errors)) {
            // Voer de query uit om een nieuwe gebruiker toe te voegen
            try {
                $query = "INSERT INTO Users (name, description) VALUES (:name, :description)";
                $statement = $conn->prepare($query);
                $statement->execute([
                    ':name' => $name,
                    ':description' => $description
                ]);
                $msg = "Gebruiker succesvol aangemaakt.";
                header("Location: ../meldingen/index.php?msg=" . urlencode($msg));
                exit;
            } catch (PDOException $e) {
                $_SESSION['error'] = "Fout bij het aanmaken van de gebruiker: " . $e->getMessage();
                header("Location: ../meldingen/index.php");
                exit;
            }
        } else {
            $_SESSION['errors'] = $errors;
            header("Location: ../meldingen/index.php");
            exit;
        }
    }

    // Verwerk de 'update' actie
    if ($_POST['action'] == 'update') {
        $errors = [];
        $id = $_POST['id'] ?? null;
        $capaciteit = $_POST['capaciteit'] ?? null;
        $prioriteit = isset($_POST['prioriteit']) ? 1 : 0;
        $melder = $_POST['melder'] ?? '';
        $overige_info = $_POST['overige_info'] ?? '';

        // Validatie van de input
        if (empty($id) || !is_numeric($id)) {
            $errors[] = "Ongeldig ID.";
        }
        if (!is_numeric($capaciteit)) {
            $errors[] = "Capaciteit moet een nummer zijn.";
        }
        if (empty($melder)) {
            $errors[] = "Melder is verplicht.";
        }

        // Als er geen validatiefouten zijn, update de melding
        if (empty($errors)) {
            try {
                $query = "UPDATE meldingen SET capaciteit = :capaciteit, prioriteit = :prioriteit, melder = :melder, overige_info = :overige_info WHERE id = :id";
                $statement = $conn->prepare($query);
                $statement->execute([
                    ':capaciteit' => $capaciteit,
                    ':prioriteit' => $prioriteit,
                    ':melder' => $melder,
                    ':overige_info' => $overige_info,
                    ':id' => $id
                ]);
                $msg = "Melding succesvol bijgewerkt.";
                header("Location: ../meldingen/index.php?msg=" . urlencode($msg));
                exit;
            } catch (PDOException $e) {
                $_SESSION['error'] = "Fout bij het bijwerken van de melding: " . $e->getMessage();
                header("Location: ../meldingen/index.php");
                exit;
            }
        } else {
            $_SESSION['errors'] = $errors;
            header("Location: ../meldingen/index.php");
            exit;
        }
    }

    // Verwerk de 'delete' actie
    if ($_POST['action'] == 'delete') {
        $id = $_POST['id'] ?? null;

        // Validatie van de input
        if (empty($id) || !is_numeric($id)) {
            $msg = "Ongeldig ID voor verwijdering.";
            header("Location: ../meldingen/index.php?msg=" . urlencode($msg));
            exit;
        }

        // Verwijder de melding uit de database
        try {
            $query = "DELETE FROM quizz WHERE id = :id";
            $statement = $conn->prepare($query);
            $statement->execute([':id' => $id]);

            $msg = "Melding succesvol verwijderd.";
            header("Location: ../meldingen/index.php?msg=" . urlencode($msg));
            exit;
        } catch (PDOException $e) {
            $_SESSION['error'] = "Fout bij het verwijderen van de melding: " . $e->getMessage();
            header("Location: ../meldingen/index.php");
            exit;
        }
    }
}
?>
