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
    'sql103.byetcluster.com',
];

echo "<h2>INFINITYFREE MYSQL DATABASE DIAGNOSTIC</h2>";

foreach ($hosts as $h) {
    echo "<h3>Testing Host: $h</h3>";
    try {
        $conn = new mysqli($h, $user, $pass);
        if ($conn->connect_error) {
            echo "<span style='color:red'>Connection Failed: " . $conn->connect_error . "</span><br>";
            continue;
        }
        
        echo "<span style='color:green'>Connected to $h successfully!</span><br>";
        
        $test_names = [
            'if0_42562646_lesrenang',
            'if0_42562646_lesrenangjogja',
            'if0_42562646_db',
            'if0_42562646_site',
            'if0_42562646_1',
            'if0_42562646_laravel',
            'if0_42562646_wp',
            'if0_42562646_test',
        ];
        
        $found = false;
        foreach ($test_names as $dbname) {
            try {
                if ($conn->select_db($dbname)) {
                    echo "<h1 style='color:green'>FOUND WORKING DATABASE: $dbname</h1>";
                    $found = true;
                    
                    $env_file = __DIR__ . '/.env';
                    if (file_exists($env_file)) {
                        $c = file_get_contents($env_file);
                        $c = preg_replace('/DB_HOST=.*/', 'DB_HOST=' . $h, $c);
                        $c = preg_replace('/DB_DATABASE=.*/', 'DB_DATABASE=' . $dbname, $c);
                        file_put_contents($env_file, $c);
                        echo "<b>.env auto-updated to DB_HOST=$h & DB_DATABASE=$dbname!</b><br>";
                    }
                    
                    $import_file = __DIR__ . '/import_db.php';
                    if (file_exists($import_file)) {
                        $ic = file_get_contents($import_file);
                        $ic = preg_replace('/\$host = \'.*\';/', "\$host = '$h';", $ic);
                        $ic = preg_replace('/\$dbname = \'.*\';/', "\$dbname = '$dbname';", $ic);
                        file_put_contents($import_file, $ic);
                        echo "<b>import_db.php auto-updated to host=$h & dbname=$dbname!</b><br>";
                    }
                    break;
                }
            } catch (Throwable $e) {
                echo "Database '$dbname': <span style='color:red'>Not accessible / does not exist</span><br>";
            }
        }
        
        if (!$found) {
            echo "<b style='color:orange'>No database found on $h. Database is not created yet in cPanel.</b><br>";
        }
        
        $conn->close();
    } catch (Throwable $e) {
        echo "<span style='color:red'>Connection Exception on $h: " . $e->getMessage() . "</span><br>";
    }
}
?>"""

with open("/tmp/check_all_db.php", "w") as f:
    f.write(test_db_php)

print("Uploading updated check_all_db.php...")
with open("/tmp/check_all_db.php", "rb") as f:
    ftp.storbinary("STOR check_all_db.php", f)

ftp.quit()
print("Uploaded successfully!")
