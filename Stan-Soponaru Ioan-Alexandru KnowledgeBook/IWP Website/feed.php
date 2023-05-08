<?php
include 'php_shortcuts/header.php';
include 'functions.php';
//print_r($_SESSION);
?>
<div class="content container">
    <?php
    if (empty($_SESSION['ID'])) {
    ?> <h1>Here you can look at posts sent by other people.</h1><br>
        <p>To create a post, please login <a class="welcome" href="login.php">here</a> first!</p>
    <?php
    } elseif (!empty($_SESSION['ID'])) {
    ?>
        <h1>Here you can look at posts sent by other people or create a post yourself.</h1><br>
        <h3 class="align_left">Create a post: </h3>
        <div>
            <form class="align_left" method="post" action="feed.php">
                <input class="textarea" type="text" name="title" placeholder="Post title" /><br /><br />
                <textarea class="textarea" type="text" name="content" rows="5" cols="50">Content here... </textarea><br>
                <input type="submit" name="submit" />
            </form>
        </div>


        <?php

        if (!empty($_POST['title']) && !empty($_POST['content'])) { ?>
            <form id="redirect_post" method="POST" action="postCreated.php">
                <input type="hidden" name="title" value="<?php echo $_POST['title']; ?>" />
                <input type="hidden" name="content" value="<?php echo $_POST['content']; ?>" />
            </form>
            <script type="text/javascript">
                document.getElementById('redirect_post').submit();
            </script>
    <?php

        }
    }

    ?>

    <br><br>
    <h3 class="align_left">Other posts: </h3>


    <?php
    //SELECT * FROM `articles` left join `logindb` on `logindb`.`id`=`articles`.`user_id` where `logindb`.`id`=19
    $sql = "SELECT * FROM `articles` left join `logindb` on `logindb`.`id`=`articles`.`user_id`";
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