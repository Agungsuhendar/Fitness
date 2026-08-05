from ftplib import FTP

ftp = FTP('ftpupload.net')
ftp.login('if0_42562646', 'Arkanza0123456')
ftp.cwd('htdocs')

proper_htaccess = """<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
"""

with open("/tmp/proper_htaccess", "w") as f:
    f.write(proper_htaccess)

print("Uploading corrected .htaccess...")
with open("/tmp/proper_htaccess", "rb") as f:
    ftp.storbinary("STOR .htaccess", f)

ftp.quit()
print("Corrected .htaccess uploaded successfully!")
