<?php

include 'php_shortcuts/header.php';

include 'functions.php';



if (isset($_POST) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['nume']) && !empty($_POST['email'])) {
  $conectare = mysqli_connect(SERVER, UTILIZATOR, PAROLA, TABELA);
  //echo "aaa";
  $sql = "INSERT INTO `logindb` (`ID`, `nume`, `email`, `username`, `password`) VALUES (NULL, 
      '" . mysqli_real_escape_string($conectare, desinfect(ucfirst($_POST['nume']))) . "',
      '" . mysqli_real_escape_string($conectare, desinfect(ucfirst($_POST['email']))) . "',
      '" . mysqli_real_escape_string($conectare, desinfect(ucfirst($_POST['username']))) . "',
      '" . mysqli_real_escape_string($conectare, desinfect(ucfirst($_POST['password']))) . "'
  )";
  //echo $sql;
  $insert = mysqli_query($conectare, $sql);
  if (!$insert) {
    die('Este o eroare in sql: ' . mysqli_error($conectare));
  } else echo "User registered succesfully.";
  mysqli_close($conectare);




  //print_r($_SESSION);

  Redirect('welcome.php');
}


?>

<div class="content register">

  <br><br><br>
  <h1>Register</h1>
  <form name="form1" method="post" action="register.php">
    <br>
    <input type="text" name="nume" placeholder="Name">
    <br>
    <input type="email" name="email" placeholder="Email account">
    <br>
    <input type="text" name="username" placeholder="Username">
    <br>
    <input type="password" name="password" placeholder="Password">
    <br>
    <input type="submit" name="input3" style="border-width: 1px; color:darkblue" /><br>
  </form>
  <a href="login.php"><button style="border-width:1px; color:darkred">Already registered?</button></a>

  <?php





  ?>


</div>


<?php
include 'php_shortcuts/footer.php';
?>