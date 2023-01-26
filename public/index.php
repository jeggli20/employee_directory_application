<?php require_once("../private/initialize.php"); ?>

<?php
$php_title = "Company Name";
$search = "";
$employees = Employee::select_all();

if(post_request()) {
    $search = $_POST["search"];
    $employees = Employee::select_name($search);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $page_title; ?></title>
    </head>
    <body>
        <form action="<?php echo url_for("/index.php"); ?>" method="POST">
            <input id="searchbar" type="search" name="search" placeholder="Search..." value="<?php echo $search; ?>" />
            <button type="submit">Go</button>
        </form>
        <div class="employee_list">
            <ul>
                <?php
                foreach($employees as $employee) {
                    echo "<a href='#'><li>" . $employee->full_name() . "</li></a>";
                }
                ?>
            </ul>
        </div>
    </body>
</html>