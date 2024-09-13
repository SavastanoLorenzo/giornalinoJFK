<?php

$dbHost="localhost";
$dbUsr="root";
$dbPass="";
$dbName="giornalino";

$conn=new mysqli($dbHost,$dbUsr,$dbPass,$dbName);
if($conn->connect_error){
    die("connessione fallita ".mysqli_connect_error());
}
    //ottenimento informazioni dell'utente
    $username = $_POST['username'];
    $psw = $_POST['psw'];
    //query di ricerca utenti
    $miaQuery="select username,password_hash,ruolo from account where username='$username';";
    $risultato=$conn->query($miaQuery);
    
    if(mysqli_num_rows($risultato) == 0){
        echo '<h3> Username o password errati</h3>';
    }else{
        //ottenimento informazioni dalla query
        $row = mysqli_fetch_assoc($risultato);
        $user = $row['username'];
        $pswHash = $row['password_hash'];
        //inizio sessione e caricamento informazioni
        session_start();
        $_SESSION['username'] = $row['username'];
        $_SESSION['ruolo'] = $row['ruolo'];
        
        //accesso alle pagine personali
        if($username === $user && password_verify($psw,$pswHash)){
            if($_SESSION['ruolo'] == "amministratore"){
                header("Location: amministratore.php");
            }else if($_SESSION['ruolo'] == "validatore"){
                header("Location: validatore.php");
            }else if($_SESSION['ruolo'] == "scrittore"){
                header("Location: scrittore.html");
            }
        }
        
        if($_SESSION['ruolo'] == "amministratore"){
            header("Location: amministratore.php");
        }

    }
?>
