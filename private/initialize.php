<?php
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PUBLIC_PATH));
define("PUBLIC_PATH", PROJECT_PATH . "/public");

$public_end = strpos($_SERVER["SCRIPT_NAME"], "/public") + 7;
$doc_root = strpos($_SERVER["SCRIPT_NAME"], 0, $public_end);
define("WWW_ROOT", $doc_root);
?>