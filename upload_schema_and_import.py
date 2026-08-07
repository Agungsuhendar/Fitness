import os
from ftplib import FTP

def upload_sql_and_script():
    host = "ftpupload.net"
    user = "if0_42562646"
    password = "Arkanza0123456"

    print("Connecting to FTP...")
    ftp = FTP(host)
    ftp.login(user, password)
    ftp.cwd("htdocs")

    print("Uploading updated database_dump.sql (with CREATE TABLE statements)...")
    with open("database_dump.sql", "rb") as f:
        ftp.storbinary("STOR database_dump.sql", f)

    import_php = """<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'sql103.infinityfree.com';
$user = 'if0_42562646';
$pass = 'Arkanza0123456';
$dbname = 'if0_42562646_lesrenang';
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
$errors = 0;
foreach ($queries as $query) {
    $q = trim($query);
    if (!empty($q)) {
        if ($conn->query($q)) {
            $count++;
        } else {
            $errors++;
        }
    }
}

echo "SUCCESS_IMPORTED_QUERIES_" . $count . "_ERRORS_" . $errors;
$conn->close();
?>"""

    with open("/tmp/import_db.php", "w") as f:
        f.write(import_php)

    print("Uploading import_db.php...")
    with open("/tmp/import_db.php", "rb") as f:
        ftp.storbinary("STOR import_db.php", f)

    ftp.quit()
    print("Database dump and importer script uploaded successfully!")

if __name__ == "__main__":
    upload_sql_and_script()
