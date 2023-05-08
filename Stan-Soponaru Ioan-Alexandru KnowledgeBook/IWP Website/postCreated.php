<?php
include 'php_shortcuts/header.php';
include 'functions.php';
?> <div class="content container">
    <?php
    //print_r($_SESSION);
    //echo $_POST['title'] . $_POST['content'];

    if (isset($_POST) && !empty($_POST['title']) && !empty($_POST['content'])) {
        $conectare = mysqli_connect(SERVER, UTILIZATOR, PAROLA, TABELA);
        //echo "aaa";

        //$date = DateTime::createFromFormat('d-m-Y', date('d-m-Y'))->setTime(time(), time());
        //echo $date->format('d M Y g:i:s a');
        $date = date("Y-m-d H:i:s", time() + 1 * 3600);
        $sql = "INSERT INTO `articles` (`id`, `title`, `content`, `creation_data`, `user_id`) VALUES (NULL, 
        '" . mysqli_real_escape_string($conectare, desinfect(ucfirst($_POST['title']))) . "',
        '" . mysqli_real_escape_string($conectare, desinfect(ucfirst($_POST['content']))) . "',
        '" . $date . "',
        '" . $_SESSION['ID'] . "'
    )";
        //echo $sql;
        $insert = mysqli_query($conectare, $sql);
        if (!$insert) {
            die('Este o eroare in sql: ' . mysqli_error($conectare));
        } else {
            $nrarticole = "";


            $sql = "SELECT * FROM `articles` WHERE `user_id` = " . $_SESSION['ID'];
            //echo $sql;
            list($nr, $sql) = db_select($sql);
            if ($sql === false) {
                $error = db_error();
                //echo $error;
            }


            echo "<h1>Post created for <em>" . ucwords($_SESSION['nume']) . "</em>.</h1><br><br><h3>Now you can look at your posts in the <a href='feed.php' class='welcome'>Posts</a> tab. </h3><br><br><h4>You have a number of <a href='profile.php' class='welcome'>" . $nr . "</a> posts already created.</h4>";
        }
        mysqli_close($conectare);

    ?> <?php
    }

        ?>




</div>



<?php
include 'php_shortcuts/footer.php';
?>