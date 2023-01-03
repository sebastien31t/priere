<?php
    include('header.php');

    $idsujet = $_POST['idsujet'];
?>

<div class="container">
    <div class="row">
        <div class="col">
            <form method="post" action="fonctionsapp/cloturersujetstr.php">
                <?php
                    $sql = "SELECT idSujet, Description, idxEglise, idxUtilisateur, Temoignage,date_format(CreationDte, '%d %m %Y') as CreationDte,ClotureDte from Sujet 
                    where idSujet = $idsujet";
                    $requete = $conn->query($sql);
                    $donne = $requete->fetch_assoc();
                ?>
                <label for="">Sujet de prière</label>
                <input type="text" class="form-control" value="<?php echo $donne['Description'] ?>" disabled required name="desc">
                <label>Témoignage</label>
                <textarea placeholder="Témoignage" name="temoignage" class="form-control"></textarea>
                <div class="row">
                    <div class="col">
                        <label for="">Date de création</label>
                        <input type="text" class="form-control" value="<?php echo $donne['CreationDte'] ?>" required disabled>
                    </div>
                    <div class="col">
                        <label for="">Date de réponse</label>
                        <input type="date" class="form-control" value="<?php echo $donne['ClotureDte'] ?>" required name="rep">
                    </div>
                </div>
                <input type="hidden" value="<?php echo $idsujet ?>" name="idsujet">
                <button type="submit" name="valider" class="btn btn-outline-success btn-widht">Enregistrer</button>
            </form>
        </div>
    </div>
</div>



<?php
    include('footer.php');
?>