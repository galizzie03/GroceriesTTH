<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="tps/style.css">
</head>
<a href='tindex.php'>Homepage</a>
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
    echo "<br><br>Benvenuto ".$_SESSION['mail']."<br>";
?>
	<h1>I tuoi supermercati</h1>
	<table border="2">
    <tr>
    	<td><b>Nome</b></td>
        <td><b>Città</b></td>
        <td><b>Indirizzo</b></td>
        <td><b>Azioni</b></td>
    </tr>
    <form action="tsupermercati.php" method="post">
<?php
  $servername = "localhost";
  $username = "galizzi.edoardo.studente@itispaleocapa.it";
  $password = "m2tjprgWwzDm";
  $dbname = "my_edoardogalizzi";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $sql = " SELECT * FROM supermercati WHERE PartitaIVA='".$_SESSION['partita_iva']."'";
  
  $result = $conn->query($sql);
  if ($result->num_rows > 0) 
  {
    while($row = $result->fetch_assoc()) 
    {
    	echo "<tr><td><a class='edit' href='./tprodotti.php?id=".$row["ID"]."'>".$row["Nome"]."</a></td>";
        echo "<td>".$row["Indirizzo"]."</td>";
      	echo "<td><a class='edit' href='./editsupermercato.php?id=".$row["ID"]."'>Modifica</a>|";
      	echo "<a class='edit' href='./deletesupermercato.php?id=".$row["ID"]."'>Cancella</a></td></tr>";
  	}
    echo "<tr><td><input type=\"text\" name=\"supermercato\" id=\"supermercato\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"indirizzo\" id=\"indirizzo\" value=\"\"></td>";
    echo "<td><input type=\"submit\" value=\"Inserisci\"></td></tr></form>";
  } 
  else 
    echo "0 results";
  echo "</table>";
    
  $inserimento = " INSERT INTO supermercati (Nome,Indirizzo,PartitaIVA) VALUES ('" . $_POST["supermercato"] . "','" . $_POST["indirizzo"] . "','" . $_SESSION['partita_iva'] . "')";
  $controllo = " SELECT * FROM supermercati WHERE Indirizzo = '" . $_POST["indirizzo"] . "'";
    
  $result = $conn->query($controllo);
  if (!($result->num_rows > 0)) {
  	if ($_POST["supermercato"]!=null)
    	$conn->query($inserimento);
  } elseif ($_POST["supermercato"] == "" || $_POST["indirizzo"] == "" || $_POST["supermercato"] == null || $_POST["indirizzo"] == null)
  		echo "<br>Dati mancanti";
  else
  		echo "<br>Indirizzo già usato.<br>";
  
  $conn->close();
  ?>
  
  <br><a href='tlogout.php'>logout</a>
</html>
