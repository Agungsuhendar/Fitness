import os
import sys
import zipfile
from ftplib import FTP

def split_and_upload():
    print("1. Creating part1_vendor.zip and part2_app.zip...")
    
    excluded_dirs = {
        'vendor/laravel/pint', 
        'vendor/phpunit', 
        'vendor/fakerphp', 
        'vendor/mockery', 
        'vendor/nunomaduro',
        'vendor/myclabs',
        'vendor/sebastian',
        'vendor/phar-io',
        'vendor/theseer',
        'node_modules', 
        '.git', 
        'storage/logs'
    }

    z1 = zipfile.ZipFile("part1_vendor.zip", "w", zipfile.ZIP_DEFLATED)
    z2 = zipfile.ZipFile("part2_app.zip", "w", zipfile.ZIP_DEFLATED)

    with zipfile.ZipFile("les-renang-deploy.zip", "r") as z_in:
        for item in z_in.infolist():
            skip = False
            for ex in excluded_dirs:
                if item.filename.startswith(ex):
                    skip = True
                    break
            if skip:
                continue

            if item.filename.startswith("vendor/"):
                z1.writestr(item, z_in.read(item.filename))
            else:
                z2.writestr(item, z_in.read(item.filename))

    z1.close()
    z2.close()

    size1 = os.path.getsize("part1_vendor.zip") / (1024 * 1024)
    size2 = os.path.getsize("part2_app.zip") / (1024 * 1024)
    print(f"part1_vendor.zip size: {size1:.2f} MB")
    print(f"part2_app.zip size: {size2:.2f} MB")

    print("\n2. Connecting to InfinityFree FTP...")
    ftp = FTP("ftpupload.net")
    ftp.login("if0_42562646", "Arkanza0123456")
    ftp.cwd("htdocs")

    print("Uploading part1_vendor.zip...")
    with open("part1_vendor.zip", "rb") as f:
        ftp.storbinary("STOR part1_vendor.zip", f)

    print("Uploading part2_app.zip...")
    with open("part2_app.zip", "rb") as f:
        ftp.storbinary("STOR part2_app.zip", f)

    # Upload unzipper script for multi-part
    unzip_script = """<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

foreach (['part1_vendor.zip', 'part2_app.zip'] as $file) {
    if (file_exists($file)) {
        $zip = new ZipArchive;
        if ($zip->open($file) === TRUE) {
            $zip->extractTo(__DIR__);
            $zip->close();
            @unlink($file);
            echo "EXTRACTED_" . $file . "<br>";
        }
    }
}
if (file_exists('index2.html')) {
    @unlink('index2.html');
}
echo "ALL_EXTRACTS_DONE";
?>"""

    with open("/tmp/unzip_multi.php", "w") as f:
        f.write(unzip_script)

    print("Uploading unzip_multi.php...")
    with open("/tmp/unzip_multi.php", "rb") as f:
        ftp.storbinary("STOR unzip_multi.php", f)

    ftp.quit()
    print("Split upload and helper script finished successfully!")

if __name__ == "__main__":
    split_and_upload()
