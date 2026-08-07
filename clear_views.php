<?php

$dirs = [
    __DIR__ . '/storage/framework/views',
    dirname(__DIR__) . '/storage/framework/views',
    __DIR__ . '/storage/framework/cache/data',
    dirname(__DIR__) . '/storage/framework/cache/data',
];

$count = 0;
foreach ($dirs as $dir) {
    if (is_dir($dir)) {
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );
        foreach ($files as $fileinfo) {
            if ($fileinfo->isFile() && $fileinfo->getFilename() !== '.gitignore') {
                @unlink($fileinfo->getRealPath());
                $count++;
            }
        }
    }
}

// Clear bootstrap cache files
$bootstrap_dirs = [__DIR__ . '/bootstrap/cache', dirname(__DIR__) . '/bootstrap/cache'];
foreach ($bootstrap_dirs as $bdir) {
    if (is_dir($bdir)) {
        foreach (glob($bdir . '/*.php') as $bf) {
            @unlink($bf);
        }
    }
}

echo "View cache cleared successfully! (" . $count . " compiled view/cache files removed) All caches cleared successfully!";
?>
