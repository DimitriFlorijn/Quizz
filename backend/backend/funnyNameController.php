<?php

class FunnyNameController
{
    private $db;

    // Constructor: Initialiseer databaseverbinding
    public function __construct($dbConnection)
    {
        $this->db = $dbConnection;
    }

    // Functie om "funny names" op te halen uit de database
    public function getFunnyNames()
    {
        $sql = "SELECT funnyname FROM funnyname";
        $result = $this->db->query($sql);

        $funnyNames = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $funnyNames[] = $row['funnyname'];
            }
        }

        return $funnyNames;
    }

    // Functie om de view te laden
    public function showFunnyNames()
    {
        $funnyNames = $this->getFunnyNames();
        include 'funnyName.php';
    }
}
