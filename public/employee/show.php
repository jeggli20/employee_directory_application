<?php 
require_once("../../private/initialize.php"); 
require_login();
$styles_path = "/stylesheets/crud.css";
?>

<?php
$id = $_GET["id"];
if($id === NULL) {
    redirect_to("/index.php");
}
 
$employee_info = Employee::select_by_id($id);
?>

<?php
$page_title = "Company Directory - Show Employee"; 
include_once(SHARED_PATH . "/header.php"); 
?>

<main>
    <div class="crud-content">
        <div class="crud-heading">
            <a class="back-link" href="<?php echo url_for("/index.php?id=" . url($employee_info->id)); ?>">&laquo; Back</a>
            <h2>Employee Information</h2>
            <div class="filler"></div> 
        </div>
        <ul class="show-list">
            <li class="show-item">First Name:<span class="info"><?php echo $employee_info->first_name; ?></span></li>
            <li class="show-item">Last Name:<span class="info"><?php echo $employee_info->last_name; ?></span></li>
            <li class="show-item">Username:<span class="info"><?php echo $employee_info->username; ?></span></li>
            <li class="show-item">Email:<span class="info"><?php echo $employee_info->email; ?></span></li>
            <li class="show-item">Birthday:<span class="info"><?php echo $employee_info->date_formatter("birthday"); ?></span></li>
            <li class="show-item">Phone Number:<span class="info"><?php echo $employee_info->phone_number_formatter()["display"]; ?></span></li>
            <li class="show-item">Job Title:<span class="info"><?php echo $employee_info->id_to_string("job"); ?></span></li>
            <li class="show-item">Supervisor:<span class="info"><?php echo $employee_info->id_to_string("supervisor"); ?></span></li>
            <li class="show-item">Date Started:<span class="info"><?php echo $employee_info->date_formatter("date_started"); ?></span></li>
        </ul>
    </div>
</main>

<?php include_once(SHARED_PATH . "/footer.php"); ?>