<?php
include 'php_shortcuts/header.php';
include 'functions.php';

?>



<div class="content container">

    <h2>Here you can give feedback about the site and suggestions on how to improve it.</h2>
    <br><br>

    <div>
        <form class="align_left" method="POST" action="feedback.php">
            <input class="textarea" type="text" name="title" placeholder="Title..." /><br /><br />
            <textarea class="textarea" type="text" name="content" rows="5" cols="50">Content here... </textarea><br>
            <input type="submit" name="submit" />
        </form>
    </div>

    <?php

    ?>





    <?php

    if (isset($_POST) && !empty($_POST['title']) && !empty($_POST['content'])) {
        $conectare = mysqli_connect(SERVER, UTILIZATOR, PAROLA, TABELA);
        //echo "aaa";
        $sql = "INSERT INTO `feedback` (`id`, `title`, `content`) VALUES (NULL, 
        '" . mysqli_real_escape_string($conectare, desinfect(ucfirst($_POST['title']))) . "',
        '" . mysqli_real_escape_string($conectare, desinfect(ucfirst($_POST['content']))) . "'
    )";
        //echo $sql;
        $insert = mysqli_query($conectare, $sql);
        if (!$insert) {
            die('Este o eroare in sql: ' . mysqli_error($conectare));
        } else echo "<h2 class='welcome'>Feedback offered succesfully.<br> If you would like to, you can add another feedback.</h2>";
        mysqli_close($conectare);
    }


    ?>

</div>




<?php
include 'php_shortcuts/footer.php';
?>