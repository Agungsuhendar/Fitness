import os
import time
from ftplib import FTP

def upload_symfony7():
    print("Connecting to FTP...")
    time.sleep(2)
    ftp = FTP("ftpupload.net")
    ftp.login("if0_42562646", "Arkanza0123456")
    
    # Priority upload: Request.php
    print("Uploading Priority File: Request.php (Symfony 7.4)...")
    req_file = "vendor/symfony/http-foundation/Request.php"
    with open(req_file, "rb") as f:
        ftp.storbinary(f"STOR htdocs/{req_file}", f)
    print("Priority Request.php uploaded!")
    
    count = 0
    for root, dirs, files in os.walk("vendor/symfony"):
        remote_dir = "htdocs/" + root.replace("\\", "/")
        parts = remote_dir.split("/")
        for i in range(1, len(parts) + 1):
            parent = "/".join(parts[:i])
            try:
                ftp.mkd(parent)
            except Exception:
                pass
        for file in files:
            local_file = os.path.join(root, file)
            remote_file = remote_dir + "/" + file
            try:
                with open(local_file, "rb") as f:
                    ftp.storbinary(f"STOR {remote_file}", f)
                count += 1
                if count % 100 == 0:
                    print(f"Uploaded {count} Symfony 7.4 files...")
            except Exception as e:
                print(f"Error {remote_file}: {e}")
                
    # Upload composer autoloader files
    print("Uploading updated composer autoloader files...")
    for file in os.listdir("vendor/composer"):
        local_f = os.path.join("vendor/composer", file)
        if os.path.isfile(local_f):
            remote_f = "htdocs/vendor/composer/" + file
            try:
                with open(local_f, "rb") as f:
                    ftp.storbinary(f"STOR {remote_f}", f)
            except Exception:
                pass
                
    ftp.quit()
    print("DONE! All Symfony 7.4 files uploaded.")

if __name__ == "__main__":
    upload_symfony7()
