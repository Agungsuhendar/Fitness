from ftplib import FTP

host = "ftpupload.net"
user = "if0_42586885"
password = "Arkanza0123456"

print("Connecting to FTP...")
ftp = FTP(host)
ftp.login(user, password)
ftp.cwd("htdocs")

import_php = """<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'sql103.epizy.com';
$user = 'if0_42586885';
$pass = 'Arkanza0123456';
$dbname = 'if0_42586885_fitlife';
$sqlFile = 'database_dump.sql';

if (!file_exists($sqlFile)) {
    die("SQL_FILE_NOT_FOUND");
}

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("CONNECTION_FAILED: " . $conn->connect_error);
}

$sql = file_get_contents($sqlFile);
$queries = explode(';', $sql);

$count = 0;
foreach ($queries as $query) {
    $q = trim($query);
    if (!empty($q)) {
        if ($conn->query($q)) {
            $count++;
        }
    }
}

echo "AUTOMATED_DB_IMPORT_SUCCESSFUL_COUNT_" . $count;
$conn->close();
?>"""

with open("/tmp/import_db.php", "w") as f:
    f.write(import_php)

print("Uploading import_db.php to /htdocs/...")
with open("/tmp/import_db.php", "rb") as f:
    ftp.storbinary("STOR import_db.php", f)

ftp.quit()
print("import_db.php script uploaded successfully!")
