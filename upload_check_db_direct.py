from ftplib import FTP

ftp = FTP('ftpupload.net')
ftp.login('if0_42562646', 'Arkanza0123456')
ftp.cwd('htdocs')

check_db_php = """<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'sql103.epizy.com';
$user = 'if0_42562646';
$pass = 'Arkanza0123456';
$db = 'if0_42562646_lesrenang';

mysqli_report(MYSQLI_REPORT_OFF);

$conn = @new mysqli($host, $user, $pass);
if ($conn->connect_errno) {
    echo "MYSQL_CONNECT_FAILED: " . $conn->connect_error;
    exit;
}

echo "MYSQL_CONNECT_SUCCESS<br>";

if (@$conn->select_db($db)) {
    echo "DATABASE_EXISTS_AND_ACCESSIBLE";
} else {
    echo "DATABASE_DOES_NOT_EXIST: " . $conn->error;
}
$conn->close();
?>"""

with open("/tmp/check_db_direct.php", "w") as f:
    f.write(check_db_php)

print("Uploading check_db_direct.php...")
with open("/tmp/check_db_direct.php", "rb") as f:
    ftp.storbinary("STOR check_db_direct.php", f)

ftp.quit()
print("Uploaded successfully!")
