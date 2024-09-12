<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    $msg = "Eerst inloggen voordat u verder kunt.";
    header("Location: ../login.php?msg=" . urlencode($msg));
    exit;
}

function logError($errorMessage) {
    error_log($errorMessage, 3, "../logs/errors.log");
}

function createUser($conn, $name, $password) {
    try {
        $query = "INSERT INTO Users (name, password) VALUES (:name, :password)";
        $statement = $conn->prepare($query);
        $statement->execute([
            ':name' => $name,
            ':password' => password_hash($password, PASSWORD_DEFAULT) // Hash het wachtwoord
        ]);
        return "Gebruiker succesvol aangemaakt.";
    } catch (PDOException $e) {
        logError("Fout bij het aanmaken van de gebruiker: " . $e->getMessage());
        return false;
    }
}

function updateMelding($conn, $id, $capaciteit, $prioriteit, $melder, $overige_info) {
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
        return "Melding succesvol bijgewerkt.";
    } catch (PDOException $e) {
        logError("Fout bij het bijwerken van de melding: " . $e->getMessage());
        return false;
    }
}

function deleteMelding($conn, $id) {
    try {
        $query = "DELETE FROM quizz WHERE id = :id";
        $statement = $conn->prepare($query);
        $statement->execute([':id' => $id]);
        return "Melding succesvol verwijderd.";
    } catch (PDOException $e) {
        logError("Fout bij het verwijderen van de melding: " . $e->getMessage());
        return false;
    }
}

function getMeldingen($conn) {
    try {
        $query = "SELECT * FROM meldingen";
        $statement = $conn->query($query);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        logError("Fout bij het ophalen van meldingen: " . $e->getMessage());
        return [];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'conn.php';
    $action = $_POST['action'] ?? '';
    
    switch ($action) {
        case 'create':
            $name = $_POST['name'] ?? '';
            $password = $_POST['password'] ?? '';
            $errors = [];

            if (empty($name)) {
                $errors[] = "Naam is verplicht.";
            }
            if (empty($password)) {
                $errors[] = "Wachtwoord is verplicht.";
            }

            if (empty($errors)) {
                $msg = createUser($conn, $name, $password);
                if ($msg) {
                    header("Location: index.php?msg=" . urlencode($msg));
                } else {
                    $_SESSION['error'] = "Fout bij het aanmaken van de gebruiker.";
                    header("Location: ../meldingen/index.php");
                }
                exit;
            } else {
                $_SESSION['errors'] = $errors;
                header("Location: ../meldingen/index.php");
                exit;
            }
            break;

        case 'update':
            $id = $_POST['id'] ?? null;
            $capaciteit = $_POST['capaciteit'] ?? null;
            $prioriteit = isset($_POST['prioriteit']) ? 1 : 0;
            $melder = $_POST['melder'] ?? '';
            $overige_info = $_POST['overige_info'] ?? '';
            $errors = [];

            if (empty($id) || !is_numeric($id)) {
                $errors[] = "Ongeldig ID.";
            }
            if (!is_numeric($capaciteit)) {
                $errors[] = "Capaciteit moet een nummer zijn.";
            }
            if (empty($melder)) {
                $errors[] = "Melder is verplicht.";
            }

            if (empty($errors)) {
                $msg = updateMelding($conn, $id, $capaciteit, $prioriteit, $melder, $overige_info);
                if ($msg) {
                    header("Location: ../meldingen/index.php?msg=" . urlencode($msg));
                } else {
                    $_SESSION['error'] = "Fout bij het bijwerken van de melding.";
                    header("Location: ../meldingen/index.php");
                }
                exit;
            } else {
                $_SESSION['errors'] = $errors;
                header("Location: ../meldingen/index.php");
                exit;
            }
            break;

        case 'delete':
            $id = $_POST['id'] ?? null;
            if (empty($id) || !is_numeric($id)) {
                $msg = "Ongeldig ID voor verwijdering.";
                header("Location: ../meldingen/index.php?msg=" . urlencode($msg));
                exit;
            }

            $msg = deleteMelding($conn, $id);
            if ($msg) {
                header("Location: ../meldingen/index.php?msg=" . urlencode($msg));
            } else {
                $_SESSION['error'] = "Fout bij het verwijderen van de melding.";
                header("Location: ../meldingen/index.php");
            }
            exit;
            break;

        default:
            $_SESSION['error'] = "Ongeldige actie.";
            header("Location: ../meldingen/index.php");
            exit;
    }
}
?>
