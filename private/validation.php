<?php
declare(strict_types=1);

function is_blank(string $string): bool {
    return !isset($string) || trim($string) === "";
}
?>