from ftplib import FTP

ftp = FTP('ftpupload.net')
ftp.login('if0_42562646', 'Arkanza0123456')
ftp.cwd('htdocs')

print("Ensuring storage & bootstrap cache directories exist on server...")

dirs_to_create = [
    'storage',
    'storage/app',
    'storage/app/public',
    'storage/framework',
    'storage/framework/cache',
    'storage/framework/cache/data',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
    'bootstrap',
    'bootstrap/cache'
]

for d in dirs_to_create:
    try:
        ftp.mkd(d)
        print(f"Created: {d}")
    except Exception:
        pass

# Delete local cached files in bootstrap/cache on server
try:
    ftp.cwd('bootstrap/cache')
    for f in ftp.nlst():
        if f.endswith('.php') and f != '.' and f != '..':
            try:
                ftp.delete(f)
                print(f"Deleted cached file: bootstrap/cache/{f}")
            except Exception as e:
                print(f"Could not delete {f}: {e}")
    ftp.cwd('../../')
except Exception as e:
    print("bootstrap/cache check error:", e)

# Upload clean .env file
env_content = """APP_NAME="Les Renang Jogja"
APP_ENV=production
APP_KEY=base64:CdXXYLtLXrZrkwLjcF2ua4j5q9pkoiX9FCN2xY3WTqM=
APP_DEBUG=true
APP_URL=http://lesrenangjogja.site.je

LOG_CHANNEL=stderr
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

with open("/tmp/clean_env", "w") as f:
    f.write(env_content)

with open("/tmp/clean_env", "rb") as f:
    ftp.storbinary("STOR .env", f)
print(".env file updated with APP_DEBUG=true & LOG_CHANNEL=stderr!")

ftp.quit()
print("Clean up completed successfully!")
