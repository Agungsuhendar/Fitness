import os
from ftplib import FTP, error_perm

def set_debug_and_create_dirs():
    host = "ftpupload.net"
    user = "if0_42562646"
    password = "Arkanza0123456"

    print("Connecting to InfinityFree FTP...")
    ftp = FTP(host)
    ftp.login(user, password)
    ftp.cwd("htdocs")

    # 1. Update .env with APP_DEBUG=true
    env_content = """APP_NAME="Les Renang Jogja"
APP_ENV=production
APP_KEY=base64:CdXXYLtLXrZrkwLjcF2ua4j5q9pkoiX9FCN2xY3WTqM=
APP_DEBUG=true
APP_URL=http://lesrenangjogja.site.je

LOG_CHANNEL=single
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=sql103.infinityfree.com
DB_PORT=3306
DB_DATABASE=if0_42562646_lesrenang
DB_USERNAME=if0_42562646
DB_PASSWORD=Arkanza0123456

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
"""
    with open("/tmp/prod_env_debug", "w") as f:
        f.write(env_content)

    print("Uploading .env with APP_DEBUG=true...")
    with open("/tmp/prod_env_debug", "rb") as f:
        ftp.storbinary("STOR .env", f)

    # 2. Ensure all storage and bootstrap directories exist
    dirs_to_create = [
        "storage",
        "storage/app",
        "storage/app/public",
        "storage/framework",
        "storage/framework/views",
        "storage/framework/sessions",
        "storage/framework/cache",
        "storage/framework/cache/data",
        "storage/logs",
        "bootstrap",
        "bootstrap/cache"
    ]

    for d in dirs_to_create:
        try:
            ftp.mkd(d)
            print(f"Created directory: {d}")
        except error_perm:
            pass

    ftp.quit()
    print("Debug settings & Storage directories setup completed!")

if __name__ == "__main__":
    set_debug_and_create_dirs()
