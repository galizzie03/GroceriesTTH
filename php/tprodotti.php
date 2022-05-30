<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="tps/style.css">
</head>
<a href='tindex.php'>Homepage</a>
<a href='tsupermercati.php'>Supermercati</a>
<?php
  	session_start();
    if(!isset($_SESSION['mail']))
    {
      header("location:tlogin.php");
      exit();
    }
    if(!isset($_SESSION['partita_iva']))
    {
      header("location:tbrowsesup.php");
      exit();
    }
    if(!isset($_GET['id']))
    {
    	header("location:tsupermercati.php");
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
        <td><b>Quantità</b></td>
        <td><b>Azioni</b></td>
    </tr>
<?php
	echo "<form action=\"tprodotti.php?id=".$id."\" method=\"post\">";
  $servername = "localhost";
  $username = "galizzi.edoardo.studente@itispaleocapa.it";
  $password = "m2tjprgWwzDm";
  $dbname = "my_edoardogalizzi";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);
  
  $sql = "SELECT prodotti.* FROM prodotti,supermercati WHERE Supermercato = '" . $_GET['id'] . "' AND prodotti.Supermercato = supermercati.ID AND PartitaIVA = '" . $_SESSION["partita_iva"] ."'";
  $result = $conn->query($sql);
  if (!($result->num_rows > 0))
  	die('Supermercato non esistente');
  else
  {
    while($row = $result->fetch_assoc()) 
    {
    	echo "<tr><td>".$row["ID"]."</td>";
        echo "<td>".$row["Nome"]."</td>";
        echo "<td>".$row["Marca"]."</td>";
        echo "<td>".$row["Descrizione"]."</td>";
        echo "<td>€".$row["Prezzo"]."</td>";
        echo "<td>".$row["Quantita"]."</td>";
      	echo "<td><a class='edit' href='./editprodotto.php?id=".$row["ID"]."&s=".$id."'>Modifica</a>";
      	echo "<a class='edit' href='./deleteprodotto.php?id=".$row["ID"]."&s=".$id."'>Cancella</a></td></tr>";
  	}
    echo "<tr><td></td><td><input type=\"text\" name=\"nome\" id=\"nome\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"marca\" id=\"marca\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"descrizione\" id=\"descrizione\" value=\"\"></td>";
    echo "<td><input type=\"numeric\" name=\"prezzo\" id=\"prezzo\" value=\"\"></td>";
    echo "<td><input type=\"numeric\" name=\"quantita\" id=\"quantita\" value=\"\"></td>";
    echo "<td><input type=\"submit\" value=\"Inserisci\"></td></tr></form>";
  } 
  echo "</table>";
    
  $inserimento = " INSERT INTO prodotti (Nome,Marca,Descrizione,Prezzo,Quantita,Supermercato) VALUES ('" . $_POST["nome"] . "','" . $_POST["marca"] . "','" . $_POST['descrizione'] . "','" . $_POST['prezzo'] . "','" . $_POST['quantita'] . "','" . $id . "')";
  
  if ($_POST["nome"] != "" || $_POST["marca"] != "" || $_POST["descrizione"] != "" || $_POST["prezzo"] != "" || $_POST["quantita"] != "" || $_POST["nome"] != "" || $_POST["marca"] != "" || $_POST["descrizione"] != "" || $_POST["prezzo"] != "" || $_POST["quantita"] != "")
  	{
    	$conn->query($inserimento);
        die();
    }
  else
  	echo "<br>Dati mancanti.<br>";
  
  $conn->close();
  ?>
  
  <br><a href='tlogout.php'>logout</a>
</html>
