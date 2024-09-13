<!DOCTYPE html>
<html>
    <head>
        <title>Registrazione giornalino</title>
        <link rel="stylesheet" href="../styles/scrittore.css">
    </head>
    <body>
        <h1 class="title">Registrazione al sito del giornalino del j.f.kennedy</h1>
        <nav>
            | <a href="lettore.php">Home</a> |
            <a href="login.html">Login</a> |
            <a href="registrazione.html">Registrazione</a> |
        </nav>
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

                    $titolo = $_POST['titolo'];
                    $descrizione = $_POST['descrizione'];
                    $testo = $_POST['testo'];
                    $categoria = $_POST['categoria'];
                    $hotWord = $_POST['hotWord'];
                    $username = $_SESSION['username'];
                    //echo $username;
                    $miaQuery="insert into notizie(titolo,descrizione,testo,categoria,validato,scrittore,hotword) VALUES('$titolo','$descrizione','$testo','$categoria','0','$username','hotWord');";
                    $risultato=$conn->query($miaQuery);
                                if(($risultato==FALSE)){
                                    echo "Query con errori: <br>";
                                    echo mysqli_error($conn);
                                }else{
                                    echo "<p>Inserimento eseguito con successo </br>";
                                    echo "premere qui per accedere alla pagina di <a href='login.html'>login</a></p>";
                                }
            ?>
    </body>
</html>