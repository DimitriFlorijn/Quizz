<?php
require_once 'conn.php';

$funnynames = $_POST['funnynames'];

$query = "INSERT INTO funnynames (funnyname)
VALUES(:funnynames)";

$statement = $conn->prepare($query);

$statement->execute([
    ":funnynames" => $funnynames]);

    header("location: ../funnyName.php" );
?>