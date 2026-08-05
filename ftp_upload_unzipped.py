import os
import sys
import zipfile
from ftplib import FTP, error_perm

def upload_unzipped_files():
    print("1. Extracting part1_vendor.zip and part2_app.zip locally...")
    extract_dir = "/tmp/extracted_site"
    os.makedirs(extract_dir, exist_ok=True)

    with zipfile.ZipFile("part1_vendor.zip", "r") as z:
        z.extractall(extract_dir)

    with zipfile.ZipFile("part2_app.zip", "r") as z:
        z.extractall(extract_dir)

    print("Extraction complete locally!")

    print("\n2. Connecting to InfinityFree FTP...")
    ftp = FTP("ftpupload.net")
    ftp.login("if0_42562646", "Arkanza0123456")
    ftp.cwd("htdocs")

    def upload_dir(local_path, remote_path):
        print(f"Syncing directory: {remote_path}")
        for item in os.listdir(local_path):
            l_item = os.path.join(local_path, item)
            r_item = remote_path + "/" + item if remote_path else item

            if os.path.isdir(l_item):
                try:
                    ftp.mkd(r_item)
                except error_perm:
                    pass # Directory already exists
                upload_dir(l_item, r_item)
            else:
                try:
                    with open(l_item, "rb") as f:
                        ftp.storbinary(f"STOR {r_item}", f)
                except Exception as e:
                    print(f"Error uploading {r_item}: {e}")

    print("Uploading all unzipped files directly to /htdocs...")
    upload_dir(extract_dir, "")

    ftp.quit()
    print("\nALL UNZIPPED FILES UPLOADED SUCCESSFULLY!")

if __name__ == "__main__":
    upload_unzipped_files()
