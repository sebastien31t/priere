<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <link href="dist/css/bootstrap.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&display=swap" rel="stylesheet"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/icone.ico" />
    <title>Vie Chrétienne</title>
</head>
<body>
    <div class="row hauteur"></div>
    <div class="text-center txt"><h1 class="text-center">Vie Chretienne</h1></div>
    <div class="row hauteur"></div>

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
    </div>
    
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 col-sm-12">
            <form action="index.php" method="post">
                <input type="text" class="form-control text-center" placeholder="Nom" name="nom">
                <input type="password" class="form-control text-center inh" placeholder="mot de passe" name="mdp">
                <button type="submit" class="btn btn-outline-success btn-widht" name="valider">Valider</button> 
            </form>
        

    <?php
        include('fonc/connect.php');
        if(isset($_POST['valider'])){
            $messge = 0;
            $nom = $_POST['nom'];
            $nom = $conn->real_escape_string($nom);
            $password = $_POST['mdp'];

            $sql = "SELECT idUtilisateur,nom,mdp,Prenom,Mail,Telephonne,Admin,idxEglise from Utilisateur where nom = '$nom'";

            if ($requeteuser = $conn->query($sql)){

                while($donne = $requeteuser->fetch_assoc()){
                    $hash = $donne['mdp'];
                    if (password_verify($password,$hash)){

                        $_SESSION['id'] = $donne['idUtilisateur'];
                        $_SESSION['nom'] = $donne['nom'];
                        $_SESSION['prenom'] = $donne['Prenom'];
                        $_SESSION['mail'] = $donne['Mail'];
                        $_SESSION['tel'] = $donne['Telephonne'];
                        $_SESSION['admin'] = $donne['Admin'];
                        $_SESSION['idxEglise'] = $donne['idxEglise'];

                        header('location:accueil.php');
                    }
                    else{ 
                        $messge = 1;
                    }
                }
                if($messge == 1){?>
                    <div class="alert alert-warning text-center inh" role="alert">
                        <strong>erreur d'identifiant ou de mot de passe</strong>
                    </div>
                <?php
                }
            }
            
        }
    ?>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="hauteur"></div>
    <div class="container  !spacing">
        <div class="row  ">
            <p id="presentation">
            Vie Chrétienne est une application qui sert à resserrer les liens entre chrétien au sein de son église, 
            ici chacun peut déposer ses requêtes. Et bien sûr voir les besoins de ses frères et sœurs. 
            Il est possible de mentionner que vous vous liez à une chaine de prière d’un simple clic.
            Vous vous sentirez aimer et entourer en voyant les personnes qui vont vous soutenir dans les moments 
            difficiles via la prière. 
            C’est aussi l’occasion de rencontrer des personnes que l’on ne connait pas dans l’église. 
            Pour plus de renseignement, merci de nous contacter via le formulaire. 
            L’équipe vie-chretienne.app 
            </p>
        </div>
    </div>
    <div class="hauteur"></div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 col-sm-12">
            <?php
                if (isset($_POST['validermail'])){

                    $TO = 'inform-el.com';
                    // Sender Info
                    $name = $_POST['nom'];
                    $prenom =$_POST['prenom'];
                    $email = $_POST['mail'];
                    $portable = $_POST['portable'];
                    $subject = $_POST['objet'];
                    $message = $_POST['message'];
                    $error = "";


                    // Import PHPMailer classes into the global namespace
                    // These must be at the top of your script, not inside a function

                    require 'PHPMailer/src/Exception.php';
                    require 'PHPMailer/src/PHPMailer.php';
                    require 'PHPMailer/src/SMTP.php';


                    // Instantiation and passing `true` enables exceptions
                    $mail = new PHPMailer(true);


                    try {
                        //Server settings
                        $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                        $mail->isSMTP();                                            // Send using SMTP
                        $mail->Host       = 'mail.gandi.net';                    // Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                        $mail->Username   = 'contact@vie-chretienne.app';                     // SMTP username
                        $mail->Password   = 'Bmwmpowerm3917=$*m3917';                               // SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                        //Recipients
                        $mail->setFrom($email, $name, $prenom);
                        $mail->addAddress('contact@vie-chretienne.app', 'Vie Chretienne');     // Add a recipient
                        $mail->addAddress($email, $name, $prenom);               // Name is optional
                        //$mail->addReplyTo('info@example.com', 'Information');
                        //$mail->addCC('cc@example.com');
                        //$mail->addBCC('bcc@example.com');

                        // Attachments
                        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                        // Content
                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = $subject;
                        $mail->Body    = $name." ".$prenom."<br> Telephone: ".$portable."<br>".$message;
                        //$mail->AltBody = $message;
                        

                        $mail->send();
                        ?>
                            <div class="alert alert-success text-center" role="alert">
                                Votre message a bien été envoyé !
                            </div>
                        <?php
                    }
                    catch (Exception $e){ ?>
                        <div class="alert alert-danger text-center" role="alert">
                            Le message n'a pas été envoyé, veuillez reéssayer plus tard. Merci.
                        </div>
                    <?php }
                }
                        
                ?>
            <form action="index.php" method="post">
                <input class="form-control inh" name="nom" placeholder="Votre nom" required>
                <input class="form-control inh" name="prenom" placeholder="Votre prenom" required>
                <input class="form-control inh" name="mail" placeholder="Votre mail" required>
                <input class="form-control inh" name="portable" placeholder="Votre portable">
                <input class="form-control inh" name="objet" placeholder="Objet">
                <textarea class="form-control inh" name="message" placeholder="Votre message"></textarea>
                <button class="btn btn-outline-success btn-widht" name="validermail">Envoyer</button>
            </form>
        </div>
        <div class="colcol-md-4"></div>
    </div>
    <div class="hauteur"></div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>
