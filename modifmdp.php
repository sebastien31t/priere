<?php
    include('header.php');
?>

<form action="modifmdp.php" method="post">
    <input type="text" name="id" class="form-control">
    <input type="password" name="mdp" class="form-control">
    <button class="btn btn-warning" name="valider">valider</button>
</form>


<?php   
    if(isset($_POST['valider'])){
        $id = $_POST['id'];
        $mdp = $_POST['mdp'];

        $mdpc = password_hash($mdp, PASSWORD_DEFAULT);

        $sql = "UPDATE Utilisateur set mdp = '$mdpc' where idUtilisateur = $id ";
        
        if($requete = $conn->query($sql)){
            echo "Requete réalisé avec succès !";

        }
    }



    include('footer.php');
?>