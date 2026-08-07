<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$dirs = [
    __DIR__ . '/storage',
    __DIR__ . '/storage/app',
    __DIR__ . '/storage/app/public',
    __DIR__ . '/storage/framework',
    __DIR__ . '/storage/framework/cache',
    __DIR__ . '/storage/framework/cache/data',
    __DIR__ . '/storage/framework/sessions',
    __DIR__ . '/storage/framework/testing',
    __DIR__ . '/storage/framework/views',
    __DIR__ . '/storage/logs',
    __DIR__ . '/bootstrap/cache',
];

foreach ($dirs as $d) {
    if (!is_dir($d)) {
        if (@mkdir($d, 0777, true)) {
            echo "Created: $d<br>";
        } else {
            echo "<span style='color:red;'>Failed to create: $d</span><br>";
        }
    } else {
        echo "Exists: $d<br>";
    }
}
echo "<h3 style='color:green;'>All storage directories verified & created successfully!</h3>";
?>
