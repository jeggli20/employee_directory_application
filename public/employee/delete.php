<?php 
require_once("../../private/initialize.php"); 
require_login();

// Page Variables
$page_title = "Company Directory - Delete Employee";
$script_paths = ["/scripts/delete.js"];
$style_paths = ["/stylesheets/crud.css"]; 
$id = $_GET["id"];
$employee = Employee::select_by_id($id);

if($employee === false) {
    redirect_to("/index.php?id=1");
}

if(post_request()) {
    $result = $employee->delete();

    if($result) {
        redirect_to("/index.php");
    }
}
?>

<!-- Page Content -->
<?php include_once(SHARED_PATH . "/header.php"); ?>
    <main>
        <div class="crud-content">
            <div class="crud-heading">
                <a class="back-link" href="<?php echo url_for("/index.php?id=" . url($id)); ?>">&laquo; Back</a>
                <h2>Delete Employee</h2>
                <div class="filler"></div> 
            </div>
            <form class="delete-form" action="<?php echo url_for("/employee/delete.php?id=" . url($id)); ?>" method="POST">  
            <p class="delete-text">Are you sure you want to delete <?php echo $employee->full_name(); ?>?</p>
            <div class="btns">
                <button class="delete-btn" type="submit">Yes</button>  
                <a class="delete-btn" href="<?php echo url_for("/index.php?id=" . url($id)); ?>" type="button"><div>No</div></a>        
            </div>
            </form>
        </div>
    </main>
<?php include_once(SHARED_PATH . "/footer.php"); ?>