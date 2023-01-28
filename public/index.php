<?php require_once("../private/initialize.php"); ?>

<?php
$page_title = "Company Directory";
$employees = Employee::select_all();

$id = $_GET["id"] ?? "1";
if($id == NULL) {
    redirect_to("/index.php?id=1");
}
 
$employee_info = Employee::select_by_id($id);
$username = $_SESSION["username"] ?? "";
$user = Employee::select_by_username($username)->first_name;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $page_title; ?></title>
        <script defer src="scripts/index.js"></script>
        <link href="./styles/index.css" rel="stylesheet" />
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
                <img class="user-photo" src="./images/placeholder_profile.png" alt="Employee photo" />
            </div>
        </header>
        <main>
            <div class="search">
                <div class="search-tools">
                    <label for="sort">Sort:</label>
                    <select id="sort" name="sort">
                        <option value="a-z">A-Z</option>
                        <option value="z-a">Z-A</option>
                    </select>
                    <input id="searchbar" type="search" name="search" placeholder="Search..." />
                </div>
                <div class="employee-list-container">
                    <ul class="employee-list">
                        <?php
                        foreach($employees as $employee) {
                            echo "<a class='employee-link'  href='" . url_for("/index.php?id=" . $employee->id) . "'><li class='employee'><img class='list-photo' src='./images/placeholder_profile.png' alt='Employee photo' />" . html($employee->full_name());
                            if($session->compare_id($employee->id)) {
                                echo "<span class='user-indicator'>You</span>";
                            }
                            echo "</li></a>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="employee-info">
                <div class="information">
                    <div class="basic-info">
                        <img class="employee-photo" src="./images/placeholder_profile.png" alt="Employee photo" />
                        <div>
                            <ul class="basic-list">
                                <li class="list-item">Name: <?php echo html($employee_info->full_name()); ?></li>
                                <li class="list-item">Birthday: <?php echo html($employee_info->birthday); ?></li>
                                <li class="list-item">First Employed: <?php echo html($employee_info->date_started); ?></li>
                                <li class="list-item">Time Employed: <?php echo html($employee_info->time_employed_days); ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="extra-info">
                        <button class="extra-btn" type="button">Title: <?php echo html($employee_info->id_to_string("job")); ?></button>
                        <a class="extra-btn" href="<?php echo url_for('/index.php?id=' . $employee_info->supervisor_id); ?>">Reports To: <?php echo html($employee_info->id_to_string("supervisor")); ?></a>
                    </div>
                    <div class="extra-info">
                        <a class="extra-btn" href="tel:1111111111">Phone: <?php echo html($employee_info->phone_number); ?></a>
                        <a class="extra-btn" href="mailto:example@gmail.com">Email: <?php echo html($employee_info->email); ?></a>
                    </div>
                </div>
                <div></div>
            </div>
            <footer>

            </footer>
        </main>
    </body>
</html>