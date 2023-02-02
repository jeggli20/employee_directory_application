<?php require_once("../../private/initialize.php"); ?>

<?php
$page_title = "Company Directory - New Employee";

if(post_request()) {
    $form_info = $_POST["employee"] ?? [];
    $employee = new Employee($form_info);
    $result = $employee->insert_into();

    if($result) {
        $new_id = $employee->id;
        redirect_to("/employee/show.php?id=" . $new_id);
    }
}
?>

<?php include_once(SHARED_PATH . "/public_header.php"); ?>

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