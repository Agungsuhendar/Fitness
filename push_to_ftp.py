import os
import sys
import time
from ftplib import FTP, error_perm

FTP_HOST = "ftpupload.net"
FTP_USER = "if0_42586885"
FTP_PASS = "Arkanza0123456"
REMOTE_ROOT = "htdocs"

DIRS_TO_SYNC = [
    'app',
    'bootstrap',
    'config',
    'database',
    'public',
    'resources',
    'routes',
]

FILES_TO_SYNC = [
    '.env',
    '.htaccess',
    'index.php',
    'artisan',
    'composer.json',
    'composer.lock',
    'database_dump.sql'
]

def connect_ftp():
    ftp = FTP()
    ftp.connect(FTP_HOST, 21, timeout=30)
    ftp.login(FTP_USER, FTP_PASS)
    ftp.set_pasv(True)
    return ftp

def ensure_remote_dir(ftp, remote_dir):
    parts = remote_dir.split('/')
    current = ""
    for part in parts:
        if not part:
            continue
        current = f"{current}/{part}" if current else part
        try:
            ftp.mkd(current)
        except error_perm:
            pass # Directory already exists

def upload_file(ftp, local_path, remote_path, max_retries=3):
    for attempt in range(max_retries):
        try:
            with open(local_path, 'rb') as f:
                ftp.storbinary(f"STOR {remote_path}", f)
            return True
        except Exception as e:
            print(f"  Retry {attempt+1}/{max_retries} for {remote_path}: {e}")
            time.sleep(1)
            try:
                ftp.quit()
            except:
                pass
            try:
                ftp = connect_ftp()
            except:
                pass
    return False

def push():
    print("=" * 50)
    print("      PUSHING PROJECT TO INFINITYFREE FTP      ")
    print(f"      Host: {FTP_HOST} | User: {FTP_USER}")
    print("=" * 50)

    print(f"Connecting to {FTP_HOST} as {FTP_USER}...")
    ftp = connect_ftp()
    print("Connected successfully!")

    uploaded_files = 0
    failed_files = []

    # Upload single files
    for file_name in FILES_TO_SYNC:
        if os.path.exists(file_name):
            remote_path = f"{REMOTE_ROOT}/{file_name}"
            print(f"Uploading file: {file_name} -> {remote_path}")
            if upload_file(ftp, file_name, remote_path):
                uploaded_files += 1
            else:
                failed_files.append(file_name)

    # Upload directories recursively
    for dir_name in DIRS_TO_SYNC:
        if not os.path.exists(dir_name):
            continue
        print(f"\nSyncing directory: {dir_name}/ ...")
        for root, _, files in os.walk(dir_name):
            rel_path = os.path.relpath(root, ".")
            remote_dir = f"{REMOTE_ROOT}/{rel_path.replace(os.sep, '/')}"
            ensure_remote_dir(ftp, remote_dir)

            for file in files:
                if file.startswith("._") or file.endswith(".swp"):
                    continue
                local_file = os.path.join(root, file)
                remote_file = f"{remote_dir}/{file}"
                print(f"  -> {local_file}")
                if upload_file(ftp, local_file, remote_file):
                    uploaded_files += 1
                else:
                    failed_files.append(local_file)

    try:
        ftp.quit()
    except:
        pass

    print("\n" + "=" * 50)
    print(f"PUSH COMPLETED: {uploaded_files} files uploaded successfully.")
    if failed_files:
        print(f"WARNING: {len(failed_files)} files failed to upload:")
        for f in failed_files:
            print(f"  - {f}")
    else:
        print("ALL FILES SYNCED TO FTP SUCCESSFULLY!")
    print("=" * 50)

if __name__ == "__main__":
    push()
