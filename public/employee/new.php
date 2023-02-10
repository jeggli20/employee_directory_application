<?php 
require_once("../../private/initialize.php"); 
require_login();

// Page Variables
$page_title = "Company Directory - New Employee"; 
$script_paths = ["/scripts/validate.js"];
$style_paths = ["/stylesheets/crud.css"];
$form_info = $_POST["employee"] ?? [];
$employee = new Employee($form_info);

if(post_request()) {
    $result = $employee->insert_into();

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
                <a class="back-link" href="<?php echo url_for("/index.php"); ?>">&laquo; Back</a>
                <h2>New Employee</h2>
                <div class="filler"></div> 
            </div>
            <form action="<?php echo url_for("/employee/new.php"); ?>" method="POST">
                <?php include_once(SHARED_PATH . "/form_fields.php"); ?>   
                <button class="btn" type="submit">Submit</button>           
            </form>
        </div>
    </main>
<?php include_once(SHARED_PATH . "/footer.php"); ?>