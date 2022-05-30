<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="tps/style.css">
</head>
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
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $delete = "DELETE FROM prodotti WHERE ID = '".$id."'";
  if ($conn->query($delete) === TRUE) {
    echo "<br><br>Prodotto cancellato";
    header("location:tprodotti.php?id=".$_GET['s']);
  } else {
      echo "Errore nella cancellazione di record: " . $conn->error;
      sleep(1);
  }
  $conn->close();
  ?>
</html>
