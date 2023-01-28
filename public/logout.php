<?php require_once("../private/initialize.php"); ?>

<?php
$session->logout();
redirect_to("/login.php");
?>