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
    if(isset($_GET['id']))
    {
    	$_SESSION['cart'][] = array($_GET[id],1);
        exit();
    }
    $id = $_GET['id'];
        
    echo "<br><br>Benvenuto ".$_SESSION['mail']."<br>";
?>
	<h1>Carrello</h1>
	<table border="2">
    <tr>
        <td><b>Nome</b></td>
        <td><b>Prezzo</b></td>
        <td><b>Azioni</b></td>
    </tr>
<?php
  $servername = "localhost";
  $username = "galizzi.edoardo.studente@itispaleocapa.it";
  $password = "m2tjprgWwzDm";
  $dbname = "my_edoardogalizzi";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);
  $count = sizeof($_SESSION['cart']);
  for ($x = 0; $x <= $count ; $x++)
  {
  	echo "<tr>";
  	for ($y = 0; $y <= sizeof($_SESSION['cart'][$x]); $y++)
    {
    	echo "<td>".$_SESSION['cart'][$x][$y]."</td>";
    }
    echo "</tr>";
  }
  	
  
  $conn->close();
  ?>
  
  <br><a href='tlogout.php'>logout</a>
</html>
