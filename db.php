<?php
$host = 'mysql-ghernaia.alwaysdata.net';
$dbname = 'ghernaia_adoptus'; 
$user = 'ghernaia';            
$password = 'event!asso14'; // TON MOT DE PASSE ALWAYS DATA

// Connexion MySQLi
$mysqli = new mysqli($host, $user, $password, $dbname);
if ($mysqli->connect_error) {
    die('Erreur de connexion MySQLi : ' . $mysqli->connect_error);
}

// Connexion PDO
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $password, $options);
} catch (PDOException $e) {
    die("Erreur de connexion PDO : " . $e->getMessage());
}
