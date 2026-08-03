import os
import sys
from ftplib import FTP

def upload_zip_file():
    host = "ftpupload.net"
    user = "if0_42562646"
    password = "Arkanza0123456"

    print("Connecting to InfinityFree FTP...")
    ftp = FTP(host)
    ftp.login(user, password)
    ftp.cwd("htdocs")

    zip_file = "les-renang-deploy.zip"
    print(f"Uploading {zip_file} (38 MB) to /htdocs/...")
    with open(zip_file, "rb") as f:
        ftp.storbinary(f"STOR {zip_file}", f)

    print("les-renang-deploy.zip uploaded successfully!")
    ftp.quit()

if __name__ == "__main__":
    upload_zip_file()
