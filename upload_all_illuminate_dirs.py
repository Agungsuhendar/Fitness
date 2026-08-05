import os
import concurrent.futures
from ftplib import FTP

def upload_single(args):
    local_file, remote_file = args
    try:
        ftp = FTP("ftpupload.net")
        ftp.login("if0_42562646", "Arkanza0123456")
        
        # Ensure parent directories exist
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

def fast_illuminate():
    base_illuminate = "vendor/laravel/framework/src/Illuminate"
    
    file_list = []
    for root, dirs, files in os.walk(base_illuminate):
        for file in files:
            local_file = os.path.join(root, file)
            remote_file = "htdocs/" + local_file.replace("\\", "/")
            file_list.append((local_file, remote_file))
            
    print(f"Total Illuminate files to upload: {len(file_list)}")
    
    success = 0
    with concurrent.futures.ThreadPoolExecutor(max_workers=3) as executor:
        results = executor.map(upload_single, file_list)
        for res in results:
            if res:
                success += 1
                if success % 100 == 0:
                    print(f"Progress: {success}/{len(file_list)} files uploaded...")
                    
    print(f"Done! {success} files uploaded.")

if __name__ == "__main__":
    fast_illuminate()
