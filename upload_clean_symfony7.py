import os
import concurrent.futures
from ftplib import FTP

def upload_single(args):
    local_file, remote_file = args
    try:
        ftp = FTP("ftpupload.net")
        ftp.login("if0_42562646", "Arkanza0123456")
        
        parts = remote_file.split("/")
        for i in range(1, len(parts)):
            parent = "/".join(parts[:i])
            try:
                ftp.mkd(parent)
            except Exception:
                pass
                
        with open(local_file, "rb") as f:
            ftp.storbinary(f"STOR {remote_file}", f)
        ftp.quit()
        return True
    except Exception as e:
        return False

def upload_symfony_and_composer():
    file_list = []
    
    # 1. Symfony v7.4 files
    for root, dirs, files in os.walk("vendor/symfony"):
        for file in files:
            local_f = os.path.join(root, file)
            remote_f = "htdocs/" + local_f.replace("\\", "/")
            file_list.append((local_f, remote_f))
            
    # 2. Composer autoloader files
    for file in os.listdir("vendor/composer"):
        local_f = os.path.join("vendor/composer", file)
        if os.path.isfile(local_f):
            remote_f = "htdocs/vendor/composer/" + file
            file_list.append((local_f, remote_f))
            
    # 3. Root autoload.php
    file_list.append(("vendor/autoload.php", "htdocs/vendor/autoload.php"))
    
    print(f"Total Symfony v7.4 + Composer autoloader files to upload: {len(file_list)}")
    
    success = 0
    with concurrent.futures.ThreadPoolExecutor(max_workers=3) as executor:
        results = executor.map(upload_single, file_list)
        for res in results:
            if res:
                success += 1
                if success % 100 == 0:
                    print(f"Progress: {success}/{len(file_list)} files uploaded...")
                    
    print(f"Done! Uploaded {success} Symfony 7.4 files successfully.")

if __name__ == "__main__":
    upload_symfony_and_composer()
