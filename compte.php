<?php
    include('header.php');

    $iduser = $_SESSION['id'];

    $sqlutilisateur = "SELECT u.idUtilisateur, u.nom, u.Prenom, u.Mail, u.Telephonne, u.Admin, u.idxEglise, e.NomEglise
    from Utilisateur as u
    join Eglise as e on u.idxEglise = e.idEglise
    Where u.idUtilisateur = $iduser";

    $requeteuser = $conn->query($sqlutilisateur);
    $donneuser = $requeteuser->fetch_assoc();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 ">
            <h4>Informations personnelles</h4>
            <!-- <form action="majcompte.php" method="post"> -->
                <input type="text" id="nom" name="nom" value="<?php echo $donneuser['nom'] ?>" class="form-control text-center">
                <input type="text" id="prenom" name="prenom" value="<?php echo $donneuser['Prenom'] ?>" class="form-control text-center inh">
                <input type="text" id="mail" name="mail" value="<?php echo $donneuser['Mail'] ?>" class="form-control text-center inh">
                <input type="text" id="telephone" name="telephone" value="<?php echo $donneuser['Telephonne'] ?>" class="form-control text-center inh">
                <button type="submit" id="validerinfo" class="btn btn-outline-warning btn-widht">modifier les informations personnelles</button>
                <div id="majok"></div>
            <!-- </form> --> 
                
            <hr>
            <h4>Modifier votre mot de passe</h4>
            <form action="compte.php" method="post">
                <div id="different"></div>
                <input type="password" name="pass1" id="pass1" class="form-control text-center">
                <input type="password" name="pass2" id="pass2" class="form-control text-center inh">
                <button type="submit" id="validermdp" name="validermdp" value="validermdp" class="btn btn-outline-warning btn-widht">modifier le mot de passe</button>
            </form>
            <?php
                if(isset($_POST['validermdp'])){;
                    
                    $mdp1 = $_POST['pass1'];
                    //$mdp1 = $conn->real_escape_string($mdp1);
                    $mdp2 = $_POST['pass2'];
                    //$mdp2 = $conn->real_escape_string($mdp2);
                    $mdp = password_hash($mdp2,PASSWORD_DEFAULT);

                    if($mdp1 == $mdp2){
                        $sqlmdp = "UPDATE Utilisateur set 
                                    mdp = '$mdp'
                                    where idUtilisateur = $iduser";
                                    
                        if($requetemaj = $conn->query($sqlmdp)){ ?>
                            <div class="alert alert-success text-center" role="alert">
                                Modification du mot de passe réalisé avec succès
                            </div>
                        <?php }
                    }
                    else{ ?>
                        <div class="alert alert-danger text-center" role="alert">
                            Les mots de passes sont diffétents !
                        </div>
                    <?php }
                }

            ?>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>

<?php
    include('footer.php');
?>