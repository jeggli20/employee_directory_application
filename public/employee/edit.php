<?php require_once("../../private/initialize.php"); ?>

<?php
$id = $_GET["id"];
$employee = Employee::select_by_id($id);
if($employee === false) {
    redirect_to("/index.php?id=1");
}

if(post_request()) {
    $form_info = $_POST["employee"] ?? [];
    $employee->merge_attributes($form_info);
    $result = $employee->update();

    if($result) {
        $new_id = $employee->id;
        redirect_to("/employee/show.php?id=" . $new_id);
    }
}
?>

<?php
$page_title = "Company Directory - Edit Employee";
$script_path = "/scripts/edit.js";
$stylesheet_path = "/stylesheets/index.css"; 
include_once(SHARED_PATH . "/public_header.php"); 
?>

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
            <a href="<?php echo url_for("/index.php?id=" . url($id)); ?>">&laquo; Back</a>
            <h2>Edit Employee</h2>
        </div>
        <form action="<?php echo url_for("/employee/edit.php?id=" . url($id)); ?>" method="POST">
            <?php include_once(SHARED_PATH . "/form_fields.php"); ?>   
            <button type="submit">Submit</button>           
        </form>
    </div>
</main>

<?php include_once(SHARED_PATH . "/public_footer.php"); ?>