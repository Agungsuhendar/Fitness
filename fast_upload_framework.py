import os
import concurrent.futures
from ftplib import FTP

def upload_single_file(args):
    local_path, remote_path = args
    try:
        ftp = FTP("ftpupload.net")
        ftp.login("if0_42562646", "Arkanza0123456")
        
        # Ensure parent directories exist
        parts = remote_path.split("/")
        for i in range(1, len(parts)):
            parent = "/".join(parts[:i])
            try:
                ftp.mkd(parent)
            except Exception:
                pass
                
        with open(local_path, "rb") as f:
            ftp.storbinary(f"STOR {remote_path}", f)
        ftp.quit()
        return True, remote_path
    except Exception as e:
        return False, f"{remote_path}: {e}"

def fast_upload():
    local_dir = "vendor/laravel/framework/src/Illuminate"
    remote_base = "htdocs/vendor/laravel/framework/src/Illuminate"
    
    file_list = []
    for root, dirs, files in os.walk(local_dir):
        for file in files:
            local_file = os.path.join(root, file)
            rel_path = os.path.relpath(local_file, local_dir)
            remote_file = remote_base + "/" + rel_path.replace("\\", "/")
            file_list.append((local_file, remote_file))
            
    print(f"Total Illuminate framework files to upload: {len(file_list)}")
    
    success = 0
    failed = 0
    with concurrent.futures.ThreadPoolExecutor(max_workers=10) as executor:
        results = executor.map(upload_single_file, file_list)
        for res, path in results:
            if res:
                success += 1
                if success % 50 == 0:
                    print(f"Uploaded {success}/{len(file_list)} framework files...")
            else:
                failed += 1
                print(f"Error: {path}")
                
    print(f"\nFAST UPLOAD FINISHED: {success} succeeded, {failed} failed!")

if __name__ == "__main__":
    fast_upload()
