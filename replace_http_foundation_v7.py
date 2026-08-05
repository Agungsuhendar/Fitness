import os
from ftplib import FTP, error_perm

def delete_ftp_dir(ftp, dir_path):
    try:
        items = ftp.nlst(dir_path)
    except Exception:
        return
        
    for item in items:
        if item in ['.', '..']:
            continue
        try:
            ftp.delete(item)
        except error_perm:
            delete_ftp_dir(ftp, item)
            
    try:
        ftp.rmd(dir_path)
    except Exception:
        pass

def replace_http_foundation():
    print("Connecting to FTP...")
    ftp = FTP("ftpupload.net")
    ftp.login("if0_42562646", "Arkanza0123456")
    
    target_remote = "htdocs/vendor/symfony/http-foundation"
    print(f"Cleaning old {target_remote} directory...")
    delete_ftp_dir(ftp, target_remote)
    
    local_base = "vendor/symfony/http-foundation"
    print(f"Uploading clean Symfony 7.4 {local_base}...")
    
    count = 0
    for root, dirs, files in os.walk(local_base):
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
            with open(local_file, "rb") as f:
                ftp.storbinary(f"STOR {remote_file}", f)
            count += 1
            
    ftp.quit()
    print(f"SUCCESS! Uploaded {count} clean Symfony 7.4 http-foundation files!")

if __name__ == "__main__":
    replace_http_foundation()
