
<?php
include ('../fonc/connect.php');

    $id = $_POST['id'];
    $sujet = $_POST['sujet'];
    $sujet = $conn->real_escape_string($sujet);

    $sqlmaj = "UPDATE Sujet set 
                Description = '$sujet'
                where idSujet = $id";
                echo $sqlmaj;
    $conn->query($sqlmaj) 
    
    ?>