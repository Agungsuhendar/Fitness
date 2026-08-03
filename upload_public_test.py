from ftplib import FTP

ftp = FTP('ftpupload.net')
ftp.login('if0_42562646', 'Arkanza0123456')
ftp.cwd('htdocs/public')

test_php = """<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    echo "1. Checking vendor/autoload.php...<br>";
    $autoload = __DIR__ . '/../vendor/autoload.php';
    if (!file_exists($autoload)) {
        die("AUTOLOAD_NOT_FOUND");
    }
    require $autoload;
    echo "   -> Autoload loaded successfully!<br>";

    echo "2. Checking bootstrap/app.php...<br>";
    $bootstrap = __DIR__ . '/../bootstrap/app.php';
    if (!file_exists($bootstrap)) {
        die("BOOTSTRAP_NOT_FOUND");
    }
    $app = require_once $bootstrap;
    echo "   -> App bootstrapped successfully!<br>";

    echo "3. Capturing Request...<br>";
    $request = Illuminate\\Http\\Request::capture();
    echo "   -> Request captured!<br>";

    echo "4. Handling Kernel...<br>";
    $kernel = $app->make(Illuminate\\Contracts\\Http\\Kernel::class);
    $response = $kernel->handle($request);
    echo "   -> Kernel handled! Response status: " . $response->getStatusCode() . "<br>";
    
    echo "5. Sending Response Content...<br><hr>";
    echo $response->getContent();

} catch (Throwable $e) {
    echo "<h2 style='color:red'>EXACT ERROR CAUGHT IN PUBLIC TEST:</h2>";
    echo "<b>Type:</b> " . get_class($e) . "<br>";
    echo "<b>Message:</b> " . $e->getMessage() . "<br>";
    echo "<b>File:</b> " . $e->getFile() . " (Line " . $e->getLine() . ")<br>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
?>"""

with open("/tmp/test_public.php", "w") as f:
    f.write(test_php)

print("Uploading test_public.php...")
with open("/tmp/test_public.php", "rb") as f:
    ftp.storbinary("STOR test_public.php", f)

ftp.quit()
print("Uploaded successfully!")
