<?php 
    include('header.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <?php 

                $idUtilisateur = $_SESSION['id'];

                $sqlpriere = "SELECT s.idSujet, s.Description, s.idxEglise, s.Repondu,s.Temoignage,
                date_format(CreationDte,'%d %m %Y') as Creationdte,
                date_format(ClotureDte, '%d %m %Y') as ClotureDte,
                t.idxUtilisateur,
                u.nom,
                u.Prenom
                from Sujet s
                join tl_priere as t on idSujet = idxSujet
                join Utilisateur as u on s.idxUtilisateur = idUtilisateur
                where t.idxUtilisateur = $idUtilisateur and ClotureDte is null";

                if ($requetepriere = $conn->query($sqlpriere)){ ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sujet</th>
                                <th>posté par</th>
                                <th>Date de Création</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($donnepriere = $requetepriere->fetch_assoc()){?>
                                    <tr>
                                        <td><?php echo $donnepriere['Description'] ?></td>
                                        <td class="min"><?php echo $donnepriere['Prenom'].' '.$donnepriere['nom'] ?></td>
                                        <td class="min"><?php echo $donnepriere['Creationdte'] ?></td>
                                    </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                <?php }
            ?>
        </div>
    </div>
</div>
<?php 
include('footer.php');
?>