<?php
    if(isset($_POST['valider'])){
        include('header.php');

        $tem = $_POST['temoignage'];
        $tem = $conn->real_escape_string($tem);
        $dterep = $_POST['rep'];
        $idsujet = $_POST['idsujet'];

        $sql = "UPDATE Sujet set 
        Temoignage = '$tem',
        ClotureDte = '$dterep',
        Repondu = true
        where idSujet = $idsujet";

        $requete = $conn->query($sql);
        header('location:../reponduok.php');
    }