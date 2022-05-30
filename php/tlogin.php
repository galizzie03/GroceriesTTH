<html>
<head>
	<link rel="stylesheet" href="tps/style.css">
</head>
<body>
	<h1>Accesso</h1>
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
    
    if(!isset($_POST['mail']) || !isset($_POST['pass']))
    {
    	echo "<form method='post' action='tlogin.php'>\n";
        echo "Email<br><input type='text' name='mail'><br><br>\n";
        echo "Password<br><input type='password' name='pass'><br><br>\n";
        echo "<input type='submit' value='Accedi'>\n";
        echo "<br><br><a href='tsignup.php'>Registrazione</a>";
        echo "</form>\n";
        exit();
    }

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = " SELECT * FROM tpsutenti WHERE Email = '" . $_POST['mail'] . "' AND Password='" . $_POST['pass'] . "'";
    
    $result = $conn->query($sql);
    $data=$result->fetch_assoc();
    if ($result->num_rows > 0) 
    {	
    	if ($data['PartitaIVA'] == null)
        {
        	$_SESSION['mail'] = $_POST['mail'];
        	header("location:tbrowsesup.php");
        }
        else
        {
        	$_SESSION['mail'] = $_POST['mail'];
            $_SESSION['partita_iva'] = $data['PartitaIVA'];
        	header("location:tsupermercati.php");
        }
    }
    else
    	echo "<br><br>Email/password sbagliati o incompleti";
    ?>
</body>
</html>