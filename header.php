<?php
session_start();
    if ($_SESSION['nom'] == null){
        header('location:index.php');
    }
include('fonc/connect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="dist/css/bootstrap.css" >
    <link href="style.css" rel="stylesheet">
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/icone.ico" />
    <title>Vie Chrétienne</title>
</head>
<body>

<div class="row entete">
    <div class="col hauteur">
        <div class="titre">
            <h4>Bienvenue <?php echo $_SESSION['nom'] ?> <?php echo $_SESSION['prenom'] ?></h4>
        </div>
        <div class="titre">
            <form method="post" action="fonc/deconnect.php">
                <button type="submit" class="btn btn-outline-danger">Déconnexion</button>
            </form>
        </div>
    </div>
</div>

<?php
    $iduser = $_SESSION['id'];
    $sqlmenu = "SELECT count(idUtilisateur) as nbre from Utilisateur where idUtilisateur = $iduser and Admin = 1";
    $requetemenu = $conn->query($sqlmenu);
    $donnemenu = $requetemenu->fetch_assoc();

    switch ($donnemenu['nbre']){
        case 0 : 
            include('menu/menu.php');
            break;
        case 1 : 
            include('menu/menu-admin.php');
            break;
    }
?>