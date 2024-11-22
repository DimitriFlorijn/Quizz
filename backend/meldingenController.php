<?php
require_once 'conn.php';

$funnynames = $_POST['funnynames'];

echo $funnynames;

$query = "INSERT INTO funnynames (funnynames)
VALUES(:funnynames)";

$statement = $conn->prepare($query);

$statement->execute([
    ":funnynames" => $funnynames]);

$funnynames = $statement->fetch(PDO::FETCH_ASSOC);
echo "<h1>{$funnynames['funnynames']}</h1>";


?>