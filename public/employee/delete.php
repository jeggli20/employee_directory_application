<?php require_once("../../private/initialize.php"); ?>

<?php
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

<?php
$page_title = "Company Directory - Delete Employee";
$script_path = "";
$stylesheet_path = "/stylesheets/index.css"; 
include_once(SHARED_PATH . "/public_header.php"); 
?>

<main>
    <div class="crud-content">
        <div class="crud-heading">
            <a href="<?php echo url_for("/index.php?id=" . url($id)); ?>">&laquo; Back</a>
            <h2>Delete Employee</h2>
        </div>
        <p>Are you sure you want to delete <?php echo $employee->full_name(); ?></p>
        <form action="<?php echo url_for("/employee/delete.php?id=" . url($id)); ?>" method="POST">  
            <button class="delete-btn" type="submit">Yes</button>  
            <a class="delete-btn" href="<?php echo url_for("/index.php?id=" . url($id)); ?>">No</a>         
        </form>
    </div>
</main>

<?php include_once(SHARED_PATH . "/public_footer.php"); ?>