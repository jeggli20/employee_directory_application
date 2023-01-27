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
    </head>
    <body>
        <div id="search">
            <label for="sort">Sort:</label>
            <select id="sort" name="sort">
                <option value="a-z">A-Z</option>
                <option value="z-a">Z-A</option>
            </select>
            <input id="searchbar" type="search" name="search" placeholder="Search..." />
        </div>
        <div class="employee_list">
            <ul>
                <?php
                foreach($employees as $employee) {
                    echo "<a href='#'><li class='employee'>" . $employee->full_name() . "</li></a>";
                }
                ?>
            </ul>
        </div>
    </body>
</html>