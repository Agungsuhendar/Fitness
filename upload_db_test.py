from ftplib import FTP

ftp = FTP('ftpupload.net')
ftp.login('if0_42562646', 'Arkanza0123456')
ftp.cwd('htdocs')

test_db_php = """<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$user = 'if0_42562646';
$pass = 'Arkanza0123456';
$dbname = 'if0_42562646_lesrenang';

$hosts = [
    'sql103.epizy.com',
    'sql103.infinityfree.com',
    'sql103.byetcluster.com',
    '185.27.134.113',
];

echo "<h1>INFINITYFREE MYSQL CONNECTION TEST</h1>";

$working_host = null;

foreach ($hosts as $host) {
    echo "Testing host: <b>$host</b> ... ";
    $conn = @new mysqli($host, $user, $pass, $dbname);
    if ($conn->connect_error) {
        echo "<span style='color:red'>FAILED: " . $conn->connect_error . "</span><br>";
    } else {
        echo "<span style='color:green;font-weight:bold'>SUCCESS! Connected to $host!</span><br>";
        $working_host = $host;
        $conn->close();
    }
}

if ($working_host) {
    echo "<h3>Updating .env DB_HOST to $working_host ...</h3>";
    $env_path = __DIR__ . '/.env';
    $env = file_get_contents($env_path);
    $env = preg_replace('/DB_HOST=.*/', 'DB_HOST=' . $working_host, $env);
    file_put_contents($env_path, $env);
    echo "<b style='color:green'>.env DB_HOST UPDATED SUCCESSFULLY TO $working_host!</b>";
}
?>"""

with open("/tmp/test_db_connect.php", "w") as f:
    f.write(test_db_php)

print("Uploading test_db_connect.php...")
with open("/tmp/test_db_connect.php", "rb") as f:
    ftp.storbinary("STOR test_db_connect.php", f)

ftp.quit()
print("Uploaded successfully!")
