<html>
	<head>
		<link rel="stylesheet" href="tps/style.css">
	</head>
    <body>
        <?php
            session_start();
                if(!isset($_SESSION['mail']))
                {
                header("location:tlogin.php");
                exit();
                }
                if(!isset($_GET['id']))
                {
                  header("location:tprodotti.php?id=".$_GET['s']);
                  exit();
                }
                else
                	$id = $_GET['id'];
                    
                if (!isset($_SESSION['partita_iva']))
                {
                  header("location:tbrowsesup.php");
                  exit();
                }
            echo "<a href='tprodotti.php?id=".$_GET['s']."'>Supermercato</a><br><br>";

            $servername = "localhost";
            $username = "galizzi.edoardo.studente@itispaleocapa.it";
            $password = "m2tjprgWwzDm";
            $dbname = "my_edoardogalizzi";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error)
                die("Connection failed: ".$conn->connect_error);
            $sql = "SELECT * FROM prodotti WHERE ID = '" . $id . "' AND Supermercato = '" . $_GET["s"] . "'";
            $result = $conn->query($sql);
            if ($result->num_rows != 1)
                die('Prodotto non esistente');
            $data=$result->fetch_assoc();
            echo "<form action='./editprodotto.php?id=".$id."&s=".$_GET[s]."' method='post'>";
            echo "Nome<br><input type='text' name='nome' id='nome' value='" . $data[Nome] . "'><br><br>";
            echo "Marca<br><input type='text' name='marca' id='marca' value='" . $data[Marca] . "'><br><br>";
            echo "Descrizione<br><input type='text' name='descrizione' id='descrizione' value='" . $data[Descrizione] . "'><br><br>";
            echo "Prezzo<br><input type='numeric' name='prezzo' id='prezzo' value='" . $data[Prezzo] . "'><br><br>";
            echo "Quantità<br><input type='numeric' name='quantita' id='quantita' value='" . $data[Quantita] . "'><br><br>";
            echo "<input type='submit'></form>";
            echo $iva;
            $update = "UPDATE prodotti SET Nome = '" . $_POST[nome] . "', Marca = '" . $_POST[marca] . "', Descrizione = '" . $_POST[descrizione] . "', Prezzo = '" . $_POST[prezzo] . "', Quantita = '" . $_POST[quantita] . "' WHERE ID = '" . $id . "'";
            $conn->query($update);
            $conn->close();
        ?>
        (se si vuole annullare, cliccare su invia e tornare ai prodotti)
        <br><br><a href='logout.php'>logout</a>
    </body>
</html>
