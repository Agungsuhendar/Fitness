<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$hosts = [
    'sql103.infinityfree.com', 'sql103.infinityfree.com',
    'sql100.epizy.com', 'sql101.epizy.com', 'sql102.epizy.com', 'sql104.epizy.com', 'sql105.epizy.com', 'sql106.epizy.com', 'sql107.epizy.com', 'sql108.epizy.com', 'sql109.epizy.com',
    'sql200.epizy.com', 'sql201.epizy.com', 'sql210.infinityfree.com', 'sql203.epizy.com', 'sql204.epizy.com', 'sql205.epizy.com', 'sql206.epizy.com', 'sql207.epizy.com', 'sql208.epizy.com',
    'sql300.epizy.com', 'sql301.epizy.com', 'sql302.epizy.com', 'sql303.epizy.com', 'sql304.epizy.com', 'sql305.epizy.com', 'sql306.epizy.com', 'sql307.epizy.com', 'sql308.epizy.com', 'sql309.epizy.com', 'sql310.epizy.com', 'sql311.epizy.com', 'sql312.epizy.com',
    'sql100.infinityfree.com', 'sql101.infinityfree.com', 'sql102.infinityfree.com', 'sql104.infinityfree.com', 'sql105.infinityfree.com', 'sql200.infinityfree.com', 'sql201.infinityfree.com', 'sql300.infinityfree.com',
    'sql100.byetcluster.com', 'sql101.byetcluster.com', 'sql102.byetcluster.com', 'sql103.byetcluster.com', 'sql200.byetcluster.com', 'sql300.byetcluster.com', 'sql301.byetcluster.com', 'sql302.byetcluster.com'
];

$user = 'if0_42586885';
$pass = 'Arkanza0123456';

echo "<h2>Auto-Scanning MySQL Host for user: $user</h2>";

$found_host = null;
$found_conn = null;

foreach ($hosts as $h) {
    try {
        mysqli_report(MYSQLI_REPORT_OFF);
        $conn = new mysqli($h, $user, $pass);
        if (!$conn->connect_error) {
            echo "<h3 style='color:green;'>CONNECTED SUCCESSFULLY TO HOST: $h !</h3>";
            $found_host = $h;
            $found_conn = $conn;
            break;
        }
    } catch (Exception $e) {
        // ignore
    }
}

if (!$found_conn) {
    echo "<h3 style='color:red;'>Could not connect to any tested host. Check cPanel -> MySQL Databases for your exact MySQL Host name.</h3>";
} else {
    $res = $found_conn->query("SHOW DATABASES");
    $databases = [];
    if ($res) {
        while ($row = $res->fetch_array()) {
            $db = $row[0];
            if ($db != 'information_schema' && $db != 'performance_schema') {
                $databases[] = $db;
            }
        }
    }

    echo "<p>Databases found under host <strong>$found_host</strong>:</p><ul>";
    foreach ($databases as $db) {
        echo "<li><strong>$db</strong></li>";
    }
    echo "</ul>";

    if (empty($databases)) {
        echo "<p style='color:orange;'>No databases found! Please create a database in cPanel -> MySQL Databases.</p>";
    } else {
        $target_db = $databases[0];
        echo "<h3>Importing database into <code>$target_db</code> ...</h3>";
        $found_conn->select_db($target_db);
        
        $sqlFile = __DIR__ . '/database_dump.sql';
        if (!file_exists($sqlFile)) {
            $sqlFile = __DIR__ . '/../database_dump.sql';
        }
        
        if (file_exists($sqlFile)) {
            $sql = file_get_contents($sqlFile);
            $queries = explode(';', $sql);
            $count = 0;
            foreach ($queries as $query) {
                $q = trim($query);
                if (!empty($q)) {
                    if ($found_conn->query($q)) {
                        $count++;
                    }
                }
            }
            echo "<h2 style='color:green;'>SUCCESS! Imported $count queries into $target_db!</h2>";
            
            // Update .env file
            foreach ([__DIR__ . '/.env', __DIR__ . '/../.env'] as $ef) {
                if (file_exists($ef)) {
                    $c = file_get_contents($ef);
                    $c = preg_replace('/DB_HOST=.*/', 'DB_HOST=' . $found_host, $c);
                    $c = preg_replace('/DB_DATABASE=.*/', 'DB_DATABASE=' . $target_db, $c);
                    file_put_contents($ef, $c);
                    echo "<p style='color:green;'>Updated .env ($ef) with DB_HOST=$found_host and DB_DATABASE=$target_db</p>";
                }
            }
        }
    }
    $found_conn->close();
}
?>
