<?php
    include('header.php');
?>

<div class="container haut">
    <div class="row">
        <div class="col">
            <form action="creersujet.php" method="post">
                <textarea rows="10" placeholder="Sujet" class="form-control" required name="sujet"></textarea>
                <button type="submit" name="valider" class="btn btn-outline-success btn-widht">Enregistrer le sujet de prière</button>
            </form>
        </div>
    </div>
</div>
<?php
    include('footer.php');

    if(isset($_POST['valider'])){

        $sujet = $_POST['sujet'];
        $sujet = $conn->real_escape_string($sujet);
        $eglise = $_SESSION['idxEglise'];
        $iduser = $_SESSION['id'];

        $sql ="INSERT into Sujet (Description, idxEglise, idxUtilisateur, CreationDte) values
                ('$sujet',$eglise,$iduser,now())";
        if($requete = $conn->query($sql)){ ?>
            <div class="alert alert-success text-center inh" role="alert">
                <strong>Sujet bien enregistrer</strong>
            </div>
        <?php }
    } ?>