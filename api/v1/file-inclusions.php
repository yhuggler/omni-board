<?php
// Includes all files in a specific directory

$recursiveDirectoryIterator = new RecursiveDirectoryIterator('./src',RecursiveDirectoryIterator::SKIP_DOTS);
$recursiveIteratorIterator = new RecursiveIteratorIterator($recursiveDirectoryIterator);

foreach($recursiveIteratorIterator as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) == "php") {
        include_once $file;
    }
}

?>
