import os
import sys
from ftplib import FTP

def upload_and_extract_vendor():
    host = "ftpupload.net"
    user = "if0_42562646"
    password = "Arkanza0123456"

    print("Connecting to FTP...")
    ftp = FTP(host)
    ftp.login(user, password)
    ftp.cwd("htdocs")

    zip_file = "vendor_only.zip"
    print(f"Uploading {zip_file} (7.64 MB) to /htdocs/...")
    with open(zip_file, "rb") as f:
        ftp.storbinary(f"STOR {zip_file}", f)

    print("vendor_only.zip uploaded successfully!")

    # Helper PHP script to extract vendor_only.zip
    unzip_script = """<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$file = 'vendor_only.zip';
if (!file_exists($file)) {
    die("VENDOR_ZIP_NOT_FOUND");
}

$zip = new ZipArchive;
$res = $zip->open($file);
if ($res === TRUE) {
    $zip->extractTo(__DIR__);
    $zip->close();
    @unlink($file);
    echo "VENDOR_DEPENDENCIES_SUCCESSFULLY_EXTRACTED";
} else {
    echo "ZIP_EXTRACT_ERROR_" . $res;
}
?>"""

    with open("/tmp/unzip_vendor.php", "w") as f:
        f.write(unzip_script)

    print("Uploading unzip_vendor.php...")
    with open("/tmp/unzip_vendor.php", "rb") as f:
        ftp.storbinary("STOR unzip_vendor.php", f)

    ftp.quit()
    print("Vendor zip and unzipper script uploaded successfully!")

if __name__ == "__main__":
    upload_and_extract_vendor()
