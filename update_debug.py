from ftplib import FTP

ftp = FTP('ftpupload.net')
ftp.login('if0_42562646', 'Arkanza0123456')
ftp.cwd('htdocs')

debug_php = """<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    echo "<h1>LARAVEL DEBUG DIAGNOSTIC</h1>";
    echo "PHP Version: " . phpversion() . "<br>";
    
    $autoload = __DIR__ . '/vendor/autoload.php';
    if (!file_exists($autoload)) {
        throw new Exception("vendor/autoload.php missing");
    }
    require $autoload;
    echo "Autoload: OK<br>";
    
    $app = require_once __DIR__ . '/bootstrap/app.php';
    echo "Bootstrap: OK<br>";
    
    $kernel = $app->make(Illuminate\\Contracts\\Http\\Kernel::class);
    echo "Kernel Make: OK<br>";
    
    $request = Illuminate\\Http\\Request::capture();
    echo "Request Capture: OK<br>";
    
    $response = $kernel->handle($request);
    echo "Kernel Handle: OK (Status: " . $response->getStatusCode() . ")<br>";
    
    echo "<hr><h2>FULL HTML RENDER OUTPUT:</h2>";
    echo $response->getContent();
    
} catch (Throwable $e) {
    echo "<h2 style='color:red'>EXACT ERROR CAPTURED:</h2>";
    echo "<b>Type:</b> " . get_class($e) . "<br>";
    echo "<b>Message:</b> " . $e->getMessage() . "<br>";
    echo "<b>File:</b> " . $e->getFile() . " (Line " . $e->getLine() . ")<br>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
?>"""

with open("/tmp/laravel_debug.php", "w") as f:
    f.write(debug_php)

print("Uploading updated laravel_debug.php...")
with open("/tmp/laravel_debug.php", "rb") as f:
    ftp.storbinary("STOR laravel_debug.php", f)

ftp.quit()
print("Uploaded successfully!")
