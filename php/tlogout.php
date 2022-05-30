<?php
  session_start();
  session_destroy();
  header("location:tlogin.php");
?>
<style>
body {
  padding-top: 50px;
  padding-right: 600px;
  padding-bottom: 50px;
  padding-left: 600px;
}
</style>