<?php
include 'php_shortcuts/header.php';


//echo "<pre>" . print_r($_w) . "</pre>";

include 'functions.php';


if (isset($_SESSION['ID'])) {
?>
    <div class="content container">




        <?php
        echo "<br>
    <h1 class='welcome'> You cannot relog because you are already connected," .  $_SESSION['nume'] . " </h1>
    <br>
    <h2 class='welcome'> You can unlog here. </h2>
    <a href='" . DOMENIU . "delog.php'><button>Delog here</button></a>";
        ?>

    </div>
<?php
} else {

    //echo $_POST['username'] . $_POST['password'];
    if (isset($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {
        //echo "trimit";
        $where = " `username` LIKE " . db_quote(desinfect($_POST['username']));

        $sql = "SELECT `ID`, `nume`, `email`, `username`, `password` FROM `logindb` WHERE " . $where . " LIMIT 1";
        //echo $sql;
        list($nr, $preiau) = db_select($sql);
        if ($preiau === false) {
            $error = db_error();
            //echo $error;
        }
        //	if($preiau[0]['activ'] == ''){
        //		$eroare = "<div class='nereusita' style='display:block'>User inactiv!<br/> Vă rugăm să contactați administratorul site-ului.</div>";
        //	}

        if ($preiau) {
            //print_r($preiau);
            if (strtolower($preiau[0]['username']) === strtolower($_POST['username']) && $preiau[0]['password'] === $_POST['password']) {
                $_SESSION = $preiau[0];

                //$_SESSION['logat'] = 1;


                //print_r($_SESSION);
                //exit;
                Redirect('welcome.php');
            } else {
                $eroare = "<div class='nereusita' style='display:block'>Combinație parolă / username nereușită!<br/> Vă rugăm să reîncercați logarea sau să contactați administratorul site-ului.</div>";
            }
        }
    }
?>



    <div class="content container">

        <h1>Please login into your account.</h1>



        <div class="login">
            <h1>Login</h1>

            <FORM name="form2" method="POST" action="login.php">

                <input type="text" name="username" placeholder="Username">
                <br>
                <input type="password" name="password" placeholder="Password">
                <br>
                <input type="hidden" name="referer" value="login">
                <br>
                <input type="submit" placeholder="" style="border-width: 1px; color:darkblue" />
            </form>
            <a href="register.php"><button type="submit" style="border-width:1px; color:darkred">Register</button></a>
            <br><br><br>
            <?php

            if (isset($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {
                echo "<br>Connection unsuccesfull. Please check your username and password!";
            }



            ?>
        </div>



    </div>
<?php
}


?>




<?php
include 'php_shortcuts/footer.php';
?>