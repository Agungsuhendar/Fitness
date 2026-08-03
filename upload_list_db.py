from ftplib import FTP

ftp = FTP('ftpupload.net')
ftp.login('if0_42562646', 'Arkanza0123456')
ftp.cwd('htdocs')

test_db_php = """<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$user = 'if0_42562646';
$pass = 'Arkanza0123456';

$hosts = [
    'sql103.epizy.com',
    'sql103.infinityfree.com',
];

echo "<h1>LIST ACCESSIBLE DATABASES</h1>";

foreach ($hosts as $host) {
    try {
        $conn = new mysqli($host, $user, $pass);
        if ($conn->connect_error) {
            echo "Host $host: <span style='color:red'>" . $conn->connect_error . "</span><br>";
        } else {
            echo "Host $host: <span style='color:green'>CONNECTED!</span><br>";
            $res = $conn->query("SHOW DATABASES");
            if ($res) {
                echo "Databases found:<br><ul>";
                while ($row = $res->fetch_array()) {
                    echo "<li>" . $row[0] . "</li>";
                }
                echo "</ul>";
            }
            $conn->close();
        }
    } catch (Throwable $e) {
        echo "Host $host: <span style='color:red'>" . $e->getMessage() . "</span><br>";
    }
}
?>"""

with open("/tmp/list_db.php", "w") as f:
    f.write(test_db_php)

print("Uploading list_db.php...")
with open("/tmp/list_db.php", "rb") as f:
    ftp.storbinary("STOR list_db.php", f)

ftp.quit()
print("Uploaded successfully!")
