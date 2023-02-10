<?php 
require_once("../private/initialize.php"); 
require_login();

// Page Variables
$page_title = "Company Directory";
$script_paths = ["/scripts/index.js"];
$style_paths = ["/stylesheets/index.css"];
$employees = Employee::select_all(["sort" => "first_name"]);
$jobs = Job::select_all(["sort" => "job_title"]);

$id = $_GET["id"] ?? "1";
if($id == NULL) {
    redirect_to("/index.php?id=1");
}
 
$employee_info = Employee::select_by_id($id);
?>

<!-- Page Content -->
<?php include_once(SHARED_PATH . "/header.php"); ?>
    <main class="main-content">
        <div class="search">
            <div class="search-tool">
                <input id="searchbar" type="search" name="search" placeholder="Search..." />
            </div>
            <div class="employee-list-container">
                <ul class="employee-list">
                    <?php
                    if($session->job_id === "3") {
                        echo "<a class='new-link' href='" . url_for("/employee/new.php") . "'><li>+ New Employee</li></a>";
                    }
                    ?>
                    <?php
                    foreach($employees as $employee) {
                        echo "<a class='employee-link'  href='" . url_for("/index.php?id=" . $employee->id) . "'><li class='employee ";
                        if($id === $employee->id) {
                            echo "current-employee";
                        }
                        echo "'><div class='employee-identity'><img class='list-photo' src='" . url_for("/images/employees/thumb/thumb" . "_placeholder_profile" . ".png") . "' alt='Employee photo' />" . html($employee->full_name());
                        if($session->compare_id($employee->id)) {
                            echo "</div><span class='user-indicator'>Me</span>";
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
                    <img class="employee-photo" src="<?php echo url_for('/images/employees/' . 'placeholder_profile' . '.png') ?>" alt="Employee photo" />
                    <div class="list-container">
                        <ul class="basic-list">
                            <li class="list-item">Name:<span class="info"><?php echo html($employee_info->full_name()); ?></span></li>
                            <li class="list-item">Birthday:<span class="info"><?php echo html($employee_info->date_formatter("birthday")); ?></span></li>
                            <li class="list-item">First Employed:<span class="info"><?php echo html($employee_info->date_formatter("date_started")); ?></span></li>
                            <li class="list-item">Time Employed:<span class="info"><?php echo html($employee_info->date_formatter("time_employed")); ?></span></li>
                        </ul>
                    </div>
                </div>
                <div class="extra-info">
                    <div class="extra-btn-disabled">Title:<span class="info"><?php echo html($employee_info->id_to_string("job")); ?></span></div>
                    <a class="extra-btn" href="<?php echo url_for('/index.php?id=' . ($employee_info->supervisor_id ?? $employee_info->id)); ?>">Reports To:<span class="info"><?php echo html($employee_info->id_to_string("supervisor")); ?></span></a>
                </div>
                <div class="extra-info">
                    <a class="extra-btn" href="tel:<?php echo $employee_info->phone_number_formatter()["numbers"]; ?>">Phone:<span class="info"><?php echo html($employee_info->phone_number_formatter()["display"]); ?></span></a>
                    <a class="extra-btn" href="mailto:example@gmail.com">Email:<span class="info"><?php echo html($employee_info->email); ?></span></a>
                </div>
            </div>
            <?php
            if($session->job_id === "3") {
                echo "<div class='crud-links'>";
                echo "<a class='crud-link' type='button' href='" . url_for("/employee/edit.php?id=" . url($employee_info->id)) . "'>Edit Employee</a>";
                echo "<a class='crud-link' type='button' href='" . url_for("/employee/delete.php?id=" . url($employee_info->id)) . "'>Delete Employee</a>";
                echo "</div>";
            }
            ?>
        </div>
    </main>
<?php include_once(SHARED_PATH . "/footer.php"); ?>
