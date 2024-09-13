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
        <p>
            <form method="POST" action="hotword.php">
                <input type="text" name="hotword" placeholder="ricerca hotword"> 
                <input type="submit" class="btn" value="cerca">
        </p>     
        </form>

<?php

    $dbHost="localhost";
    $dbUsr="root";
    $dbPass="";
    $dbName="giornalino";

    $conn=new mysqli($dbHost,$dbUsr,$dbPass,$dbName);
    if($conn->connect_error){
            die("connessione fallita ".mysqli_connect_error());
        }

        $miaQuery="select * from notizie where validato= '1'";
        $risultato=$conn->query($miaQuery);
        if(mysqli_num_rows($risultato) != 0){
            if(($risultato==FALSE)){
                echo "Query con errori: <br>";
                echo mysqli_error($conn);   
            }else{
                while($riga=mysqli_fetch_array($risultato,MYSQLI_ASSOC)){
                    echo "<p><h2>".$riga['titolo']."</h2></p><h4>".$riga['descrizione']."</h4><p>".$riga['testo']."</p><p>"."Hotword: ".$riga['hotword']."</p><p>"."Autore: ".$riga['scrittore']."</p></br><hr>";
                }
            }
        }
?>
    </body>
</html>