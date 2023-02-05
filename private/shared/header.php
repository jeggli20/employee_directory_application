<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $page_title; ?></title>
        <?php
        if(isset($script_path)) {
            echo "<script defer src=" . url_for($script_path) . "></script>"; 
        }
        ?>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Heebo&family=Playfair+Display+SC:wght@700&display=swap" rel="stylesheet">
        <link href="<?php echo url_for("stylesheets/global.css") ?>" rel="stylesheet" />
        <?php
        if(isset($styles_path)) {
            echo "<link href=" . url_for($styles_path) . " rel='stylesheet' />"; 
        }
        ?>
    </head>
    <body>
        <header>
            <div class="heading">
                <h1><?php echo $company_name; ?></h1>
                <span> | </span>
                <h2>Employee Directory</h2>
            </div>
            <?php
            if($session->is_logged_in()) {
                echo "<div class='user'>";
                echo    "<div class='user-text'>";
                echo        "<span>Welcome, " . html($user) . "</span>";
                echo        "<a href=" . url_for("/logout.php") . ">Logout</a>";
                echo    "</div>";
                echo    "<img class='user-photo' src=" . url_for("/images/placeholder_profile.png") . " alt='Employee photo' />";
                echo "</div>";
            }
            ?>
        </header>