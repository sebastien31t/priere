<?php 
    include('header.php');

    $sqlAjoutService = "";
?>
<div class="container">
    <div class="hauteur"></div>
    <div class="row">
        <h4>Creer un service</h4>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form action="ajoutservice.php" method="post">
                <select name="choix" id="choix" class="form-control">
                    <option value=""></option>
                    <?php 
                        $sqlchoix = "SELECT idService, Description from ServiceDes order by Description asc";
                        $requeteChoix = $conn->query($sqlchoix);
                        while($donneChoix = $requeteChoix->fetch_assoc()){ ?>
                            <option value="<?php echo $donneChoix['idService'] ?>"><?php echo $donneChoix['Description'] ?></option>
                        <?php }
                    ?>
                </select>
                <button type="submit" class="btn btn-success btn-widht" name="valider">Valider</button>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
    <hr>
    <div class="row">
    <h4>Demande en cour</h4>
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <?php 
        $ideglise = $_SESSION['idxEglise'];
        $sqlserencour = "SELECT idxUtilisateur, idxServiceDes, idxEglise 
                        from Services 
                        where idxUtilisateur is null and idxEglise = $ideglise";
        if ($requeteencours = $conn->query($sqlserencour)){ ?>
            <table class="table table-bordered table-inverse table-responsive">
                <thead class="thead-inverse">
                    <tr>
                        <th>Service</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($donneencour = $requeteencours->fetch_assoc()){ 
                                $idservice = $donneencour['idxServiceDes'];
                                $sqldes = "SELECT idService, Description from ServiceDes where idService = $idservice order by Description";
                                $resueteservice = $conn->query($sqldes);
                                $donneservice = $resueteservice->fetch_assoc();
                                ?>
                                <tr>
                                    <td><?php echo $donneservice['Description'] ?></td>
                                </tr>
                            <?php }
                        ?>
                    </tbody>
            </table>

        <?php }


        ?>
    </div>
    <div class="col-md-3"></div>

    </div>
</div>



<?php 
    include('footer.php');
    
?>
