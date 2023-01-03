<?php
    session_start();
    include('connect.php');
    include('../footer.php');

    //if(isset($_POST['ajout'])){
        $id = $_SESSION['id'];
        $idsu = $_POST['idSujet'];

        
        $sqlrechercheprire = "SELECT idxUtilisateur, idxSujet, priere 
                                from tl_priere 
                                where idxUtilisateur = $id and idxSujet = $idsu";
        $requeterecherchepriere = $conn->query($sqlrechercheprire);
        $donnerrechercheprie = $requeterecherchepriere->fetch_assoc();

        if ($requeterecherchepriere->num_rows == 0){

            

                $sqlpriere = "INSERT into tl_priere (idxUtilisateur, idxSujet, priere) values 
                ($id, $idsu,1)";

                $requetepriere= $conn->query($sqlpriere);
        }

?>
