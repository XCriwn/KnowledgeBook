<?php
//require 'rb-mysql.php';
include 'php_shortcuts/header.php';




// $sql = "SELECT ID, Username, Password FROM logindb";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//   // output data of each row
//   while($row = $result->fetch_assoc()) {
//     echo "id: " . $row["ID"]. " - Name: " . $row["Username"]. " " . $row["Password"]. "<br>";
//   }
// } else {
//   echo "0 results";
// }




if (isset($_POST['Username'])) {
  $prod = R::dispense('logindb');
  //$prod->Username = $_POST['ID'];
  $prod->username = $_POST['Username'];
  $prod->password = $_POST['Password'];
  $prod->password = $_POST['Email'];
  $prod->password = $_POST['Password'];
  $id = R::store($prod);

  // Create connection
}
// function postInput2()
// {
//  .//echo $_POST['input1'];
// }


?>

<div class="content register">

  <br><br><br>
  <h1>Register</h1>
  <form name="form1" method="post" action="register.php">
    <br>
    <input type="text" name="Username" placeholder="Username">
    <br>
    <input type="password" name="Password" placeholder="Password">
    <br>
    <input type="submit" name="input3" placeholder="" style="border-width: 1px; color:darkblue" /><br>
  </form>
  <a href="login.php"><button style="border-width:1px; color:darkred">Already registered?</button></a>

  <?php





  ?>


</div>


<?php
include 'php_shortcuts/footer.php';
?>