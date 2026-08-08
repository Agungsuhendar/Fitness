<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$logFile = __DIR__ . '/debug_output.txt';
$out = '';

try {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    
    $request = Illuminate\Http\Request::create('/register', 'GET');
    $response = $kernel->handle($request);
    
    $out .= 'HTTP_STATUS: ' . $response->getStatusCode() . "
";
    if ($response->getStatusCode() === 500) {
        if (isset($response->exception)) {
            $out .= 'EXCEPTION: ' . $response->exception->getMessage() . "
";
            $out .= 'FILE: ' . $response->exception->getFile() . ':' . $response->exception->getLine() . "
";
            $out .= 'TRACE: ' . $response->exception->getTraceAsString() . "
";
        } else {
            $out .= 'BODY: ' . substr($response->getContent(), 0, 1000) . "
";
        }
    } else {
        $out .= 'SUCCESS! Status is ' . $response->getStatusCode();
    }
} catch (Throwable $e) {
    $out .= 'GLOBAL EXCEPTION: ' . $e->getMessage() . "
";
    $out .= 'FILE: ' . $e->getFile() . ':' . $e->getLine() . "
";
    $out .= 'TRACE: ' . $e->getTraceAsString() . "
";
}

file_put_contents($logFile, $out);
echo 'LOGGED';
