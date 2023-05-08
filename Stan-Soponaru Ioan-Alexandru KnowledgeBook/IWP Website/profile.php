<?php
include 'php_shortcuts/header.php';
include 'functions.php';






?>




<div class="content container">

    <h1>Here you can see your profile and your posts.</h1>


    <?php if (empty($_SESSION['ID'])) { ?>
        <a class="profile_links" href="login.php">Login</a>
        <p class="profile_links"> | </p>
        <a class="profile_links" href="register.php"> Register</a>

    <?php } ?>
    <br><br>

    <button class="welcome align_right2" id="btn_back" onclick="schimba_back() ">Change background</button>
    <script>
        var x;

        function schimba_back() {
            btn = document.getElementById("btn_back");
            addEventListener(onclick, btn);

            if (x === undefined) {
                x = 1;
                //alert(x);
            }
            //alert("test");

            //alert(x + " al doilea");
            if (x % 4 == 0) {
                x = 1;
            } else {
                x = x + 1;
            }
            document.body.style.backgroundImage = "url('img/background" + x + ".jpg')";
            sessionStorage.setItem("session_x", x);

            //alert(y);
            //document.getElementById('body').style.backgroundImage = 'url("../img/background"' + x + '".jpg")'
        }
    </script>

    <br><br>
    <?php
    $nrandparantheses = "";
    if (!empty($_SESSION['ID'])) {
        $where = "where `logindb`.`id`= " . $_SESSION['ID'];
        $alecuiarticole = "Your";
        $sql_nr = "SELECT * FROM `articles` WHERE `user_id` = " . $_SESSION['ID'];
    //echo $sql;
    list($nr, $sql_nr) = db_select($sql_nr);
    $nrandparantheses = "(<strong class='welcome'>".$nr."</strong>)";
    } else {
        $where = "";
        $alecuiarticole = "All";
    }

    

    ?> <h2 class="align_left"><?php echo $alecuiarticole ?> posts <?php echo $nrandparantheses ?>: </h2><br>
    <?php
    $sql = "SELECT * FROM `articles` left join `logindb` on `logindb`.`id`=`articles`.`user_id` " . $where;
    list($nr, $articles) = db_select($sql);
    //print_r($articles[0]);
    if ($articles === false) {
        $error = db_error();
        //echo $error;
    }

    if ($nr == 0) {
        echo "<h5 class='align_left welcome'>You have no posts yet, try creating one!</h5>";
    }

    for ($i = 0; $i < $nr; $i++) {

    ?>

        <div class="articole">
            <h3 class="titlu_articol"><?php echo $articles[$i]['title']; ?></h3>
            <p class="body_article"><?php echo substr($articles[$i]['content'], 0, 500); ?></p>
            <p class="semnatura"><?php echo "Made in " . $articles[$i]['creation_data'] . ", created by " . $articles[$i]['nume'] ?></p>


        </div>



    <?php
    }
    ?>




</div>



<?php
include 'php_shortcuts/footer.php';
?>