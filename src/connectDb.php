<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test connexion à la base de donnée</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    
</body>
</html>
<?php 
$host = 'db';
$username = 'root';
$password = 'root';
$database = 'phpdb';

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    die("Good connecté à la base de donnée ;-)");
} catch (PDOException $e) {
    echo "Ho ho Connection failed !!! => " . $e->getMessage();
    die();
}

?>
