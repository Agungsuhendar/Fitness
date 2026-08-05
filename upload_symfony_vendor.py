import os
from ftplib import FTP, error_perm

def ftp_mkd_safe(ftp, path):
    try:
        ftp.mkd(path)
    except error_perm:
        pass

def upload_dir_recursive(ftp, local_base, remote_base):
    """Upload a directory recursively via FTP"""
    for root, dirs, files in os.walk(local_base):
        # Calculate remote path
        rel_path = os.path.relpath(root, os.path.dirname(local_base))
        remote_path = remote_base + '/' + rel_path.replace('\\', '/')

        # Create remote directory
        ftp_mkd_safe(ftp, remote_path)

        # Upload files
        for file in files:
            local_file = os.path.join(root, file)
            remote_file = remote_path + '/' + file
            try:
                with open(local_file, 'rb') as f:
                    ftp.storbinary(f'STOR {remote_file}', f)
                print(f'  ✓ {remote_file}')
            except Exception as e:
                print(f'  ✗ {remote_file}: {e}')

print("Connecting to FTP...")
ftp = FTP('ftpupload.net')
ftp.login('if0_42562646', 'Arkanza0123456')

# Upload the entire vendor/symfony directory
print("\nUploading vendor/symfony (all packages)...")
upload_dir_recursive(ftp, 'vendor/symfony', 'htdocs/vendor')

# Also upload vendor/composer updated files
print("\nUploading vendor/composer files...")
remote_comp = 'htdocs/vendor/composer'
ftp_mkd_safe(ftp, remote_comp)
for f in os.listdir('vendor/composer'):
    local_f = os.path.join('vendor/composer', f)
    if os.path.isfile(local_f):
        with open(local_f, 'rb') as fp:
            ftp.storbinary(f'STOR {remote_comp}/{f}', fp)
        print(f'  ✓ vendor/composer/{f}')

ftp.quit()
print("\nDone! All symfony packages uploaded.")
