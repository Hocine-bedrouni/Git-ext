<?php
$host = "localhost";
$db = "jarditou";
$user = "root";
$pass = "";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset"; /*data source name*/ 

/*try to connect, if it doesn't work, display an error message*/
try {
    $pdo = new PDO($dsn, $user, $pass);
    echo "<p class='text-success'>Connexion to the database was successful !</p>";
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "<p class='text-danger'>Connexion to the database was unsuccessful !</p>";
    // throw new PDOException($e->getMessage()); /*throw will stop all executions and display a php error*/
}

?>