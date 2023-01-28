<?php require_once("../private/initialize.php"); ?>

<?php
if(post_request()) {
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";

    $user = Employee::select_by_username($username);

    $session->login($user);
    redirect_to("/index.php?id=" . url($user->id));
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $page_title; ?></title>
        <script defer src="scripts/public.js"></script>
        <link href="./styles/login.css" rel="stylesheet" />
    </head>
    <body>
        <main>
            <header>
                <img src="./images/placeholder_logo.png" alt="Company Logo" />
                <h2>Employee Directory Login</h2>
            </header>
            <div class="login-content">
                <form class="login-form" action="<?php echo url_for('/login.php'); ?>" method="POST">
                    <div class="input-group">
                        <label for="username">Username: </label>
                        <input type="text" id="username" name="username" placeholder="Username" />
                    </div>
                    <div class="input-group">
                        <label for="password">Password: </label>
                        <input type="password" id="password" name="password" placeholder="Password" />
                    </div>
                    <button type="submit" class="login-btn">Login</button> 
                </form>
            </div>
        </main>
    </body>
</html>
