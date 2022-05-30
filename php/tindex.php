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
      echo "Benvenuto ".$_SESSION['mail']."<br>";
      if(isset($_SESSION['partita_iva']))
      	echo "<br><a href='tsupermercati.php'>Gestisci i tuoi supermercati</a>";
      else
      	echo "<br><a href='tbrowsesup.php'>Sfoglia i supermercati</a>";
      echo "<br><a href='tlogout.php'>Logout</a>";
    ?>
</body>
</html>
