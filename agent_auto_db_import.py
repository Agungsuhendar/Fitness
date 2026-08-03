import os
import sys
import time
import re
import pymysql
from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.by import By

def auto_db_agent():
    print("=" * 60)
    print("  AUTOMATED AGENT DATABASE IMPORTER v1  ")
    print("=" * 60)

    options = Options()
    options.add_argument('--no-sandbox')
    options.add_argument('--disable-dev-shm-usage')

    print("Launching Selenium Chrome Browser...")
    try:
        driver = webdriver.Chrome(options=options)
    except Exception as e:
        print(f"Error launching Chrome: {e}")
        return

    mysql_host = None
    db_name = None

    try:
        print("Navigating to Account details page...")
        driver.get("https://dash.infinityfree.com/accounts")
        time.sleep(3)

        if "login" in driver.current_url.lower():
            print("\nPlease log in to InfinityFree in the opened Chrome window if needed...")
            while "login" in driver.current_url.lower():
                time.sleep(2)
            print("Login detected! Proceeding...")

        # Open if0_42562646 details
        page_html = driver.page_source
        
        # Search for MySQL Host in page text
        print("Searching for MySQL Host & DB details...")
        body_text = driver.find_element(By.TAG_NAME, "body").text
        
        host_match = re.search(r'sql\d+\.[a-z0-9\.]+', body_text, re.IGNORECASE)
        if host_match:
            mysql_host = host_match.group(0)
            print(f"Found MySQL Host: {mysql_host}")

        db_match = re.search(r'if0_42562646_[a-zA-Z0-9_]+', body_text)
        if db_match:
            db_name = db_match.group(0)
            print(f"Found Database Name: {db_name}")

        # If not found on list, click account link
        if not mysql_host or not db_name:
            links = driver.find_elements(By.TAG_NAME, "a")
            account_link = None
            for link in links:
                href = link.get_attribute("href") or ""
                if "if0_42562646" in href or "accounts/" in href:
                    account_link = link
                    break
            
            if account_link:
                print("Navigating into account details page...")
                account_link.click()
                time.sleep(4)
                
                body_text = driver.find_element(By.TAG_NAME, "body").text
                host_match = re.search(r'sql\d+\.[a-z0-9\.]+', body_text, re.IGNORECASE)
                if host_match:
                    mysql_host = host_match.group(0)
                    print(f"Found MySQL Host: {mysql_host}")

                db_match = re.search(r'if0_42562646_[a-zA-Z0-9_]+', body_text)
                if db_match:
                    db_name = db_match.group(0)
                    print(f"Found Database Name: {db_name}")

        driver.quit()

        if mysql_host and db_name:
            print(f"\nExtracted MySQL Credentials:")
            print(f"  Host: {mysql_host}")
            print(f"  DB Name: {db_name}")
            print(f"  User: if0_42562646")
            
            print("\nExecuting Database Import via pymysql...")
            conn = pymysql.connect(
                host=mysql_host,
                user="if0_42562646",
                password="Arkanza0123456",
                database=db_name,
                autocommit=True
            )
            print("Connected to InfinityFree MySQL database!")
            
            with open("database_dump.sql", "r", encoding="utf-8") as f:
                sql_script = f.read()

            statements = sql_script.split(';')
            cursor = conn.cursor()
            count = 0
            for stmt in statements:
                s = stmt.strip()
                if s:
                    try:
                        cursor.execute(s)
                        count += 1
                    except Exception as ex:
                        pass
            print(f"Successfully executed {count} SQL statements!")
            conn.close()
            print("\nAUTOMATED DATABASE IMPORT COMPLETE!")
        else:
            print("\nCould not automatically locate MySQL Host/DB Name on page.")
            print("Please ensure account and MySQL database are created in InfinityFree cPanel.")

    except Exception as e:
        print("Agent automation notice:", e)

if __name__ == "__main__":
    auto_db_agent()
