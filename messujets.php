<?php
    include('header.php');
?>
<div class="container-fluid haut">
    <div class="row">
        <div class="col-md-6">    
            <h4>Mes sujets en cours</h4>
            <?php 
                $iduser = $_SESSION['id'];
                $sqlencours = "SELECT idSujet, Description, idxEglise, idxUtilisateur 
                                from Sujet 
                                where idxUtilisateur = $iduser and Repondu = 0";
                if ($requeteencours = $conn->query($sqlencours)){ ?>
                    <table class="table table-light text-center">
                        <thead>
                            <tr>
                                <td>Sujet</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                while($donneencours = $requeteencours->fetch_assoc()){ ?>
                                    <tr>
                                        <td><?php echo $donneencours['Description'] ?></td>
                                        <td>
                                            <form method="post" action="cloturersujet.php">
                                                <input type="hidden" name="idsujet" value="<?php echo $donneencours['idSujet'] ?>">
                                                <button type="submit" class="btn btn-outline-success">Dieu a répondu</button>
                                            </form>
                                        </td>
                                        <td>
                                        <?php
                                            $issujet = $donneencours['idSujet'];

                                            $sqlmoi = "SELECT u.nom, u.Prenom
                                            from Utilisateur as u
                                            join tl_priere on idUtilisateur = idxUtilisateur
                                            where idxSujet = $issujet";

                                            if($requetemoi = $conn->query($sqlmoi)){
                                                while ($donnemoi = $requetemoi->fetch_assoc()){?>
                                                    <div class="alert alert-success " role="alert">
                                                        je prie pour toi <strong><?php echo $donnemoi['Prenom'].' '.$donnemoi['nom'] ?></strong>
                                                    </div>
                                                <?php } ?> </td> <?php
                                            }

                                        ?>
                                    </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                <?php 
                }
            ?>
        </div>
        <div class="col">
            <h4>Dieu à répondu</h4>
            <?php 
                $iduser = $_SESSION['id'];
                $sqlencours = "SELECT idSujet, Description, idxEglise, idxUtilisateur, Temoignage
                                from Sujet 
                                where idxUtilisateur = $iduser and Repondu = 1";
                if ($requeteencours = $conn->query($sqlencours)){ ?>
                    <table class="table table-light text-center">
                        <thead>
                            <tr>
                                <td>Sujet</td>
                                <td>Témoignage</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                while($donneencours = $requeteencours->fetch_assoc()){ ?>
                                    <tr>
                                        <td><?php echo $donneencours['Description'] ?></td>
                                        <td><?php echo $donneencours['Temoignage'] ?></td>
                                    </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                <?php 
                }
            ?>
        </div>
    </div>
</div>
<?php
    include('footer.php');
?>