<?php
include 'php_shortcuts/header.php';
include 'functions.php';
//echo "<pre>" . print_r($_SESSION) . "</pre>";

?>



<!-- <div class="home_text">
    <h1>Welcome to our website!</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <button type="button" id="button1" onclick="showmore()">Read More</button>

    <span id="span1"></span> -->

<div class="content container">

    <h1>Welcome to KnowledgeBook!</h1>
    <!-- <h3>Here you can see our latest articles!</h3> -->


    <?php if (empty($_SESSION['ID'])) { ?>
        <a class="profile_links" href="login.php">Login</a>
        <p class="profile_links"> | </p>
        <a class="profile_links" href="register.php"> Register</a>

    <?php } ?>
    <br><br>

    <h3 class="align_left">Our latest posts: </h3>
    <?php
    $sql = "SELECT * FROM `articles` left join `logindb` on `logindb`.`id`=`articles`.`user_id` ORDER BY `creation_data` DESC LIMIT 3";
    list($nr, $articles) = db_select($sql);
    //print_r($articles[0]);
    if ($articles === false) {
        $error = db_error();
        //echo $error;
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

<script>
    var button = document.getElementById("button1"),
        span = document.getElementById("span1");


    function showmore() {
        span.innerHTML = "<br><br><h1>We are one of the most dedicated firms to our job.</h1><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><h1>Our best interest is you!</h1><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><hr><h2>If i had your attention so far, register now and join us!</h2><hr>";

    }
</script>