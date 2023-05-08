<?php
session_start();

require("rb-mysql.php");



mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}


//check if the user is allowed to access this page

$servername = "localhost";
$username = "root";
$password = "";
$db = "mydb";

//connect to the database
R::setup("mysql:host=$servername;dbname=$db", $username, $password);

// Create connection
// $conn = new mysqli($servername, $username, $password, $db);


// Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// debug_to_console("Connected successfully");


// // Create database
// $sql = "CREATE DATABASE myDB";
// if ($conn->query($sql) === TRUE) {
//   debug_to_console("Database created successfully");
// } else {
//     debug_to_console("Error creating database: " . $conn->error);
// }


?>


<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.css">

    <title>My Site</title>

</head>

<body onload="changebckgrd();">
    <script>
        function changebckgrd() {
            if (sessionStorage.getItem("session_x") === undefined) {
                sessionStorage.setItem("session_x", 2);
            }
            document.body.style.backgroundImage = "url('img/background" + sessionStorage.getItem("session_x") + ".jpg')";
        }
    </script>

    <header>
        <nav class="navbar navbar-expand-sm bg-light">

            <!-- Links -->
            <ul class="navbar-nav header container">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="feed.php">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="feedback.php">Feedback</a>
                </li>
                <li class="nav-item">

                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
                <li class="nav-item">

                    <?php if (!empty($_SESSION['ID'])) {
                        $link = "delog.php";
                        $link2 = "Logout";
                        $clasa = "";
                    } else {
                        $link = "login.php";
                        $link2 = "Login";
                        $clasa = "nelogat";
                    }
                    ?>

                    <a class="nav-link culoare_li <?php echo $clasa; ?>" href="<?php echo $link; ?>"> <?php echo $link2; ?> </a>

                </li>
            </ul>


    </header>