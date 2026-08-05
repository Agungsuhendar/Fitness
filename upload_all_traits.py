import os
from ftplib import FTP

def upload_traits_and_support():
    ftp = FTP("ftpupload.net")
    ftp.login("if0_42562646", "Arkanza0123456")
    
    dirs_to_upload = [
        "vendor/laravel/framework/src/Illuminate/Reflection",
        "vendor/laravel/framework/src/Illuminate/Support",
        "vendor/laravel/framework/src/Illuminate/Contracts",
        "vendor/laravel/framework/src/Illuminate/Container",
        "vendor/laravel/framework/src/Illuminate/Foundation",
    ]
    
    count = 0
    for base_dir in dirs_to_upload:
        print(f"Uploading directory {base_dir}...")
        for root, dirs, files in os.walk(base_dir):
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
                except Exception as e:
                    print(f"Error uploading {remote_file}: {e}")
                    
    ftp.quit()
    print(f"Upload complete! Uploaded {count} core Illuminate files.")

if __name__ == "__main__":
    upload_traits_and_support()
