import os
from ftplib import FTP

host = "ftpupload.net"
user = "if0_42586885"
password = "Arkanza0123456"
target_dir = "fitlifehub.site.je/htdocs"

print("Connecting to FTP...")
ftp = FTP(host)
ftp.login(user, password)
ftp.cwd(target_dir)

import_php = """<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$hosts_to_try = [
    'sql210.infinityfree.com', 'sql103.infinityfree.com',
    'sql100.epizy.com', 'sql101.epizy.com', 'sql102.epizy.com', 'sql104.epizy.com', 'sql105.epizy.com', 'sql106.epizy.com', 'sql107.epizy.com', 'sql108.epizy.com',
    'sql200.epizy.com', 'sql201.epizy.com', 'sql210.infinityfree.com', 'sql203.epizy.com', 'sql204.epizy.com', 'sql205.epizy.com', 'sql206.epizy.com', 'sql207.epizy.com',
    'sql300.epizy.com', 'sql301.epizy.com', 'sql302.epizy.com', 'sql303.epizy.com', 'sql304.epizy.com', 'sql305.epizy.com', 'sql306.epizy.com', 'sql307.epizy.com', 'sql308.epizy.com', 'sql309.epizy.com', 'sql310.epizy.com', 'sql311.epizy.com', 'sql312.epizy.com',
    'sql100.infinityfree.com', 'sql101.infinityfree.com', 'sql102.infinityfree.com', 'sql200.infinityfree.com', 'sql300.infinityfree.com'
];

$user = isset($_POST['user']) ? trim($_POST['user']) : 'if0_42586885';
$pass = isset($_POST['pass']) ? trim($_POST['pass']) : 'Arkanza0123456';
$req_host = isset($_POST['host']) ? trim($_POST['host']) : '';
$req_db = isset($_POST['dbname']) ? trim($_POST['dbname']) : '';

if (!empty($req_host)) {
    array_unshift($hosts_to_try, $req_host);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>FitLife Hub - Database Setup</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #0f172a; color: #f8fafc; padding: 30px; }
        .card { max-width: 650px; margin: 0 auto; background: #1e293b; padding: 25px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); }
        h1 { color: #38bdf8; font-size: 24px; margin-top: 0; }
        .success { background: #064e3b; color: #a7f3d0; padding: 15px; border-radius: 8px; border: 1px solid #059669; }
        .warning { background: #451a03; color: #fde68a; padding: 15px; border-radius: 8px; border: 1px solid #d97706; }
        .error { background: #450a0a; color: #fecaca; padding: 15px; border-radius: 8px; border: 1px solid #dc2626; }
        input, button { width: 100%; padding: 10px; margin: 8px 0; border-radius: 6px; border: 1px solid #475569; background: #0f172a; color: white; box-sizing: border-box; }
        button { background: #0284c7; font-weight: bold; cursor: pointer; border: none; }
        button:hover { background: #0369a1; }
    </style>
</head>
<body>
<div class="card">
    <h1>FitLife Hub - InfinityFree DB Setup</h1>
<?php

$conn = null;
$working_host = null;

mysqli_report(MYSQLI_REPORT_OFF);

foreach (array_unique($hosts_to_try) as $h) {
    if (!$h) continue;
    $test_conn = @new mysqli($h, $user, $pass);
    if (!$test_conn->connect_error) {
        $conn = $test_conn;
        $working_host = $h;
        break;
    }
}

if (!$conn) {
    echo "<div class='error'>
            <h3>⚠️ Connection Failed / Access Denied</h3>
            <p>Sistem belum dapat terhubung ke MySQL InfinityFree.</p>
            <p>Silakan masukkan <strong>MySQL Hostname</strong>, <strong>MySQL Password</strong> (Account Password dari Dashboard InfinityFree), dan <strong>Database Name</strong> yang dibuat di cPanel:</p>
          </div>";
    echo "<form method='POST'>
            <label>MySQL Host (dari InfinityFree cPanel):</label>
            <input type='text' name='host' value='" . htmlspecialchars($req_host ?: 'sql210.infinityfree.com') . "'>
            <label>MySQL Username:</label>
            <input type='text' name='user' value='" . htmlspecialchars($user) . "'>
            <label>MySQL Password (Account Password):</label>
            <input type='password' name='pass' value='" . htmlspecialchars($pass) . "'>
            <label>Database Name (dari cPanel):</label>
            <input type='text' name='dbname' value='" . htmlspecialchars($req_db) . "' placeholder='misal: if0_42586885_fitlife'>
            <button type='submit'>Coba Hubungkan Kembali & Impor</button>
          </form>";
} else {
    echo "<p style='color:#38bdf8;'>Terhubung ke MySQL Host: <strong>$working_host</strong></p>";

    $databases = [];
    if (!empty($req_db)) {
        $databases[] = $req_db;
    }
    
    $res = $conn->query("SHOW DATABASES");
    if ($res) {
        while ($row = $res->fetch_array()) {
            $db = $row[0];
            if ($db != 'information_schema' && $db != 'performance_schema') {
                $databases[] = $db;
            }
        }
    }
    $databases = array_unique($databases);

    if (empty($databases)) {
        echo "<div class='warning'>
                <h3>⚠️ Belum Ada Database di cPanel</h3>
                <p>Silakan buat database terlebih dahulu di <strong>InfinityFree cPanel -> MySQL Databases</strong>.</p>
              </div>";
        echo "<form method='POST'>
                <input type='hidden' name='host' value='$working_host'>
                <input type='hidden' name='user' value='$user'>
                <input type='hidden' name='pass' value='$pass'>
                <label>Nama Database yang Baru Dibuat:</label>
                <input type='text' name='dbname' placeholder='if0_42586885_fitlife' required>
                <button type='submit'>Proses Impor Ke Database</button>
              </form>";
    } else {
        $target_db = null;
        foreach ($databases as $db) {
            if ($conn->select_db($db)) {
                $target_db = $db;
                break;
            }
        }

        if (!$target_db) {
            echo "<div class='error'>
                    <h3>⚠️ Database Tidak Dapat Diakses</h3>
                    <p>Silakan masukkan nama database yang tepat:</p>
                  </div>";
            echo "<form method='POST'>
                    <input type='hidden' name='host' value='$working_host'>
                    <input type='hidden' name='user' value='$user'>
                    <input type='hidden' name='pass' value='$pass'>
                    <input type='text' name='dbname' placeholder='if0_42586885_fitlife' required>
                    <button type='submit'>Coba Impor</button>
                  </form>";
        } else {
            echo "<p>Menggunakan Database: <strong>$target_db</strong></p>";
            
            $sqlFile = __DIR__ . '/database_dump.sql';
            if (!file_exists($sqlFile)) {
                $sqlFile = __DIR__ . '/../database_dump.sql';
            }

            if (!file_exists($sqlFile)) {
                echo "<div class='error'>Berkas <code>database_dump.sql</code> tidak ditemukan di server.</div>";
            } else {
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
                echo "<div class='success'>
                        <h2>🎉 IMPOR DATABASE BERHASIL!</h2>
                        <p>Total query SQL dieksekusi: <strong>$count</strong> tabel & data.</p>
                        <p><a href='/' style='color:#67e8f9; font-weight:bold;'>KLIK DISINI UNTUK MEMBUKA APLIKASI WEB</a></p>
                      </div>";
                
                // Update .env file on server automatically
                foreach ([__DIR__ . '/.env', __DIR__ . '/../.env'] as $ef) {
                    if (file_exists($ef)) {
                        $c = file_get_contents($ef);
                        $c = preg_replace('/DB_HOST=.*/', 'DB_HOST=' . $working_host, $c);
                        $c = preg_replace('/DB_DATABASE=.*/', 'DB_DATABASE=' . $target_db, $c);
                        $c = preg_replace('/DB_USERNAME=.*/', 'DB_USERNAME=' . $user, $c);
                        $c = preg_replace('/DB_PASSWORD=.*/', 'DB_PASSWORD=' . $pass, $c);
                        file_put_contents($ef, $c);
                    }
                }
            }
        }
    }
    $conn->close();
}
?>
</div>
</body>
</html>
"""

with open("/tmp/import_db.php", "w") as f:
    f.write(import_php)

print("Uploading smart import_db.php & database_dump.sql to fitlifehub.site.je/htdocs/ and public/...")
with open("/tmp/import_db.php", "rb") as f:
    ftp.storbinary("STOR import_db.php", f)

if os.path.exists("database_dump.sql"):
    with open("database_dump.sql", "rb") as f:
        ftp.storbinary("STOR database_dump.sql", f)

try:
    ftp.cwd("public")
    with open("/tmp/import_db.php", "rb") as f:
        ftp.storbinary("STOR import_db.php", f)
    if os.path.exists("database_dump.sql"):
        with open("database_dump.sql", "rb") as f:
            ftp.storbinary("STOR database_dump.sql", f)
    print("Uploaded to public/ directory!")
except Exception as e:
    print(f"Notice public upload: {e}")

ftp.quit()
print("Smart import_db.php & database_dump.sql uploaded successfully!")
