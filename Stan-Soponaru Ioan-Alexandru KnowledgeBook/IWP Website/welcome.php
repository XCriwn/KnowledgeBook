<?php
include 'php_shortcuts/header.php';
include 'functions.php';
//echo "<pre>" . print_r($_SESSION) . "</pre>";

$a = explode('/', $_SERVER['HTTP_REFERER']);
$b = count($a);

//echo $a[$b-1];
echo "<div class='content container'>";
if ($a[$b - 1] == "login.php") {

    echo "<br><h1 class='welcome'> Welcome " . $_SESSION['nume'] . "</h1>";
} elseif ($a[$b - 1] == "register.php") {
    echo "<br><h1 class='welcome'> Congrats on the new account "  . "</h1>"; //. $_SESSION['nume']
}


?>


<br>
<p>If you're interested in learning more about us you can go to the <a class="welcome" href="home.php"><em>Home</em></a> page.</p>
<p>If you'd like to see other posts, consider the <a class="welcome" href="feed.php"><em>Posts</em></a> page.</p>
<p>If you'd like to drop some feedback, consider the <a class="welcome" href="feedback.php"><em>Feedback</em></a> page.</p>
<p>To see your profile, you can click on the <a class="welcome" href="profile.php"><em>Profile</em></a> page.</p>
</div>




<?php
include 'php_shortcuts/footer.php';
?>