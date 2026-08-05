<?php

$dir = __DIR__ . '/storage/framework/views';
if (is_dir($dir)) {
    $files = glob($dir . '/*');
    $count = 0;
    foreach ($files as $file) {
        if (is_file($file) && basename($file) !== '.gitignore') {
            @unlink($file);
            $count++;
        }
    }
    echo "View cache cleared successfully! (" . $count . " compiled view files removed)\n";
} else {
    echo "Framework views directory not found!\n";
}

// Also clear bootstrap cache
$cache_file = __DIR__ . '/bootstrap/cache/services.php';
if (file_exists($cache_file)) @unlink($cache_file);
$config_file = __DIR__ . '/bootstrap/cache/config.php';
if (file_exists($config_file)) @unlink($config_file);
$routes_file = __DIR__ . '/bootstrap/cache/routes.php';
if (file_exists($routes_file)) @unlink($routes_file);

echo "All caches cleared successfully!";
