<?php require_once("../private/initialize.php"); ?>

<?php
$php_title = "Company Name";
$employees = Employee::select_all();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $page_title; ?></title>
        <script defer src="scripts/public.js"></script>
        <link href="./styles/public.css" rel="stylesheet" />
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
                    <span>Welcome, <?php echo "Employee First Name"; ?></span>
                    <span>Logout</span>
                </div>
                <img class="user-photo" src="./images/placeholder-profile.png" alt="Employee photo" />
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
                            echo "<a class='employee-link'  href='#'><li class='employee'><img class='list-photo' src='./images/placeholder-profile.png' alt='Employee photo' />" . $employee->full_name() . "</li></a>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="employee-info">
                <div class="information">
                    <div class="basic-info">
                        <img class="employee-photo" src="./images/placeholder-profile.png" alt="Employee photo" />
                        <div>
                            <ul class="basic-list">
                                <li class="list-item">Name: <?php echo "James Tanner"; ?></li>
                                <li class="list-item">Birthday: <?php echo "Jun 15th"; ?></li>
                                <li class="list-item">First Employed: <?php echo "Dec 12th, 2012"; ?></li>
                                <li class="list-item">Time Employed: <?php echo "10 years 2 months 14 days"; ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="extra-info">
                        <button class="extra-btn" type="button">Title: <?php echo "Engineer"; ?></button>
                        <a class="extra-btn" href="#">Reports To: <?php echo "James Tanner"; ?></a>
                    </div>
                    <div class="extra-info">
                        <a class="extra-btn" href="tel:1111111111">Phone: <?php echo "111-111-1111"; ?></a>
                        <a class="extra-btn" href="mailto:example@gmail.com">Email: <?php echo "example@gmail.com"; ?></a>
                    </div>
                </div>
                <div></div>
            </div>
            <footer>

            </footer>
        </main>
    </body>
</html>