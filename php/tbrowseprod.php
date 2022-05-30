<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="tps/style.css">
</head>
<a href='tindex.php'>Homepage</a>
<a href='tbrowsesup.php'>Supermercati</a>
<a href='cart.php'>Carrello</a>
<?php
  	session_start();
    if(!isset($_SESSION['mail']))
    {
      header("location:tlogin.php");
      exit();
    }
    if(!isset($_GET['id']))
    {
    	header("location:tbrowsesup.php");
        exit();
    }
    $id = $_GET['id'];
        
    echo "<br><br>Benvenuto ".$_SESSION['mail']."<br>";
?>
	<h1>Prodotti</h1>
	<table border="2">
    <tr>
    	<td><b>ID</b></td>
        <td><b>Nome</b></td>
        <td><b>Marca</b></td>
        <td><b>Descrizione</b></td>
        <td><b>Prezzo</b></td>
        <td><b></b></td>
    </tr>
<?php
  $servername = "localhost";
  $username = "galizzi.edoardo.studente@itispaleocapa.it";
  $password = "m2tjprgWwzDm";
  $dbname = "my_edoardogalizzi";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);
  
  $sql = "SELECT * FROM prodotti WHERE Supermercato = '" . $_GET['id'] . "'";
  $result = $conn->query($sql);
  if (!($result->num_rows > 0))
  	die('Supermercato non esistente');
  else
    while($row = $result->fetch_assoc()) 
    {
    	echo "<tr><td>".$row["ID"]."</td>";
        echo "<td>".$row["Nome"]."</td>";
        echo "<td>".$row["Marca"]."</td>";
        echo "<td>".$row["Descrizione"]."</td>";
        echo "<td>€".$row["Prezzo"]."</td>";
        if ($row["Quantita"] > 0)
        {
        	echo "<td>";
            echo "<form method='post' action='./cart.php?id=".$row["ID"]."&s=".$id."' >";
            echo "Disponibile ";
            echo "<input type='submit' name='submit' value='Aggiungi al carrello'>";
            echo "</form>";
            echo "</td>";
        }
       	else
        	echo "<td>Non disponibile</td>";
        echo "</tr>";
  	}
    
  echo "</table>";
  $conn->close();
  ?>
  
  <br><a href='tlogout.php'>logout</a>
</html>
