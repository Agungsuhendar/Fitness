from ftplib import FTP

host = "ftpupload.net"
user = "if0_42562646"
password = "Arkanza0123456"

print("Connecting to FTP...")
ftp = FTP(host)
ftp.login(user, password)
ftp.cwd("htdocs")

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

with open("/tmp/env_sql103_inf", "w") as f:
    f.write(env_content)

print("Uploading updated .env with DB_HOST=sql103.infinityfree.com...")
with open("/tmp/env_sql103_inf", "rb") as f:
    ftp.storbinary("STOR .env", f)

ftp.quit()
print("Updated .env successfully!")
