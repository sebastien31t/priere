<?php
//Connexion base de données
#include '../header.php';
$servername = "127.0.0.1";
$username = "seb31t";
$password = "Bmwmpowerm3917=$*m";
$dbname = "priere";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>