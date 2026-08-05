import sys
from ftplib import FTP

def fix_infinity_hosting():
    host = "ftpupload.net"
    user = "if0_42562646"
    password = "Arkanza0123456"

    print("Connecting to InfinityFree FTP...")
    ftp = FTP(host)
    ftp.login(user, password)
    ftp.cwd("htdocs")

    # 1. Create root .htaccess to route requests to /public/index.php
    htaccess_content = """<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^$ public/ [L]
    RewriteRule (.*) public/$1 [L]
</IfModule>
"""
    with open("/tmp/root_htaccess", "w") as f:
        f.write(htaccess_content)

    print("Uploading root .htaccess...")
    with open("/tmp/root_htaccess", "rb") as f:
        ftp.storbinary("STOR .htaccess", f)

    # 2. Create production .env file
    env_content = """APP_NAME="Les Renang Jogja"
APP_ENV=production
APP_KEY=base64:CdXXYLtLXrZrkwLjcF2ua4j5q9pkoiX9FCN2xY3WTqM=
APP_DEBUG=false
APP_URL=http://lesrenangjogja.site.je

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=sql103.epizy.com
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
    with open("/tmp/prod_env", "w") as f:
        f.write(env_content)

    print("Uploading production .env file...")
    with open("/tmp/prod_env", "rb") as f:
        ftp.storbinary("STOR .env", f)

    ftp.quit()
    print("Fix script completed successfully!")

if __name__ == "__main__":
    fix_infinity_hosting()
