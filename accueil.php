<?php 
    include('header.php');
?>
<div class="container-fluid haut">
    <div class="row">
        <div class="col">
            <h5>Liste de prière</h5>
            <?php
                $iduser = $_SESSION['id'];
                $ideglise = $_SESSION['idxEglise'];

                $sqlrecherche = "SELECT distinct t.idSujet, t.Description, t.idxEglise, t.idxUtilisateur, u.nom, u.Prenom, t.CreationDte
                from Sujet as t
                join Utilisateur as u on idUtilisateur = idxUtilisateur
                where t.idxEglise = $ideglise and ClotureDte is null
                order by t.CreationDte asc"; 

                if($requeterecherche = $conn->query($sqlrecherche)){
                    $compteurId  = 1 ;
            ?>
                    <table class="table">
                        <thead>
                        <tr>
                            <td>Sujet</td>
                            <td>Demandé par</td>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($donnerecherche = $requeterecherche->fetch_assoc()){

                                    
                                    $id_sujet = $donnerecherche['idSujet'];

                                    $sqlprie = "SELECT t.idxSujet, t.idxUtilisateur, t.priere
                                    from tl_priere as t
                                    join Sujet as s on t.idxSujet = s.idSujet
                                    where s.idSujet = $id_sujet and t.idxUtilisateur = $iduser";

                                    $requetesujet = $conn->query($sqlprie);
                                    $donneprie = $requetesujet->fetch_assoc();

                                        $sqlcount = "SELECT count(idxSujet) as compteur from tl_priere where idxSujet = $id_sujet";
                                        $requetecount = $conn->query($sqlcount);
                                        $donnecount = $requetecount->fetch_assoc();

                                    if ($donnecount['compteur'] > 0) {

                                        switch($donneprie['priere']){
                                            case 1 :
                                                $color = 'success';
                                                $message = 'Je prie pour toi';                
                                            break;
                                            default :
                                                $color = 'warning';
                                                $message = 'Ajouter à mes prières';
                                            break;
                                        }
                                    
                                    } ?>
                                    <tr>
                                        <td><?php echo $donnerecherche['Description'] ?></td>
                                        <td><?php echo $donnerecherche['nom'].' '.$donnerecherche['Prenom'] ?></td>
                                        <td>
                                            <?php
                                                if ($donnerecherche["idxUtilisateur"] != $_SESSION['id']){

                                            ?>
                                            <div>
                                                <input type="hidden" value="<?php echo $donnerecherche['idSujet'] ?>" name="idsuj" id="idSujet-<?php echo $compteurId ?>">
                                                <button type="button" id="validerpriere-<?php echo $compteurId ?>" class="validerpriere btn btn-outline-<?php echo $color ?>" ><?php echo $message ?></button>
                                            </div>
                                        </td>
                                    </tr>

                                    <?php $compteurId = $compteurId + 1; }
                                    else{
                                        ?>
                                            <div>
                                                <form action="majsujet.php" method="post">
                                                    <input type="hidden" value="<?php echo $donnerecherche['idSujet'] ?>" name="idsuj">
                                                    <button type="submit"class="btn btn-light" name="validermaj">Modifier le sujet de priere</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <?php }
                                
                                }
                                ?>
                        </tbody>
                    </table>
                <?php } 

                
                ?>        
        </div>
        <div class="col">
            <h4>Dieu a répondu !</h4>

            <?php
            $sqlrepondu = "SELECT t.idSujet, t.Description, t.idxEglise, t.idxUtilisateur, u.nom, u.Prenom,t.Temoignage
                            from Sujet as t
                            join Utilisateur as u on idUtilisateur = idxUtilisateur
                            where t.idxEglise = $ideglise and t.Repondu = 1 limit 30";
            if ($requeterepondu = $conn->query($sqlrepondu)){

                while($donnrepondu = $requeterepondu->fetch_assoc()){
                ?>
                    <div class="alert alert-success" role="alert">
                        <h6>Posté par <?php echo $donnrepondu['Prenom'].' '.$donnrepondu['nom'] ?></h6>
                        <small><?php echo $donnrepondu['Description']?></small><br><br>
                        <?php echo $donnrepondu['Temoignage'] ?>
                    </div>
                    
                <?php
                } 
            } ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        setInterval(function() { location.reload() }, 30000);
    });
</script>
<?php 
    include('footer.php');
?>