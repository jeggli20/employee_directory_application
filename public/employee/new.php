<?php require_once("../../private/initialize.php"); ?>

<?php
$page_title = "Company Directory - New Employee";
$errors = [];

if(post_request()) {
    $form_info = $_POST["employee"] ?? [];

    //! TODO validation!!!
    if(empty($errors)) {
        $args = $_POST["employee"];
        $new_emp = new Employee($args);
        $result = $new_emp->insert_into();
        if($result) {
            $new_id = $new_emp->id;
            redirect_to("/employee/show.php?id=" . $new_id);
        }
    }
}

$id = $_GET["id"] ?? "1";
if($id == NULL) {
    redirect_to("/index.php?id=1");
}
 
$employee_info = Employee::select_by_id($id);
$username = $_SESSION["username"] ?? "";
$user = Employee::select_by_username($username)->first_name;
?>

<?php include_once(SHARED_PATH . "/public_header.php"); ?>

<main>
    <div class="crud-content">
        <div class="crud-heading">
            <a href="<?php echo url_for("/index.php"); ?>">&laquo; Back</a>
            <h2>New Employee</h2>
        </div>
        <form action="<?php echo url_for("/employee/new.php"); ?>" method="POST">
            <?php include_once(SHARED_PATH . "/form_fields.php"); ?>   
            <button type="submit">Submit</button>           
        </form>
    </div>
</main>

<?php include_once(SHARED_PATH . "/public_footer.php"); ?>