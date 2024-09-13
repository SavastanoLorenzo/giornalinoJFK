<!DOCTYPE html>
<html>
    <?php
    session_start();
    ?>      
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../styles/validatore.css">
        <title> Pagina validazione notizie</title>
    </head>
    <body>
        <div class="container-fluid">
            <h1> Sessione validazione notizie</h1>
            <p>
                <nav>
                    | <a href="lettore.php">Home</a> |
                    <a href="../index.html">Logout <?php session_destroy(); ?></a> |
                    <a href="registrazione.html">Registrazione</a> |
                  </nav>
            </p>
            <p>
            <form method='post' id='form' action='validatore.php'>
                <?php
                    $dbHost="localhost";
                    $dbUsr="validatore";
                    $dbPass="";
                    $dbName="giornalino";
                 
                    $conn=new mysqli($dbHost,$dbUsr,$dbPass,$dbName);
                    if($conn->connect_error){
                             die("connessione fallita ".mysqli_connect_error());
                        }
                    $miaQuery="select * from notizie where validato = 0";
                    $risultato=$conn->query($miaQuery);
                    if(mysqli_num_rows($risultato) != 0){
                        if(($risultato==FALSE)){
                            echo "Query con errori: <br>";
                            echo mysqli_error($conn);   
                        }else{
                            while($riga=mysqli_fetch_array($risultato,MYSQLI_ASSOC)){
                                echo "<h1>".$riga['titolo']."</h1><h4>".$riga['descrizione']."</h4><p>".$riga['testo']."</p></br>";
                                echo "<p><input type='checkbox' name=\"".$riga['idNotizia']."\" value=".$riga['idNotizia']." class='check'></p><hr>";
                            }
                        }
                    }else{
                        echo "<h4> Non ci sono articoli da validare</h4>";
                    }
                ?>
                <p>
                    <input type="submit" name="validBtn" form="form" value="Valida">
                </p>    
            </form>
                <?php
                    $vett = array();
                    $i = 0;
                    foreach($_POST as $value){
                        if(is_numeric($value)){
                            $vett[$i]=$value;
                            $i++;
                        }    
                    }
                    for($i=0;$i<count($vett);$i++){
                        $validazione= "UPDATE notizie SET validato='1' WHERE idNotizia ={$vett[$i]}"; 
                        $rs=$conn->query($validazione); 
                        if($i==count($vett)-1){
                            session_destroy();
                            Header("Location:../index.html"); 
                        }
                    }

                    /*
                    print_r($vett);
                    if(isset($_POST['validBtn'])){
                        if(isset($_POST['idNotizia'])){
                            echo "sono qui";
                            $accept = $_POST['idNotizia'];
                            echo "accept".$accept;
                            for($i=0;$i<count($accept);$i++){
                                $validazione= "UPDATE notizie SET validato='1' WHERE idNotizia = '{$accept[$i]}'"; echo "validazion vake:". $validazione;
                                $rs=$conn->query($validazione); 
                            }

                        }
                    }*/
                ?>

                <!--
                function check(){
                if($_POST['valid'] == 'ok'){
                    $miaQuery="alter table notizie set validato = 1";
                    $risultato=$conn->query($miaQuery);
                    if(mysqli_num_rows($risultato) != 0){
                        if(($risultato==FALSE)){
                            echo "Query con errori: <br>";
                            echo mysqli_error($conn);   
                        }
                    }-->
        </div>
        <hr>
        <footer>
            | <a href="lettore.php">Home</a> |
            <a href="../index.html">Logout </a> |
            <a href="registrazione.html">Registrazione</a> |
        </footer>
    </body>
</html>