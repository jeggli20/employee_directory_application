<?php require_once("../private/initialize.php"); ?>

<?php
$employees = Employee::select_all();

$id = $_GET["id"] ?? "1";
if($id == NULL) {
    redirect_to("/index.php?id=1");
}
 
$employee_info = Employee::select_by_id($id);
?>

<?php
$page_title = "Company Directory";
$script_path = "/scripts/index.js";
$stylesheet_path = "/stylesheets/index.css"; 
include_once(SHARED_PATH . "/public_header.php"); 
?>

<main class="main-content">
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
                if($session->job_id === "3") {
                    echo "<a href='" . url_for("/employee/new.php") . "'><li>+ New Employee</li></a>";
                }
                ?>
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
                <a class="extra-btn" href="<?php echo url_for('/index.php?id=' . ($employee_info->supervisor_id ?? $employee_info->id)); ?>">Reports To: <?php echo html($employee_info->id_to_string("supervisor")); ?></a>
            </div>
            <div class="extra-info">
                <a class="extra-btn" href="tel:1111111111">Phone: <?php echo html($employee_info->phone_number); ?></a>
                <a class="extra-btn" href="mailto:example@gmail.com">Email: <?php echo html($employee_info->email); ?></a>
            </div>
        </div>
        <div>
            <?php
            if($session->job_id === "3") {
                echo "<div>";
                echo "<a type='button' href='" . url_for("/employee/edit.php?id=" . url($employee_info->id)) . "'>Edit Employee</a>";
                echo "<a type='button' href='" . url_for("/employee/delete.php") . "'>Delete Employee</a>";
                echo "</div>";
            }
            ?>
            <img class="company-logo" src="<?php echo url_for("/images/placeholder_logo.png"); ?>" alt="Company logo" />
        </div>
    </div>
</main>

<?php include_once(SHARED_PATH . "/public_footer.php"); ?>
