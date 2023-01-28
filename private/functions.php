<?php
declare(strict_types=1);

function url_for(string $path): string {
    if($path[0] !== "/") {
        $path = "/" . $path;
    }

    return WWW_ROOT . $path;
}

function post_request(): bool {
    return $_SERVER["REQUEST_METHOD"] === "POST";
}

function redirect_to(string $path) {
    header("Location: " . url_for($path));
}

function html(?string $string=""): string {
    if($string === NULL) {
        $string = "N/A";
    }
    return htmlspecialchars($string);
}

function url(string $string=""): string {
    return urlencode($string);
}
?>