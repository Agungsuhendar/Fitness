from ftplib import FTP

ftp = FTP('ftpupload.net')
ftp.login('if0_42562646', 'Arkanza0123456')
ftp.cwd('htdocs')

files_to_remove = [
    'simple_test.php',
    'laravel_debug.php',
    'check_db_direct.php',
    'find_dbname.php',
    'check_all_db.php',
    'list_db.php',
    'fast_extract.php',
    'fix_laravel.php',
    'extract_laravel.php',
    'fix_symfony.php',
    'cleanup_and_extract.php',
    'unzip.php',
    'unzip_multi.php',
    'unzip_vendor.php',
    'part1_vendor.zip',
    'part2_app.zip',
    'vendor_only.zip',
    'vendor_full.zip',
    'laravel_vendor.zip',
    'symfony_only.zip'
]

print("Cleaning up temporary deployment files on server...")
for fname in files_to_remove:
    try:
        ftp.delete(fname)
        print(f"Removed: {fname}")
    except Exception:
        pass

try:
    ftp.delete('public/test_public.php')
    print("Removed: public/test_public.php")
except Exception:
    pass

ftp.quit()
print("Server cleanup complete!")
