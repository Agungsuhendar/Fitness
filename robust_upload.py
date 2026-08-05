import os
import time
from ftplib import FTP, error_perm, error_temp, all_errors

def make_ftp():
    ftp = FTP()
    ftp.connect('ftpupload.net', 21, timeout=30)
    ftp.login('if0_42562646', 'Arkanza0123456')
    ftp.set_pasv(True)
    return ftp

def safe_mkd(ftp, path):
    try:
        ftp.mkd(path)
    except:
        pass

def upload_file_with_retry(ftp, local_path, remote_path, retries=3):
    for attempt in range(retries):
        try:
            with open(local_path, 'rb') as f:
                ftp.storbinary(f'STOR {remote_path}', f)
            return True
        except Exception as e:
            print(f'  Retry {attempt+1}/{retries}: {remote_path} ({e})')
            time.sleep(2)
            try:
                ftp.quit()
            except:
                pass
            try:
                ftp2 = make_ftp()
                ftp.__dict__.update(ftp2.__dict__)
            except:
                pass
    return False

# Only upload the KEY files needed for autoloader bootstrap
# These are the files in autoload_files.php + all class files
PRIORITY_FILES = [
    'vendor/symfony/deprecation-contracts/function.php',
    'vendor/symfony/polyfill-mbstring/bootstrap.php',
    'vendor/symfony/polyfill-ctype/bootstrap.php',
    'vendor/symfony/polyfill-php80/bootstrap.php',
    'vendor/symfony/polyfill-php83/bootstrap.php',
    'vendor/symfony/polyfill-php84/bootstrap.php',
    'vendor/symfony/polyfill-php85/bootstrap.php',
    'vendor/symfony/polyfill-intl-normalizer/bootstrap.php',
    'vendor/symfony/polyfill-intl-grapheme/bootstrap.php',
    'vendor/symfony/polyfill-intl-idn/bootstrap.php',
    'vendor/symfony/polyfill-uuid/bootstrap.php',
    'vendor/symfony/string/Resources/functions.php',
    'vendor/symfony/var-dumper/Resources/functions/dump.php',
    'vendor/symfony/clock/Resources/now.php',
    'vendor/symfony/translation/Resources/functions.php',
    'vendor/ralouphie/getallheaders/src/getallheaders.php',
    'vendor/nunomaduro/termwind/src/Functions.php',
    'vendor/ramsey/uuid/src/functions.php',
    'vendor/laravel/prompts/src/helpers.php',
]

print("Connecting to FTP...")
ftp = make_ftp()

success_count = 0
fail_count = 0

# First upload priority files
print("\n=== UPLOADING PRIORITY FILES ===")
for local_path in PRIORITY_FILES:
    if not os.path.exists(local_path):
        print(f"  SKIP (not found): {local_path}")
        continue

    # Build remote path
    remote_path = 'htdocs/' + local_path.replace('\\', '/')

    # Ensure all parent directories exist
    parts = remote_path.split('/')
    for i in range(1, len(parts)):
        dir_path = '/'.join(parts[:i])
        if dir_path:
            safe_mkd(ftp, dir_path)

    if upload_file_with_retry(ftp, local_path, remote_path):
        print(f"  OK: {local_path}")
        success_count += 1
    else:
        print(f"  FAIL: {local_path}")
        fail_count += 1

print(f"\n=== PRIORITY FILES: {success_count} OK, {fail_count} FAILED ===")

# Now upload ALL of vendor/symfony, vendor/laravel, vendor/illuminate etc.
print("\n=== UPLOADING ALL VENDOR/SYMFONY ===")
for root, dirs, files in os.walk('vendor/symfony'):
    remote_dir = 'htdocs/' + root.replace('\\', '/')
    safe_mkd(ftp, remote_dir)
    for file in files:
        local_f = os.path.join(root, file)
        remote_f = 'htdocs/' + local_f.replace('\\', '/')
        if upload_file_with_retry(ftp, local_f, remote_f):
            success_count += 1
        else:
            fail_count += 1

print(f"\n=== SYMFONY COMPLETE: {success_count} OK, {fail_count} FAILED ===")

ftp.quit()
print("UPLOAD COMPLETE!")
