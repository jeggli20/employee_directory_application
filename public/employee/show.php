<?php require_once("../../private/initialize.php"); ?>

<?php
$page_title = "Company Directory - Show Employee";

$id = $_GET["id"];
if($id === NULL) {
    redirect_to("/index.php");
}
 
$employee_info = Employee::select_by_id($id);
?>

<?php include_once(SHARED_PATH . "/public_header.php"); ?>

<main>
    <?php
    if(!empty($employee->errors)) {
        echo "<div class='errors-container'>";
        echo "<ul class='errors-list'>";
        foreach($employee->errors as $error) {
            echo "<li class='error'>" . $error . "</li>";
        }
        echo "</ul>";
        echo "</div>";
    }
    ?>
    <div class="crud-content">
        <div class="crud-heading">
            <a href="<?php echo url_for("/index.php"); ?>">&laquo; Back</a>
            <h2>Employee Information</h2>
        </div>
        <ul>
            <li>First Name: <?php echo $employee_info->first_name; ?></li>
            <li>Last Name: <?php echo $employee_info->last_name; ?></li>
            <li>Username: <?php echo $employee_info->username; ?></li>
            <li>Email: <?php echo $employee_info->email; ?></li>
            <li>Birthday: <?php echo $employee_info->birthday; ?></li>
            <li>Phone Number: <?php echo $employee_info->phone_number; ?></li>
            <li>Job Title: <?php echo $employee_info->id_to_string("job"); ?></li>
            <li>Supervisor: <?php echo $employee_info->id_to_string("supervisor"); ?></li>
            <li>Date Started: <?php echo $employee_info->date_started; ?></li>
            <li>Time Employed (Days): <?php echo $employee_info->time_employed_days; ?></li>
        </ul>
    </div>
</main>

<?php include_once(SHARED_PATH . "/public_footer.php"); ?>