<html>
<head>
<link rel="stylesheet" href="tps/style.css">
</head>
<body>
  <?php
    session_start();
    $servername = "localhost";
    $username = "galizzi.edoardo.studente@itispaleocapa.it";
    $password = "m2tjprgWwzDm";
    $dbname = "my_edoardogalizzi";
    
    if(isset($_SESSION['mail']))
    {
    	if (isset($_SESSION['partita_iva']))
        	header("location:tsupermercati.php");
        else
        	header("location:tbrowsesup.php");
    }
  ?>
  <h1>Registrazione</h1>
  <form action="tsignup.php" method="post">
  Nome<br> <input type="text" name="nome" id="nome"><br><br>
  Cognome<br> <input type="text" name="cognome" id="cognome"><br><br>
  Mail<br> <input type="text" name="mail" id="mail"><br><br>
  Password<br> <input type="pass" name="pass" id="pass"><br><br>
  Partita IVA (solo se proprietario di un supermercato)<br> <input type="text" name="iva" id="iva"><br><br>
  <input type='submit' value='Registrati'><br><br>
  <a href='tlogin.php'>Accedi</a>
  <?php

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $mail = $_POST["mail"];
    $pass =  $_POST["pass"];
    $iva = $_POST["iva"];
    $controllo = " SELECT * FROM tpsutenti WHERE Email='".$mail."' OR PartitaIVA='".$iva."'";
    $inserimentoc = " INSERT INTO tpsutenti (PartitaIVA,Email,Password,Nome,Cognome) VALUES (NULL,'".$mail."','".$pass."','".$_POST["nome"]."','".$_POST["cognome"]."')";
    $inserimentop = " INSERT INTO tpsutenti (PartitaIVA,Email,Password,Nome,Cognome) VALUES ('".$iva."','".$mail."','".$pass."','".$_POST["nome"]."','".$_POST["cognome"]."')";
    $result = $conn->query($controllo);

    if (!($result->num_rows > 0)) 
    {
      if ($mail != "" && $pass != "" && $_POST["nome"] != "" && $_POST["cognome"] != "")
      {
          $_SESSION['mail'] = $mail;
          if ($iva!="" || $iva!=null)
          {
          	$conn->query($inserimentop);
          	$_SESSION['partita_iva'] = $iva;
          }
          else
          	$conn->query($inserimentoc);
          header("location:tlogin.php");
      }
      else
          echo "<br><br>Dati mancanti";
    } 
    else {
    	echo "<br><br>Mail e/o partita iva già usata";
  }
    $conn->close();
    ?>
</body>
</html>
