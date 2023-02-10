<?php 
require_once("../private/initialize.php"); 

// Page variables
$page_title = "Company Directory - Login";
$script_paths = ["/scripts/validate.js"];
$style_paths = ["/stylesheets/login.css"];
$password = "";
$username= "";
$pass_class = "";
$user_class = "";
$errors = [];

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
        if($user !== NULL && $user->verify_password($password)) {
            $session->login($user);
            redirect_to("/index.php?id=" . url($user->id));
        } else {
            $errors[] ="Something went wrong. Check your credentials and try again";
        }
    }
}
?>

<!-- Page Content -->
<?php include_once(SHARED_PATH . "/header.php"); ?>
    <main>
        <div class="container">
            <div class="header-container">
                <img class="logo" src="<?php echo url_for("/images/placeholder_logo.png"); ?>" alt="Company Logo" />
                <h2>Employee Directory Login</h2>
            </div>
             <!-- Error Display -->
            <?php
            if(!empty($errors)) {
                echo "<div class='errors-container'>";
                echo    "<ul class='errors-list'>";
                foreach($errors as $error) {
                    echo "<li class='error'>" . $error . "</li>";
                }
                echo    "</ul>";
                echo "</div>";
            }
            ?>
            <div class="content-container">
                <form class="login-form" action="<?php echo url_for('/login.php'); ?>" method="POST">
                    <div class="input-group">
                        <label for="username">Username: </label>
                        <input class="<?php echo $user_class; ?>" type="text" id="username" name="username" placeholder="Username" value="<?php echo $username; ?>" />
                    </div>
                    <div class="input-group">
                        <label for="password">Password: </label>
                        <input class="<?php echo $pass_class; ?>" type="password" id="password" name="password" placeholder="Password" value="<?php echo $password; ?>" />
                    </div>
                    <button class="btn" type="submit" class="login-btn">Login</button> 
                </form>
            </div>
        </div>
    </main>
<?php include_once(SHARED_PATH . "/footer.php"); ?>
