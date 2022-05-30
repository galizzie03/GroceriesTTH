<html>
	<head>
		<link rel="stylesheet" href="tps/style.css">
	</head>
    <body>
        <a href='tsupermercati.php'>Supermercati</a><br><br>
        Nome<br>
        <?php
            session_start();
                if(!isset($_SESSION['mail']))
                {
                header("location:tlogin.php");
                exit();
                }
                if(!isset($_GET['id']))
                {
                  header("location:tsupermercati.php");
                  exit();
                }
                else
                	$id = $_GET['id'];
                    
                if (!isset($_SESSION['partita_iva']))
                {
                  header("location:tbrowsesup.php");
                  exit();
                }

            $servername = "localhost";
            $username = "galizzi.edoardo.studente@itispaleocapa.it";
            $password = "m2tjprgWwzDm";
            $dbname = "my_edoardogalizzi";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error)
                die("Connection failed: ".$conn->connect_error);
            $sql = "SELECT * FROM supermercati WHERE ID = '" . $id . "' AND PartitaIVA = '" . $_SESSION["partita_iva"] . "'";
            $result = $conn->query($sql);
            if ($result->num_rows != 1)
                die('Azienda non esistente');
            $data=$result->fetch_assoc();
            echo "<form action='./editsupermercato.php?id=".$id."' method='post'>";
            echo "<input type='text' name='nome' id='nome' value='" . $data[Nome] . "'><br><br>";
            echo "Indirizzo<br><input type='text' name='indirizzo' id='indirizzo' value='" . $data[Indirizzo] . "'>";
            echo "<br><input type='submit'></form>";
            echo $iva;
            $update = "UPDATE supermercati SET Nome = '" . $_POST[nome] . "', Indirizzo = '" . $_POST[indirizzo] . "' WHERE ID = '" . $id . "'";
            $conn->query($update);
            $conn->close();
        ?>
        (se si vuole annullare, cliccare su invia e tornare ai supermercati)
        <br><br><a href='logout.php'>logout</a>
    </body>
</html>
