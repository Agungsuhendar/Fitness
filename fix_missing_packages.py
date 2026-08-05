import os
from ftplib import FTP, error_perm

def safe_mkd(ftp, path):
    try:
        ftp.mkd(path)
    except:
        pass

def upload_file(ftp, local_path, remote_path):
    # Ensure parent dirs exist
    parts = remote_path.split('/')
    for i in range(1, len(parts)):
        d = '/'.join(parts[:i])
        safe_mkd(ftp, d)
    with open(local_path, 'rb') as f:
        ftp.storbinary(f'STOR {remote_path}', f)

# Packages that are INCOMPLETE on server (only 1 file = bootstrap.php only, missing class files)
incomplete_pkgs = [
    'vendor/symfony/polyfill-mbstring',
    'vendor/symfony/polyfill-intl-grapheme', 
    'vendor/symfony/polyfill-php83',
]

print("Connecting to FTP...")
ftp = FTP('ftpupload.net')
ftp.login('if0_42562646', 'Arkanza0123456')

count = 0
for pkg in incomplete_pkgs:
    print(f"\nUploading {pkg}...")
    for root, dirs, files in os.walk(pkg):
        remote_dir = 'htdocs/' + root.replace('\\', '/')
        safe_mkd(ftp, remote_dir)
        for file in files:
            local_f = os.path.join(root, file)
            remote_f = 'htdocs/' + local_f.replace('\\', '/')
            try:
                with open(local_f, 'rb') as f:
                    ftp.storbinary(f'STOR {remote_f}', f)
                print(f"  OK: {remote_f}")
                count += 1
            except Exception as e:
                print(f"  FAIL: {remote_f} - {e}")

# Also upload other missing packages from autoload_files
other_missing = [
    'vendor/laravel/prompts',
    'vendor/nunomaduro/termwind',
    'vendor/ramsey/uuid',
    'vendor/ralouphie/getallheaders',
]

for pkg in other_missing:
    if not os.path.exists(pkg):
        print(f"  SKIP (not local): {pkg}")
        continue
    print(f"\nUploading {pkg}...")
    for root, dirs, files in os.walk(pkg):
        remote_dir = 'htdocs/' + root.replace('\\', '/')
        safe_mkd(ftp, remote_dir)
        for file in files:
            local_f = os.path.join(root, file)
            remote_f = 'htdocs/' + local_f.replace('\\', '/')
            try:
                with open(local_f, 'rb') as f:
                    ftp.storbinary(f'STOR {remote_f}', f)
                count += 1
            except Exception as e:
                print(f"  FAIL: {remote_f} - {e}")

ftp.quit()
print(f"\nDONE! Uploaded {count} files total.")
