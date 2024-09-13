<!DOCTYPE html>
<html>
    <?php
        session_start();
    ?>
    <head>
        <title>Notizie giornalino kennedy</title>
        <link rel="stylesheet" href="../styles/lettore.css">
    </head>
    <body>
        <h1 class="title">Giornalino del kennedy!!</h1>
        <p>
            <nav>
                | <a href="../index.html">Home</a> |
                <a href="login.html">Login</a> |
                <a href="registrazione.html">Registrazione</a> |
                <a href="../index.html">Logout <?php session_destroy(); ?> </a> |
            </nav>
        </p>
<?php

    $dbHost="localhost";
    $dbUsr="root";
    $dbPass="";
    $dbName="giornalino";

    $hotword = $_POST['hotword'];

    $conn=new mysqli($dbHost,$dbUsr,$dbPass,$dbName);
    if($conn->connect_error){
            die("connessione fallita ".mysqli_connect_error());
        }

        $miaQuery="select * from notizie where validato is not null and hotword='$hotword';";
        $risultato=$conn->query($miaQuery);
        if(mysqli_num_rows($risultato) != 0){
            if(($risultato==FALSE)){
                echo "Query con errori: <br>";
                echo mysqli_error($conn);   
            }else{
                while($riga=mysqli_fetch_array($risultato,MYSQLI_ASSOC)){
                    echo "<p><h2>".$riga['titolo']."</h2></p><h4>".$riga['descrizione']."</h4><p>".$riga['testo']."</p><p>"."Hotword: ".$riga['hotword']."</p></br><hr>";
                }
            }
        }
?>
    </body>
</html>