<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="tps/style.css">
</head>
<a href='tsupermercati.php'>Supermercati</a>
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
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT * FROM supermercati WHERE ID = '".$id."'";
  $delete = "DELETE FROM supermercati WHERE ID = '".$id."'";
  if ($conn->query($delete) === TRUE) {
    echo "<br><br>Record cancellato";
    header("location:tsupermercati.php");
  } else {
    echo "Errore nella cancellazione di record: " . $conn->error;
    sleep(1);
  }
  $result = $conn->query($sql);
  $conn->close();
  ?>
</html>
