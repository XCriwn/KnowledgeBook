<?php
session_start();
include 'functions.php';


session_start();

if ($_SESSION["ID"]) {
    session_unset();
    session_destroy();
    $_SESSION = array();
    Redirect(DOMENIU . 'home.php', false);
} else {
    echo "You cannot delog because you have not been logged in yet!";
}

?>

<?php ?>
