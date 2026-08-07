import os
import sys
from ftplib import FTP

def fix_infinity_hosting():
    host = "ftpupload.net"
    user = "if0_42586885"
    password = "Arkanza0123456"
    target_dir = "fitlifehub.site.je/htdocs"

    print("Connecting to InfinityFree FTP...")
    ftp = FTP(host)
    ftp.login(user, password)
    ftp.cwd(target_dir)

    # 1. Create root .htaccess
    htaccess_content = """<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_URI} !^/import_db\.php
    RewriteRule ^$ public/ [L]
    RewriteCond %{REQUEST_URI} !^/import_db\.php
    RewriteRule (.*) public/$1 [L]
</IfModule>
"""
    with open("/tmp/root_htaccess", "w") as f:
        f.write(htaccess_content)

    print("Uploading root .htaccess...")
    with open("/tmp/root_htaccess", "rb") as f:
        ftp.storbinary("STOR .htaccess", f)

    # 2. Upload database.sqlite
    sqlite_local = "database/database.sqlite"
    if os.path.exists(sqlite_local):
        try:
            ftp.mkd("database")
        except:
            pass
        print("Uploading database/database.sqlite...")
        with open(sqlite_local, "rb") as f:
            ftp.storbinary("STOR database/database.sqlite", f)

    # 3. Create production .env file configured with SQLite
    env_content = """APP_NAME="FitLife Hub"
APP_ENV=production
APP_KEY=base64:CdXXYLtLXrZrkwLjcF2ua4j5q9pkoiX9FCN2xY3WTqM=
APP_DEBUG=false
APP_URL=https://fitlifehub.site.je

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=sqlite
DB_DATABASE=/home/vol1_4/infinityfree.com/if0_42586885/fitlifehub.site.je/htdocs/database/database.sqlite

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
"""
    with open("/tmp/prod_env", "w") as f:
        f.write(env_content)

    print("Uploading production .env file...")
    with open("/tmp/prod_env", "rb") as f:
        ftp.storbinary("STOR .env", f)

    ftp.quit()
    print("Fix script completed successfully!")

if __name__ == "__main__":
    fix_infinity_hosting()
