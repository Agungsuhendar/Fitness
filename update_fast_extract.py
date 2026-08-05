from ftplib import FTP

ftp = FTP('ftpupload.net')
ftp.login('if0_42562646', 'Arkanza0123456')
ftp.cwd('htdocs')

fast_extract_php = """<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$file = __DIR__ . '/laravel_vendor.zip';
if (!file_exists($file)) {
    die('ZIP_NOT_FOUND');
}

$zip = new ZipArchive;
if ($zip->open($file) === TRUE) {
    $count = 0;
    for ($i = 0; $i < $zip->numFiles; $i++) {
        $filename = $zip->getNameIndex($i);
        $dest = __DIR__ . '/' . $filename;
        if (substr($filename, -1) === '/') {
            if (!is_dir($dest)) {
                @mkdir($dest, 0755, true);
            }
        } else {
            $dir = dirname($dest);
            if (!is_dir($dir)) {
                @mkdir($dir, 0755, true);
            }
            $content = $zip->getFromIndex($i);
            if ($content !== false) {
                file_put_contents($dest, $content);
                $count++;
            }
        }
    }
    $zip->close();
    @unlink($file);
    echo 'EXTRACTED_OVERWRITE_SUCCESS_FILES_' . $count;
} else {
    echo 'ZIP_OPEN_FAILED';
}
?>"""

with open("/tmp/fast_extract.php", "w") as f:
    f.write(fast_extract_php)

print("Uploading updated fast_extract.php...")
with open("/tmp/fast_extract.php", "rb") as f:
    ftp.storbinary("STOR fast_extract.php", f)

ftp.quit()
print("Uploaded successfully!")
