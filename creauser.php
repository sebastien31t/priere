<?php 
    include('header.php');
?>

<div class="container">
    <div class="row hauteur">   
    </div>
    <form action="creauser.php" method="post">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <input type="text" class="form-control" name="nom" placeholder="Nom">
                <input type="text" class="form-control" name="prenom" placeholder="Prenom">
                <input type="password" class="form-control" name="motdepasse" placeholder="Mot de passe">
            </div>
            <div class="col">
                <input type="mail" class="form-control" name="mail" placeholder="Mail">
                <input type="text" class="form-control" name="telephone" placeholder="Téléphone">
                <button type="submit" name="valider" class="btn btn-outline-success btn-widht">valider</button>
            </div>
            <div class="col"></div>
        </div>
    </form>
    </div>
</div>


<?php 
    include('footer.php');

    if(isset($_POST['valider'])){

        $nom = $_POST['nom'];
        $nom = $conn->real_escape_string($nom);
        $prenom = $_POST['prenom'];
        $prenom = $conn->real_escape_string($prenom);
        $mdp = $_POST['motdepasse'];
        $mdp = $conn->real_escape_string($mdp);
        $mail = $_POST['mail'];
        $mail = $conn->real_escape_string($mail);
        $tel = $_POST['telepnone'];
        $tel = $conn->real_escape_string($tel);

        $mdp = password_hash($mdp,PASSWORD_DEFAULT);

        $sqlinsertuser = "INSERT into Utilisateur (nom, Prenom, mdp, Mail, Telephonne, idxEglise) values
        ('$nom','$prenom','$mdp','$mail','$tel',1)";
        
        if ($requeteinsertuser = $conn->query($sqlinsertuser)){ ?>
            <div class="alert alert-success fade show text-center" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Ajout avec succès !</strong>
            </div>
        <?php }

    }
include('footer.php');
?>