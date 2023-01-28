<?php require_once("../private/initialize.php"); ?>

<?php
$page_title = "Company Directory - Login";
$username= "";
$password = "";
$errors = [];
$user_class = "";
$pass_class = "";

if(post_request()) {
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";
    
    if(is_blank($username)) {
        $errors[] = "Username cannot be blank";
        $user_class = "invalid";
    }
    if(is_blank($password)) {
        $errors[] = "Password cannot be blank";
        $pass_class = "invalid";
    }
    if(empty($errors)) {
        $user = Employee::select_by_username($username);
        if($user !== NULL) {
            $session->login($user);
            redirect_to("/index.php?id=" . url($user->id));
        } else {
            $errors[] ="Something went wrong. Try again";
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $page_title; ?></title>
        <script defer src="scripts/login.js"></script>
        <link href="./styles/login.css" rel="stylesheet" />
    </head>
    <body>
        <main>
            <header>
                <img src="./images/placeholder_logo.png" alt="Company Logo" />
                <h2>Employee Directory Login</h2>
            </header>
            <?php
            if(!empty($errors)) {
                echo "<div class='errors-container'>";
                echo "<ul class='errors-list'>";
                foreach($errors as $error) {
                    echo "<li class='error'>" . $error . "</li>";
                }
                echo "</ul>";
                echo "</div>";
            }
            ?>
            <div class="login-content">
                <form class="login-form" action="<?php echo url_for('/login.php'); ?>" method="POST">
                    <div class="input-group">
                        <label for="username">Username: </label>
                        <input class="<?php echo $user_class; ?>" type="text" id="username" name="username" placeholder="Username" value="<?php echo $username; ?>" />
                    </div>
                    <div class="input-group">
                        <label for="password">Password: </label>
                        <input class="<?php echo $pass_class; ?>" type="password" id="password" name="password" placeholder="Password" value="<?php echo $password; ?>" />
                    </div>
                    <button type="submit" class="login-btn">Login</button> 
                </form>
            </div>
        </main>
    </body>
</html>
