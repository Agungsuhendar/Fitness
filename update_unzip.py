from ftplib import FTP

host = "ftpupload.net"
user = "if0_42562646"
password = "Arkanza0123456"

print("Connecting to FTP...")
ftp = FTP(host)
ftp.login(user, password)
ftp.cwd("htdocs")

unzip_script = """<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$file = 'les-renang-deploy.zip';
if (!file_exists($file)) {
    die("ZIP_FILE_NOT_FOUND");
}

if (file_exists('index2.html')) {
    @unlink('index2.html');
}

$zip = new ZipArchive;
$res = $zip->open($file);
if ($res === TRUE) {
    $zip->extractTo(__DIR__);
    $zip->close();
    echo "AUTOMATED_UNZIP_SUCCESSFUL";
} else {
    echo "ZIP_OPEN_FAILED_ERR_CODE_" . $res;
}
?>"""

with open("/tmp/unzip.php", "w") as f:
    f.write(unzip_script)

print("Uploading unzip.php...")
with open("/tmp/unzip.php", "rb") as f:
    ftp.storbinary("STOR unzip.php", f)

ftp.quit()
print("unzip.php uploaded!")
