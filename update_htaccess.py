from ftplib import FTP

host = "ftpupload.net"
user = "if0_42562646"
password = "Arkanza0123456"

print("Connecting to FTP...")
ftp = FTP(host)
ftp.login(user, password)
ftp.cwd("htdocs")

htaccess_official = """<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_URI} !^/public/
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
"""

with open("/tmp/official_htaccess", "w") as f:
    f.write(htaccess_official)

print("Uploading official InfinityFree .htaccess...")
with open("/tmp/official_htaccess", "rb") as f:
    ftp.storbinary("STOR .htaccess", f)

ftp.quit()
print("Official .htaccess uploaded successfully!")
