<?php 

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'industrial_instruments';
$mysqli = new mysqli($servername, $username, $password, $dbname);
//Vérification de la connexion
if ($mysqli->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}
?>