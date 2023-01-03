<?php
    include('header.php');
        $eglise = $_SESSION['idxEglise'];
        $cle = $_POST['choix'];
        $sqlajoutser = "INSERT into Services (idxServiceDes,idxEglise) values ($cle,$eglise)";
        $requeteajout = $conn->query($sqlajoutser);
        header('location:creerservice.php');
        //echo $sqlajoutser;
