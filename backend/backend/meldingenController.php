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

class FunnyNameController
{
    private $db;
    public function __construct($dbConnection)
    {
        $this->db = $dbConnection;
    }
    public function getFunnyNames()
    {
        try {
            $sql = "SELECT funnyname FROM funnyname";
            $result = $this->db->query($sql);

            $funnyNames = [];
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $funnyNames[] = $row['funnyname'];
                }
            }
            return $funnyNames;
        } catch (Exception $e) {
            logError("Fout bij het ophalen van funny names: " . $e->getMessage());
            return [];
        }
    }
    public function createUser($name, $password, $funnyname)
    {
        try {
            $query = "INSERT INTO users (name, password, funnyname) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("sss", $name, $password, $funnyname);
            $stmt->execute();
            return "Gebruiker succesvol aangemaakt.";
        } catch (Exception $e) {
            logError("Fout bij het aanmaken van de gebruiker: " . $e->getMessage());
            return false;
        }
    }
    public function showFunnyNames()
    {
        $funnyNames = $this->getFunnyNames();
        include '../funnyName.php';
    }
}
?>
