<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $page_title; ?></title>
        <script defer src="scripts/index.js"></script>
        <link href="<?php echo url_for("/stylesheets/index.css"); ?>" rel="stylesheet" />
    </head>
    <body>
        <header>
            <div class="heading">
                <h1>Company Name</h1>
                <span> | </span>
                <h2>Employee Directory</h2>
            </div>
            <div class="user">
                <div class="user-text">
                    <span>Welcome, <?php echo html($user); ?></span>
                    <a href="<?php echo url_for("/logout.php"); ?>">Logout</a>
                </div>
                <img class="user-photo" src="<?php echo url_for("/images/placeholder_profile.png"); ?>" alt="Employee photo" />
            </div>
        </header>