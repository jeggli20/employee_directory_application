<?php 
require_once("../../private/initialize.php"); 
require_login();

// Page Variables
$page_title = "Company Directory - Edit Employee";
$script_paths = ["/scripts/edit.js", "/scripts/validate.js"];
$style_paths = ["/stylesheets/crud.css"];
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

<!-- Page Content -->
<?php include_once(SHARED_PATH . "/header.php"); ?>
    <main>
        <div class="crud-content">
            <div class="crud-heading">
                <a class="back-link" href="<?php echo url_for("/index.php?id=" . url($id)); ?>">&laquo; Back</a>
                <h2>Edit Employee</h2>
                <div class="filler"></div> 
            </div>
            <form action="<?php echo url_for("/employee/edit.php?id=" . url($id)); ?>" method="POST">
                <?php include_once(SHARED_PATH . "/form_fields.php"); ?>   
                <button class="btn" type="submit">Submit</button>           
            </form>
        </div>
    </main>
<?php include_once(SHARED_PATH . "/footer.php"); ?>