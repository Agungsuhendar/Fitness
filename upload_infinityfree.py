import sys
import os
from ftplib import FTP

def upload_to_infinityfree(host, username, password):
    print(f"Connecting to FTP server {host}...")
    try:
        ftp = FTP(host)
        ftp.login(username, password)
        print("Connected successfully!")
        
        # Change directory to htdocs
        try:
            ftp.cwd('htdocs')
            print("Changed directory to /htdocs")
        except Exception as e:
            print(f"Could not change to htdocs directory: {e}")

        # Upload zip file
        zip_filename = "les-renang-deploy.zip"
        if os.path.exists(zip_filename):
            print(f"Uploading {zip_filename}...")
            with open(zip_filename, 'rb') as f:
                ftp.storbinary(f'STOR {zip_filename}', f)
            print(f"{zip_filename} uploaded successfully!")
        
        # Upload sql file
        sql_filename = "database_dump.sql"
        if os.path.exists(sql_filename):
            print(f"Uploading {sql_filename}...")
            with open(sql_filename, 'rb') as f:
                ftp.storbinary(f'STOR {sql_filename}', f)
            print(f"{sql_filename} uploaded successfully!")

        ftp.quit()
        print("FTP Upload Complete!")
        return True
    except Exception as e:
        print(f"FTP Upload Failed: {e}")
        return False

if __name__ == "__main__":
    if len(sys.argv) >= 4:
        upload_to_infinityfree(sys.argv[1], sys.argv[2], sys.argv[3])
    else:
        print("Usage: python3 upload_infinityfree.py <host> <username> <password>")
