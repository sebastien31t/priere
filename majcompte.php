<?php 
    session_start();
    include('fonc/connect.php');
    $iduser = $_SESSION['id'];
    $nom = $_POST['nom'];
    $nom = $conn->real_escape_string($nom);
    $prenom = $_POST['prenom'];
    $prenom = $conn->real_escape_string($prenom);
    $mail = $_POST['mail'];
    $mail = $conn->real_escape_string($mail);
    $telephone = $_POST['telephone'];
    $telephone = $conn->real_escape_string($telephone);

    $sqlmajinfo = "UPDATE Utilisateur set 
    nom = '$nom',
    Prenom = '$prenom',
    Mail = '$mail',
    Telephonne = '$telephone'
    where idUtilisateur = $iduser";

    if ($requetemaj = $conn->query($sqlmajinfo)){
        header('location:compte.php');
    } 
?>