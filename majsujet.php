<?php 
include('header.php');

if(isset($_POST['validermaj'])){

    $id = $_POST['idsuj'];
    $sqlrec = "SELECT idSujet, Description from Sujet where idSujet = $id";
    $requeterech = $conn->query($sqlrec);
    $donnerech = $requeterech->fetch_assoc();

}

?>
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form action="majsujet.php" method="post">
                <input type="hidden" id="idSujet" name="idsujet" value="<?php echo $donnerech['idSujet'] ?>">
                <textarea id="textSujet" class="form-control inh" rows="10" name="sujet"><?php echo $donnerech['Description'] ?></textarea>
                <button type="button" id="majsujet" class="btn btn-widht btn-outline-success" name="valider">Valider</button>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<div id="successMajSujet">
    
</div>
<?php
    include('footer.php');
?>