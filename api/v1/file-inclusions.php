<?php

$recursiveDirectoryIterator = new RecursiveDirectoryIterator('./',RecursiveDirectoryIterator::SKIP_DOTS);
$recursiveIteratorIterator = new RecursiveIteratorIterator($recursiveDirectoryIterator);

foreach($recursiveIteratorIterator as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) == "php" && !strpos($file, 'vendor')) {
        include_once $file;
    }
}
?>
