<!DOCTYPE html>
<html>
    <head>
        <title>Registrazione giornalino</title>
        <link rel="stylesheet" href="../styles/generic.css">
    </head>
    <body>
        <h1 class="title">Registrazione al sito del giornalino del j.f.kennedy</h1>
            <?php
                session_start();

                $dbHost="localhost";
                $dbUsr="root";
                $dbPass="";
                $dbName="giornalino";

                $conn=new mysqli($dbHost,$dbUsr,$dbPass,$dbName);
                if($conn->connect_error){
                        die("connessione fallita ".mysqli_connect_error());
                    }
                    
                    //ottenimento informazioni dell'utente che vuole registrarsi
                    $username = $_POST['username']; 
                    $psw = $_POST['psw'];
                    $ruolo = $_POST['ruolo'];
                    $hashPSW = password_hash($psw,PASSWORD_DEFAULT); //creazione della password criptata

                    $miaQuery="insert into account(username,password_hash,ruolo) VALUES('$username','$hashPSW','$ruolo');";
                    //query di inserimento nuovo utente
                    $risultato=$conn->query($miaQuery);
                                if(($risultato==FALSE)){
                                    echo "Query con errori: <br>";
                                    echo mysqli_error($conn);
                                }else{
                                    echo "<p>registrazione eseguita con successo!! </br>";
                                    echo "premere qui per accedere alla pagina di <a href='login.html'>login</a></p>";
                                }
            ?>
    </body>
</html>