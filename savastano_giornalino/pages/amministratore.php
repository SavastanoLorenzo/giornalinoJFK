<!DOCTYPE html>
<html>
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
    ?>
    <head>
        <title>Home Page Giornalino</title>
        <link rel="stylesheet" href="../styles/amministratore.css">
    </head>
    <body>
        <h1 class="title">Giornalino J.F.Kennedy</h1>
        <p>
            <nav>
                | <a href="../index.html">Home</a> |
                <a href="login.html">Login</a> |
                <a href="registrazione.html">Registrazione</a> |
                <a href="../index.html"><?php session_destroy(); ?>Logout</a> |
              </nav>
        </p>
        <p>Benvenuto amministratore</p>
            <form method="post" name="form">
                <p>
                    <label>Seleziona utente: </label>
                </p>
                <p>
                    <select name="utente" id="utente">
                    <?php
                        
                        $query = "SELECT username FROM account";
                        $result = $conn->query($query);
                        while ($row = mysqli_fetch_array($result)) 
                        {
                            echo "<option value=\"".$row['username']."\">";
                            echo $row['username']; 
                            echo "</option>";
                        }
                        $username = $row['username'];
                    ?>
                    
                    </select>
                </p>
                <p>
                    <label>Ruolo utente: </label>
                </p>
                <p>
                    <select name="ruolo" id="ruolo">
                        <option value="scrittore">Scrittore</option>
                        <option value="validatore">Validatore</option>
                        <option value="amministratore">Amministratore</option>
                    </select>
                </p>
                <p>
                    <input type="submit" class="btn" name="submit" value="Salva modifiche">
                </p>
        </form>

    </body>
</html>

<?php		
        $ruolo = null;
        $usernameScelto = null;

        if(isset($_POST['submit'])) 
        {
            $ruolo = $_POST['ruolo'];
            $usernameScelto = $_POST['utente'];
            $aggiornaRuolo = "UPDATE account SET ruolo = \"$ruolo\" WHERE username = '$usernameScelto';";
            $resultRuolo = $conn->query($aggiornaRuolo);
            header("Location: ../index.html");
        }
    
		mysqli_close($conn);
	?>