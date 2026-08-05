from ftplib import FTP

ftp = FTP('ftpupload.net')
ftp.login('if0_42562646', 'Arkanza0123456')
ftp.cwd('htdocs')

test_db_php = """<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$user = 'if0_42562646';
$pass = 'Arkanza0123456';
$host = 'sql103.epizy.com';

$possible_dbs = [
    'if0_42562646_lesrenang',
    'if0_42562646_lesrenangjogja',
    'if0_42562646_db',
    'if0_42562646_site',
    'if0_42562646_1',
    'if0_42562646_laravel',
    'if0_42562646_main',
];

echo "<h1>TESTING EXACT DATABASE NAME</h1>";

$conn = new mysqli($host, $user, $pass);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$working_db = null;

foreach ($possible_dbs as $db) {
    try {
        if ($conn->select_db($db)) {
            echo "<h2 style='color:green'>SUCCESS! Database '$db' EXISTS and is ACCESSIBLE!</h2>";
            $working_db = $db;
            break;
        }
    } catch (Throwable $e) {
        echo "Database '$db': <span style='color:red'>Access denied / does not exist</span><br>";
    }
}

if ($working_db) {
    $env_path = __DIR__ . '/.env';
    $env = file_get_contents($env_path);
    $env = preg_replace('/DB_DATABASE=.*/', 'DB_DATABASE=' . $working_db, $env);
    $env = preg_replace('/DB_HOST=.*/', 'DB_HOST=sql103.epizy.com', $env);
    file_put_contents($env_path, $env);
    echo "<b style='color:green'>Updated .env with DB_DATABASE=$working_db and DB_HOST=sql103.epizy.com!</b>";
} else {
    echo "<h3 style='color:orange'>None of the common database names matched. Please create a database in cPanel -> MySQL Databases and enter its name.</h3>";
}

$conn->close();
?>"""

with open("/tmp/find_dbname.php", "w") as f:
    f.write(test_db_php)

print("Uploading updated find_dbname.php...")
with open("/tmp/find_dbname.php", "rb") as f:
    ftp.storbinary("STOR find_dbname.php", f)

ftp.quit()
print("Uploaded successfully!")
