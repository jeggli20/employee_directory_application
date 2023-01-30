<?php require_once("../../private/initialize.php"); ?>

<?php
$page_title = "Company Directory - Delete Employee";

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
    <a href="<?php echo url_for("/index.php"); ?>">&laquo; Back</a>
</main>

<?php include_once(SHARED_PATH . "/public_footer.php"); ?>